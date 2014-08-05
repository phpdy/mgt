<?php
//会员管理
class userinfo_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbtable = "userinfo" ;
	
	protected $items = array('id','name','password','username','sex','birth',
	'paper','paperno','company','job','province','city','address','post','mobile','phone','email','createtime','memberid','member','other','tag') ;

	public function queryCount($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

		$p1 = "" ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value)){
				continue ;
			}
			
			if($key=='username'){
				$p1 .= "and username like '%$value%' " ;
				continue ;
			}
			if($key=='memberid'){
				$p1 .= "and memberid like '%$value%' " ;
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "and $key=? " ;
				$params[] = $value ;
			}
		}
		
		$sql = "select count(*) count from userinfo where 1=1 $p1 ";
		$result = $this->getOne($sql,$params) ;
		$pages = (int)(($result['count'] - 1)/FinalClass::$_list_pagesize) + 1 ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result['count'].">".$pages;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $pages;	
	}

	public function query($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

		$p1 = "" ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value)){
				continue ;
			}
			
			if($key=='username'){
				$p1 .= "and username like '%$value%' " ;
				continue ;
			}
			if($key=='memberid'){
				$p1 .= "and memberid like '%$value%' " ;
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "and $key=? " ;
				$params[] = $value ;
			}
		}
		$size = FinalClass::$_list_pagesize ;
		$start = (empty($data['page'])?0:$data['page'])*$size ;
		
		$sql = "select * from ".$this->dbtable." where ".$this->getWhere()." $p1 ".$this->getOrder()." limit $start,$size";
		$result = $this->querySQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . sizeof($result);
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}

	public function queryAll($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

		$p1 = "" ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value)){
				continue ;
			}
		
			if($key=='username'){
				$p1 .= "and username like '%$value%' " ;
				continue ;
			}
			if($key=='memberid'){
				$p1 .= "and memberid like '%$value%' " ;
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "and $key=? " ;
				$params[] = $value ;
			}
		}
		
		$sql = "select * from ".$this->dbtable." where ".$this->getWhere()." $p1 ".$this->getOrder();
		$result = $this->querySQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . sizeof($result);
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 更新密码
	 * Enter description here ...
	 */
	function updatePWD($userid,$password) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "update ".$this->dbtable." set password=?  where id=? ";
		$params = array($password,$userid) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql";
		
		$log .= "|".$result ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log);
		return $result ;
	}
	/**
	* 删除
	*/
	function delete($userid) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "delete from ".$this->dbtable." where id=? ";
		$params = array($userid) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql";
		
		$log .= "|".$result ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log);
		return $result ;
	}

	protected function getOrder(){
		return " order by createtime desc " ;
	}
}

