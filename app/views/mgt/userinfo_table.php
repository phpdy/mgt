<table>
	<tbody>
	<tr>
		<td class="title"><b>姓名:</b></td><td><input type="text" name="username" value="<?php echo $userinfo['username']; ?>" size=20></td>
	</tr>
	<tr><td class="title"><b>会员类型:</b></td><td>
		<select name="member">
			<option value="0" <?php if($userinfo['member']==0){echo "selected";}?>>普通会员
			<option value="1" <?php if($userinfo['member']==1){echo "selected";}?>>全科会员
			<option value="2" <?php if($userinfo['member']==2){echo "selected";}?>>在线教育会员
			<option value="3" <?php if($userinfo['member']==3){echo "selected";}?>>俱乐部会员
		</select></td>
	</tr>
	<tr>
		<td class="title"><b>性别:</b></td><td><input type="radio" <?php if($userinfo['sex']==1){echo "checked";} ?> id="1" value="1" name="sex"><label for="1">男</label>
		<input type="radio" <?php if($userinfo['sex']==2){echo "checked";} ?> id="2" value="2" name="sex"><label for="2">女</label></td>
	</tr>
	<tr><td class="title"><b>出生年月:</b></td><td><input type="text" name="birth" value="<?php echo $userinfo['birth']; ?>" size=20 onclick="new Calendar().show(this);"></td></tr>
	<tr><td class="title"><b>身份证号:</b></td><td><input type="text" name="sfz" value="<?php echo $userinfo['sfz']; ?>" size=20></td></tr>
	<tr>
		<td class="title"><b>所在地:</b></td><td>
		<input type="text" name="province" value="<?php echo $userinfo['province']; ?>" size=10>省
		<input type="text" name="city" value="<?php echo $userinfo['city']; ?>" size=20>市</td>
	</tr>
	<tr>
		<td class="title"><b>通讯地址:</b></td><td><input type="text" name="address" value="<?php echo $userinfo['address']; ?>" size=50>
		<b>邮编:</b><input type="text" name="post" value="<?php echo $userinfo['post']; ?>" size=10></td>
	</tr>
	<tr><td class="title"><b>手机号:</b></td><td><input type="text" name="mobile" value="<?php echo $userinfo['mobile']; ?>" size=20></td></tr>
	<tr><td class="title"><b>电话:</b></td><td><input type="text" name="phone" value="<?php echo $userinfo['phone']; ?>" size=20></td></tr>
	<tr><td class="title"><b>电子邮箱:</b></td><td><input type="text" name="email" value="<?php echo $userinfo['email']; ?>" size=20></td></tr>
	<tr><td class="title"><b>登记时间:</b></td><td><input type="text" name="createtime" value="<?php echo $userinfo['createtime']; ?>" size=20></td></tr>

	<tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
	</tbody>
</table>
