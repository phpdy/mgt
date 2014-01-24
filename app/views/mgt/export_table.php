<?php 
header("Content-type:application/octet-stream");
header("Accept-Ranges:bytes");
header("Content-type:application/vnd.ms-excel");  
header("Content-Disposition:attachment;filename=".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table>" ;
if(!empty($list) && is_array($list)){
	foreach ($list as $item){
		if(is_array($item)){
			echo "<tr>" ;
			foreach ($item as $k=>$v){
				echo "<td>$v</td>" ;
			}
			echo "</tr>" ;
		}
	}
}
echo "</table>" ;
?>