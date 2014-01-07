<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>模块修改</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
<div id="main" class="main">
<div id="gamefeatures"><H2>模块修改</H2></div>
	<form action="" method="get">
	<input type="hidden" name="dir" value="admin">
	<input type="hidden" name="control" value="module">
	<input type="hidden" name="action" value="up_sub">
	<input type="hidden" name="id" value="<?php echo $module['id']; ?>">
	<div id="gamemain">
		<table width="20%" border="0" >
			<tr><td class="title"><B>模块名:</B></td><td><input type="text" name="name" value="<?php echo $module['name']; ?>" size=80></td></tr>
			<tr><td class="title"><B>模块链接:</B></td><td><input type="text" name="url" value="<?php echo $module['url']; ?>" size=80></td></tr>
			<tr><td class="title"><B>模块类型:</B></td><td><input type="radio" name="type" value="1" id="1" <?php echo ($module['type']==1 ? 'checked' : '');?> ><label for="1">目录</label> <input type="radio" name="type" value="2" id="2" <?php echo ($module['type']==2 ? 'checked' : '');?>><label for="2">文件</label></td></tr>
			<tr>
				<td class="title"><B>上级模块:</B></td>
				<td>
					<select name="parentid">
					<option value="0">根目录
					<?php 
					foreach ($list as $item){
						$select = ($item['id']==$module['parentid'] ? 'selected' : '');
						echo "<option value='".$item['id']."' $select >".$item['name'] ;
					}
					?>
					</select>
				</td>
			</tr>
			<tr><td colspan="2"><input type="submit" name="sub" value="提交" class="sub-btn"></td></tr>
		</table>
	</div>
	</form>
</div>
</div>
</body>
</html>