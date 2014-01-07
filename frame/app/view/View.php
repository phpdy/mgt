<?php

class View extends Object {
	private $_vars = array();
	private $_path ;
	
	public function __construct($path=""){
		$this->_path = VIEW_PATH.$path ;
	}
	
	function assign($vars, $value) {
		$this->_vars [$vars] = $value;
	}
	
	function display($file,$dir='') {
		$tplfile = rtrim ( $this->_path, DS ). DS.(strlen($dir)>0 ? $dir.DS : '')  . $file;
		if (! is_file ( $tplfile )) {
			trigger_error ( 'template file ' . $tplfile . ' not exists!', E_USER_ERROR );
		}
		extract ( $this->_vars );
		include $tplfile;
	}
}

?>