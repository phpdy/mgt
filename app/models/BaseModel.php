<?php

class BaseModel extends Model {
	protected $dbIndex = 'admin';
	protected $dbtable = "" ;
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
}
