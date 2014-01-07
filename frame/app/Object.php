<?php

class Object {

	public function __construct() {
		
	}
	

	public function toString() {
		$class = get_class($this);
		return $class;
	}
	
	public function getUrlParams(){
		
	}
}

?>