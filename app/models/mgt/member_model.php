<?php
//会员类型
class member_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbtable = "member" ;
	
	/**
	 * 按ID查询
	 * @param int $id
	 */
	public function queryById($id){
		return $this->getOneById( $id) ;
	}
	
	/**
	 * 查询
	 */
	public function queryAll() {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$result = $this->getList() ;
		
		$log .= '|getList|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}

}

