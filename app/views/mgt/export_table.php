<?php 
//header("Content-Type: application/force-download");
//header("Content-Type: application/octet-stream");
//header("Content-Type: application/download");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
//header("Content-Disposition:attachment;filename=Order_{$time}.xls");

header("Content-Disposition:attachment;filename=".$filename.".xls");

if(!empty($list) && is_array($list)){
	//echo "<table  border=0>" ;
	foreach ($list as $item){
		if(is_array($item)){
			//echo "<tr>" ;
			foreach ($item as $k=>$v){
				//echo "<td>" ;
				echo iconv("utf-8", "gbk", $v) ;
				//echo "</td>" ;
				echo "\t" ;
			}
			echo "\n" ;
			//echo "</tr>" ;
		}
	}
	//echo "</table>" ;
}
?>