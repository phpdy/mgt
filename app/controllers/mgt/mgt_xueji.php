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
//		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('memberid',$_GET['memberid']) ;
		$this->view->display('xueji_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		if(!empty($data['cnid'])){
			$data['cnid'] = strtoupper($data['cnid']) ;
		}
		
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
		$data['memberid'] = $_REQUEST['memberid'] ;
		if(!empty($_POST['cnid'])){
			$data['cnid'] = strtoupper($_POST['cnid']) ;
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
		
		$this->view->assign('memberid',$_REQUEST['memberid']) ;
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display('xueji_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//export 导出
	public function exportAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = array() ;
		$data['memberid'] = $_REQUEST['memberid'] ;
		if(!empty($_POST['cnid'])){
			$data['cnid'] = strtoupper($_POST['cnid']) ;
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
		$result = $this->xueji_model->queryAll($data) ;
		
		$memberlist = $this->member_model->queryAll() ;
		$list = array() ;
		$list[] = array(
			'ID','学籍号','会员ID','姓名','会员类型','起始日期','终止日期','备注'
		) ;
		foreach ($result as $item){
			$memberid = $item['memberid'] ;
			foreach ($memberlist as $member){
				if($member['id']==$memberid){
					$membername = $member['name'] ;
					break ;
				}
			}
			
			$it = array(
				$item['id'],$item['cnid'],$item['userid'],$item['username'],$membername,
				$item['start_date'],$item['end_date'],$item['other']
				) ;
			$list[] = $it ;
		}
		
		$this->view->assign('filename',"会员查询列表") ;
		$this->view->assign('list',$list) ;
		$this->view->display('export_table.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	public function list2Action(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$remberlist = $this->member_model->queryAll() ;
		$this->view->assign('remberlist',$remberlist) ;
		
		$data = array('userid'=>$_GET['userid']) ;
		$result = $this->xueji_model->query($data) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('xueji_list2.php');
		
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
		
		$cnid = strtoupper($_GET['cnid']) ;
		$data = array('cnid'=>$cnid) ;
		if(!empty($_GET['memberid'])){
			$data['memberid'] = $_GET['memberid'] ;//暂时屏蔽
		}
		
		if(!empty($cnid)){
			$xuejilist = $this->xueji_model->query($data) ;
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