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
        <div id="gamefeatures"><h2>成绩录入</h2></div>
        <form method="post" action="?dir=mgt&control=score&action=submit">
            <div id="gamemain">
			<table>
				<tbody>
				<tr><td class="title"><b>学籍号:</b></td><td><input type="text" name="cnid" value="" size=20></td></tr>
				<tr>
					<td class="title"><b>姓名:</b></td><td><input type="text" name="username" size=20 readonly><input type="hidden" name="userid" value="" size=20></td>
				</tr>
				<tr><td class="title"><b>作业:</b></td><td>
					<select name="workid">
					<?php 
					foreach($worklist as $item){
						$id = $item['id'] ;
						$name = $item['name'] ;
						echo "<option value='$id' >$name" ;
					}
					?>
					</select></td>
				</tr>
				<tr><td class="title"><b>成绩:</b></td><td><input type="text" name="score" value="" size=20></td></tr>
				<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=100 rows=5></textarea></td></tr>
				
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
<script language="javascript" type="text/javascript" src="manager/js/jquery-1.7.1.js" ></script>
<script language="javascript" type="text/javascript" >
$(function() {
	$('input[name="sub"]').click(function() {
		var userid = $('input[name="userid"]').val();
		if(userid == ''){
			alert('学籍号不能为空!');
			$('input[name="cnid"]').focus();
			return false;
		}
		
		if (username && userid) {
//			alert("submit"+$('form')) ;
			$('form').submit();
		}
	});

	$('input[name="cnid"]').change(function(){
		var cnid = $('input[name="cnid"]').val();
		$.get("?dir=mgt&control=xueji&action=get&cnid="+cnid ,function(data){
//			alert(data) ;
			var xueji = eval("["+data+"]") ;
//			alert(xueji.length) ;
//			alert(xueji[0]['userid']) ;
//			alert(xueji[0]['username']) ;
			if(xueji.length > 0 && xueji[0]['userid']>0){
				var userid = xueji[0]['userid'] ;
				var username = xueji[0]['username'] ;
				//alert(userid) ;
				$('input[name="userid"]').val(userid) ;
				$('input[name="username"]').val(username) ;
			} else {
				alert(cnid+"学籍号输入错误，请重新输入。") ;
				$('input[name="userid"]').val("") ;
				$('input[name="username"]').val("") ;
				$('input[name="cnid"]').val("") ;
				$('input[name="cnid"]').focus();
			}
		});
		
	});
});

</script>