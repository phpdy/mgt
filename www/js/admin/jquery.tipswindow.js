//-------------------------------------------------------------------------------------
//Name:tipsWindow 2.0
//Author:By Await 
//Date:2010-11-18
//WebSite:http://leotheme.cn
//---------------------------------------------------------------------------------------
/*说明:
 *之前的版本存在很多Bug,代码也很乱.这次重写了代码；
 *2.0经过几天的测试，没发现什么问题，当然。大家遇到问题请通知我；
 *调用方法例子里已经做了说明；
 *在这里说下有些注意的地方：
 * 1.外部关闭弹出层方法：$.tipsWindow.removeBox();
 * 2.在.net下如果出现一闪就没了请在事件里加"return false"阻止默认事件;
 * 3.___fns:function(){}要在给定___closeID的时候才能回调；默认关闭时不会执行的;
 * 4.用url方式在Chrome浏览器下数据出错时请在SERVER端调用;
---------------------------------------------------------------------------------------*/
;(function(){	   
	$.tipsWindow=function(options){
		options = $.extend({
			___title: "Hello World",	//窗口标题文字
			___content: "text:内容",	//内容(可选内容为){ text | id | img | url | iframe }
			___width: "300",			//窗口宽度
			___height: "200",			//窗口离度
			___titleClass: "boxTitle",	//窗口标题样式名称
			___closeID:"",				//关闭窗口ID
			___time:"",					//自动关闭等待时间
			___drag:"",					//拖动手柄ID
			___showbg:false,			//是否显示遮罩层
			___fns:function(){}			//关闭窗口后执行的函数
		},options);
		if ($('#___box').length==0)$.tipsWindow.init(options);
	};
	$.extend($.tipsWindow,{
		//初始化
		init: function (options){
			$.tipsWindow.showBox(options);
			$("#___boxTitle>span").live("click",function(){	//默认关闭按钮
				$.tipsWindow.removeBox();
			});
			if(options.___closeID != ""){
				$("#"+options.___closeID).live("click",function(){	
					if(options.___fns != "" && $.isFunction(options.___fns)) {
						options.___fns.call(this);
					}
					$.tipsWindow.removeBox();
				});
			}
			if(options.___time != "") {
				setTimeout($.tipsWindow.removeBox,options.___time);
			}
			if(options.___showbg != "" && options.___showbg == true){
				var $boxBgDom = "<div id=\"boxBg\" style=\"position:absolute;width:100%;height:"+$(document).height()+"px;left:0;top:0;z-index: 999991\"></div>";
				$("body").append($boxBgDom);
			}
			if(options.___drag != "") {
				$.tipsWindow.dragBox(options);
			};
			if(options.___showbg != true){
				$box = $("#___box");
				$box.addClass("shadow");
			}
			$.tipsWindow.contentBox(options);
			$.tipsWindow.keyDown();
		},
		//构造并定位弹出层
		showBox: function(options) {
			var isIE6 = !-[1,] && !window.XMLHttpRequest;
			var	___width = options.___width < 100 ? 100 : options.___width,
				___height= options.___height < 50 ? 50 : options.___height;//设置最小宽高
			var $width = parseInt(options.___width)+2 > 1000 ? parseInt(options.___width)+2 : parseInt(options.___width)+2,
				$height = parseInt(options.___height)+33 > 550 ? 550 : parseInt(options.___height)+33;//设置最大宽高
			var $boxDom = "<div id=\"___box\" class=\"box\">";
				$boxDom += "<div id=\"___boxTitle\"><h3></h3><span>关闭</span></div>";
				$boxDom += "<div id=\"___boxContent\" class=\"boxContent\"></div>";
				$boxDom += "</div>";
				$("body").append($boxDom);
			var $box = $("#___box"),
				$boxContent = $("#___boxContent");
				$boxContent.css({
					width:___width+"px",
					height:___height+"px"
				});
			if(!isIE6){
				$box.css({
					position:"fixed",
					left:"50%",
					top:"50%",
					width:$width+"px",
					height:$height+"px",
					marginLeft:-(parseInt($width/2))+"px",
					marginTop:-(parseInt($height/2)+5)+"px",
					zIndex: "999999"
				});
			}else{
				$box.css({
					position:"absolute",
					left:"50%",
					top:document.documentElement.offsetHeight/2-$height/2-5+"px",
					width:$width+"px",
					height:$height+"px",
					marginLeft:-(parseInt($width/2))+"px",
					zIndex: "999999"
				});
				$(window).resize(function(){//当窗口大小发生变化时修正top值
					$box.css({
						top:document.documentElement.offsetHeight/2-$height/2-5+"px"
					});
				});
				$("select").css("visibility","hidden");//IE6下隐藏下拉菜单
				$("body").css("background-attachment","fixed").css("background-image","url(about:blank)");
				var $layer = document.createElement("<div style='position:absolute;border:0;padding:0;margin:0;overflow:hidden;background:transparent;top:expression((document).documentElement.scrollTop);left:expression((document).documentElement.scrollLeft);width:expression((document).documentElement.clientWidth);height:expression((document).documentElement.clientHeight);display:block;z-index:999992'>");
				$("body").append($layer);
				$box.appendTo($layer);//IE6下Fixed定位
			}
			var $title = $("#___boxTitle>h3");
				$title.html(options.___title);
			if(options.___titleClass != ""){
				$title.parent().addClass(options.___titleClass);
				$title.parent().find("span").hover(function(){
					$(this).addClass("hover");
				},function(){
					$(this).removeClass("hover");
				});
			}
		},
		//关闭弹出层
		removeBox: function (options){
			var $box = $("#___box");
			var $boxbg = $("#boxBg");
				$("select").css("visibility","visible");//关闭弹出层后显示下拉菜单
			if($box != null || $boxbg != null){
				$box.remove();
				$boxbg.remove();
			}
		},
		//健盘事件，当按Esc的时候关闭弹出层
		keyDown: function() {
			$(document).keydown(function(e) {
				e = e || event;
				if(e.keyCode == 27) $.tipsWindow.removeBox();
			})
		},
		//绑定拖拽
		dragBox: function (options){
			var moveX = 0,moveY = 0,
				drag = false;
			var ___ID = document.getElementById("___box"),
				___Handle = document.getElementById(options.___drag);
			___Handle.onmouseover = function() {
				this.style.cursor = "move";
			}
			___Handle.onmousedown = function(e) {
				drag = true;
				e = window.event?window.event:e;
				moveX = e.clientX - ___ID.offsetLeft;
				moveY = e.clientY - ___ID.offsetTop;
				document.onmousemove = function(e) {
					if (drag) {
						e = window.event?window.event:e;
						window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty();//阻止浏览器默认选取
						var x = e.clientX - moveX;
						var y = e.clientY - moveY;
						if ( x > 0 &&( x + ___ID.scrollWidth < document.documentElement.clientWidth) && y > 0 && y + ___ID.scrollHeight < document.documentElement.clientHeight ) {
							___ID.style.left = x + "px";
							___ID.style.top = y + "px";
							___ID.style.margin = "auto";
						}
					}
				};
				document.onmouseup = function(){
					drag = false;
				};
			};
		},
		//装载弹出层内容
		contentBox: function (options) {
			var $contentID = $("#___boxContent");
				$contentType = options.___content.substring(0,options.___content.indexOf(":"));
				$content = options.___content.substring(options.___content.indexOf(":")+1,options.___content.length);
			var isIE6 = !-[1,] && !window.XMLHttpRequest;
			switch($contentType) {
				case "text":
					$contentID.html($content);
				break;
				case "id":
					$contentID.html($("#"+$content).html());
				break;
				case "img":
				$contentID.ajaxStart(function() {
					$(this).html("<p class='boxLoading'>loading...</p>");
				});
				$.ajax({
					error:function(){
						$contentID.html("<p class='boxError'>加载数据出错...</p>");
					},
					success:function(html){
						$contentID.html("<img src="+$content+" alt='' />");
					}
				});
				break;
				case "url":
				var contentDate=$content.split("?");
				$contentID.ajaxStart(function(){
					$(this).html("<p class='boxLoading'>loading...</p>");
				});
				$.ajax({
					type:contentDate[0],
					url:contentDate[1],
					data:contentDate[2],
					error:function(){
						$contentID.html("<p class='boxError'>加载数据出错...</p>");
					},
					success:function(html){
						$contentID.html(html);
					}
				});
				break;
				case "iframe":
				$contentID.css({overflowY:"hidden"});
				$contentID.ajaxStart(function(){
					$(this).html("<p class='boxLoading'>loading...</p>");
				});
				$.ajax({
					error:function(){
						$contentID.html("<p class='boxError'>加载数据出错...</p>");
					},
					success:function(html){
						$contentID.html("<iframe src=\""+$content+"\" width=\"100%\" height=\""+parseInt(options.___height)+"px\" scrolling=\"auto\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>");
					}
				});
			}
		}
	});
})(jQuery);