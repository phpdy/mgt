<?php
//会员类型
class member_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbtable = "member" ;
	protected $items = array('name','state') ;
	
	/**
	 * 按ID查询
	 * @param int $id
	 */
	public function queryById($id){
		return $this->getOneById( $id) ;
	}
	

}

