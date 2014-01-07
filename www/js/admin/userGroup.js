var url = 'index.php?module=admin&action=ajax';
function getUserInfo(userid) {
	var user_group = document.getElementsByName('user_group');
	for(var j=0;j<user_group.length;j++){
			user_group[j].checked = false;
	}
	
	var channelall = document.getElementsByName('channelall');
	for(var j=0;j<channelall.length;j++){
		channelall[j].checked = false;
	}
	
	if (status == 1) {
		alert('您正在添加用户，不能查看已有用户信息！');
		return;
	}
	$('.bg').css('background', '');
	$('#' + userid).css('background', '#CCC');
	$.post(url, {
		runaction : 'selectUserGroupInfoId',
		userid : userid
	}, function(data) {
		data = eval("(" + data + ")");
		get_userid = data.Id;
		username = data.username;
		realname = data.realname;
		channelall = data.allchannel;
		$('#get_userid').val(get_userid);
		$('input[name="userCode"]').val(username);
		$('input[name="userName"]').val(realname)
		if(channelall == 1){
			$('input[name="channelall"]').attr('checked','true');
		}
		if(data.usergroup){
			usergroup = data.usergroup;
			var userarr = usergroup.split('|');
			var user_group = document.getElementsByName('user_group');
			for(var i=0;i<userarr.length;i++){
				for(var j=0;j<user_group.length;j++){
					if(userarr[i] == user_group[j].value){
						user_group[j].checked = true;
					}
				}
			}
			
		}

		
	});
}
function updateUser() {	
	var channelall = 0;
	if($('#channelall').attr("checked") == true){
		channelall = 1;
	}	
	var userid = get_userid ? get_userid : $('#get_userid').val();
	var name = $('#userName').val();
	var password = $('#user_password').val();
	
	
	var usg = new Array();
	var ugarray = document.getElementsByName('user_group');
	for(var i=0;i<ugarray.length;i++){
		if(ugarray[i].checked == true){
			usg.push(ugarray[i].value);
		}
	}
	
	if (ifrealname()) {
		$.post(url, {
			runaction : 'updateUserGroupInfo',
			userid : userid,
			realname : name,
			password : password,
			usergroup: usg,
			channelall : channelall
		}, function(data) {
			alert("用户信息修改成功");
			window.location.reload();
		});

	}
}
function deleteUser() {
	if (get_userid == 1) {
		alert("该用户不能删除！");
		return;
	}
	if (confirm("确定删除用户" + username + "吗？")) {
		$.post(url, {
			runaction : 'deleteUserGroupInfo',
			userid : get_userid
		}, function(data) {
			window.location.reload();
		});

	} else {
		return;
	}
}
function addUser() {
	var usg = new Array();
	var ugarray = document.getElementsByName('user_group');
	for(var i=0;i<ugarray.length;i++){
		if(ugarray[i].checked == true){
			usg.push(ugarray[i].value);
		}
	}
	
	var channelall = 0;
	if($('#channelall').attr("checked") == true){
		channelall = 1;
	}
	var user = {
		username : $('#userCode').val(),
		password : $('#user_password').val(),
		realname : $('#userName').val(),
		user_group:usg,
		channelall: channelall
	};
	if (ifusername() && ifrealname() && ifpassword()) {
		$.post(url, {
			runaction : 'addUserGroupInfo',
			user : user
		}, function(data) {
			if (data == "1") {
				alert("成功添加一个用户");
			}
			window.location.reload();
		});
	}
}

// 判断用户名
function ifusername() {
	var username = $("#userCode");
	if (username.val() == "") {
		$('#errusername').html('<font color=red>用户名不能为空</font>');
		return false;
	}
	if(!(/^[A-Za-z0-9_]+$/.test(username.val()))){
		alert('登录名不能为空且必须由字母、数字、下划线组成！');
		return false;
	}	
	var temp = false;
	$.ajax( {
		type : "POST",
		async : false,
		url : url,
		data : {
			runaction : 'ifname',
			username : username.val()
		},
		success : function(data) {
			if (data == "1") {
				$("#errusername").html('<font color=red>该用户已存在，不能注册！</font>');
				temp = false;
			} else {
				$("#errusername").html('<font color=green>可用的用户名！</font>');
				temp = true;
			}
		}
	});
	return temp;
}

// 判断真实姓名是否正确
function ifrealname() {
	var realname = $('#userName');
	$('#errrealname').html('');
	if (realname.val() == "") {
		$('#errrealname').html('<font color=red>真实姓名不能为空</font>');
		return false;
	}
	return true;
}

// 判断密码是否正确
function ifpassword() {
	var password = $('#user_password');
	$('#errpassword').html('');
	if (password.val() == "") {
		$('#errpassword').html('<font color=red>密码不能为空</font>');
		return false;
	} else if (password.val().length < 6 || password.val().length > 16) {
		$('#errpassword').html('<font color=red>密码由6至16位数字或字母组成</font>');
		return false;
	}
	return true;
}



function addCancleChange() {
	status = 0;
	$('input[name="hy"]').trigger('click');
	$('#get_userid').val(get_userid);
	$('#userCode').val(username);
	$('#userName').val(realname);
	$('#userCode').attr('disabled', true);
	$('#userName').attr('disabled', true);
	$('#password').hide();
	$('#group').hide();
	$('#channel_all').hide();
	$("#errusername").hide();
	$('#errrealname').hide();
	$('input[name="reset"]').hide();
	$('input[name="add"]').show();
	$('input[name="update"]').show();
	$('input[name="delete"]').show();
	$('input[name="cancle"]').hide();
	$('input[name="save"]').hide();
}
function updateCancleChange() {
	$('input[type="reset"]').trigger('click');
	$('input[name="userCode"]').attr('disabled', true);
	$('input[name="userName"]').attr('disabled', true);
	$('input[name="user_password"]').attr('disabled', true);
	$('#password').hide();
	$('#group').hide();
	$('#channel_all').hide();
	$('input[name="update"]').show();
	$('input[name="cancle"]').hide();
	$('input[name="save"]').hide();
	$('input[type="reset"]').hide();
}
function clearForm() {
	$('input[name="userCode"]').val('');
	$('input[name="userName"]').val('');
	$('input[name="user_password"]').val('');
	$('input[type="checkbox"]').attr('checked','');
}
