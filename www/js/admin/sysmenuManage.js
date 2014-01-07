$(function() {
	var url = 'index.php?module=admin&action=ajax';
	var trmun = $('.tr').length;
	var trColor = [ "#FEE065", "#DAF39C", "#7FBFE5" ];
	for (i = 0; i < trmun; i++) {
		$('.tr')[i].style.backgroundColor = trColor[i % 2];
		$('.tr')[i].onmouseover = function() {
			this.style.backgroundColor = trColor[2];
		}
		$('.tr')[i].onmouseout = function() {
			this.style.backgroundColor = trColor[this.sectionRowIndex % 2];
		}
	}
	for ( var i = 0; i < trmun; i++) {
		$('input[name="cancel"]').eq(i).parent().hide();
	}
	for ( var i = 0; i < trmun; i++) {
		$('input[name="save"]').eq(i).parent().hide();
	}
	$('.openorclose').click(function() {
		startObjVisible('pingbi');
	});
	$('.int').blur(function() {
		// 判断是否为整数
		var value = $(this).val();
		if (!(/^(\+|-)?\d+$/.test(value)) || value < 0) {
			alert($(this).attr('alt') + "必须是正整数！");
		}
	});
	$('input[name="delete"]').click(function() {
		var tr = $(this).parent().parent();
		var menuID = $(tr).find('td:first').text();
		if (confirm('确定删除该目录节点（' + $(tr).find('font').eq(0).text() + '）吗？')) {
			$.post(url, {
				runaction : 'deleteSysMenu',
				menuID : menuID
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
	});
	$('input[name="save"]').click(function() {
		var tr = $(this).parent().parent();
		var td = $(tr).find('td');
		var menuID = $(td).eq(0).text();
		var font = $(tr).find('font');
		$(td).each(function(i) {
			$(this).children('font').show();
		});
		var text = $(tr).find('input[type="text"]');
		$(text).each(function(i) {
			$(this).hide();
		});
		var menuname = $(text).eq(0).val();
		var menuurl = $(text).eq(1).val();
		var privid = $(text).eq(2).val();
		var onelevel = $(text).eq(3).val();
		var twolevel = $(text).eq(4).val();
		$.post(url, {
			runaction : 'updateOraddSysMunu',
			menuID : menuID,
			menuname : menuname,
			menuurl : menuurl,
			privid : privid,
			onelevel : onelevel,
			twolevel : twolevel
		}, function(data) {
			// alert(data);
			$(font).eq(0).text(menuname);
			$(font).eq(1).text(menuurl);
			$(font).eq(2).text(privid);
			$(font).eq(3).text(onelevel);
			$(font).eq(4).text(twolevel);
			$(tr).find('input[name="delete"]').parent().show();
			$(tr).find('input[name="update"]').parent().show();
			$(tr).find('input[name="save"]').parent().hide();
			$(tr).find('input[name="cancel"]').parent().hide();
		});
	});
	$('input[name="submit"]').click(function() {
		var menuname = $('#menuname').val();
		var privid = $('#privid').val();
		var onelevel = $('#onelevel').val();
		var twolevel = $('#twolevel').val();
		var menuurl = $('#menuurl').val();
		$.post(url, {
			runaction : 'updateOraddSysMunu',
			menuname : menuname,
			menuurl : menuurl,
			privid : privid,
			onelevel : onelevel,
			twolevel : twolevel
		}, function(data) {
			window.location.reload();
		});
	});
});