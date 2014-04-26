<?php

class Configs{
	public static $dbconfig = array(
		"admin"		=>	array(
			'mysql_conn' => 'mysql:host=localhost;port=3306;dbname=nyipmgt' ,
			'mysql_user' => 'gpuser',
			'mysql_pwd' => 'GpSogou1234',
			'charset'	=> 'utf8'
		),
		"phpcms"	=>	array(
			'mysql_conn' => 'mysql:host=localhost;port=3306;dbname=phpcms' ,
			'mysql_user' => 'gpuser',
			'mysql_pwd' => 'GpSogou1234',
			'charset'	=> 'utf8'
		),
	) ;
	
}
	
?>