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
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$this->userinfo_model->insertUserinfo($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$this->userinfo_model->updateUserinfo($data) ;
		}
		if(empty($result)){
			echo "操作失败" ;
			die() ;
		}
		print_r($data) ; die() ;
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$userinfo = array() ;
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
		
		$this->view->display('$userinfo_up.php');
		
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