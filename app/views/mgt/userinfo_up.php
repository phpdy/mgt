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
        <div id="gamefeatures"><h2>会员信息修改</h2></div>
        <form method="post" name="form" id="form" action="?dir=mgt&control=userinfo&action=submit">
            <input type="hidden" value="<?php echo $userinfo['id']; ?>" name="id">
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
	$("#registsubmit").click(function(){
		if(confirm('你确定要提交数据吗？')){
			var username = $('#username').val() ;
			if(username=="" ){
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