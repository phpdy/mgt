<?php
//
class index_model extends BaseModel {
	protected $dbIndex = 'phpcms';
	protected $dbtable = "v9_club" ;
	
	protected $items = array('id','title','thumb','fee') ;


	protected function getOrder(){
		return "order by startdate desc" ;
	}
	
	public function getNewsList($pid){
		
		$sql = "select id,catid,title,thumb,description,url,startdate,closedate,fee from v9_club where catid=$pid order by startdate desc" ;
		$result = $this->getAll($sql) ;
		
		foreach ($result as $item){
//			$time = $item['inputtime'] ;
			$newItem = array(
				'id'		=>	$item['id'] ,
				'imgurl'	=>	$item['thumb'] ,
				'title'		=>	$item['title'] ,
				'desc'		=>	$item['description'] ,
				'startdate'	=>	$item['startdate'] ,
				'closedate'	=>	$item['closedate'] ,
//				'time'		=>	$time ,
//				'date'		=>	date('Y-m-d ',$time) ,
			) ;
			$newlist[] = $newItem ;
		}
		
		return $newlist ;
	}

	public function getNewsByid($id){
		$sql = "select id,catid,title,thumb,description,url,inputtime,startdate,closedate,fee from v9_club where id=$id" ;
		$result = $this->getOne($sql) ;
		
		return $result ;
	}
}

