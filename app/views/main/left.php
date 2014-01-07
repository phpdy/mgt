<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>左菜单</title>
	<link rel="StyleSheet" href="manager/js/dtree/dtree.css" type="text/css" />
	<script type="text/javascript" src="manager/js/dtree/dtree.js"></script>
</head>
<body bgcolor="#F3FBFF">
	<div class="dtree">
	<p><a href="javascript: d.openAll();">全部展开</a> | <a href="javascript: d.closeAll();">全部合并</a></p>
	<script type="text/javascript">
		var img_path = 'manager/js/dtree/img/' ;
		var d = new dTree('d');
		d.add(0,-1,'游戏运营管理后台');

		<?php 
		$set = array() ;
		$set2 = array() ;
		//print_r($list) ;
		foreach ($list as $key=>$item){
			//剔除删除的模块
			$state = $item['state'] ;
			if ($state!='1'){
				unset($list[$key]) ;
			}
			//文件夹数组
			if($item['type']==1){
				$set[] = $item['id'] ;
			}
			if (in_array($item['id'], $set2)){
				unset($list[$key]) ;
			} else {
				$set2[] = $item['id'] ;
			}
		}
//		print_r($list) ;
		foreach ($list as $item){
			$id = $item['id'] ;
			$name = $item['name'] ;
			$url = $item['url'] ;
			$type = $item['type'] ;
			$parentid = $item['parentid'] ;
			if($type==1){
				echo "d.add($id,$parentid,'$name','','$name');\r\n" ;
			} else if (in_array($parentid, $set)){
				echo "d.add($id,$parentid,'$name','$url','$name','main');\r\n" ;
			}
		}
		?>
		
		document.write(d);
	</script>
	<br>
	
	</div>
</body>
</html>
