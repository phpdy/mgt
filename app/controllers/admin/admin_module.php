<?php

class admin_module extends BaseController {

	public function init(){
		$this->module_model = $this->initModel('module_model','admin');
	}
	//添加
	public function addAction(){
		$result = $this->module_model->selectModule(array('type'=>1)) ;
		$this->view->assign('list',$result) ;
		$this->view->display('module_add.php');
	}
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$name = $_GET['name'] ;
		$url = $_GET['url'] ;
		$type = $_GET['type'] ;
		$parentid = $_GET['parentid'] ;
		$log .= "|$name,$url,$type,$parentid" ;
		$module = array(
			"name"		=>	$name,
			"url"		=>	$url,
			"type"		=>	$type,
			"parentid"	=>	$parentid,
		) ;
		$result = $this->module_model->insertModule($module) ;
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
		$result = $this->module_model->selectModule() ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('module_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$result = $this->module_model->selectModule(array('id'=>$id)) ;
		$this->view->assign('module',$result[0]) ;
		
		$result = $this->module_model->selectModule(array('type'=>1)) ;
		$this->view->assign('list',$result) ;
		
		$this->view->display('module_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	public function up_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$name = $_GET['name'] ;
		$url = $_GET['url'] ;
		$type = $_GET['type'] ;
		$parentid = $_GET['parentid'] ;
		$log .= "|$id,$name,$url,$type,$parentid" ;
		$module = array(
			"id"		=>	$id,
			"name"		=>	$name,
			"url"		=>	$url,
			"type"		=>	$type,
			"parentid"	=>	$parentid,
		) ;
		$result = $this->module_model->updateModule($module) ;
		if(empty($result)){
			echo "fail" ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//模块禁用开启
	public function updateAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$id = $_GET['id'] ;
		$log .= "|$id" ;
		$result = $this->module_model->selectModule(array('id'=>$id)) ;
		$state = $result[0]['state'] ;
		$module = array(
			"id"		=>	$id,
			"state"		=>	$state==1?0:1,
		) ;
		$result = $this->module_model->updateModule($module) ;
		
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>