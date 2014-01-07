<?php
/**
 * lib目录下相关的静态方法。
 *
 */
class Lib {
	private static $_importFiles = array() ;
	
	public static function import($class, $dir='') {
		$key = $dir.$class;
    	if (isset(Lib::$_importFiles[$key])) {
	        return true ;
	    }
	    
	    $filename   =  LIB_PATH . ('' == $dir ? '' : $dir . DS) . $class . '.php';
		if(is_file($filename)){
            require_once $filename;
            Lib::$_importFiles[$key] = true ;
            return true ;
        }
        return false ;
    }
    
    static function safeS($str, $len=0) {
        $arr = array();
        if ($len) {
            if (is_array($str)) {
                foreach ($str as $value) {
                    $arr[] = Lib::strSub($value, 0, $len);
                }
                $str = $arr;
            } else {
                $str = Lib::strSub($str, 0, $len);
            }
        }
        //if(!get_magic_quotes_gpc()) {
        $str = is_array($str) ? array_map(array('Lib', 'safeS'), $str) : addslashes($str);
        //}

        return trim($str);
    }
}

?>