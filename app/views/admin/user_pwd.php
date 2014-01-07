<html>
<head>
	<meta charset="UTF-8">
	<title>修改密码</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
<script src="manager/js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>修改密码</h2></div>
        <form method="get" action="">
            <input type="hidden" value="admin" name="dir">
            <input type="hidden" value="user" name="control">
            <input type="hidden" value="up" name="action">
            <input type="hidden" value="<?php echo $userid;?>" name="userid">
            <div id="gamemain">
                <table>
                    <tbody><tr><td class="title"><b>新密码:</b></td><td><input type="password" id="password" name="password"></td></tr>
                    <tr><td colspan="2"><input class="sub-btn" type="submit" id="sub" value="提交" name="sub"></td></tr>
                    </tbody></table>
            </div>
        </form>
    </div>
</div>
</body>
</html>
