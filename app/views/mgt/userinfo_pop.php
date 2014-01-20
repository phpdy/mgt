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
			手机号：<input type="text" name="mobile" id="mobile" value="<?php echo @$userinfo['mobile'] ;?>" size="10" maxlength="10"/>
			电子邮箱：<input type="text" name="email" id="email" value="<?php echo @$userinfo['email'] ;?>" size="10" maxlength="10"/>
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
			result += '<tr id="title"><td>ID</td><td>姓名</td><td>性别</td><td>手机号</td><td>操作</td></tr>';

			for(var i=0; i < list.length; i++){
				var style = "trstyle1" ;
				if(i%2==0){
					style = "trstyle2" ;
				}
//				alert(list[i]) ;
				var userinfo = eval(list[i]) ;
				ret = userinfo['id']+","+userinfo['username'] ;
				result += "<tr class='"+style+"'><td>"+(i+1)+"</td><td>"+userinfo['username']+"</td><td>"+(userinfo['sex']==1?"男":"女")+"</td><td>"+userinfo['mobile']+"</td><td><input type='button' value='选择' onclick=\"retrunValue('"+ret+"')\"></td></tr>" ;
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