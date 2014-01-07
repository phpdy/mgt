<?php

class Model extends Object {
	protected $dbconfig ;
	protected $pdo ;
	public function __construct(){
		if(!empty($this->dbconfig)){
			$this->getPdo();
		}
	}
	
	protected function getPdo(){
		$config = $this->dbconfig ;
		if (!is_array($config)){
			return  ;
		}
		if(array_key_exists('mysql_conn',$config) && 
		array_key_exists('mysql_user',$config) &&
		array_key_exists('mysql_pwd',$config) &&
		array_key_exists('charset',$config) ){
			try {
				$this->pdo = new PDO($config['mysql_conn'],$config['mysql_user'],$config['mysql_pwd']) ;
				$temp = "SET NAMES ".$config['charset'];
				$this->pdo->exec($temp);
			} catch (PDOException $e) {
				echo ('连接失败:'.$e->getMessage());
				//exit('连接失败:'.$e->getMessage());
			}
		}
	}
	
	protected function getConn(){
		$config = $this->dbconfig ;
		if (!is_array($config)){
			return  ;
		}
		if(array_key_exists('mysql_host',$config) && 
		array_key_exists('mysql_user',$config) &&
		array_key_exists('mysql_pwd',$config) && 
		array_key_exists('mysql_db',$config)){
			$conn = mysql_connect($config['mysql_host'], $config['mysql_user'], $config['mysql_pwd'])
			or die ('Not connected : ' . mysql_error());

			mysql_select_db($config['mysql_db'], $conn) or die ($config['mysql_db'].'not find: ' . mysql_error());
//			$this->pdo = $conn ;
		}
	}
	
	/**
	 * SQL执行，更新和插入
	 * @param string $sql
	 * @param array $params
	 */
	public function excuteSQL($sql,$params=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__."|$sql|" ;
		try {
			$stmt = $this->pdo->prepare($sql);
			if(is_array($params) && sizeof($params)>0 ){
				$params = array_values($params) ;
				foreach ($params as $key=>$value){
					$stmt->bindValue($key+1,$value);
					$log.="$value," ;
				}
			}
			$result = $stmt->execute();
			$log .= "|$result" ;
			$log .= "|".(int)(microtime(true)*1000-$start) ;
			Log::info($log) ;
			
			return $result ;
		} catch (Exception $e) {
			Log::error($log."|".$e->__toString()) ;
		}
	}
	
	/**
	 * SQL查询，返回查询数组
	 * @param unknown_type $sql
	 * @param unknown_type $params
	 */
	public function querySQL($sql,$params=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__."|$sql|" ;
		try {
			$stmt = $this->pdo->prepare($sql);
			if(is_array($params) && sizeof($params)>0 ){
				$params = array_values($params) ;
				foreach ($params as $key=>$value){
					$stmt->bindParam($key+1,$value);
					$log.="$value," ;
				}
			}
			$stmt->execute();
			$list = $stmt->fetchAll(PDO::FETCH_BOTH);
			
			$log .= "|".sizeof($list) ;
			$log .= "|".(int)(microtime(true)*1000-$start) ;
			Log::info($log) ;
			return $list ;
		} catch (Exception $e) {
			Log::error($log."|".$e->__toString()) ;
		}
	}
	
}

?>