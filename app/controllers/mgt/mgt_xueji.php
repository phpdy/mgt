<?php

class mgt_xueji extends BaseController {

	public function init(){
		$this->xueji_model = $this->initModel('xueji_model');
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->member_model = $this->initModel('member_model');
		
		@session_start ();
		$this->view->assign('_username',$_SESSION [FinalClass::$_session_user]['username']) ;
	}
	//添加
	public function addAction(){
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		$this->view->display('xueji_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->xueji_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->xueji_model->update($data) ;
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
		if(!empty($_POST['cnid'])){
			$data['cnid'] = $_POST['cnid'] ;
		}
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['state'])){
			$data['state'] = $_POST['state'] ;
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$pagenum = $this->xueji_model->queryCount($data) ;
		$result = $this->xueji_model->query($data) ;
		
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display('xueji_list.php');
		
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
		$object = $this->xueji_model->getOneById($id) ;
		$this->view->assign('xueji',$object) ;
		
		$this->view->display('xueji_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->xueji_model->getOneById($id) ;
		$this->view->assign('xueji',$object) ;
		
		$this->view->display('xueji_show.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//根据学籍号查询学籍信息
	public function getAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$cnid = $_GET['cnid'] ;
		if(!empty($cnid)){
			$xuejilist = $this->xueji_model->query(array('cnid'=>$cnid)) ;
		}
		
		$xueji = array() ;
		if(!empty($xuejilist) && sizeof($xuejilist)==1){
			$xueji = $xuejilist[0] ;
			$xueji = $this->iconvArray($xueji) ;
		}
		echo json_encode($xueji) ;
		
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