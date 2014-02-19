<?php

class mgt_wuliu extends BaseController {

	public function init(){
		$this->wuliu_model = $this->initModel('wuliu_model');
		$type = array(
			1	=>'第一单元包裹' ,
			2	=>'第二单元包裹' ,
			3	=>'第三单元包裹' ,
			4	=>'第四单元包裹' ,
			5	=>'第五单元包裹' ,
			6	=>'第六单元包裹' ,
			7	=>'欢迎信' ,
			8	=>'反光伞' ,
			9	=>'学员证、采访证' ,
			10	=>'第一单元作业' ,
			11	=>'第二单元作业' ,
			12	=>'第三单元作业' ,
			13	=>'第四单元作业' ,
			14	=>'第五单元作业' ,
			15	=>'第六单元作业' ,
			16	=>'第七单元作业' ,
			17	=>'其它' ,
		) ;
		$this->view->assign('typelist',$type) ;
	}
	//添加
	public function addAction(){
		$this->view->display('wuliu_add.php');
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $this->getPost() ;
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->wuliu_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->wuliu_model->update($data) ;
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
		
		$data = array() ;
		$result = $this->wuliu_model->query($data) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('wuliu_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->wuliu_model->getOneById($id) ;
		$this->view->assign('wuliu',$object) ;
		
		$this->view->display('wuliu_up.php');
		
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