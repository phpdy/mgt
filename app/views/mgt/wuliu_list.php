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
        <div id="gamefeatures"><h2>物流查询</h2></div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>收货人</td>
                <td>物品</td>
                <td>订单号</td>
                <td>订单日期</td>
                <td>物流公司</td>
                <td>操作</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			echo "<tr class='$class'><td>$item[id]</td><td>$item[username]</td><td>$item[cargo]</td><td>$item[orderid]</td><td>$item[datetime]</td><td>$item[companies]</td>".
			"<td><a href='?dir=mgt&control=wuliu&action=up&id=$item[id]'>修改</a></td></tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>