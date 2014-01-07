<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>信息查询</h2></div>
        
        <div id="gamemain">
        <form method="post" action="">
            <input type="hidden" value="mgt" name="dir">
            <input type="hidden" value="userinfo" name="control">
            <input type="hidden" value="list" name="action">
       		姓名：<input type="text" name="username" value="" size="10" maxlength="10"/>
       		会员类型：<select name="member">
       		<option value="-1" >全部
			<option value="0" >普通会员
			<option value="1" >全科会员
			<option value="2" >在线教育会员
			<option value="3" >俱乐部会员
			</select>
			手机号：<input type="text" name="mobile" value="" size="10" maxlength="10"/>
			电子邮箱：<input type="text" name="email" value="" size="10" maxlength="10"/>
			<input type="submit" value="查询">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>姓名</td>
                <td>会员类型</td>
                <td>性别</td>
                <td>出生日期</td>
                <td>手机号</td>
                <td>备用电话</td>
                <td>电子邮箱</td>
                <td>省市</td>
                <td>注册日期</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$member = $item['member'] ;
			if($member==1){
				$member = "全科会员" ;
			} else if($member==2){
				$member = "在线教育会员" ;
			} else if($member==3){
				$member = "俱乐部会员" ;
			} else {
				$member = "普通会员" ;
			}
			$sex = $item['sex']==1?"男":"女" ;
			$birth 	= $item['birth'] ;
			$mobile = $item['mobile'] ;
			$phone 	= $item['phone'] ;
			$email	= $item['email'] ;
			$dz		= $item['province']." ".$item['city'] ;
			$createtime = $item['createtime'] ;
			
			echo "<tr class='$class'><td>$item[id]</td><td><a href='?dir=mgt&control=userinfo&action=up&id=$item[id]'>$item[username]</a></td>"
			."<td>$member</td><td>$sex</td><td>$birth</td><td>$mobile</td><td>$phone</td><td>$email</td><td>$dz</td><td>$createtime</td></tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>