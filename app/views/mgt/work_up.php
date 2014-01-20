<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="js/Calendar3.js" ></script>
</head>
<body>

<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>作业内容修改</h2></div>
        <form method="post" action="?dir=mgt&control=work&action=submit">
            <div id="gamemain">
            <input type="hidden" name="id" value="<?php echo $work['id'];?>">
			<table>
				<tbody>
				<tr><td class="title"><b>类别:</b></td><td>
					<select name="memberid">
					<?php 
					foreach($remberlist as $item){
						$id = $item['id'] ;
						$name = $item['name'] ;
						$p="" ;
						if(@$work['memberid']==$id){
							$p="selected";
						}
						echo "<option value='$id' $p>$name" ;
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td class="title"><b>名称:</b></td><td><input type="text" name="name" size=20 value="<?php echo $work['name'];?>"></td>
				</tr>
				<tr><td class="title"><b>作业说明:</b></td><td><textarea name="note" cols=100 rows=10><?php echo $work['note'];?></textarea></td></tr>
				<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=100 rows=5><?php echo $work['other'];?></textarea></td></tr>
				
				<tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
				</tbody>
			</table>
            </div>
        </form>
    </div>
</div>
</body>
</html>