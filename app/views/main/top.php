<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>51wan</title>
<link href="manager/css/frame.css" rel="stylesheet" type="text/css" />
</head>
<body class="showmenu">
<div class="pagemask"></div>
<iframe class="iframemask"></iframe>
<div class="head">
<div class="top">
<div class="top_logo">
	<h1>系统管理后台</h1>
<!--	<img src="manager/images/logo.jpg"  height="37" />-->
</div>
<div class="top_link">
<ul>
	<li class="welcome">
	<?php
//	print_r($_SESSION [FinalClass::$_session_user]) ;
	echo  $_SESSION [FinalClass::$_session_user]['username'] ;
	?> ，您好！</li>
	<li><a href="manager.php?action=loginout" target="_top">注销</a></li>
</ul>
</div>

<div class="topnav">
<div class="nav" id="nav"></div>
<div class="sysmsg">
<div class="scroll">
<?php 
	if (isset($system) && is_array($system)){
		foreach ($system as $item){
			$name = $item['name'] ;
			$url = $item['url'] ;
			
			echo "<a href='$url' target='_blank'>$name</a>" ;
		}
	}
?>
</div>
</div>
</div>

</div>
</div>

</body>
</html>
