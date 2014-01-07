<?php

class main_index extends BaseController {
	public function init(){
		$this->model = $this->initModel('user_model','admin');
		$this->module = $this->initModel('module_model','admin');
		$this->system = $this->initModel('system_model','admin');
	}
	//首页
	public function defaultAction(){
		@session_start();
		if (!empty($_SESSION[FinalClass::$_session_user]) && is_array($_SESSION [FinalClass::$_session_user])){
			$system = $this->system->selectSystem();
			$this->view->assign('system',$system) ;
			$this->view->display('index.php') ;
			die();
		}
		$this->view->display('login.php');
	}
	
	//登录
	public function loginAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$username = Lib::safeS ( @$_POST ['username'] );
		$password = Lib::safeS ( @$_POST ['password'] );
		$log .= "|$username,$password" ;
		$userinfo = $this->model->getUserInfo ( $username );
		if ($userinfo) {
//			$password = md5($password) ;
			if ($userinfo ['password'] !=  $password ) {
				$this->view->assign('message','密码错误！') ;
			} else {
				@session_start ();

				$_SESSION [FinalClass::$_session_user] = $userinfo ;
//				@$_SESSION ['userid'] = $userinfo ['id'];
			}
		} else {
			$this->view->assign('message','用户不存在！') ;
		}
		
		$this->defaultAction() ;
//		$this->view->display('index.php') ;
		
		$log .= "|" ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	//左侧工具条
	public function showLeftAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		//查询权限
		@session_start ();
		$userid = $_SESSION [FinalClass::$_session_user]['id'] ;
		$log.="|$userid" ;
		$rank = $this->userinfo->selectUserRankList($userid);
//		$rank = $this->module->selectModule();
		//admin用户拥有所有权限
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$_rank = $this->module->selectModule();
			$rank = array_merge($rank,$_rank) ;
		}
//		$rank = array_unique($rank) ;
		$this->view->assign('list',$rank) ;
		$this->view->display('left.php') ;
		
		$log .= "|" ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	public function topAction(){
		@session_start();
		$system = $this->system->selectSystem();
		$this->view->assign('system',$system) ;
		$this->view->display('top.php') ;
	}
	public function showRightAction(){
		$this->view->display('right.php') ;
	}
	
	//退出
	public function loginoutAction(){
		@session_start ();
		$_SESSION [FinalClass::$_session_user] = null ;
		unset($_SESSION[FinalClass::$_session_user]) ;
		$this->view->display('login.php') ;
	}

}

?>