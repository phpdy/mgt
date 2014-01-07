<?php

class admin_userrole extends BaseController {

	public function init(){
		$this->user = $this->initModel('user_model','admin');
		$this->rolse = $this->initModel('rolse_model','admin');
		$this->module = $this->initModel('module_model','admin');
	}
	//首页
	public function addAction(){
		$user_list = $this->user->getUserList() ;
		$userinfo_list = $this->userinfo->selectUserinfo() ;
		//剔除已添加的用户信息
		foreach ($user_list as $key=>$user){
			$userid = $user['id'] ;
			foreach ($userinfo_list as $userinfo){
				if ($userinfo['userid']==$userid){
					unset($user_list[$key]) ;
					break ;
				}
			}
		}
		$this->view->assign('user_list',$user_list) ;
		
//		$rolse_list = $this->rolse->selectRolse() ;
		@session_start ();
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$rolse_list = $this->rolse->selectRolse() ;
		} else {
			$rolseid = $this->userinfo->selectUserRolseList($this->getUserID()) ;
			$rolse_list = $this->rolse->selectRolse(array('ids'=>$rolseid[0]['rolses'])) ;
		}
//		print_r($rolse_list);
		$this->view->assign('rolse_list',$rolse_list) ;
		
		$this->view->display('userrole_add.php');
	}
	
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$userid = $_GET['userid'] ;
		$rolses = $_GET['rolses'] ;
		
		if (empty($rolses)) {
			$this->listAction();
			exit;
		}
		
		//判断该用户角色是否创建
		$data = array('userid'=>$userid);
		$res = $this->userinfo->selectUserinfo($data);
		if (!empty($res)) {
			echo '该用户角色已经创建';
			exit;
		}
		
		$rolses = implode(',', $rolses) ;
		$log .= "|$userid,$rolses" ;
		$rq = array(
			"userid"		=>	$userid,
			"rolses"		=>	$rolses,
		) ;
		$result = $this->userinfo->insertUserinfo($rq) ;
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	//用户角色列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$result = $this->userinfo->selectUserinfo() ;
		$this->view->assign('list',$result) ;
		$user_list = $this->user->getUserList() ;
		$this->view->assign('user_list',$user_list) ;
		$rolse_list = $this->rolse->selectRolse() ;
		$this->view->assign('rolse_list',$rolse_list) ;
		$this->view->display('userrole_list.php');
	}

	//修改用户角色
	public function upAction(){
		$id = $_GET['id'] ;

		//获取当前用户的角色列表
	
		@session_start ();
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$show_rolelist = $this->rolse->selectRolse() ;
		} else {
			$rolseid = $this->userinfo->selectUserRolseList($this->getUserID()) ;
			$show_rolelist = $this->rolse->selectRolse(array('ids'=>$rolseid[0]['rolses'])) ;
		}
		
		//获取要修改用户的角色列表
		$res = $this->userinfo->selectUserinfo(array('id'=>$id));
		if (empty($res[0]['rolses'])) {
			$rolelist = '';
		}else {
			$rolelist = $this->rolse->selectRolse(array('ids'=>$res[0]['rolses']));
		}
		
		$userid = $res[0]['userid'];
		//获取修改用户的username和realname
		$usernames = $this->user->getusername($userid);
		
		$this->view->assign('id', $id);
		$this->view->assign('usernames', $usernames);
		$this->view->assign('show_rolelist', $show_rolelist);
		$this->view->assign('rolelist', $rolelist);
		$this->view->display('userrole_up.php');
	}
	
	//执行修改用户角色
	public function up_subAction(){
		$id = $_POST['id'];
		$rolses = $_POST['rolses'];
		//如果用户删除所有角色添加默认角色
		if (empty($rolses)) {
			$strrolses = '';
		}else {
			$strrolses = implode(',', $rolses);
		}
		
		$data = array(
				'id'=>$id,
				'rolses'=>$strrolses,
				'state'=>1
				);
			
		
		$this->userinfo->updateUserinfo($data);
		
		$this->listAction();
		
	}
	
	//删除用户角色
	public function delAction() {
		$id = $_GET['id'];
		$data = array('id'=>$id);
		$this->userinfo->delUserinfo($data);
		
		$this->listAction();
	}
}

?>