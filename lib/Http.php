<?php

class Http {

	public function getHttp($url,$method=1){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $method);
		curl_setopt($ch, CURLOPT_HEADER, 0);
//		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		
//		curl_setopt($ch, CURLOPT_REFERER, "");
//		curl_setopt($ch, CURLOPT_USERAGENT, "");
//		curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//不直接输出，返回到变量
		$result = curl_exec($ch);
//		$result = explode(',', $result);
		curl_close($ch);
//		print_r($result);
		return $result ;
	}
}

$h = new Http() ;
$result = $h->getHttp("http://localhost/index.php?module=interface&control=codelist&check=no&giftid=22");
//print_r($result) ;
echo "=====" ;
print_r($result) ;
$r = json_decode($result) ;
print_r($r) ;
?>