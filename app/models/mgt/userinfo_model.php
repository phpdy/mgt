<?php

class userinfo_model extends BaseModel {
	protected $dbIndex = 'admin';
	
	private $items = array('name','password','username','sex','birth','sfz','province','city','address','post','mobile','phone','email','createtime','member') ;

	/**
	 * insert
	 * @param array $data
	 */
	public function insertUserinfo($data) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$log .= "|$name,$username,$password";

		$p1 = "" ;
		$p2 = "" ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value)){
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "$key," ;
				$p2 .= "?," ;
				$params[] = $value ;
			}
		}
		$p1 = substr($p1,0,-1) ;
		$p2 = substr($p2,0,-1) ;
		
		$sql = "INSERT INTO userinfo ($p1) VALUES ($p2)";
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 按ID查询
	 * @param int $id
	 */
	public function queryUserinfoById($id){
		return $this->getOneById("userinfo", $id) ;
	}
	
	/**
	 * 更新信息
	 * @param array $data
	 */
	function updateUserinfo($data) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$log .= "|$name,$username,$password";

		$p1 = "" ;
		$params = array() ;
		
		foreach ($data as $key=>$value){
			if(in_array($key, $this->items)){
				$p1 .= "$key=?," ;
				$params[] = $value ;
			}
		}
		
		$p1 = substr($p1,0,-1) ;
		
		$params[] = $data['id'] ;
		
		$sql = "update userinfo set $p1 where id=?";
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 查询
	 * @param array $data
	 */
	public function queryUserinfo($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$log .= "|$name,$username,$password";

		$p1 = "" ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value) && $key!='member'){
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "and $key=? " ;
				$params[] = $value ;
			}
		}
		
		$sql = "select * from userinfo where 1=1 $p1 order by username ";
		$result = $this->getAll($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}

}

