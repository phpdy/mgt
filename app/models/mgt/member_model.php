<?php
//会员类型
class member_model extends BaseModel {
	protected $dbIndex = 'admin';
	
	/**
	 * 按ID查询
	 * @param int $id
	 */
	public function queryById($id){
		return $this->getOneById("member", $id) ;
	}
	
	/**
	 * 查询
	 */
	public function queryAll() {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$result = $this->getAllByTablename("member") ;
		
		$log .= '|getAllByTablename|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}

}

