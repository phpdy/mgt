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
					<?php 
					foreach ($memberlist as $item){
						$op ="" ;
						if($data['ptype']==$item['id']){
							$op ="selected" ;
						}
						echo "<option value='$item[id]' $op>$item[name]" ;
					}
					?>
					</select>
       		二级类别:<select name="pid" id="pid">
					<option value='' selected>全部
					<?php 
					foreach($clublist as $club){
						$op = "" ;
						if($club['id']==$data['pid']){
							$op = "selected" ;
						}
						echo "<option value='$club[id]' $op>$club[title]" ;
					}
					?>
					</select>
       		支付状态:<select name="state" id="state">
					<option value='' selected>全部
					<option value='0' <?php if($data['state']=='0'){echo "selected";} ?>>未付款
					<option value='1' <?php if($data['state']==1){echo "selected";} ?>>成功
					<option value='-1' <?php if($data['state']==-1){echo "selected";} ?>>失败
					</select>
			<input type="hidden" name="page" value="<?php echo @$data['page'] ;?>"/>
			<input type="submit" value="查询">&nbsp;&nbsp;
			<input type="button" name="export" id="export" value="导出">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>订单号</td>
                <td>姓名</td>
                <td>用户名</td>
                <td>性别</td>
                <td>金额</td>
                <td>支付方式</td>
                <td>缴费类别</td>
                <td>缴费二级类别</td>
                <td>付款日期</td>
                <td>支付状态</td>
                <td>操作</td>
            </tr>
		<?php
		$i = 0;
		$pno = empty($data['page'])?0:$data['page'] ;//页号
		//print_r($clublist);
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
			if($item['state']==-3){
				$state ='删除' ;
			}
			foreach ($memberlist as $mem){
				if($mem['id']==$item['ptype']){
					$ptype = $mem['name'] ;
				}
			}
			$pay = "<a href='?dir=mgt&control=pay&action=up&id=$item[id]'>修改</a>" ;
			if($item['state']==1 && $item['paytype']=='在线支付'){
				$pay = "&nbsp;" ;
			}
			$now = time() ;
			$time = strtotime($item['createtime']) ;
			if($item['state']!=1 && ($now-$time)>60*60*24*3){
				$pay .= "&nbsp;<input type='button' value='删除用户' onclick='del({$item['id']})'/>" ;
			}
			echo "<tr class='$class'><td>$no</td><td>$item[orderid]</td><td><a href='?dir=mgt&control=pay&action=up&id=$item[id]'>$item[username]</a></td>"
			."<td>$item[name]</td><td>$item[sex]</td><td>$item[money]</td><td>$item[paytype]</td>"
			."<td>$ptype</td><td>$item[pname]</td><td>$item[paydate]</td><td>$state</td><td>$pay</td></tr>" ;
		$i++;
		}
		?>
		</table>
		
		
		<?php include 'paging.php';?>
	</div>
</div>
</body>
</html>
<script language="javascript" type="text/javascript" src="manager/js/jquery-1.7.2.min.js" ></script>
<script language="javascript" type="text/javascript" >
$(document).ready(function(){
	$("#export").click(function(){
		var temp = document.createElement("form");        
	    temp.action = "?dir=mgt&control=pay&action=export&username="+$('#username').val()+
	    "&ptype="+$('#ptype').val()+"&pid="+$('#pid').val()+"&state="+$("#state").val();
	    temp.method = "POST";
	    temp.style.display = "none";

	    document.body.appendChild(temp);
	    temp.submit();
	    
	});
});

function del(id){
	if(id!=null && id!=""){
		if(confirm('你确定要删除订单吗？')){
		$.get("?dir=mgt&control=pay&action=del&id="+id,{},function(data){
			alert(data) ;
			location.reload();
		});
		}
	}
}
</script>