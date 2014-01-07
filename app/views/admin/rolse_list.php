<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>角色列表</title>
<link rel="stylesheet" href="manager/css/style.css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>角色列表</h2></div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title"><td>ID</td><td>角色名</td><td>备注</td><td width="75%">权限</td></tr>
			<?php 
			$i = 0;
			foreach ($list as $item){
				$class = ($i%2==0 ? 'trstyle1' : 'trstyle2');
				echo "<tr class='$class'><td>$item[id]</td><td><a href='?dir=admin&control=rolse&action=up&id=$item[id]'>$item[rolse]</a></td><td>$item[info]</td><td>" ;
				$modules = $item['modules'] ;
				$modules = explode(',', $modules) ;
				foreach ($modules as $id){
					foreach ($module_list as $item){
						if ($id==$item['id']){
							echo $item['name'].'|' ;
							break ;
						}
					}
				}
				echo "</td></tr>" ;
				$i++;
			}
			?>
        </table>
    </div>
</div>
</body>
</html>