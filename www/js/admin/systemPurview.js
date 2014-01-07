$(function() {
	var url = 'index.php?module=admin&action=ajax';
	var status = 0;// 状态为1是修改
	var guideTr = $('.trbg');
	for (i = 0; i < guideTr.length; i++) {
		guideTr[i].onmouseover = function() {
			var guideTd = $(this).find('td');
			for(j = 0; j < guideTd.length; j++){
				guideTd[j].style.backgroundColor = '#fee1e1';
			}
		}
		guideTr[i].onmouseout = function() {
			var guideTd = $(this).find('td');
			for(j = 0; j < guideTd.length; j++){
				guideTd[j].style.backgroundColor = '#f3fbff';
			}
		}
	}
	var trbgmun = guideTr.length;
	for ( var i = 0; i < trbgmun; i++) {
		$('input[name="cancel"]').eq(i).parent().hide();
	}
	for ( var i = 0; i < trbgmun; i++) {
		$('input[name="save"]').eq(i).parent().hide();
	}
	$('input[name="delete"]').click(function() {
		var tr = $(this).parent().parent();
		var privid = $(tr).find('td:first').text();
		if (confirm('确定删除该条权限（' + $(tr).find('font').eq(0).text() + '）吗？')) {
			$.post(url, {
				runaction : 'deletePriv',
				privid : privid
			}, function(data) {
				$(tr).remove();
			});
		}
	});
	$('input[name="update"]').click(function() {
		var tr = $(this).parent().parent();
		var td = $(tr).find('td');
		$(td).each(function(i) {
			$(this).children('font').hide();
		});
		var text = $(tr).find('input[type="text"]');
		$(text).each(function(i) {
			$(this).show();
		});
		$(tr).find('input[name="delete"]').parent().hide();
		$(tr).find('input[name="update"]').parent().hide();
		$(tr).find('input[name="save"]').parent().show();
		$(tr).find('input[name="cancel"]').parent().show();
	});
	$('input[name="cancel"]').click(function() {
		var tr = $(this).parent().parent();
		var td = $(tr).find('td');
		var font = $(tr).find('font');
		$(td).each(function(i) {
			$(this).children('font').show();
		});
		var text = $(tr).find('input[type="text"]');
		$(text).each(function(i) {
			$(this).hide();
		});
		$(text).eq(0).val($(font).eq(0).text());
		$(text).eq(1).val($(font).eq(1).text());
		$(text).eq(2).val($(font).eq(2).text());
		$(text).eq(3).val($(font).eq(3).text());
		$(text).eq(4).val($(font).eq(4).text());
		$(tr).find('input[name="delete"]').parent().show();
		$(tr).find('input[name="update"]').parent().show();
		$(tr).find('input[name="save"]').parent().hide();
		$(tr).find('input[name="cancel"]').parent().hide();
		status = 0;
	});
	$('input[name="save"]').click(function() {
		var tr = $(this).parent().parent();
		var td = $(tr).find('td');
		var privid = $(td).eq(0).text();
		var font = $(tr).find('font');
		$(td).each(function(i) {
			$(this).children('font').show();
		});
		var text = $(tr).find('input[type="text"]');
		$(text).each(function(i) {
			$(this).hide();
		});
		var privname = $(text).eq(0).val();
		var module = $(text).eq(1).val();
		var control = $(text).eq(2).val();
		var action = $(text).eq(3).val();
		var privurl = $(text).eq(4).val();
		$.post(url, {
			runaction : 'updateOraddPriv',
			privid : privid,
			privname : privname,
			module : module,
			control : control,
			action : action,
			privurl : privurl
		}, function(data) {
			// alert(data);
			$(font).eq(0).text(privname);
			$(font).eq(1).text(module);
			$(font).eq(2).text(control);
			$(font).eq(3).text(action);
			$(font).eq(4).text(privurl);
			$(tr).find('input[name="delete"]').parent().show();
			$(tr).find('input[name="update"]').parent().show();
			$(tr).find('input[name="save"]').parent().hide();
			$(tr).find('input[name="cancel"]').parent().hide();
			status = 0;
		});
	});
	$('input[name="action"]').blur(function() {
		var str = $(this).val();
		if (str != '') {
			$.post(url, {
				runaction : 'isChinese',
				str : str
			}, function(data) {
				if (data) {
					alert(data);
				}
			});
		} else {
			alert('不能为空！');
		}
	});
	$('#addFunc').click(function() {
		startObjVisible("float_layer");
	});
	$('.openorclose').click(function() {
		startObjVisible("float_layer");
	});
	$('input[name="submit"]').click(function() {
		var privname = $('#privname').val();
		var module = $('#module').val();
		var control = $('#control').val();
		var action = $('#action').val();
		var privurl = $('#privurl').val();
		$.post(url, {
			runaction : 'updateOraddPriv',
			privname : privname,
			module : module,
			control : control,
			action : action,
			privurl : privurl
		}, function(data) {
			// alert(data);
			window.location.reload();
		});
	});
});
