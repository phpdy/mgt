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
        <div id="gamefeatures"><h2>会员信息表</h2></div>
        <table>
		<tbody>
		<tr><td class="title"><b>姓名:</b></td><td><?php echo @$userinfo['username']; ?></td></tr>
		<tr><td class="title"><b>会员类型:</b></td><td><?php echo @$userinfo['member']; ?></td></tr>
		<tr><td class="title"><b>性别:</b></td><td><?php if(@$userinfo['sex']==1){echo "男";} else {echo '女';} ?></td></tr>
		<tr><td class="title"><b>出生年月:</b></td><td><?php echo @$userinfo['birth']; ?></td></tr>
		<tr><td class="title"><b>身份证号:</b></td><td><?php echo @$userinfo['sfz']; ?></td></tr>
		<tr><td class="title"><b>所在地:</b></td><td><?php echo @$userinfo['province']; ?>省 <?php echo @$userinfo['city']; ?>市</td>	</tr>
		<tr><td class="title"><b>通讯地址:</b></td><td><?php echo @$userinfo['address']; ?>	<b>邮编:</b><?php echo @$userinfo['post']; ?></td></tr>
		<tr><td class="title"><b>手机号:</b></td><td><?php echo @$userinfo['mobile']; ?></td></tr>
		<tr><td class="title"><b>电话:</b></td><td><?php echo @$userinfo['phone']; ?></td></tr>
		<tr><td class="title"><b>电子邮箱:</b></td><td><?php echo @$userinfo['email']; ?></td></tr>
		<tr><td class="title"><b>登记时间:</b></td><td><?php echo @$userinfo['createtime']; ?></td></tr>
	
		</tbody>
	</table>
    </div>
</div>
</body>
</html>