<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
<script language="javascript" type="text/javascript" src="js/Calendar1.js" ></script>
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>信息查询</h2></div>
        
        <div id="gamemain">
        <form method="post" action="?dir=mgt&control=userinfo&action=list">
       		账号：<input type="text" name="name" id="name" value="<?php echo @$userinfo['name'] ;?>" size="20" maxlength="50"/>
			姓名：<input type="text" name="username" id="username" value="<?php echo @$userinfo['username'] ;?>" size="10" maxlength="10"/>
       		会员类型：<select name="memberid" id="memberid">
       		<option value="0" >全部
	       		<?php 
				foreach($memberlist as $item){
					$id = $item['id'] ;
					$name = $item['name'] ;
					$p="" ;
					if($id==@$userinfo['memberid']){
						$p="selected" ;
					}
					echo "<option value='$id' $p>$name" ;
				}
	       		?>
			</select>
			手机号：<input type="text" name="mobile" id="mobile" value="<?php echo @$userinfo['mobile'] ;?>" size="11" maxlength="11"/>
			注册来源：<select name="tag" id="tag">
			<?php $tag = @$userinfo['tag'] ;?>
       		<option value="0" >全部
       		<option value='www' <?php if($tag=='www'){echo 'selected';}?>>www
			<option value='club' <?php if($tag=='club'){echo 'selected';}?>>club
			<option value='mgt' <?php if($tag=='mgt'){echo 'selected';}?>>mgt
			</select>
			注册日期:<input type="text" name="createtime" value="<?php echo @$userinfo['createtime']; ?>" size=10 onclick="new Calendar().show(this);" readonly>
			<input type="hidden" name="page" value="<?php echo @$userinfo['page'] ;?>"/>
			<input type="submit" value="查询">&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="export" id="export" value="导出">
        </form>
        </div>
        
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>姓名</td>
                <td>账号</td>
                <td>性别</td>
                <td>出生日期</td>
                <td>联系方式</td>
                <td>电子邮箱</td>
                <td>工作单位(职务)</td>
                <td>注册日期</td>
                <td>注册来源</td>
                <td>修改</td>
            </tr>
		<?php
		$i = 0;
		$pno = empty($userinfo['page'])?0:$userinfo['page'] ;//页号
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$memberid = $item['memberid'] ;
			$member = $item['member'] ;
			$memid = explode(',',$memberid) ;
			
			if(array_count_values($memid,2)){
				$member = " <a href='?dir=mgt&control=xueji&action=list2&userid=$item[id]'>$member</a> " ;
			}
			
			$sex = "-" ;
			if($item['sex']==1){
				$sex = "男" ;
			} else if($item['sex']==2){
				$sex = "女" ;
			}
			$birth 	= $item['birth'] ;
			$paperno= $item['paperno'] ;
			$mobile = $item['mobile'] ;
			if (!empty($item['phone'])){
				$mobile	.= '<br/>'.$item['phone'] ;
			}
			$email	= $item['email'] ;
			$company= $item['company'] ;
			$job	= $item['job'] ;
			if (!empty($job)){
				$company	.= '<br/>'.$job ;
			}
			$createtime = $item['createtime'] ;
			$tag = $item['tag'] ;
			
			$no = $i+1+FinalClass::$_list_pagesize*$pno ;//序号
			
			$q = @$_GET['q'] ;
			$op = "&nbsp;" ;
			if(!empty($q)){
				$op .= "<a href='?dir=mgt&control=userinfo&action=up&id=$item[id]'>修改信息</a>" ;
				if($q==2){
					$op .= "<input type='button' value='删除用户' onclick='del({$item['id']})'/>
					<input type='button' value='密码修改' onclick='up({$item['id']})'/>" ;
				}
			}
			echo "<tr class='$class'><td>$no</td><td><a href='?dir=mgt&control=userinfo&action=show&id=$item[id]'>$item[username]</a></td>".
			"<td>$item[name]</td>".
			//"<td>$member</td>".
			"<td>$sex</td><td>$birth</td>".
			//"<td>$paperno</td>".
			"<td>$mobile</td><td>$email</td><td>$company</td>".
			"<td>$createtime</td><td>$tag</td>".
			"<td>$op</td></tr>" ;
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
	    temp.action = "?dir=mgt&control=userinfo&action=export&name="+$('#name').val()
	    +"&username="+$('#username').val()+"&memberid="+$('#memberid').val()+"&mobile="+$('#mobile').val()
	    +"&tag="+$('#tag').val()+"&createtime="+$('#createtime').val();
	    temp.method = "POST";
	    temp.style.display = "none";

	    document.body.appendChild(temp);
	    temp.submit();
	    
	});
});

function up(uid){
	var password = prompt("请输入新密码","");
	if(password!=null && password!=""){
		$.get("?dir=mgt&control=userinfo&action=uppwd&userid="+uid+"&password="+password,{},function(data){
			alert(data) ;
		});
	}
}
function del(uid){
	if(uid!=null && uid!=""){
		if(confirm('你确定要删除用户吗？')){
		$.get("?dir=mgt&control=userinfo&action=del&userid="+uid,{},function(data){
			alert(data) ;
			location.reload();
		});
		}
	}
}
</script>