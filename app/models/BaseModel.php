<?php

class BaseModel extends Model {
	protected $dbIndex = 'admin';
	protected $dbtable = "" ;
	protected $items = array();
	protected $start ;//起始时间
	protected $da_pre = "my" ;
	
	function __construct(){
		try {
			$this->dbconfig = Configs::$dbconfig[$this->dbIndex] ;
			parent::__construct() ;
		} catch (Exception $e) {
			log::logError($e->__toString() ) ;
			throw new Exception($e) ;
		}
		$this->da_pre = FinalClass::$_system ;
	}
	
	/**
	 * 查询一条结果
	 * @param string $sql
	 * @param array $params
	 */
	public function getOne($sql,$params=array()){
		$list = $this->querySQL($sql,$params) ;
		
		if (!is_array($list) || sizeof($list)!=1){
			return array() ;
		}
		return $list[0] ;
	}
	
	/**
	 * 根据ID号查询结果
	 * @param string $table
	 * @param int $id
	 */
	public function getOneById($id){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "select * from ".$this->dbtable." where id = ?" ;
		$list = $this->querySQL($sql,array($id)) ;
		
		if (!is_array($list) || sizeof($list)!=1){
			return array() ;
		}
		$log .= "|$sql|" . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $list[0] ;
	}
	public function getList(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "select * from ".$this->dbtable."  order by id" ;
		$list = $this->querySQL($sql,array()) ;
		
		$log .= "|$sql|".sizeof($list).'|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		if (!is_array($list) || sizeof($list)==0){
			return array() ;
		}
		return $list ;
	}
	
	/**
	 * 查询表所有数据
	 * @param string $table
	 */
	public function getAllByTablename($table){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "select * from $table order by id" ;
		$list = $this->querySQL($sql,array()) ;
		
		$log .= "|$sql|" . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $list ;
	}

	/**
	 * 查询所有结果
	 * @param string $sql
	 * @param array $params
	 */
	public function getAll($sql,$params=array()){
		$list = $this->querySQL($sql,$params) ;
		
		return $list ;
	}

	/**
	 * 按条件查询
	 *
	 * @param array $data
	 * @return array
	 */
	public function queryAll($data=array()) {
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
		
		$sql = "select * from ".$this->dbtable." where ".$this->getWhere()." $p1 order by id ";
		$result = $this->querySQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . sizeof($result);
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 按条件查询
	 *
	 * @param array $data
	 * @return array
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
		$size = FinalClass::$_list_pagesize ;
		$start = (empty($data['page'])?0:$data['page'])*$size ;
		
		$sql = "select * from ".$this->dbtable." where ".$this->getWhere()." $p1 order by id limit $start,$size";
		$result = $this->querySQL($sql,$params) ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . sizeof($result);
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	//统计总数
	public function queryCount($data=array()) {
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
		
		$sql = "select count(*) count from ".$this->dbtable." where 1=1 $p1 ";
		$result = $this->getOne($sql,$params) ;
		$pages = (int)(($result['count'] - 1)/FinalClass::$_list_pagesize) + 1 ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $result['count'].">".$pages;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $pages;	
	}
	
	protected function getWhere(){
		return "1=1 " ;
	}
}
