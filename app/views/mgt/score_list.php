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
        <div id="gamefeatures"><h2>成绩查询</h2></div>
        
        <div id="gamemain">
        <form method="post" action="?dir=mgt&control=score&action=list">
            <input type="hidden" name="memberid" value="<?php echo $memberid; ?>">
       		姓名：<input type="text" name="username" value="<?php echo @$data['username'] ;?>" size="10" maxlength="10"/>
			学籍号：<input type="text" name="cnid" value="<?php echo @$data['cnid'] ;?>" size="10" maxlength="10"/>
			会员类型：<select name="workid">
       		<option value="0" >全部
	       		<?php 
				foreach($worklist as $item){
					$id = $item['id'] ;
					$name = $item['name'] ;
					$p="" ;
					if($id==@$data['workid']){
						$p="selected" ;
					}
					echo "<option value='$id' $p>$name" ;
				}
	       		?>
			</select>
			<input type="hidden" name="page" value="<?php echo @$data['page'] ;?>"/>
			<input type="submit" value="查询">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>学籍号</td>
                <td>姓名</td>
                <td>考试科目</td>
                <td>成绩</td>
                <td>备注</td>
                <td>操作员</td>
                <td>操作日期</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		$pno = empty($data['page'])?0:$data['page'] ;//页号
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			
			$work = "" ;
			foreach($worklist as $it){
				if($it['id']==$item['workid']){
					$work = $it['name'] ;
				}
			}
			
			$no = $i+1+FinalClass::$_list_pagesize*$pno ;//序号
			echo "<tr class='$class'><td>$no</td><td>$item[cnid]</td><td>$item[username]</td>".
			"<td>$work</td><td>$item[score]</td><td>$item[other]</td><td>$item[modifer]</td><td>$item[modiftime]</td>".
			"<td><a href='?dir=mgt&control=score&action=up&id=$item[id]&memberid=$memberid'>修改</a></td></tr>" ;
		$i++;
		}
		?>
		</table>
		
		
		<?php include 'paging.php';?>
	</div>
</div>
</body>
</html>