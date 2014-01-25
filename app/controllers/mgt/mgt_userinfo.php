<?php

class mgt_userinfo extends BaseController {

	public function init(){
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->member_model = $this->initModel('member_model');
		$this->xueji_model = $this->initModel('xueji_model');
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
			$result = $this->userinfo_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->userinfo_model->update($data) ;
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
		
		$data = array() ;
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['memberid'])){
			$data['memberid'] = $_POST['memberid'] ;
		}
		if(!empty($_POST['mobile'])){
			$data['mobile'] = $_POST['mobile'] ;
		}
		if(!empty($_POST['cnid'])){
			$data['cnid'] = $_POST['cnid'] ;
			$xueji = $this->xueji_model->query(array('cnid'=>$data['cnid'])) ;
//			print_r($data) ;
//			print_r($xueji) ;
			
			if(!empty($xueji) && sizeof($xueji)==1){
				$data['id'] = $xueji[0]['userid'] ;
			}
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$pagenum = $this->userinfo_model->queryCount($data) ;
		$result = $this->userinfo_model->query($data) ;
		
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('userinfo',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display('userinfo_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//export 导出
	public function exportAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = array() ;
		if(!empty($_GET['username'])){
			$data['username'] = $_GET['username'] ;
		}
		if(!empty($_GET['memberid'])){
			$data['memberid'] = $_GET['memberid'] ;
		}
		if(!empty($_GET['mobile'])){
			$data['mobile'] = $_GET['mobile'] ;
		}
		if(!empty($_GET['cnid'])){
			$data['cnid'] = $_GET['cnid'] ;
			$xueji = $this->xueji_model->query(array('cnid'=>$data['cnid'])) ;
//			print_r($data) ;
//			print_r($xueji) ;
			
			if(!empty($xueji) && sizeof($xueji)==1){
				$data['id'] = $xueji[0]['userid'] ;
			}
		}
		if(!empty($_GET['page'])){
			$data['page'] = $_GET['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$result = $this->userinfo_model->queryAll($data) ;
		
		$list = array() ;
		$list[] = array(
			'ID','姓名','会员类型','性别','出生日期','证件类型','证件号','单位','职务','省','市','通信地址','邮编','手机号','电话','邮箱'
		) ;
		foreach ($result as $item){
			$sex = $item['sex']==2?'女':'男' ;
			$type = $item['paper'] ;
			switch ($type){
				case 1:$paper="身份证"; break ;
				case 2:$paper="军官证"; break ;
				case 3:$paper="护照"; break ;
				case 4:$paper="其他"; break ;
				case 1:$paper="其他"; break ;
			}
			
			$it = array(
				$item['id'],$item['username'],$item['member'],$sex,$item['birth'],$paper,$item['paperno'],
				$item['company'],$item['job'],$item['province'],$item['city'],
				$item['address'],$item['post'],$item['mobile'],$item['phone'],$item['email'],
				) ;
			$list[] = $it ;
		}
		
		$this->view->assign('filename',"会员查询列表") ;
		$this->view->assign('list',$list) ;
		$this->view->display('export_table.php');
		
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