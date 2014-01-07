<?php
header("content-type:text/html; charset=utf-8") ;
//设置默认控制器 
if (empty($_GET['dir'])) {
	$_GET['dir'] = "main";
}
//设置默认控制器 
if (empty($_GET['control'])) {
	$_GET['control'] = "index";
}
//设置默认Action
if (empty($_GET['action'])) {
	$_GET['action'] = 'default';
}
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'frame' .DIRECTORY_SEPARATOR . 'start.php';
