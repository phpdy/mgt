<table>
	<tbody>
	<?php if(isset($userinfo) && isset($userinfo['id'])){ ?>
	<tr>
		<td class="title"><b>账号:</b></td><td><?php echo @$userinfo['name']; ?></td>
	</tr>
	<?php } else {?>
	<tr>
		<td class="title"><b>账号:</b></td><td><input type="text" name="name" id="name" value="" size=30> <font color='red'>*</font></td>
	</tr>
	<tr>
		<td class="title"><b>登录密码:</b></td><td><input type="password" name="password" id="password" value="" size=30> <font color='red'>*</font></td>
	</tr>
	<tr>
		<td class="title"><b>再次输入:</b></td><td><input type="password" name="repassword" id="repassword" value="" size=30> <font color='red'>*</font></td>
	</tr>
	<?php }?>
	<tr>
		<td class="title"><b>姓名:</b></td><td><input type="text" name="username" value="<?php echo @$userinfo['username']; ?>" size=20> <font color='red'>*</font></td>
	</tr>
	<tr><td class="title"><b>会员类型:</b></td><td>
		<?php foreach ($memberlist as $item){
			$id = $item['id'] ;
			$name = $item['name'] ;
			$op = "";
			if(array_count_values($userinfo['memberid'],$id)){
				$op = 'checked' ;
			}
			echo "<input type=\"checkbox\" id=\"$id\" value=\"$id\" $op name=\"memberid[]\"><label for=\"$id\">$name</label>" ;
		}
		?>
	</td>
	</tr>
	<tr>
		<td class="title"><b>性别:</b></td><td><input type="radio" <?php if(@$userinfo['sex']!=2){echo "checked";} ?> id="1" value="1" name="sex"><label for="1">男</label>
		<input type="radio" <?php if(@$userinfo['sex']==2){echo "checked";} ?> id="2" value="2" name="sex"><label for="2">女</label>
		</td>
	</tr>
	<tr><td class="title"><b>出生年月:</b></td><td><input type="text" name="birth" value="<?php echo @$userinfo['birth']; ?>" size=20 onclick="new Calendar().show(this);" readonly></td></tr>
	<tr><td class="title"><b>证件类型:</b></td><td>
		<select name="paper">
			<option value='1' <?php if(@$userinfo['paper']==1){echo "selected";} ?>>身份证
			<option value='2' <?php if(@$userinfo['paper']==2){echo "selected";} ?>>军官证
			<option value='3' <?php if(@$userinfo['paper']==3){echo "selected";} ?>>护照
			<option value='4' <?php if(@$userinfo['paper']==4){echo "selected";} ?>>港台证
			<option value='5' <?php if(@$userinfo['paper']==5){echo "selected";} ?>>其他
		</select></td>
	</tr>
	<tr><td class="title"><b>证件号:</b></td><td><input type="text" name="paperno" value="<?php echo @$userinfo['paperno']; ?>" size=20></td></tr>
	<tr><td class="title"><b>手机号:</b></td><td><input type="text" name="mobile" value="<?php echo @$userinfo['mobile']; ?>" size=20><font color='red'>*</font></td></tr>
	<tr><td class="title"><b>联系电话:</b></td><td><input type="text" name="phone" value="<?php echo @$userinfo['phone']; ?>" size=20></td></tr>
	<tr><td class="title"><b>电子邮箱:</b></td><td><input type="text" name="email" value="<?php echo @$userinfo['email']; ?>" size=20><font color='red'>*</font></td></tr>
	<tr>
		<td class="title"><b>工作单位:</b></td>
		<td><input type="text" name="company" value="<?php echo @$userinfo['company']; ?>" size=30>
		职务：<input type="text" name="job" value="<?php echo @$userinfo['job']; ?>" size=10>
		</td>
	</tr>
	<tr>
		<td class="title"><b>所在地:</b></td><td>
		<input type="text" name="province" value="<?php echo @$userinfo['province']; ?>" size=10>省
		<input type="text" name="city" value="<?php echo @$userinfo['city']; ?>" size=20>市</td>
	</tr>
	<tr>
		<td class="title"><b>通讯地址:</b></td><td><input type="text" name="address" value="<?php echo @$userinfo['address']; ?>" size=50>
		<b>邮编:</b><input type="text" name="post" value="<?php echo @$userinfo['post']; ?>" size=10></td>
	</tr>
	<tr><td class="title"><b>登记时间:</b></td><td><input type="text" name="createtime" value="<?php echo @$userinfo['createtime']?@$userinfo['createtime']:date('Y-m-d'); ?>" size=20 onclick="new Calendar().show(this);" readonly></td></tr>
	<tr><td class="title"><b>备注:</b></td><td><textarea name="other" cols=100 rows=5><?php echo @$userinfo['other']; ?></textarea></td></tr>
	
	<tr><td colspan="2"><input type="button" value="提  交" name="registsubmit" id="registsubmit"></td></tr>
	</tbody>
</table>
