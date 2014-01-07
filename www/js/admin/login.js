$(function() {
	var url = 'index.php?module=admin&action=login';
	$('input[name="username"]').focus(function(){
		$('input[name="username"]').val('');
	});
	$('input[name="username"]').blur(function(){
		if($('input[name="username"]').val() == ''){
			$('input[name="username"]').val('username');
		}
	});
	$('#submit').click(function() {
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		if(username == ''){
			alert('用户名不能为空!');
			$('input[name="username"]').focus();
			return false;
		}
		
		if(password == ''){
			alert('密码不能为空!');
			$('input[name="password"]').focus();
			return false;
		}
		if (username && password) {
			$.post(url, {
				username : username,
				password : password
			}, function(data) {
				if(data == '-2') {
					alert('not user');
				}else if (data == '-1'){
					alert("密码错误");
				}else{
					$('form').submit();
				}
			});
		}
	});
});