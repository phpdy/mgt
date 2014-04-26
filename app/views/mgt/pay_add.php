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
        <div id="gamefeatures"><h2>缴费录入</h2></div>
        <form method="post" action="?dir=mgt&control=pay&action=submit">
            <div id="gamemain">
			<table>
				<tbody>
				<tr>
					<td class="title"><b>姓名:</b></td><td><input type="text" name="username" size=20 onclick="pop(this)" readonly>
					<input type="hidden" name="userid" value="" size=20></td>
				</tr>
				<tr>
					<td class="title"><b>支付方式:</b></td>
					<td>
					<select name="paytype" id="paytype">
					<option value='汇款'>汇款
					<option value='到付'>到付
					<option value='在线支付'>在线支付 
					</select>
					</td>
				</tr>
				<tr>
					<td class="title"><b>缴费类别:</b></td>
					<td>
					<select name="ptype" id="ptype">
					<option value='1'>全科学员费用
					<option value='2'>在线学员费用
					<option value='4'>俱乐部学员费用
					</select>
					</td>
				</tr>
				<tr><td class="title"><b>缴费金额:</b></td><td><input type="text" name="money" value="" size=20></td></tr>
				
				<tr><td class="title"><b>会员类型:</b></td><td>
					<select name="memberid" id="memberid">
						<?php 
						foreach($memberlist as $item){
							echo "<option value='$item[id]'>$item[name]" ;
						}
						?>
					</select></td>
				</tr>
				<tr><td class="title"><b>缴费日期:</b></td><td><input type="text" name="paydate" size=20 onclick="new Calendar().show(this);" readonly></td></tr>
				<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=40 rows=10></textarea></td></tr>
				
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

});


function pop(obj){
	var url = "index.php?dir=mgt&control=userinfo&action=pop" ;
	var returnValue = window.showModalDialog(url,obj,"dialogHeight=400px;dialogWidth=600px;dialogLeft=500;dialogTop=100;center=yes;help=no;resizable=no;scroll=no;status=no;") ;
//	alert(returnValue) ;
	user = new Array;
	user = returnValue.split(",");
	
	$('input[name="userid"]').val(user[0]);
	$('input[name="username"]').val(user[1]);
	var memberid = user[2];
	//alert(memberid) ;
	$("#memberid option[value='"+memberid+"']").attr("selected", true);
}
</script>