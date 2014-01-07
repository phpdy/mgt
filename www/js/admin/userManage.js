var url = 'index.php?module=admin&action=ajax';
function getUserInfo(userid) {
	// alert($('input[name="userCode"]').attr('id'));
	if (status == 1) {
		alert('您正在添加用户，不能查看已有用户信息！');
		return;
	}
	$('.bg').css('background', '');
	$('#' + userid).css('background', '#CCC');
	$.post(url, {
		runaction : 'selectUserInfoId',
		userid : userid
	}, function(data) {
		data = eval("(" + data + ")");
		get_userid = data.Id;
		username = data.username;
		realname = data.realname;
		$('#get_userid').val(get_userid);
		$('input[name="userCode"]').val(username);
		$('input[name="userName"]').val(realname);
		$('select[name="gameGroup"]').val(data.gameGroup);
		// alert($('input[name="password"]').val()+'=>'+$('input[name="oldpass"]').val());
	});
}
function updateUser() {
	var userid = get_userid ? get_userid : $('#get_userid').val();
	var name = realname ? realname : $('#userName').val();
	var password = $('#user_password').val();
	var gameGroup = $('#gameGroup').eq(0).val();
	if (ifrealname() && ifpassword()) {
		$.post(url, {
			runaction : 'updateUserInfo',
			userid : userid,
			realname : name,
			password : password,
			gameGroup : gameGroup
		}, function(data) {
			alert("用户信息修改成功");
			window.location.reload();
		});

	}
}
function deleteUser() {
	// userid = $('get_userid').val();
	// var username = $('#userName').val();
	if (get_userid == 1) {
		alert("该用户不能删除！");
		return;
	}
	if (confirm("确定删除用户" + username + "吗？")) {
		$.post(url, {
			runaction : 'deleteUserInfo',
			userid : get_userid
		}, function(data) {
			window.location.reload();
		});

	} else {
		return;
	}
}
function addUser() {
	var user = {
		username : $('#userCode').val(),
		password : $('#user_password').val(),
		realname : $('#userName').val(),
		gameGroup : $('#gameGroup').eq(0).val()
	};
	if (ifusername() && ifrealname() && ifpassword()) {
		$.post(url, {
			runaction : 'addUserInfo',
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
	$('#gameGroup').attr('disabled',true);
	$('#password').hide();
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
	$('input[name="update"]').show();
	$('input[name="cancle"]').hide();
	$('input[name="save"]').hide();
	$('input[type="reset"]').hide();
}
function clearForm() {
	$('input[name="userCode"]').val('');
	$('input[name="userName"]').val('');
	$('input[name="user_password"]').val('');
	$('select[name="gameGroup"]').val('0');
}
