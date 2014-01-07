<?php
class rolse_model extends BaseModel {
	protected $dbIndex = 'admin';
	
	/**
	 * insert
	 * @param array $data
	 */
	public function insertRolse($data) {
		$start = microtime ( true ) * 1000;
		$log = __CLASS__ . "|" . __FUNCTION__;
		
		$rolse = $data ['rolse'];
		$info = $data ['info'];
		$modules = $data ['modules'];
		$log .= "|$rolse,$info,$modules";
		
		$sql = "insert into " . $this->da_pre . "_rolse (rolse,info,modules) values(?,?,?)";
		$params = array($rolse,$info,$modules) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql";
		
		$log .= "|" . $result;
		$log .= "|" . ( int ) (microtime ( true ) * 1000 - $start);
		Log::logBehavior ( $log );
		return $result;
	}

	/**
	 * update
	 * @param array $data
	 */
	public function updateRolse($data) {
		$start = microtime ( true ) * 1000;
		$log = __CLASS__ . "|" . __FUNCTION__;
		
		$id = $data ['id'];
		$rolse = $data ['rolse'];
		$info = $data ['info'];
		$modules = $data ['modules'];
		$log .= "|$id,$rolse,$modules";
		
		$sql = "update " . $this->da_pre . "_rolse set rolse=?,info=?,modules=? where id=?" ;
		$params = array($rolse,$info,$modules,$id) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql";
		$log .= "|" . $result;
		$log .= "|" . ( int ) (microtime ( true ) * 1000 - $start);
		Log::logBehavior ( $log );
		return $result;
	}

	/**
	 * select
	 * @param array $data
	 */
	public function selectRolse($data = array()) {
		$start = microtime ( true ) * 1000;
		$log = __CLASS__ . "|" . __FUNCTION__."|";
		
		$sql = "select * from " . $this->da_pre . "_rolse where 1=1";
		$params = array() ;
		
		if (! empty ( $data['id'] )) {
			$sql .= " and id=?";
			$params[] = $data['id'] ;
			$log .= "$data[id],";
		}
		if (! empty ( $data ['ids'] )) {
			$sql .= " and id in ($data[ids])";
		}
		$sql .= " ORDER BY id DESC ";
		$result = $this->getAll ( $sql,$params);
		$log .= "|$sql";
		
		$log .= "|" . sizeof ( $result );
		$log .= "|" . ( int ) (microtime ( true ) * 1000 - $start);
		Log::logBehavior ( $log );
		return $result;
	}
	
}