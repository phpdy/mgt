<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>信息查询</h2></div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>名称</td>
                <td>内容</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			foreach($remberlist as $it){
				$id = $it['id'] ;
				if($id==$item['memberid']){
					$name = $it['name'] ;
				}
			}
			echo "<tr class='$class'><td>$item[id]</td><td>$item[name]</td><td>$item[note]</td>".
			"<td><a href='?dir=mgt&control=work&action=up&id=$item[id]'>修改</a></td></tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>