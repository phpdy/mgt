<?php
/**
 * 系统直接的跳转
 * @author Administrator
 *
 */
class system_model extends BaseModel {
	protected $dbIndex = 'admin';
	
	public function selectSystem(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$log .= "|" ;
		
		$sql = "select * from xy_manager where state=1" ;
		$result = $this->getAll($sql) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}