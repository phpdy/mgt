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
        <form method="post" action="?dir=mgt&control=pay&action=list">
       		姓名：<input type="text" name="username" value="<?php echo @$data['username'] ;?>" size="10" maxlength="10"/>
			<input type="hidden" name="page" value="<?php echo @$data['page'] ;?>"/>
			<input type="submit" value="查询">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>订单号</td>
                <td>姓名</td>
                <td>缴费金额</td>
                <td>用途</td>
                <td>付款日期</td>
                <td>操作员</td>
                <td>操作日期</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		$pno = empty($data['page'])?0:$data['page'] ;//页号
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			
			$no = $i+1+FinalClass::$_list_pagesize*$pno ;//序号
			echo "<tr class='$class'><td>$no</td><td>$item[orderid]</td><td><a href='?dir=mgt&control=pay&action=up&id=$item[id]'>$item[username]</a></td>".
			"<td>$item[money]</td><td>$item[paytype]</td><td>$item[paydate]</td><td>$item[recorder]</td><td>$item[recordtime]</td>".
			"<td><a href='?dir=mgt&control=pay&action=up&id=$item[id]'>修改</a></td></tr>" ;
		$i++;
		}
		?>
		</table>
		
		
		<?php include 'paging.php';?>
	</div>
</div>
</body>
</html>