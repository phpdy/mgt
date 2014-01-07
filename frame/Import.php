<?php

class Import {

	/**
	 * 通用文件加载方法
	 *
	 * @param string $filename
	 * @param string $dir
	 */
	public static function importCommon($filename,$dir=""){
		Import::importPath($filename,ROOT_PATH,$dir) ;
	
//		if (class_exists($filename)){
//			exit("类$filename已经存在，命名冲突");
//		}
		return new $filename() ;
	}
	
	/**
	 * 控制层类加载方法
	 *
	 * @param string $filename
	 * @param string $dir
	 */
	public static function importController($filename,$dir=""){
//		$filename .= "Controller" ;
		$filename = "{$dir}_{$filename}" ;
		Import::importPath($filename,CONTROLLER_PATH,$dir) ;
		
		$app_path = CONTROLLER_PATH . 'AppController.php' ;
		if (is_file($app_path)){
			Import::importPath('AppController',CONTROLLER_PATH) ;
		}
	
//		if (class_exists($filename)){
//			exit("类$filename已经存在，命名冲突");
//		}
		return new $filename() ;
	}
	
	/**
	 * model层类加载方法
	 *
	 * @param string $filename
	 * @param string $dir
	 */
	public static function importModel($filename,$dir=""){
//		$filename .= "Model" ;
		Import::importPath($filename, MODEL_PATH, $dir) ;
		
		$app_path = MODEL_PATH . 'AppModel.php' ;
		if (is_file($app_path)){
			Import::importPath('AppModel',MODEL_PATH) ;
		}
	
//		if (class_exists($filename)){
//			exit("类$filename已经存在，命名冲突");
//		}
		return new $filename() ;
	}

	/**
	 * 服务层类加载方法
	 *
	 * @param string $filename
	 * @param string $dir
	 */
	public static function importService($filename,$dir=""){
		$filename .= "Service" ;
		Import::importPath($filename,SERVICE_PATH,$dir) ;
		
		$app_path = SERVICE_PATH . 'AppService.php' ;
		if (is_file($app_path)){
			Import::importPath('AppService',SERVICE_PATH) ;
		}
	
//		if (class_exists($filename)){
//			exit("类$filename已经存在，命名冲突");
//		}
		return new $filename() ;
	}
	
	
	/**
	 * 公共加载文件方法
	 *
	 * @param string $filename 文件名
	 * @param string $path 目录
	 * @param string $dir 目录下的文件夹名
	 */
	private static function importPath($filename,$path,$dir=""){
		if(empty($filename) || strlen($filename)==0){
			exit("找不到该页面，请确认请求地址正确性!");
		}
		//get $file_path
		$file_path = $path ;
		if(strlen($dir)>0){
			$file_path .= $dir . DS ;
		}
		$file_path .= $filename . '.php' ;
		
		if (!is_file($file_path)){
			exit("找不到该页面，请确认请求地址正确性:$file_path");
		}
		
		require_once $file_path ;
	}
	
}

?>