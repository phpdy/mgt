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
        <div id="gamefeatures"><h2>缴费信息修改</h2></div>
        <form method="post" action="?dir=mgt&control=pay&action=submit">
            <div id="gamemain">
            <input type="hidden" name="id" value="<?php echo $pay['id'];?>">
			<table>
				<tbody>
				<tr><td class="title"><b>姓名:</b></td><td><?php echo $pay['username'];?></td></tr>
				<tr><td class="title"><b>手机号:</b></td><td><?php echo $pay['mobile'];?></td></tr>
				<tr><td class="title"><b>固话:</b></td><td><?php echo $pay['phone'];?></td></tr>
				<tr><td class="title"><b>邮箱:</b></td><td><?php echo $pay['email'];?></td></tr>
				<tr><td class="title"><b>订单号:</b></td><td><?php echo $pay['orderid'];?></td></tr>
				<tr><td class="title"><b>支付方式:</b></td>
				<td><?php echo $pay['paytype'];?><!-- 
					<select name="paytype" id="paytype">
					<option value='<?php echo $pay['paytype'];?>'><?php echo $pay['paytype'];?>
					<option value='汇款' <?php if($pay['paytype']=='汇款'){echo "selected";}?>>汇款
					<option value='到付' <?php if($pay['paytype']=='到付'){echo "selected";}?>>到付
					<option value='在线支付' <?php if($pay['paytype']=='在线支付'){echo "selected";}?>>在线支付
					</select> -->
				<tr>
					<td class="title"><b>缴费类别:</b></td>
					<td><?php 
						foreach ($memberlist as $item){
							if($item['id']==$pay['ptype']){
								echo $item['name'] ;
							}
						}
					?></td>
				</tr>
				<tr><td class="title"><b>二级类别:</b></td><td><?php echo $pay['pname'];?></td></tr>
				<tr><td class="title"><b>缴费金额:</b></td><td><input type="text" name="money"  value="<?php echo $pay['money'];?>" size=20></td></tr>
				<tr>
					<td class="title"><b>支付状态:</b></td>
					<td>
					<select name="state" id="state">
					<option value='0' <?php if($pay['state']=='0'){echo 'selected'; } ?>>未支付
					<option value='1' <?php if($pay['state']=='1'){echo 'selected'; } ?>>成功
					<option value='-1' <?php if($pay['state']=='-1'){echo 'selected'; } ?>>失败
					<option value='-2' <?php if($pay['state']=='-2'){echo 'selected'; } ?>>其他
					</select>
					</td>
				</tr>
				<tr><td class="title"><b>缴费日期:</b></td><td><input type="text" name="paydate"  value="<?php echo $pay['paydate'];?>" size=20 onclick="new Calendar().show(this);" readonly></td></tr>
				<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=40 rows=10><?php echo $pay['other'];?></textarea></td></tr>
				
				<tr><td class="title"><b>记录人:</b></td><td><input type="hidden" name="recorder" value="<?php echo $_username; ?>"><?php echo $_username ; ?></td></tr>
				<tr><td class="title"><b>记录时间:</b></td><td><input type="hidden" name="recordtime" value="<?php echo date('Y-m-d H:i:s'); ?>"><?php echo date('Y-m-d H:i:s'); ?></td></tr>
			
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
			alert('用户名不能为空!');
			$('input[name="username"]').focus();
			return false;
		}
		
		if (username && userid) {
//			alert("submit"+$('form')) ;
			$('form').submit();
		}
	});

	$('input[name="username"]').blur(function(){
		var username = $('input[name="username"]').val();
		$.get("?dir=mgt&control=userinfo&action=userinfo&username="+username ,function(data){
			//alert(data) ;
			var userinfo = eval("["+data+"]") ;
			//alert(userinfo.length) ;
			if(userinfo.length > 0 && userinfo[0]['id']>0){
				var userid = userinfo[0]['id'] ;
				//alert(userid) ;
				$('input[name="userid"]').val(userid) ;
			} else {
				alert(username+"不是会员，请重新输入。") ;
				$('input[name="userid"]').val("") ;
				$('input[name="username"]').val("") ;
				$('input[name="username"]').focus();
			}
		});
		
	});
});

</script>