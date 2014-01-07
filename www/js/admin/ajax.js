function showMs(reqText, req, divID){
	var type = req.getResponseHeader("Content-Type");
	if (type.indexOf("text/html") == 0) {
		if(divID) {
			var begin = reqText.indexOf("<!--begin" + divID + "-->");
			var end = reqText.indexOf("<!--end" + divID + "-->");
			var innerText = reqText.slice(begin, end);
			var div = document.getElementById(divID);	
			div.innerHTML = innerText;
        } else {
			document.close();
			document.write(reqText);	
		}
	} else {
		if (divID) {
			var div = document.getElementById(divID);		
			div.innerHTML = reqText;
		} else {
			document.close();
			alert(reqText);	
		}
	}
}

function newXMLHttpRequest(){
    var xmlreq = false;
    if (window.XMLHttpRequest) {
        xmlreq = new XMLHttpRequest();        
    } else if (window.ActiveXObject) {        
    	try {
            xmlreq = new ActiveXObject("Msxml2.XMLHTTP");                
        } catch (e1) {            
			try { 
				xmlreq = new ActiveXObject("Microsoft.XMLHTTP");                    
			} catch (e2) {                
				xmlreq = false;
			}
    	}
    }
    return xmlreq;
}

function getReadyStateHandler(req, responseHandler, isXML, submitButtonID, div){
    return function(){ 
        if (req.readyState == 4) { 
		hideLoading(submitButtonID);          
            if (req.status == 200) {
				if(isXML) {
					responseHandler(req.responseXML, req, div);
				} else {
					responseHandler(req.responseText, req, div);
				}          
            } else {            
                alert("HTTP error " + req.status + ": " + req.statusText);
            }
        }
    }
}

function showLoading(submitButtonID) {
	var div = document.getElementById("loadingDiv");
	var loadingDiv = document.getElementById("loading");	
	if(div == null) {
		div = document.createElement("DIV");
		div.id = "loadingDiv";
		div.style.position = "absolute";
		div.style["z-index"] = "3";
		div.style["left"] = "60%";
		div.style["top"] = "60%";
		div.align="center";
		var st = getScrollTop();
		div.style.top = document.body.clientHeight/2 - div.offsetHeight/2 + st;
		div.style.left = document.body.clientWidth/2 - div.offsetWidth/2;
		div.innerHTML = "<img src=\"" + path +"/img/ajaxloading.gif\" width=\"16\" height=\"16\" alt=\"Loading...\" />";
	}
	loadingDiv.appendChild(div);
	div.style.display = "";
	var submitButton = document.getElementById(submitButtonID);
	if(submitButton != null){
		submitButton.disabled = true;
	}
}

function hideLoading(submitButtonID) {
	var div = document.getElementById("loadingDiv");
	if(div != null) {
		div.style.display = "none";	
	}
	var submitButton = document.getElementById(submitButtonID);
	if (submitButton != null) {
		submitButton.disabled = false;
	}
}

function myAjax(){
	this.xmlreq = newXMLHttpRequest();
    this.method = "POST";
    this.url = "";
    this.isasyn = true;
    this.paras = "";
    this.isXML = false;
    this.responseHandler = showMs;
    this.submitButtonID = "query";
    this.isShowLoading = false;
    this.innerDiv = "";
    this.sendReq = function sendRequest(){
		if(this.isShowLoading == null) {
			this.isShowLoading = true;
		}
		if(this.isShowLoading) {
			showLoading(this.submitButtonID);	
		}
		var req = newXMLHttpRequest();
		if(this.isasyn && this.responseHandler != null) {
			req.onreadystatechange = getReadyStateHandler(req, this.responseHandler, this.isXML, this.submitButtonID, this.div);
		}
		req.open(this.method, this.url, this.isasyn);
    	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    	req.send(encodeURI(this.paras));
		if(!this.isasyn  && this.responseHandler != null) {
			if (req.readyState == 4) {
				if (this.isShowLoading) {
					hideLoading(this.submitButtonID);
				}	
            	if (req.status == 200) {
					if(this.isXML) {
						this.responseHandler(req.responseXML, req, this.div);
					} else {
						this.responseHandler(req.responseText, req, this.div);
					}          
            	} else {            
                	alert("HTTP error " + req.status + ": " + req.statusText);
            	}
        	}
		}
	};
}

function Point(iX, iY){
    this.x = iX;
    this.y = iY;
}

function fGetXY(aTag){
    var oTmp = aTag;
    var pt = new Point(0, 0);
    do {
        pt.x += oTmp.offsetLeft;
        pt.y += oTmp.offsetTop;
        oTmp = oTmp.offsetParent;
    }
    while (oTmp.tagName != "BODY");
    return pt;
}

String.prototype.Trim = function () {
	return this.replace(/(^\s*)|(\s*$)/g, "");
};
String.prototype.LTrim = function () {
	return this.replace(/(^\s*)/g, "");
};
String.prototype.Rtrim = function () {
	return this.replace(/(\s*$)/g, "");
};

function isShort(num){
    var b = true;
    var re = /^[1-9]+[0-9]*]*$/; //判断正整数

    if (!re.test(num)) {
        if (num != '0') {
            alert("必须是正整数！");
            b = false;
        }
    }
    else 
        if (num > 32767) {
            alert("数据太大！必须小于32767");
            b = false;
        }
    return b;
}

function LTrim(str){
    var i;
    for (i = 0; i < str.length; i++) {
        if (str.charAt(i) != " " && str.charAt(i) != " ") 
            break;
    }
    str = str.substring(i, str.length);
    return str;
}

function RTrim(str){
    var i;
    for (i = str.length - 1; i >= 0; i--) {
        if (str.charAt(i) != " " && str.charAt(i) != " ") 
            break;
    }
    str = str.substring(0, i + 1);
    return str;
}

function Trim(str){
    return LTrim(RTrim(str));
}

function getScrollTop(){
    var scrollPos;
    if (typeof window.pageYOffset != 'undefined') {
        scrollPos = window.pageYOffset;
    }else if(typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
        scrollPos = document.documentElement.scrollTop;
    }else if(typeof document.body != 'undefined') {
    	scrollPos = document.body.scrollTop;
    }
    return scrollPos;
}
