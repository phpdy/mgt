
<!-- 分页 -->
<div style="text-align:center;margin:0 auto;font-size:20px">
<?php 
for($i=0;$i<$pagenum;$i++){
	if($pno==$i){
		echo " ".($i+1)." " ;
	} else {
		echo " <a href='#' onclick='page($i)'>".($i+1)."</a> " ;
	}
}
?>
</div>

<script language="javascript" type="text/javascript" src="manager/js/jquery-1.7.1.js" ></script>
<script language="javascript" type="text/javascript" >

function page(p){
	$('input[name="page"]').val(p);
	$('form').submit();
}

</script>