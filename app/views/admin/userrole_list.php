<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>用户角色列表</title>
<link rel="stylesheet" href="manager/css/style.css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>用户角色列表</h2></div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title"><td>用户ID</td><td>用户名</td><td>真实姓名</td><td>角色</td><td>操作</td></tr>
            <?php 
			$i = 0;
			foreach ($list as $item){
				$class = ($i%2==0 ? 'trstyle1' : 'trstyle2');
				echo "<tr class='$class'><td>$item[userid]</td>" ;
				$realname = "已删除" ;
				$username = $item['userid'] ;
				$i ++;
				foreach ($user_list as $user){
					if ($user['id']==$item['userid']){
						$username = $user['name'];
//						$realname = iconv('GBK', 'UTF-8' , $user['realname']);
						$realname = $user['username'];
						break ;
					}
				}
				$rolses = $item['rolses'] ;
				$rolses = explode(',', $rolses) ;
				$rolseNames = "" ;
				foreach ($rolses as $id){
					foreach ($rolse_list as $items){
						if ($id==$items['id']){
							$rolseNames .= $items['rolse'].'|' ;
							break ;
						}
					}
				}
				echo "<td>{$username}</td><td><a href='?dir=admin&control=userrole&action=up&id=$item[id]'>$realname</a></td><td>$rolseNames</td>";
				$userroleid = $item['id'];
				echo "<td><a href='#' onclick='showconfirm($userroleid)'>删除</a></td></tr>";
			}
			?>
            </tbody>
        </table>
    </div>
</div>
<script>
	function showconfirm(id) {
		if (confirm("确定删除吗?") == true) {
			window.location.href="index.php?dir=admin&control=userrole&action=del&id="+id;
		}		
	}
</script>
</body>
</html>