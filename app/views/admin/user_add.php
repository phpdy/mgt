<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>用户添加</title>
<link rel="stylesheet" href="manager/css/style.css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <!--<h5>用户添加</h5><br>-->
        <div id="gamefeatures"><h2>用户添加</h2></div>
        <form action="index.php?dir=admin&control=user&action=add_sub" method="post">
            <div id="gamemain">
                <table>
                    <tbody>
                    <tr><td class="title"><b>用户名:</b></td><td><input type="text" name="name"></td></tr>
                    <tr><td class="title"><b>真实姓名:</b></td><td><input type="text" name="username"></td></tr>
                    <tr><td class="title"><b>密码:</b></td><td><input type="text" name="password"></td></tr>
                    <tr><td colspan="2"><input class="sub-btn" type="submit" id="sub" value="提交" name="sub"></td></tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>