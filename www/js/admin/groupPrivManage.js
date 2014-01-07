var url = 'index.php?module=admin&action=ajax';
function cancleChange() {
	setDisabled(true);
	$('input[name="update"]').attr('disabled', false);
	$('input[name="save"]').attr('disabled', true);
	$('input[name="cancle"]').attr('disabled', true);
}

function saveGroupPriv() {
	var setArr = $('.set');
	var setmun = setArr.length;
	var checkArr = new Array();
	var z = 0;
	var s = 0;
	for ( var i = 0; i < setmun; i++) {
		var setId = $(setArr).eq(i).attr('id');
		var input = $('#' + setId + ' div').children('input[type="checkbox"]');
		var inputmun = input.length;
		for ( var j = 0; j < inputmun; j++) {
			var check = $(input).eq(j).attr('checked');
			if (check) {
				checkArr[z++] = $(input).eq(j).attr('id');
				// alert($(input).eq(j).attr('id') + '=>' +
				// $(input).eq(j).val());
			}
		}
	}
	var checkmun = checkArr.length;
	var checkStr = '';
	for ( var i = 0; i < checkmun; i++) {
		if (i + 1 < checkmun) {
			// alert(i + '=>' + checkmun);
			checkStr += checkArr[i] + '|';
		} else {
			checkStr += checkArr[i];
		}
	}
	// alert(checkStr+':'+userID);
	$.post(url, {
		runaction : 'updateUserPriv',
		checkStr : checkStr,
		userID : ID
	}, function(data) {
		// alert(data);
		$('input[name="cancle"]').trigger("click");
	});
}

function updateGroupPriv() {
	// if (ID == 1) {
	// alert('锟斤拷锟矫伙拷为锟斤拷锟斤拷员锟斤拷锟斤拷锟矫伙拷权锟斤拷只锟杰憋拷锟街讹拷锟睫改ｏ拷');
	// return;
	// }
	setDisabled(false);
	$('input[name="update"]').attr('disabled', true);
	$('input[name="save"]').attr('disabled', false);
	$('input[name="cancle"]').attr('disabled', false);
}

function setDisabled(b) {
	var cbArr = document.getElementsByTagName("INPUT");
	for ( var i = 0; i < cbArr.length; i++) {
		var cb = cbArr[i];
		var cbvalue = cb.value;
		if (cb.type == "checkbox") {
			cb.disabled = b;
		}
	}
}
function doCheck(cd) {
	var i = 0;
	var temp = new Array();
	var check = $(cd).parent().children('input[type="checkbox"]');
	var len = check.length;
	$(check).each(function() {
		if ($(this).attr('checked')) {
			temp[i++] = this;
		}
	});
	if (temp.length == len) {
		var a = temp[0].title;
		var b = temp[0].alt;
		$('#' + a).attr('checked', true);
		$('#' + b).attr('checked', true);
	} else {
		var a = temp[0].title;
		var b = temp[0].alt;
		$('#' + a).attr('checked', false);
		$('#' + b).attr('checked', false);
	}
}
function selectBarPrivs(obj) {
	var checkval = $(obj).attr('checked');
	 alert(checkval);
	var check = $(obj).parent().parent().find('input[type="checkbox"]');
	 alert(check.length);
	var count = check.length;
	for ( var i = 0; i < count; i++) {
		check.eq(i).attr('checked', checkval);
	}
}
function selectModPrivs(mcb, check) {
	var a = mcb.alt;
	if (check) {
		$('#' + a).attr('checked', true);
	} else {
		$('#' + a).attr('checked', false);
	}
	var cbArr = $(mcb).parent().parent().find('div>input[type="checkbox"]');
	for ( var i = 0; i < cbArr.length; i++) {
		var cb = cbArr[i];
		if (cb.type == "checkbox") {
			cb.checked = check;
		}
	}
}
function getUserInfo(userid) {
	ID = userid;
	$('.bg').css('background', '');
	$('#' + userid).css('background', '#CCC');
	$.post(url, {
		runaction : 'selectOnePriv',
		userID : userid
	}, function(data) {
		data = eval("(" + data + ")");
		for ( var length in data) {
			length++;
		}
		$('input[type="checkbox"]').each(function(i) {
			this.checked = false;
		});
		for ( var i = 0; i < length; i++) {
			$('#' + data[i].privid).attr('checked', true);
		}
		checked();
	});
}
function checked() {
	$('.prividbox').each(function() {
		var i = 0;
		var temp = new Array();
		var check = $(this).children('input[type="checkbox"]');
		var len = check.length;
		$(check).each(function() {
			if ($(this).attr('checked')) {
				temp[i++] = this;
			}
		});
		try {
			if (temp.length == len) {
				var a = temp[0].title;
				var b = temp[0].alt;
				$('#' + a).attr('checked', true);
				$('#' + b).attr('checked', true);
			} else {
				var a = temp[0].title;
				var b = temp[0].alt;
				$('#' + a).attr('checked', false);
				$('#' + b).attr('checked', false);
			}
		} catch (a) {
		}
	});
}

function checkItem(){
	if($('#englishItem').val()==''){
		alert('请输入项目英文名!!');
		$('#englishItem').focus();
		return false;
	}
	
	if($('#chineseItem').val()==''){
		alert('请输入项目中文名!!');
		$('#chineseItem').focus();
		return false;
	}
}

//页面初始化函数
function initialize(){
	$('#up').attr('disabled',false);
	$('#sa').attr('disabled','disabled');
	$('#cl').attr('disabled','disabled');
	$('input[type=checkbox]').attr('disabled','disabled');
}

//点击人物触动函数
function getUserItemsPriv(userid,username){
	$('#user').text(username);
	$.ajax({
	       url:url, //后台处理程序
	       type:'post',         //数据发送方式
	       dataType:'json',     //接受数据格式
	       data:{userid:userid,runaction:'getItemUser'},         //要传递的数据
	       success:function (data){
		       	$('input[type=checkbox]').attr("checked",false);
				for(var i=0; i<data.length; i++){
					$('#item_'+data[i]["itemid"]).attr("checked","checked");
				}
				$('#id_user').val(userid);
	       }
	     });
}

//点击修改触动函数
function enCheckbox(){
	$("#up").attr("disabled","disabled");
	$("#sa").attr("disabled",false);
	$("#cl").attr("disabled",false);
	$("input[type=checkbox]").attr("disabled",false);
}

//点击取消触动函数
function disCheckbox(){
	$("#up").attr("disabled",false);
	$("#sa").attr("disabled","disabled");
	$("#cl").attr("disabled","disabled");
	$("input[type=checkbox]").attr("disabled","disabled");
}

//全选函数
function selectAll(privid,check){
	$(".class"+privid).attr("checked",check);
}


//修改用户二级权限时触动函数
function saveUserItem(){
	var userid = $('#id_user').val();
	if(userid == ''){
		alert('请选择用户!!');
		return false;
	}
}

function saveMenu() {
	var setArr = $('.set');
	var setmun = setArr.length;
	var checkArr = new Array();
	var z = 0;
	var s = 0;
	for ( var i = 0; i < setmun; i++) {
		var setId = $(setArr).eq(i).attr('id');
		var input = $('#' + setId + ' div').children('input[type="checkbox"]');
		var inputmun = input.length;
		for ( var j = 0; j < inputmun; j++) {
			var check = $(input).eq(j).attr('checked');
			if (check) {
				checkArr[z++] = $(input).eq(j).attr('id');
			}
		}
	}
	var checkmun = checkArr.length;
	var checkStr = '';
	for ( var i = 0; i < checkmun; i++) {
		if (i + 1 < checkmun) {
			checkStr += checkArr[i] + '|';
		} else {
			checkStr += checkArr[i];
		}
	}

	$.post(url, {
		runaction : 'updateErPriv',
		checkStr : checkStr
	}, function(data) {
		$('input[name="cancle"]').trigger("click");
	});
}

