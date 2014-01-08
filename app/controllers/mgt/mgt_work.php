<?php

class mgt_work extends BaseController {

	public function init(){
		$this->work_model = $this->initModel('work_model');
		$this->member_model = $this->initModel('member_model');
	}
	//添加
	public function addAction(){
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		$this->view->display('work_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->work_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->work_model->update($data) ;
		}
		if(empty($result)){
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
		
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		
		$data = array() ;
		if(!empty($_POST['memberid'])){
			$data['memberid'] = $_POST['memberid'] ;
		}
		$result = $this->work_model->query($data) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('work_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		
		$id = $_GET['id'] ;
		$object = $this->work_model->getOneById($id) ;
		$this->view->assign('work',$object) ;
		
		$this->view->display('work_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		
		$id = $_GET['id'] ;
		$object = $this->work_model->getOneById($id) ;
		$this->view->assign('work',$object) ;
		
		$this->view->display('work_show.php');
		
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