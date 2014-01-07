<?php

class mgt_userinfo extends BaseController {

	public function init(){
		$this->userinfo_model = $this->initModel('userinfo_model');
	}
	//添加
	public function addAction(){
		$this->view->display('userinfo_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		if(!isset($_GET['id']) || empty($_GET['id'])){
			$this->userinfo_model->insertUserinfo($data) ;
		} else {
			$data['id'] = $_GET['id'] ;
			$this->userinfo_model->updateUserinfo($data) ;
		}
		
		if(empty($result)){
			print_r($result) ;
			echo "操作失败:$result" ;
			die() ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$userinfo = array() ;
		if(empty($_POST['username'])){
			$userinfo['username'] = $_POST['username'] ;
		}
		if($_POST['member']!=-1){
			$userinfo['member'] = $_POST['member'] ;
		}
		if(empty($_POST['mobile'])){
			$userinfo['mobile'] = $_POST['mobile'] ;
		}
		if(empty($_POST['email'])){
			$userinfo['email'] = $_POST['email'] ;
		}
		$result = $this->userinfo_model->queryUserinfo($userinfo) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('userinfo_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$userinfo = $this->userinfo_model->queryUserinfoById($id) ;
		$this->view->assign('userinfo',$userinfo) ;
		
		$this->view->display('userinfo_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	private function getPost(){
		$data = array() ;
		$data = $_GET ;
		return $data ;
	}
}

?>