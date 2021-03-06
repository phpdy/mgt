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
        <form method="post" action="?dir=mgt&control=xueji&action=list">
            <input type="hidden" name="memberid" id="memberid" value="<?php echo $memberid; ?>">
       		姓名：<input type="text" name="username" id="username" value="<?php echo @$data['username'] ;?>" size="10" maxlength="10"/>
			学籍号：<input type="text" name="cnid" id="cnid" value="<?php echo @$data['cnid'] ;?>" size="10" maxlength="10"/>
			<input type="hidden" name="page" value="<?php echo @$data['page'] ;?>"/>
			<input type="submit" value="查询">
			<input type="button" name="export" id="export" value="导出">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>姓名</td>
                <td>学籍号</td>
                <td>会员类型</td>
                <td>起始时间</td>
                <td>终止时间</td>
                <td>学籍状态</td>
                <td>操作员</td>
                <td>操作日期</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		$pno = empty($data['page'])?0:$data['page'] ;//页号
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			foreach($remberlist as $it){
				if($it['id']==$item['memberid']){
					$rembername=$it['name'] ;
				}
			}
			$state = $item['state'] ;
			
			$no = $i+1+FinalClass::$_list_pagesize*$pno ;//序号
			echo "<tr class='$class'><td>$no</td><td>$item[username]</td>".
			"<td>$item[cnid]</td><td>$rembername</td><td>$item[start_date]</td>".
			"<td>$item[end_date]</td><td>$state</td><td>$item[modifer]</td><td>$item[modiftime]</td>".
			"<td><a href='?dir=mgt&control=xueji&action=up&id=$item[id]'>修改</a></td></tr>" ;
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
	    temp.action = "?dir=mgt&control=xueji&action=export&memberid="+$('#memberid').val()+"&username="+$('#username').val()+"&cnid="+$('#cnid').val() ;
	    temp.method = "POST";
	    temp.style.display = "none";

	    document.body.appendChild(temp);
	    temp.submit();
	    
	});
});

</script>