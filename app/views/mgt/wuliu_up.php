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
        <div id="gamefeatures"><h2>物流信息录入</h2></div>
        <form method="post" action="?dir=mgt&control=wuliu&action=submit">
            <div id="gamemain">
            <input type="hidden" name="id" value="<?php echo $wuliu['id']; ?>">
			<table>
				<tbody>
				<tr><td class="title"><b>收货人:</b></td><td><input type="text" name="username" size=20 onclick="pop(this)" value="<?php echo $wuliu['username']; ?>" readonly>
				<input type="hidden" name="userid" value="<?php echo $wuliu['userid']; ?>" size=20></td></tr>
				<tr><td class="title"><b>寄送货物:</b></td><td>
					<select name="cargoid">
					<?php 
					foreach($typelist as $key=>$value){
						$p="" ;
						if($key==$wuliu['cargoid']){
							$p = "selected" ;
						}
						echo "<option value='$key' $p>$value" ;
					}
					?>
					</select></td></tr>
				<tr><td class="title"><b>说明:</b></td><td><input type="text" name="name" size=30 value="<?php echo $wuliu['name']; ?>"></td></tr>
				<tr><td class="title"><b>订单号:</b></td><td><input type="text" name="orderid" size=30 value="<?php echo $wuliu['orderid']; ?>"></td></tr>
				<tr><td class="title"><b>物流日期:</b></td><td><input type="text" name="datetime" value="<?php echo $wuliu['datetime']; ?>" size=30 onclick="new Calendar().show(this);"></td></tr>
				<tr><td class="title"><b>物流公司:</b></td><td><input type="text" name="companies" size=50 value="<?php echo $wuliu['companies']; ?>"></td></tr>
				<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=100 rows=5><?php echo $wuliu['other']; ?></textarea></td></tr>
				
				<tr><td colspan="2"><input type="submit" value="修 改" name="sub" class="sub-btn"></td></tr>
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
			alert('用户名不能为空!');
			$('input[name="username"]').focus();
			return false;
		}
		if($('input[name="orderid"]').val() == ''){
			alert('订单号不能为空!');
			$('input[name="orderid"]').focus();
			return false;
		}
		if($('input[name="datetime"]').val() == ''){
			alert('物流日期不能为空!');
			$('input[name="datetime"]').focus();
			return false;
		}
		
		if (username && userid) {
//			alert("submit"+$('form')) ;
			$('form').submit();
		}
	});

});

function pop(obj){
	var url= "index.php?dir=mgt&control=userinfo&action=pop" ;
	var returnValue = window.showModalDialog(url,obj,"dialogHeight=400px;dialogWidth=600px;dialogLeft=500;dialogTop=100;center=yes;help=no;resizable=no;scroll=no;status=no;") ;
//	alert(returnValue) ;
	user = new Array;
	user = returnValue.split(",");
	
	$('input[name="userid"]').val(user[0]);
	$('input[name="username"]').val(user[1]);
}
</script>