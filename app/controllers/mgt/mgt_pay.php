<?php

class mgt_pay extends BaseController {

	public function init(){
		$this->pay_model = $this->initModel('pay_model');
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->member_model = $this->initModel('member_model');
		
		@session_start ();
		$this->view->assign('_username',$_SESSION [FinalClass::$_session_user]['username']) ;
	}
	//添加
	public function addAction(){
		$userinfolist = $this->userinfo_model->queryUserinfo() ;
		$this->view->assign('userinfolist',$userinfolist) ;
		
		$memberlist = $this->member_model->query() ;
		$this->view->assign('memberlist',$memberlist) ;
		$this->view->display('pay_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		
		$data['orderid'] 	= "NY"+time() ;	//订单号
		$data['ptype'] 		= 1 ;	//缴费类别
		$data['state'] 		= 1 ;	//订单状态，入库未支付0，支付成功1，支付失败-1，退费-2'
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->pay_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->pay_model->update($data) ;
		}
		if(empty($result)){
			echo "操作失败:$result" ;
			die() ;
		}
		$memberlist = $this->member_model->query() ;
		$memberid = $data['memberid'] ;
		$member = "" ;
		foreach ($memberlist as $item){
			if($item['id']==$memberid){
				$member = $item['name'] ;
			}
		}
		$userinfo = array(
			'id'		=>	$data['userid'] ,
			'memberid'	=>	$memberid ,
			'member'	=>	$member ,
		) ;
		$this->userinfo_model->update($userinfo) ;
		
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = array() ;
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$pagenum = $this->pay_model->queryCount($data) ;
		$result = $this->pay_model->query($data) ;
		
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display('pay_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$userinfolist = $this->userinfo_model->queryUserinfo() ;
		$this->view->assign('userinfolist',$userinfolist) ;
		
		$memberlist = $this->member_model->query() ;
		$this->view->assign('memberlist',$memberlist) ;
		
		$id = $_GET['id'] ;
		$object = $this->pay_model->getOneById($id) ;
		$this->view->assign('pay',$object) ;
		
		$this->view->display('pay_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->pay_model->getOneById($id) ;
		$this->view->assign('pay',$object) ;
		
		$this->view->display('pay_show.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	private function getPost(){
		$data = array() ;
		$data = $_POST ;
		return $data ;
	}
}

?>