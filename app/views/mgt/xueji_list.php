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
       		姓名：<input type="text" name="username" value="<?php echo @$data['username'] ;?>" size="10" maxlength="10"/>
			学籍号：<input type="text" name="cnid" value="<?php echo @$data['cnid'] ;?>" size="10" maxlength="10"/>
			会员类型：<select name="memberid">
       		<option value="0" >全部
	       		<?php 
				foreach($remberlist as $item){
					$id = $item['id'] ;
					$name = $item['name'] ;
					$p="" ;
					if($id==@$data['memberid']){
						$p="selected" ;
					}
					echo "<option value='$id' $p>$name" ;
				}
	       		?>
			</select>
			<input type="submit" value="查询">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>姓名</td>
                <td>学籍号</td>
                <td>会员类型</td>
                <td>开学时间</td>
                <td>毕业时间</td>
                <td>学籍状态</td>
                <td>操作员</td>
                <td>操作日期</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			foreach($remberlist as $it){
				if($it['id']==$item['memberid']){
					$rembername=$it['name'] ;
				}
			}
			$state = $item['state'] ;
			echo "<tr class='$class'><td>$item[id]</td><td><a href='?dir=mgt&control=xueji&action=up&id=$item[id]'>$item[username]</a></td>".
			"<td>$item[cnid]</td><td>$rembername</td><td>$item[start_date]</td><td>$item[end_date]</td><td>$state</td><td>$item[modifer]</td><td>$item[modiftime]</td>".
			"<td><a href='?dir=mgt&control=xueji&action=up&id=$item[id]'>修改</a></td></tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>