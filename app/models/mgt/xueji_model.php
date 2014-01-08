<?php
//学籍管理
class xueji_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbtable = "lesson_xueji" ;
	
	private $items = array('cnid','userid','username','start_date','end_date','state','other','modifer','modiftime') ;

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
		
		$sql = "INSERT INTO lesson_xueji ($p1) VALUES ($p2)";
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
		
		$sql = "update lesson_xueji set $p1 where id=?";
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
			if(empty($value)){
				continue ;
			}
			if(in_array($key, $this->items)){
				$p1 .= "and $key=? " ;
				$params[] = $value ;
			}
		}
		
		$sql = "select * from lesson_xueji where 1=1 $p1 order by id ";
		$result = $this->getAll($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}

}

