<?php
/**
 * 启动文件
 */
//定义目录和常量，加载配置文件
require 'define.php';

//引入公共静态类
require FRAME_PATH. 'Lib.php';
require FRAME_PATH. 'Util.php';
require FRAME_PATH. 'Log.php';

//引入核心加载
require FRAME_PATH. 'core.php';
?>