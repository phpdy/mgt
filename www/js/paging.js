/**
 * 分页
 */
window.onload = function(){
	paging.export_url();
}
var paging = {
	// 加载全部
	/**
	 * @param 条件
	 * @param 调用的方法
	 */
	loaded : function(where){
		var action = $('#action').val();
		var Field = control = '';
		if(typeof(action) != 'undefined'){
			action = '&action=' + action;
			Field = 1;
			control = 'channelorder';
		}else{
			action = '';
			control = 'default';
		}
		$.ajax({
			url : 'index.php?module=business&control=ordermanage&action=' + control + '&page=' + where.page + '&offset=' + where.offset + '&orderform=' + where.orderform + '&start_time=' + where.start_time + '&end_time=' + where.end_time + '&cooperate=' + where.cooperate + '&paystate=' + where.paystate + '&Field=' + Field,
			type : 'get',
			dataType : 'json',
			success : function(result){
				if(result != ''){
					var str = style = '';
	    			$.each(result.Orders, function(ind, item){
	    				var paystate = item.paystate;
	    				if((ind % 2) == 0)
	    					style = 'background:#FFFFCC';
	    				else
	    					style = '';
	    				if(action == ''){
		    				str += '<tr style="' + style + '">';
							str += '<td>' + item.id + '</td>';
							str += '<td>' + item.addordertime + '</td>';
							str += '<td>' + item.paytime + '</td>';
							str += '<td>' + item.coop_id + '</td>';
							str += '<td>' + item.coop_spid + '</td>';
							str += '<td>' + item.coop_app + '</td>';
							str += '<td>' + item.coop_uid + '</td>';
							str += '<td>' + item.paymoney + '</td>';
							str += '<td>' + item.orderid + '</td>';
							str += '<td>' + item.coop_orderid + '</td>';
							if(item.paystate == 0){
								paystate = '订单入库';
							}else if(item.paystate == 1){
								paystate = '充值失败';
							}else if(item.paystate == 2){
								paystate = '充值成功';
							}else{
								paystate = item.paystate;
							}
							str += '<td>' + paystate + '</td>';
							if(item.payway == 1) 
								payway = "手机";
							else
								payway = "其他";
							str += '<td>' + payway + '</td>';
							str += '<td>' + item.phone + '</td>';
							str += '<td>' + item.yd_paycode + '</td>';
			                str += '</tr>';
			            }else{
			            	str += '<tr style="' + style + '">';
							str += '<td>' + item.addordertime + '</td>';
							str += '<td>' + item.paytime + '</td>';
							str += '<td>' + item.paymoney + '</td>';
							str += '<td>' + item.coop_orderid + '</td>';
							if(item.paystate == 0){
								paystate = '订单入库';
							}else if(item.paystate == 1){
								paystate = '充值失败';
							}else if(item.paystate == 2){
								paystate = '充值成功';
							}else{
								paystate = item.paystate;
							}
							str += '<td>' + paystate + '</td>';
							if(item.payway == 1) 
								payway = "手机";
							else
								payway = "其他";
							str += '<td>' + item.yd_paycode + '</td>';
			                str += '</tr>';
			            }
	    			})
	    			$('#orders_list').html(str);
	    			$('#paymoney').html(((result.Amount.paymoney == null) ? 0 : result.Amount.paymoney) + ' 元');
	    			$('#total').html(parseInt(result.Amount.total) + ' 条');
	    			paging.after_page(where.page, result.Paging.total);
	    			paging.export_url();
	            }
			}
		})
	},
	// 设置按钮数据		
	/** 
	 * @param page 分页
	 */
	after_page : function(page, total){
		$('#CurrPage').html(page);
		$('#jumpPage').val(page);
		$('#Next').attr('data', parseInt(page) + 1);
		$('#Previous').attr('data', page - 1);
		$('#totalPage').html(total);
	},
	handles_paging : function(){

	},
	// 获取条件
	handles_where : function(page){
		var where = {
			'page' : page,
			'offset' : parseInt($('#offset').val()),
			'cooperate' : typeof($('#cooperate').val()) != 'undefined' ? $('#cooperate').val() : '',
			'paystate' : $('#paystate').val(),
			'start_time' : $('#start_time').val(),
			'end_time' : $('#end_time').val(),
			'orderform' : $('#orderform').val()
		};
		return where;
	},
	// 设置导出数据URL
	export_url : function(){
		var where = paging.handles_where(-1);
		var channel = $('#action').val();
		if(typeof(channel) != 'undefined' && channel != '')
			channel = 'true';
		else
			channel = '';
		var $url = 'index.php?module=business&control=ordermanage&action=ExportData&channel=' + channel + '&orderform=' + where.orderform + '&start_time=' + where.start_time + '&end_time=' + where.end_time + '&cooperate=' + where.cooperate + '&paystate=' + where.paystate;
		$('#ExportData').attr('href', $url);
	}


}

/** 上一页 **/
$('#Previous').click(function(){
	var _this = $(this);
	var page = $(this).attr("data");
	if(page < 1) return;
	paging.loaded(paging.handles_where(page));
})

/** 下一页 **/
$('#Next').click(function(){
	var _this = $(this);
	var page = _this.attr('data');
	if(page > parseInt($('#totalPage').html())) return;
	paging.loaded(paging.handles_where(page));
})

/** 每页显示条数 **/
$('#offsetPage').click(function(){
	var _this = $(this);
	var page = parseInt($('#CurrPage').html());
	paging.loaded(paging.handles_where(page));
})

/** 查询 **/
$('#inquiry').bind('click', function(){
	var where = paging.handles_where(1);
	paging.loaded(where);
})

/** 跳转 **/
$('#onJump').click(function(){
	var page = parseInt($('#jumpPage').val());
	var total = parseInt($('#totalPage').html());
	if(page > total) return;
	if(page <= 0) return;
	paging.loaded(paging.handles_where(page));
})

/** 清空时间 **/
$('#start_remove').bind('click', function(){
	$('#start_time').val('');
})
$('#end_remove').bind('click', function(){
	$('#end_time').val('');
})

/** 导出数据 **/
//document.getElementById('ExportData').onClick = function(){
//	var hidefocus = $(this).attr('hidefocus');
//	if(hidefocus != 'true') return;
//	$(this).attr('hidefocus', 'false');
//	var where = paging.handles_where(-1);
//	var $url = 'index.php?module=business&control=ordermanage&action=ExportData&orderform=' + where.orderform + '&start_time=' + where.start_time + '&end_time=' + where.end_time + '&cooperate=' + where.cooperate + '&paystate=' + where.paystate;
//	window.open ($url,'newwindow','height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') 
//
//	$(this).attr('hidefocus', 'true');
//}
//$('#ExportData').bind('click', function(){
//	var hidefocus = $(this).attr('hidefocus');
//	if(hidefocus != 'true') return;
//	$(this).attr('hidefocus', 'false');
//	var where = paging.handles_where(-1);
//	var $url = 'index.php?module=business&control=ordermanage&action=ExportData&orderform=' + where.orderform + '&start_time=' + where.start_time + '&end_time=' + where.end_time + '&cooperate=' + where.cooperate + '&paystate=' + where.paystate;
//	window.open ($url,'newwindow','height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') 
//
//	$(this).attr('hidefocus', 'true');
//})