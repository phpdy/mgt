$("#sub").live("click",function(){
	var passbefore = $("#passbefore").val() ;
	var pass = $("#pass").val() ;
	var repass = $("#repass").val() ;
        if(passbefore == ''){
        	alert('ÇëÌîĞ´Ô­ÃÜÂë');
        	return false;
        }
        if(pass == ''){
        	alert('ÇëÌîĞ´ĞÂÃÜÂë');
        	return false;
        }
        if(repass == ''){
        	alert('ÇëÌîĞ´È·ÈÏÃÜÂë');
        	return false;
        }
        if(pass != repass){
        	alert('ĞÂÃÜÂëÓëÈ·ÈÏÃÜÂë²»Ò»ÖÂ');
        	return false;
        }
  });