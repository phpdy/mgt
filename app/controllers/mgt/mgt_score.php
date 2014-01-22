<?php

class mgt_score extends BaseController {

	public function init(){
		$this->score_model = $this->initModel('score_model');
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->work_model = $this->initModel('work_model');
		
		@session_start ();
		$this->view->assign('_username',$_SESSION [FinalClass::$_session_user]['username']) ;
	}
	//添加
	public function addAction(){
		$memberid = $_GET['memberid'] ;
		$worklist = $this->work_model->query(array('memberid'=>$memberid)) ;
		
		$this->view->assign('memberid',$memberid) ;
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
		$data['memberid'] = $_REQUEST['memberid'] ;
		if(!empty($_POST['cnid'])){
			$data['cnid'] = $_POST['cnid'] ;
		}
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['workid'])){
			$data['workid'] = $_POST['workid'] ;
		}
		if(!empty($_POST['state'])){
			$data['state'] = $_POST['state'] ;
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$pagenum = $this->score_model->queryCount($data) ;
		$result = $this->score_model->query($data) ;
		
		$this->view->assign('memberid',$_REQUEST['memberid']) ;
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$data) ;
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
		
		$memberid = $_GET['memberid'] ;
		$this->view->assign('memberid',$memberid) ;
		
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