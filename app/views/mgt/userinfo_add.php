<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="js/Calendar1.js" ></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.9.1.min.js" ></script>
</head>
<body>

<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>会员信息录入</h2></div>
        <form method="post" name="form" id="form" action="?dir=mgt&control=userinfo&action=submit">
            <div id="gamemain">
                <?php include 'userinfo_table.php';?>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
$(function(){
	$("#name").change(function(){
		var name = $('#name').val() ;
		if(name.length==""){
			alert("请输入用户名，用户名必须邮箱地址或学号。") ;
			$("#name").val("") ;
			$("#name").focus() ;
			return false ;
		}

		var Regex = /^(?:\w+\.?)*\w+@(?:\w+\.)*\w+$/;
		var Regex2 = /^(cn|CN|NE|ne)\d{7}$/ ;
		if (!Regex.test(name) && !Regex2.test(name)) {
			alert("请输入正确的电子邮件地址或学号！");
			$("#name").val("") ;
			$("#name").focus() ;
			return false;
		}
		
		$.post("./index.php?dir=mgt&control=userinfo&action=check",{name:$('#name').val()},function(data){
			//alert(data) ;
			if(data==0){
				alert("用户名已被使用，请重新输入") ;
				$("#name").val("") ;
				$("#name").focus() ;
				return false ;
			}
		});
		return true ;
	});

	$("#password").change(function(){
		var pwd = $('#password').val() ;
		//alert(pwd) ;
		//alert(pwd.length) ;
		if(pwd.length<6){
			alert("密码长度不能少于6位数字或字母。") ;
			$("#password").val("") ;
			$("#password").focus() ;
			return false ;
		}
		return true ;
	});
	
	$("#repassword").change(function(){
		if($('#password').val() != $('#repassword').val()){
			alert("两次输入密码不一致，请重新输入") ;
			//$("#password").val("") ;
			$("#repassword").val("") ;
			$("#repassword").focus() ;
			return false ;
		}
		return true ;
	});

	$("#registsubmit").click(function(){
		if(confirm('你确定要提交数据吗？')){
			var name = $('#name').val() ;
			var repassword = $('#repassword').val() ;
			var username = $('#username').val() ;
			if(name=="" || repassword=="" || username=="" ){
				alert("请填写完整信息") ;
				return false ;
			}
			
//			alert("ok") ;
//			alert(document.form.action) ;
//			document.form.submit();
//			$("#myForm").action="reg.php?action=regSubmit";
//			$("#myForm").submit();
			$("#form").submit();
		    return true;
		}
	});
	
})

</script>