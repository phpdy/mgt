<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>用户列表</title>
<link rel="stylesheet" href="manager/css/style.css" />
<script src="manager/js/jquery-1.7.1.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>用户列表</h2></div>
        <table class="GF-listTab">
            <tbody><tr id="title">
                <td>用户ID</td><td>用户名</td><td>真实姓名</td><td>操作</td>
            </tr>				
				<?php 
					$i = 0;
					foreach ($userlist as $v) {
					$class = ($i%2==0 ? 'trstyle1' : 'trstyle2');
//						$realname = iconv('GBK', 'UTF-8' , $v['realname']);
						$realname = $v['username'];
						echo "<tr class='{$class}'>" ;
						echo "<td>{$v['id']}</td>" ;
						echo "<td>{$v['name']}</td>" ;
						echo "<td>{$realname}</td>" ;
						echo "<td><input type='button' value='查看' onclick='show({$v['id']})'/> " ;
						if ($type==0){
							echo "<input type='button' value='密码修改' onclick='up({$v['id']})'/> <input type='button' value='删除' onclick='del({$v['id']})'/>" ;
						}
						echo "</td><tr>";
						$i ++;
					}
				?>	
			</tbody>
			</table>
    </div>
</div>
</body>
</html>
<script type="text/javascript">

function show(uid){
//	alert("/index.php?dir=admin&control=user&action=user&userid="+uid) ;
	$.get("?dir=admin&control=user&action=user&userid="+uid,{},function(data){
//		alert(data) ;
		var user = eval('('+data+')');
		var msg = "用户ID："+user["id"]+"\r\n用户名："+user["name"]+"\r\n用户昵称："+user["username"] ;
		alert(msg) ;
	});
}
function up(uid){
	var password = prompt("请输入新密码","");
	if(password!=null && password!=""){
		$.get("?dir=admin&control=user&action=up&userid="+uid+"&password="+password,{},function(data){
			alert(data) ;
		});
	}
}
function del(id){
	var r=confirm("确认删除用户？") ;
	if(r){
		$.get("?dir=admin&control=user&action=del&userid="+id,{},function(data){
			alert(data) ;
		});
	}
}
//		$(function(){
//			$("#game").change(function(){
//					$.get("./index.php?dir=game&control=admins&action=getServer",{game:$('#game').val()},function(data){
//					var gamelist = eval('('+data+')');
//					list = gamelist['result'] ;
//					result = "<option value=0>全部</option>" ;
//					if(list.length!=0){
//					for(var i=0; i < list.length; i++){
//						item = list[i];
//						result += "<option value='"+item['serverId']+"'>"+item['serverName']+"</option>";
//					}
//				}else{
//					result="<option>暂无区服</option>";
//				}
//					document.getElementById("serverid").innerHTML = result;
//				});
//			});
//
//		})


</script>