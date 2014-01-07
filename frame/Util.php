<?php
/**
 * 公共静态方法类
 *
 */
class Util {

	/**
      +----------------------------------------------------------
     * 获取用户IP
      +----------------------------------------------------------
     * @access static
      +----------------------------------------------------------
     * @return string 用户IP
      +----------------------------------------------------------
     */
    public static function getclientip() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }
    
    /**
     * 获取URL内容
     *
     * @param string $url
     * @return string
     */
	public static function getURLContent($url) {
        return file_get_contents($url);
    }
    
    /**
     * URL跳转函数
     *
     * @param string $url
     */
    public static function gotourl($url) {
//    	$url = urlencode($url);
        if (headers_sent ()) {
            echo "<script language='JavaScript' type='text/javascript'>window.location.href='$url';</script>";
            die();
        } else {
            header("Location: " . $url);
            die();
        }
    }
    

	/**
      +----------------------------------------------------------
     * 模拟GET
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param 	$url	 			 提交地址
      +----------------------------------------------------------
     * @return  @String				GET之后的返回值
      +----------------------------------------------------------
     */
	public static function my_file_get_contents($url)
	{
        $ch = curl_init();
        $timeout = 10; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT,"MISE 6.0");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $handles = curl_exec($ch);
        curl_close($ch);
		return $handles;
	}
	
	/**
      +----------------------------------------------------------
     * 模拟POST
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param 	$url	 			提交地址
     * @param	$data				提交POST的数据
      +----------------------------------------------------------
     * @return  @String				POST之后的返回值
      +----------------------------------------------------------
     */
	public static function my_file_post_contents($url,$data)
	{
        $ch = curl_init();
        $timeout = 10; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT,"MISE 6.0");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt ($ch, CURLOPT_URL, $url); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 2); 
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt ($ch, CURLOPT_POST, true); 
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data); 
        
        $handles = curl_exec($ch);
        curl_close($ch);
		return $handles;
	}
    
	/**
	 * 获取当前时间
	 *
	 * @param string $timeformat 时间格式
	 * @return string
	 */
	public static function getNowTime($timeformat = 'Y-m-d H:i:s'){
		return date($timeformat) ;
	}
    
	/**
	 * 对数组中的字符串做utf8编码
	 * json编码是必须
	 *
	 * @param array $array
	 * @return array
	 */
	public static function encodeUtf8($array){
		if (is_array($array))
		foreach ($array as $k=>$v){
			if(is_string($v)){
				$array[$k] = urlencode($v) ;
			}
			elseif(is_array($v) && sizeof($v)>0){
				$array[$k] = Util::encodeUtf8($v) ;
			}
			elseif (is_null($v)){
				$array[$k] = "" ;
			}
		}
		return $array ;
	}
	/**
	 * 对数组中的字符串做utf8解码
	 * json编码是必须
	 *
	 * @param array $array
	 * @return array
	 */
	public static function decodeUtf8($array){
		if (is_array($array))
		foreach ($array as $k=>$v){
			if(is_string($v)){
				$array[$k] = urldecode($v) ;
			}
			elseif(is_array($v)){
				$array[$k] = Util::decodeUtf8($v) ;
			}
			elseif (is_null($v)){
				$array[$k] = "" ;
			}
		}
		return $array ;
	}
	
}

?>