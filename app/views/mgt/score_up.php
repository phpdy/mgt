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
        <div id="gamefeatures"><h2>成绩修改</h2></div>
        <form method="post" action="?dir=mgt&control=score&action=submit">
            <div id="gamemain">
            <input type="hidden" name="id" value="<?php echo $score['id'] ; ?>" size=20>
            <input type="hidden" name="memberid" value="<?php echo $memberid; ?>">
			<table>
				<tbody>
				<tr><td class="title"><b>学籍号:</b></td><td><?php echo $score['cnid'] ; ?></td></tr>
				<tr>
					<td class="title"><b>姓名:</b></td><td><?php echo $score['username'] ; ?></td>
				</tr>
				<tr><td class="title"><b>作业:</b></td><td>
					<?php 
					foreach($worklist as $item){
						$id = $item['id'] ;
						$name = $item['name'] ;
						if($id == $score['workid']){
							echo $name ;
						}
					}
					?>
					</td>
				</tr>
				<tr><td class="title"><b>成绩:</b></td><td><input type="text" name="score" value="<?php echo $score['score'] ; ?>" size=20></td></tr>
				<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=100 rows=5><?php echo $score['other'] ; ?></textarea></td></tr>
				
				<tr><td class="title"><b>记录人:</b></td><td><input type="hidden" name="modifer" value="<?php echo $_username; ?>"><?php echo $_username ; ?></td></tr>
				<tr><td class="title"><b>记录时间:</b></td><td><input type="hidden" name="modiftime" value="<?php echo date('Y-m-d H:i:s'); ?>"><?php echo date('Y-m-d H:i:s'); ?></td></tr>
			
				<tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
				</tbody>
			</table>
            </div>
        </form>
    </div>
</div>
</body>
</html>
