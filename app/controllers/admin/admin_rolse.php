<?php

class admin_rolse extends BaseController {

	public function init(){
		$this->rolse_model = $this->initModel('rolse_model','admin');
		$this->module_model = $this->initModel('module_model','admin');
	}
	//首页
	public function addAction(){
//		$result = $this->module_model->selectModule() ;
		$result = $this->userinfo->selectUserRankList($this->getUserID()) ;
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$result = $this->module_model->selectModule();
		}
		$this->view->assign('list',$result) ;
		$this->view->display('rolse_add.php');
	}
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$url = $_SERVER["HTTP_REFERER"];

		$name = trim($_GET['rolse']) ;
		if(empty($name)){
			header('Location: '.$url);
			exit;
		}

		$info = trim($_GET['info']) ;
		$modules = $_GET['modules'] ;
		if(empty($modules))
			$modules = array(5,1,12);
		$modules = implode(',', $modules) ;
		$log .= "|$name,$info,$modules" ;
		$_rolse = array(
			"rolse"		=>	$name,
			"info"		=>	$info,
			"modules"	=>	$modules,
		) ;
		$result = $this->rolse_model->insertRolse($_rolse) ;
		if(empty($result)){
			echo "fail" ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$module_list = $this->module_model->selectModule() ;
		$this->view->assign('module_list',$module_list) ;
		
		$result = $this->rolse_model->selectRolse() ;
		$this->view->assign('list',$result) ;
		$this->view->display('rolse_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$result = $this->rolse_model->selectRolse(array('id'=>$id)) ;
		$modules = explode(',', $result[0]['modules']);
		$result[0]['modules'] = $modules;
		
		$this->view->assign('rolse',$result[0]) ;
		
//		$result = $this->module_model->selectModule(array('state'=>1)) ;
		$result = $this->userinfo->selectUserRankList($this->getUserID()) ;
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$result = $this->module_model->selectModule();
		}
		$this->view->assign('list',$result);
		$this->view->assign('id',$id) ;
		$this->view->display('rolse_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function up_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$id = $_GET['id'] ;
		$modules = $_GET['modules'] ;

		$name = trim($_GET['rolse']) ;
		
		if (empty($name)) {
			echo "<script>alert('角色名不能为空！！！');</script>";
		}

		$info = trim($_GET['info']) ;
		if(empty($modules))
			$modules = array(5);

		$modules = implode(',', $modules) ;
		$log .= "|$id,$name,$info,$modules" ;
		$_rolse = array(
			"id"		=>	$id,
			"rolse"		=>	$name,
			"info"		=>	$info,
			"modules"	=>	$modules,
		) ;
		$result = $this->rolse_model->updateRolse($_rolse) ;
		if(empty($result)){
			echo "fail" ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>