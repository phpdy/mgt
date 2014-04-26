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
       		缴费类别:<select name="ptype" id="ptype">
					<option value='' selected>全部
					<option value='1' <?php if($data['ptype']==1){echo "selected";} ?>>全科学员费用
					<option value='2' <?php if($data['ptype']==2){echo "selected";} ?>>在线学员费用
					<option value='4' <?php if($data['ptype']==4){echo "selected";} ?>>俱乐部学员费用
					</select>
       		支付状态:<select name="state" id="state">
					<option value='' selected>全部
					<option value='0' <?php if($data['state']=='0'){echo "selected";} ?>>未付款
					<option value='1' <?php if($data['state']==1){echo "selected";} ?>>成功
					<option value='-1' <?php if($data['state']==-1){echo "selected";} ?>>失败
					</select>
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
                <td>支付方式</td>
                <td>缴费类别</td>
                <td>缴费二级类别</td>
                <td>付款日期</td>
                <td>支付状态</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		$pno = empty($data['page'])?0:$data['page'] ;//页号
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			
			$no = $i+1+FinalClass::$_list_pagesize*$pno ;//序号
			$state ='未支付' ;
			if($item['state']==1){
				$state ='成功' ;
			}
			if($item['state']==0){
				$state ='未付款' ;
			}
			if($item['state']==-1){
				$state ='失败' ;
			}
			if($item['state']==-2){
				$state ='退款成功' ;
			}
			switch ($item['ptype']){
				case 1: $ptype = "全科学员费用" ;
					break ;
				case 2: $ptype = "在线学员费用" ;
					break ;
				case 4: $ptype = "俱乐部学员费用" ;
					break ;
				default: $ptype = "其他费用" ;
			}
			echo "<tr class='$class'><td>$no</td><td>$item[orderid]</td><td><a href='?dir=mgt&control=pay&action=up&id=$item[id]'>$item[username]</a></td>".
			"<td>$item[money]</td><td>$item[paytype]</td><td>$ptype</td><td>$item[pid]</td><td>$item[paydate]</td><td>$state</td>".
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