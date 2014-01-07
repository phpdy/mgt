<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>模块列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>模块列表</h2></div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>模块名</td>
                <td>URL</td><td>模块类型</td><td>状态</td><td>操作</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$type = $item['type']==1 ? '目录' : '文件';
			$state = $item['state']==0 ? '已禁用':'已开启';
			$tips = $item['state']==0 ? '开启':'禁用';
			echo "<tr class='$class'><td>$item[id]</td><td><a href='?dir=admin&control=module&action=up&id=$item[id]'>$item[name]</a></td>"
	."<td>$item[url]</td><td>$type</td><td>$state</td><td><a href='?dir=admin&control=module&action=update&id=$item[id]'>$tips</a></td></tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>