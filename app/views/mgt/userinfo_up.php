<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="js/Calendar1.js" ></script>
</head>
<body>

<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>会员信息修改</h2></div>
        <form method="post" action="?dir=mgt&control=userinfo&action=submit">
            <input type="hidden" value="<?php echo $userinfo['id']; ?>" name="id">
            <div id="gamemain">
                <?php include 'userinfo_table.php';?>
            </div>
        </form>
    </div>
</div>
</body>
</html>