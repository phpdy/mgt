function save(id,mark){
		if(mark=='consumecode'){
			var id = $("#id"+id).val();
			var appName = $("#appName"+id).val();
			var ydappname = $("#ydappname"+id).val();
			var CPID = $("#CPID"+id).val();
			var CPServiceID = $("#CPServiceID"+id).val();
			var ChannelID = $("#ChannelID"+id).val();
			var sender = $("#sender"+id).val();
			var money = $("#money"+id).val();
			var consumeCode = $("#consumeCode"+id).val();
			var ydKey = $("#ydKey"+id).val();
			$.ajax({
				type:"POST",
				url:"./index.php?module=business&control=ydconsumecode&action=update",
				data:{'id':id,'appName':appName,'ydappname':ydappname,'CPID':CPID,'CPServiceID':CPServiceID,'ChannelID':ChannelID,'sender':sender,'money':money,'consumeCode':consumeCode,'ydKey':ydKey},
				dataType:"json",
				success:function(res){
					if(res==0){
					alert("更新成功");
					}else{
						alert("更新失败");
					}
					
				},
				error:function(){
					alert("更新失败");
			}});
		}else{
			var id = $("#id"+id).val();
			var coopName = $("#coopName"+id).val();
			var coop_name = $("#coop_name"+id).val();
			var coopAppName = $("#coopAppName"+id).val();
			var coop_appname = $("#coop_appname"+id).val();
			var coop_key = $("#coop_key"+id).val();
			var safeip = $("#safeip"+id).val();
			var payway = $("#payway"+id).val();
			var isuse = $("#isuse"+id).val();
			var consumecode_name = $("#consumecode_name"+id).val();
			var avail = $("#avail"+id).val();
			$.ajax({
				type:"POST",
				url:"./index.php?module=business&control=ydcollaborator&action=update",
				data:{'id':id,'coopName':coopName,'coop_name':coop_name,'coopAppName':coopAppName,'coop_appname':coop_appname,'coop_key':coop_key,'safeip':safeip,'payway':payway,'isuse':isuse,'consumecode_name':consumecode_name,"avail":avail},
				dataType:"json",
				success:function(res){
					if(res==0){
					alert("更新成功");
					}
					
				},
				error:function(){
					alert("更新失败");
			}});
		}
}
			
function addsave(){
	 data = new Array();
	 var i =0 
	$(".operateEdit").each(function(){
		var name = $(this).attr('name');
		var val = $(this).val();
		data[i] = name+"="+val;
		i++
	});
	datastr =data.join('&');
	$.ajax({
		type:"POST",
		url:"./index.php?module=business&control=ydconsumecode&action=insert",
		data:datastr,
		dataType:"json",
		success:function(res){
			if(res==0){
				alert("添加成功");
			}else{
				alert("添加成功");
			}
			

		},
		error:function(){
			alert("添加失败");
	}});
}
function collaboratorsave(){
	 data = new Array();
	 var i =0 
	$(".operateEdit").each(function(){
		var name = $(this).attr('name');
		var val = $(this).val();
		data[i] = name+"="+val;
		i++
	});
	datastr =data.join('&');
	$.ajax({
		type:"POST",
		url:"./index.php?module=business&control=ydcollaborator&action=insert",
		data:datastr,
		dataType:"json",
		success:function(res){
			if(res==0){
				alert("添加成功");
			}
			

		},
		error:function(){
			alert("添加失败");
	}});
}

function yddelete(id){

	$.ajax({
		type:"POST",
		url:"./index.php?module=business&control=ydconsumecode&action=delete",
		data:{'id':id},
		dataType:"json",
		success:function(res){
			if(res==0){
				alert("删除成功");
			}
			
		},
		error:function(){
			alert("删除失败");
	}});	
		
}

function collaboratordelete(id){
	$.ajax({
		type:"POST",
		url:"./index.php?module=business&control=ydcollaborator&action=delete",
		data:{'id':id},
		dataType:"json",
		success:function(res){
			if(res==0){
				alert("删除成功");
			}
		},
		error:function(){
			alert("删除失败");
	}});	

} 