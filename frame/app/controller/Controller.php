<?php

class Controller extends Object {
	public $dir = "" ;
	public $model ;
	
	public $view ;
	
	public function __construct(){
		//views
//		if(!empty($this->view)){
			$this->view = new View($this->dir) ;
//		}

		//$models
		if(!empty($this->model)){
			//
			if(is_string($this->model)){
				$this->model = Import::importModel($this->model,$this->dir);
			}
			//array
			if(is_array($this->model)){
				$temp = $this->model ;
				$this->model = array() ;
				foreach ($temp as $v){
					$this->model[$v] = Import::importModel($v ,$this->dir);
				}
			}
		}
		$this->init() ;
	}
	public function init(){
		
	}
	public function initModel($model,$dir=""){
		$dir = empty($dir)?$this->dir:$dir ;
		return Import::importModel($model,$dir) ;
	}
}

?>