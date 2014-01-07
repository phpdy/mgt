<?php

class Log4php {
	private static $logger ;
	
	/**
	 * 获取log对象
	 *
	 * @return LoggerRoot
	 */
	public static function getLoger(){
		if(is_null(Log4php::$logger)){
			Log4php::config();
		}
		return Log4php::$logger ;
	}
	
	private static function config(){
		require_once 'log4php-2.2.1/Logger.php';
		$filename = "log4php.properties" ;
		$path = CONFIG_PATH . $filename ;
		if(file_exists($path)){
			Logger::configure($path);
		} else {
			Logger::configure($filename);
		}
		Log4php::$logger = Logger::getRootLogger();
	}
}


?>