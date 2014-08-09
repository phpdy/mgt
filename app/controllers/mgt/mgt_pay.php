<?php

class mgt_pay extends BaseController {

	public function init(){
		$this->pay_model = $this->initModel('pay_model');
		$this->userinfo_model = $this->initModel('userinfo_model');
		$this->member_model = $this->initModel('member_model');
		$this->club_model = $this->initModel('index_model','club');
		
		@session_start ();
		$this->view->assign('_username',$_SESSION [FinalClass::$_session_user]['username']) ;
	}
	//添加
	public function addAction(){
		$memberlist = $this->member_model->queryAll() ;
		$this->view->assign('memberlist',$memberlist) ;
		
		$clublist = $this->club_model->queryAll();
		$this->view->assign('clublist',$clublist) ;
		$this->view->display('pay_add.php');
	}
	
	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$userinfolist = $this->userinfo_model->queryAll() ;
		$this->view->assign('userinfolist',$userinfolist) ;
		
		$memberlist = $this->member_model->query() ;
		$this->view->assign('memberlist',$memberlist) ;

		$clublist = $this->club_model->queryAll();
		$this->view->assign('clublist',$clublist) ;
		
		$id = $_GET['id'] ;
		$object = $this->pay_model->getOneById($id) ;
		
		foreach($clublist as $club){
			if($club['id']==$object['pid']){
				$object["pname"]=$club['title'] ;
				break ;
			}
		}

		$this->view->assign('pay',$object) ;
		
		$this->view->display('pay_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		
		//$data['ptype'] 		= 1 ;	//缴费类别
//		$data['state'] 		= 1 ;	//订单状态，入库未支付0，支付成功1，支付失败-1，退费-2'
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$data['orderid'] 	= "NY"+time() ;	//订单号
			$result = $this->pay_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->pay_model->update($data) ;
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
		
		$memberlist = $this->member_model->query() ;
		$this->view->assign('memberlist',$memberlist) ;
		
		$data = array() ;
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['ptype'])){
			$data['ptype'] = $_POST['ptype'] ;
		}
		if(!empty($_POST['pid'])){
			$data['pid'] = $_POST['pid'] ;
		}
		if($_POST['state']!=''){
			$data['state'] = $_POST['state'] ;
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$pagenum = $this->pay_model->queryCount($data) ;
		$result = $this->pay_model->query($data) ;
		
		//补充结果缺少数据，用户信息和俱乐部活动名
		$userinfolist = $this->userinfo_model->queryAll() ;
		$clublist = $this->club_model->queryAll();
		foreach($result as $key=>$value){
			//补充俱乐部活动名称 pname
			$pid = $value['pid'] ;
			foreach($clublist as $club){
				if($club['id']==$pid){
					$result[$key]["pname"]=$club['title'] ;
					$_clublist[$club['id']] = $club ;
					break ;
				}
			}
			//补充用户名、性别、身份证号
			$userid = $value['userid'] ;
			foreach($userinfolist as $user){
				if($user['id']==$userid){
					$result[$key]["name"]=$user['name'] ;
					$result[$key]["sex"]=$user['sex']==2?'女':'男';
					$result[$key]["paperno"]=$user['paperno'] ;
					break ;
				}
			}
		}
		
		//过滤所有已报名的活动
		$result2 = $this->pay_model->queryAll() ;
		foreach($result2 as $key=>$value){
			$pid = $value['pid'] ;
			foreach($clublist as $club){
				if($club['id']==$pid){
					$_clublist[$club['id']] = $club ;
					break ;
				}
			}
		}
		$this->view->assign('clublist',$_clublist) ;

		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display('pay_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//导出
	public function exportAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$memberlist = $this->member_model->query() ;
		
		$data = array() ;
		if(!empty($_POST['username'])){
			$data['username'] = $_POST['username'] ;
		}
		if(!empty($_POST['ptype'])){
			$data['ptype'] = $_POST['ptype'] ;
		}
		if(!empty($_POST['pid'])){
			$data['pid'] = $_POST['pid'] ;
		}
		if($_POST['state']!=''){
			$data['state'] = $_POST['state'] ;
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$result = $this->pay_model->queryAll($data) ;
		
		//补充结果缺少数据，用户信息和俱乐部活动名
		$userinfolist = $this->userinfo_model->queryAll() ;
		$clublist = $this->club_model->queryAll();
		foreach($result as $key=>$value){
			//补充俱乐部活动名称 pname
			$pid = $value['pid'] ;
			foreach($clublist as $club){
				if($club['id']==$pid){
					$result[$key]["pname"]=$club['title'] ;
					break ;
				}
			}
			//补充用户名、性别、身份证号
			$userid = $value['userid'] ;
			foreach($userinfolist as $user){
				if($user['id']==$userid){
					$result[$key]["name"]=$user['name'] ;
					$result[$key]["sex"]=$user['sex']==2?'女':'男';
					$result[$key]["paperno"]=$user['paperno'] ;
					break ;
				}
			}
		}

		$list[] = array(
			'订单号','姓名','用户名','性别','金额','支付方式','缴费类别','缴费二级类别','付款日期','支付状态'
		) ;
		foreach ($result as $item){
			foreach ($memberlist as $mem){
				if($mem['id']==$item['ptype']){
					$ptype = $mem['name'] ;
				}
			}
			$state ='未支付' ;
			if($item['state']==1){
				$state ='成功' ;
			}
			if($item['state']==0){
				$state ='未付款' ;
			}
			if($item['state']==-1){
				$state ='失败' ;
			}
			if($item['state']==-2){
				$state ='退款成功' ;
			}
			$list[] = array(
				$item['orderid'],$item['username'],$item['name'],$item['sex'],$item['money'],
				$item['paytype'],$ptype,$item['pname'],$item['paydate'],$state,
			);
		}
		
		$this->view->assign('filename',"订单查询列表") ;
		$this->view->assign('list',$list) ;
		$this->view->display('export_table.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->pay_model->getOneById($id) ;
		$this->view->assign('pay',$object) ;
		
		$this->view->display('pay_show.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	public function delAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$res = $this->pay_model->delete($id) ;
		$log .= "|".$res ;
		
		echo $res ;
		
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