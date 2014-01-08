<?php

class mgt_score extends BaseController {

	public function init(){
		$this->score_model = $this->initModel('score_model');
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->work_model = $this->initModel('work_model');
	}
	//添加
	public function addAction(){
		$worklist = $this->work_model->query() ;
		$this->view->assign('worklist',$worklist) ;
		$this->view->display('score_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->score_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->score_model->update($data) ;
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
		
		$worklist = $this->work_model->query() ;
		$this->view->assign('worklist',$worklist) ;
		
		$data = array() ;
		if(!empty($_POST['cnid'])){
			$data['cnid'] = $_POST['cnid'] ;
		}
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['state'])){
			$data['state'] = $_POST['state'] ;
		}
		$result = $this->score_model->query($data) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('score_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$worklist = $this->work_model->query() ;
		$this->view->assign('worklist',$worklist) ;
		
		$id = $_GET['id'] ;
		$object = $this->score_model->getOneById($id) ;
		$this->view->assign('score',$object) ;
		
		$this->view->display('score_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->score_model->getOneById($id) ;
		$this->view->assign('score',$object) ;
		
		$this->view->display('score_show.php');
		
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