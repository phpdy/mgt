<?php

class mgt_userinfo extends BaseController {

	public function init(){
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->member_model = $this->initModel('member_model');
	}
	//添加
	public function addAction(){
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		$this->view->display('userinfo_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		$remberlist = $this->member_model->queryAll() ;
		foreach ($remberlist as $item){
			if($item['id']==$data['memberid']){
				$data['member'] = $item['name'] ;
			}
		}
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->userinfo_model->insertUserinfo($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->userinfo_model->updateUserinfo($data) ;
		}
		$_POST=null ;
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
		
		$userinfo = array() ;
		if(!empty($_POST['username'])){
			$userinfo['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['memberid'])){
			$userinfo['memberid'] = $_POST['memberid'] ;
		}
		if(!empty($_POST['mobile'])){
			$userinfo['mobile'] = $_POST['mobile'] ;
		}
		if(!empty($_POST['email'])){
			$userinfo['email'] = $_POST['email'] ;
		}
		$result = $this->userinfo_model->queryUserinfo($userinfo) ;
		
		$this->view->assign('userinfo',$userinfo) ;
		$this->view->assign('list',$result) ;
		$this->view->display('userinfo_list.php');
		
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
		$userinfo = $this->userinfo_model->getOneById($id) ;
		$this->view->assign('userinfo',$userinfo) ;
		
		$this->view->display('userinfo_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$userinfo = $this->userinfo_model->getOneById($id) ;
		$this->view->assign('userinfo',$userinfo) ;
		
		$this->view->display('userinfo_show.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	public function userinfoAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$username = $_GET['username'] ;
		$userinfo = $this->userinfo_model->queryByUsername($username) ;
		
		echo json_encode($userinfo) ;
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function popAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		
		$this->view->display('userinfo_pop.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	public function popupAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$userinfo = array() ;
		if(!empty($_GET['username'])){
			$userinfo['username'] = $_GET['username'] ;
		}
		if(!empty($_GET['memberid'])){
			$userinfo['memberid'] = $_GET['memberid'] ;
		}
		if(!empty($_GET['mobile'])){
			$userinfo['mobile'] = $_GET['mobile'] ;
		}
		if(!empty($_GET['email'])){
			$userinfo['email'] = $_GET['email'] ;
		}
		
		$result = array() ;
		if(!empty($userinfo)){
			$result = $this->userinfo_model->queryUserinfo($userinfo) ;
		}
		
		echo json_encode($result) ;
		
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