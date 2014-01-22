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
        <div id="gamefeatures"><h2>学籍列表</h2></div>
        
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
			
			$no = $i+1;//序号
			echo "<tr class='$class'><td>$no</td><td>$item[username]</td>".
			"<td>$item[cnid]</td><td>$rembername</td><td>$item[start_date]</td><td>$item[end_date]</td><td>$state</td>".
			"</tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>