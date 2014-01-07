<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>用户登录</title>
<link href="manager/css/manager.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.login{
	height:30px;
	width:240px;
	padding-top:5px;
	align:center;
}
.text{
	height:18px;
	width:180px;
	padding-top:5px;
	color:#808080
}
</style>
</head>
<body>

<form action="?action=login" name="login" method="post">
<div align="center">
	<div class="login"></div>
	<div class="login" align="left"><img alt="login" src="manager/images/loginbox_dl.jpg"></div>
	<div class="login">用户名：&nbsp;<input type="text" name="username" value="用户名" class="text"></div>
	<div class="login">密&nbsp;&nbsp;&nbsp;码：&nbsp;<input type="password" name="password" class="text"></div>
	<div class="login" align="right"><input type="image" name="submit" src="manager/images/login_button.jpg"/></div>
</div>
</form>

</body>
<script language="javascript" type="text/javascript" src="manager/js/jquery-1.7.1.js" ></script>
<script language="javascript" type="text/javascript" >
$(function() {
	$('input[name="username"]').focus(function(){
		$('input[name="username"]').val('');
	});
	$('input[name="username"]').blur(function(){
		if($('input[name="username"]').val() == ''){
			$('input[name="username"]').val('用户名');
		}
	});
	
	$('input[name="submit"]').click(function() {
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		if(username == ''){
			alert('用户名不能为空!');
			$('input[name="username"]').focus();
			return false;
		}
		
		if(password == ''){
			alert('密码不能为空!');
			$('input[name="password"]').focus();
			return false;
		}
		
		if (username && password) {
//			alert("submit"+$('form')) ;
			
			$('form').submit();
		}
	});
});

<?php if (!empty($message)){
	echo "alert(\"$message\")" ;
}
?>
</script>
</html>