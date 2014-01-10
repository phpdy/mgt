<input type="text" name="SNO">  
<input type="text" name="TNO">  
<input type="button" value="ok" onclick="retrunValue()">  

<script language="javascript" type="text/javascript" >
function retrunValue(){  
 var TNO=document.all.TNO.value;  
 var SNO=document.all.SNO.value;  
  
//----------方法二--start-------  
// var obj = window.dialogArguments; //父页面对象  
// obj.elements["fag1"].value = SNO; //给父页面对象赋值  
// obj.elements["fag2"].value = TNO;   
//----------方法二--end-------  
  
//----------方法一--start-------  
 window.returnValue=SNO+","+TNO; //方法返回值  
//----------方法一--end-------  
 window.close();  
}
</script>