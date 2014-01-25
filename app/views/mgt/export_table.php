<?php 

header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
//header("Content-Disposition:attachment;filename=Order_{$time}.xls");

header("Content-Disposition:attachment;filename=".$filename.".xls");

if(!empty($list) && is_array($list)){
	foreach ($list as $item){
		if(is_array($item)){
			
			foreach ($item as $k=>$v){
				echo iconv("utf-8", "gbk", $v) ;
				echo "\t" ;
			}
			echo "\n" ;
		}
	}
}
?>