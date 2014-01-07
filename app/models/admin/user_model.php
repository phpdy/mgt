<?php

class user_model extends BaseModel {
	protected $dbIndex = 'admin';
	
	/**
	 * 用户登录
	 * @param string $username
	 */
	function getUserInfo($username) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$log .= "|$username" ;
		$sql = "select * from ".$this->da_pre."_user where name=?";
		$result = $this->getOne($sql,array($username)) ;
		$log .= "|$sql" ;
		
		$log .= "|".is_array($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}

	/**
	 * 查询出所有的用户
	 */
	function getUserList() {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "select * from ".$this->da_pre."_user order by name";
		$result = $this->getAll($sql) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}

	/**
	 * 更新密码
	 * Enter description here ...
	 */
	function updatePWD($userid,$password) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "update ".$this->da_pre."_user set password=?  where id=? ";
		$params = array($password,$userid) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql";
		
		$log .= "|".$result ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log);
		return $result ;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param string $name
	 * @param string $username
	 * @param string $password
	 */
	public function addUser($name,$username,$password) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$log .= "|$name,$username,$password";

		$sql = "INSERT INTO ".$this->da_pre."_user (name,username,password,registdate) VALUES (?,?,?,?)";
		$params = array($name,$username,$password,date("Y-m-d h:i:s")) ;
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql;
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	//根据userid获取真实姓名
	public function getusername($userid) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$log .= '|' . $userid ;
		
		$sql = "SELECT * FROM ".$this->da_pre."_user WHERE id = ?";
		$result = $this->getOne($sql,array($userid));
		
		$log .= '|' . $sql;
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;
	}

	/**
	 * delete
	 * @param int $userid
	 */
	public function deleteUserByUserId($userid) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$log .= '|' . $userid ;
		
		$sql = "delete FROM ".$this->da_pre."_user WHERE id = ?";
		$result = $this->findObjectById($sql, $userid) ;
		
		$log .= '|' . $sql;
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;
	}
	


}

