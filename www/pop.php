<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>test</title>
<link rel="stylesheet" href="css/admin/style.css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>test</h2></div>
        <table class="GF-listTab">
            <tbody>
                <tr>
	            	<td><input type="text" value="" onclick="pop(this)"/></td>
	            <tr>
			
			</tbody>
			</table>
    </div>
</div>
</body>




<script language="javascript" type="text/javascript" >
function pop(obj){
	var url = "a.php" ;
	url = "index.php?dir=mgt&control=userinfo&action=pop" ;
	//window.open(url, "op", 'height=500,width=300,scrollbars=no,z-look=yes,resizable=no,menubar=yes,location=no,directories=no,alwaysRaised=yes,depended=yes') ;
	var returnValue = window.showModalDialog(url,obj,"dialogHeight=400px;dialogWidth=600px;dialogLeft=500;dialogTop=100;center=yes;help=no;resizable=no;scroll=no;status=no;") ;
	//window.showModalDialog(url,"","dialogWidth:500px;dialogHeight:300px;status:no;directories:yes;scrollbars:no;Resizable=no;location=no;location=no;titlebar=no;menubar=no") ;
	//window.showModalDialog(url,"",'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') ;
	//window.showModelessDialog(url,"","dialogHeight=200px;dialogWidth=300px;dialogLeft=500;dialogTop=100;center=yes;help=no;resizable=no;status=no;scroll=no") ;
	alert(returnValue) ;
	obj.value = returnValue ;
}
</script>
