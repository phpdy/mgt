<?php

class admin_user extends BaseController {

	public function init(){
		$this->user = $this->initModel('user_model','admin');
		$this->rolse = $this->initModel('rolse_model','admin');
		$this->module = $this->initModel('module_model','admin');
	}
	
	//用户添加页面
	public function addAction(){
		$this->view->display('user_add.php');
	}
	
	//添加用户操作
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$name = $_POST['name'];
		$username = $_POST['username'] ;//iconv("UTF-8","GB2312//IGNORE",$_POST['username']);
		$password = $_POST['password'];
		
		if (empty($username) || empty($name) || empty($password)) {
			echo '参数不能为空!!!';
			exit;
		}
		
		//检测用户名是否存在
		$userinfo = $this->user->getUserInfo($name);
		if (!empty($userinfo)) {
			echo '用户名已经存在，请重新填写！！！';
			exit;
		}
		
//		$password = md5($password);
		$log .= "|$name,$username,$password";
				
		$res = $this->user->addUser($name,$username,$password);
		if($res!=1){
			echo "fail " ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	//用户列表
	public function listAction(){
		$start = microtime(true)*1000;
		$log = __CLASS__."|".__FUNCTION__ ;
		$type = !empty($_GET['type'])?$_GET['type']:0 ;
		$log = "|$type" ;
		
		$res = $this->user->getUserList();
		$log = "|".count($res) ;
		
		$this->view->assign('type',$type);
		$this->view->assign('userlist',$res);
		$this->view->display('user_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//用户信息查询接口
	public function userAction(){
		$start = microtime(true)*1000;
		$log = __CLASS__."|".__FUNCTION__ ;
		$userid = $_GET['userid'] ;
		$log .= "|$userid" ;
		
		$res = $this->user->getusername($userid);
		$log .= "|".count($res) ;
		
		echo json_encode($res) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//用户密码更新接口
	public function upAction(){
		$start = microtime(true)*1000;
		$log = __CLASS__."|".__FUNCTION__ ;
		$userid = $_GET['userid'] ;
		$password = $_GET['password'] ;
		$log .= "|$userid,$password" ;
		
//		$password = md5($password);
		$res = $this->user->updatePWD($userid,$password) ;
		$log .= "|".$res ;
		
		echo "密码修改成功!" ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改密码
	public function pwdAction(){
		$start = microtime(true)*1000;
		$log = __CLASS__."|".__FUNCTION__ ;
		$userid = $this->getUserID() ;
		$log .= "|$userid" ;
		
		$this->view->assign('userid',$userid);
		$this->view->display('user_pwd.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//用户删除接口
	public function delAction(){
		$start = microtime(true)*1000;
		$log = __CLASS__."|".__FUNCTION__ ;
		$userid = $_GET['userid'] ;
		$log .= "|$userid" ;
		
		$res = $this->user->deleteUserByUserId($userid);
		$log .= "|".$res ;
		
		echo $res?"删除成功":"失败" ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

}

?>