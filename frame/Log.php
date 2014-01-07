<?php

class Log {
//	private static $format = "Y-m-d H:i:m" ;
	
	public static function info($info){
//		Log::write($info,"info") ;
		Log::log4php()->info($info);
	}
	public static function debug($info){
//		Log::write($info,"debug") ;
		Log::log4php()->debug($info);
	}
	public static function error($info){
//		Log::write($info,"error") ;
		Log::log4php()->error($info);
	}
	
	public static function warn($info){
		Log::log4php()->warn($info);
	}
	
	public static function logBehavior($info){
		Log::log4php()->info($info);
	}
	public static function logBusiness($info){
		Log::log4php()->info($info);
	}
	
	/**
	 * 获取log4php的对象
	 *
	 * @return LoggerRoot
	 */
	private static function log4php(){
		Lib::import('Log4php') ;
		return Log4php::getLoger() ;
	}
}

?>