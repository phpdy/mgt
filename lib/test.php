<?php
//require_once 'HttpClient.class.php';
//$http = new HttpClient() ;
//$http->quickGet("http://localhost/index.php?module=interface&control=codelist&check=no&giftid=22") ;
//echo $http->getContent() ;
//echo $http->getRequestURL() ;


//require 'Log4php.php';
//$test = Log4php::getLoger() ;
//$test->error("lss5ssyrryhhhh777yyy") ;

require 'Mail.php';
$m = new Mail() ;
//$m->sendMail("diyong@51wan.com","测试2","这是一个测试邮件<br/>test") ;

$title = "test4" ;
$body = "测试邮件<br/>ceshi" ;

$m->toEmail = "diyong@51wan.com" ;
$m->ccEmail = array("dy"=>"dyong525@163.com") ;
$m->bccEmail = array() ;
$m->files[] = "e:/20120224.log" ;
$m->files[] = "e:/logger.log" ;

//$m->fromEmail = "diyong@51wan.com";
//$m->Password = "dyong525" ;

$m->fromEmail = "dyong525@163.com";
$m->Password = "zhp918" ;
$m->host = "smtp.163.com" ;

$m->sendMails($title,$body) ;


?>