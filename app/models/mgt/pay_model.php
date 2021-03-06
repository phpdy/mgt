<?php
//缴费管理
class pay_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbtable = "lesson_pay" ;
	
	//ptype 订单分类，俱乐部 4
	//pid 子分类ID ，活动ID
	//paytype 支付类别 在线支付/汇款
	//state 状态 未支付 0， 成功1，失败-1 退款 -2
	protected $items = array('orderid','ptype','state','userid','username','pid','money','paytype','paydate','other','recorder','recordtime','createtime') ;

	/**
	 * insert
	 * @param array $data
	 */
	public function insert($data) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

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
		
		$sql = "INSERT INTO lesson_pay ($p1) VALUES ($p2)";
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 更新信息
	 * @param array $data
	 */
	function update($data) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
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
		
		$sql = "update lesson_pay set $p1 where id=?";
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
	public function query($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

		$p1 = "" ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if($value==''){
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "and $key=? " ;
				$params[] = $value ;
			}
		}
		
		$sql = "select * from lesson_pay where ".$this->getWhere()." $p1 order by id desc";
		$result = $this->getAll($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}


	public function getOneById($id){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "select a.*,b.mobile,b.phone,b.email from lesson_pay a,userinfo b where a.userid =b.id  and a.id = ?" ;
		$list = $this->querySQL($sql,array($id)) ;
		
		if (!is_array($list) || sizeof($list)!=1){
			return array() ;
		}
		$log .= "|$sql|" . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $list[0] ;
	}

	public function delete($id) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "update ".$this->dbtable." set state=-3 where id=? ";
		$params = array($id) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql";
		
		$log .= "|".$result ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log);
		return $result ;
	}

	
	protected function getWhere(){
		return " state!=-3 " ;
	}

	protected function getOrder(){
		return " order by id desc " ;
	}
}

