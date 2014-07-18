<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>信息查询</h2></div>
        
        <div id="gamemain">
        <form method="post" action="">
       		姓名：<input type="text" name="username" id="username" value="<?php echo @$userinfo['username'] ;?>" size="10" maxlength="10"/>
			手机号：<input type="text" name="mobile" id="mobile" value="<?php echo @$userinfo['mobile'] ;?>" size="12" maxlength="11"/>
			电子邮箱：<input type="text" name="email" id="email" value="<?php echo @$userinfo['email'] ;?>" size="20" maxlength="20"/>
			<input type="button" id="button" name="button" value="查询">
        </form>
        </div>
        <div id="list"></div>
	</div>
</div>
</body>
</html>
<script language="javascript" type="text/javascript" src="manager/js/jquery-1.7.2.min.js" ></script>
<script language="javascript" type="text/javascript" >
$(document).ready(function(){
	$("#button").click(function(){
//		alert("sd");
//		alert("sd"+$('#username').val());
		$.get("index.php?dir=mgt&control=userinfo&action=popup",{username:$('#username').val(),memberid:$("#memberid").val(),mobile:$('#mobile').val(),email:$('#email').val()},
			function(data){
//			alert(data);
			var list = eval(data);
			
			result = '<table class="GF-listTab">';
			result += '<tbody>';
			result += '<tr id="title"><td>姓名</td><td>手机号</td><td>邮箱地址</td><td>会员类型</td><td>操作</td></tr>';

			for(var i=0; i < list.length; i++){
				var style = "trstyle1" ;
				if(i%2==0){
					style = "trstyle2" ;
				}
//				alert(list[i]) ;
				var userinfo = eval(list[i]) ;
				ret = userinfo['id']+","+userinfo['username']+","+userinfo['member'] ;
				result += "<tr class='"+style+"'><td>"+userinfo['username']+"</td><td>"+userinfo['mobile']+"</td><td>"+userinfo['email']+"</td><td>"+userinfo['member']+"</td><td><input type='button' value='选择' onclick=\"retrunValue('"+ret+"')\"></td></tr>" ;
			}
			result += "</tbody></table>";

//			alert(result) ;
			$("#list").html(result);
		});
	});
});

function retrunValue(value){
//	alert(123) ;
//	alert(value) ;
//	var obj = window.dialogArguments;
//	alert(obj) ;
//	obj.value = value ;
	window.returnValue=value;
	window.close();  
}
</script>