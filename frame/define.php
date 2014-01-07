<?php
/**
 * 框架和系统的全局常量定义，目录的定义
 *
 */
//系统目录分割符
define('DS', DIRECTORY_SEPARATOR);

//框架目录
define('FRAME_PATH', dirname(__FILE__) .DS);

//工程目录
define('ROOT_PATH', dirname(FRAME_PATH) . DS);
//工程目录
define('APP_PATH', ROOT_PATH . 'app' . DS);
//lib目录
define('LIB_PATH', ROOT_PATH . 'lib'. DS);
//日志目录
define('LOG_PATH', ROOT_PATH . 'log'. DS);
//WWW目录
define('WWW_PATH', ROOT_PATH . 'www'. DS);

//配置文件目录
define('CONFIG_PATH', APP_PATH . 'config'. DS);
//controllers目录
define('CONTROLLER_PATH', APP_PATH . 'controllers'. DS);
//service目录
define('SERVICE_PATH', APP_PATH . 'services'. DS);
//model目录
define('MODEL_PATH', APP_PATH . 'models'. DS);
//VIEW目录
define('VIEW_PATH', APP_PATH . 'views'. DS);

//设置时间
date_default_timezone_set('Asia/Shanghai');

//引入私有配置
if(file_exists(CONFIG_PATH. 'Configs.php')){
	require CONFIG_PATH. 'Configs.php';
}
if(file_exists(CONFIG_PATH. 'FinalClass.php')){
	require CONFIG_PATH. 'FinalClass.php';
}

?>