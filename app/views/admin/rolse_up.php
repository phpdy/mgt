<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>角色修改</title>
<link rel="stylesheet" href="manager/css/style.css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>角色修改</h2></div>
        <form method="get">
            <input type="hidden" value="admin" name="dir">
            <input type="hidden" value="rolse" name="control">
            <input type="hidden" value="up_sub" name="action">
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <div id="gamemain">
                <table>
                    <tbody>
                        <tr><td class="title"><b>角色名：</b></td><td><input type="text" name="rolse" value="<?php echo $rolse['rolse'];?>"></td></tr>
                        <tr><td class="title"><b>备注:</b></td><td><input type="text" name="info" value="<?php echo $rolse['info'];?>"></td></tr>
                        <tr>
                            <td class="title">
                                <b>权限:</b>
                            </td>
                            <td>
                                <table class="RoleOfAdd-listTab">
                                    <tbody>
                                        <tr>
											<?php 
											
										find($list,$rolse,0,0) ;
										
										function find($list,$rolse,$pid,$count){
											$c=0 ;
											foreach ($list as $item){
												$id = $item['id'] ;
												$name = $item['name'] ;
												$type = $item['type'] ;
												$parentid = $item['parentid'] ;
												if ($parentid==$pid){
													if($type==1 || $c==0){
														if ($count>0){
															for($i=0;$i<$count;$i++){
																echo "<td> </td>" ;
															}
														}
													}
													echo "<td><input " ;
													if (in_array($id, $rolse['modules'])) {
														echo 'checked="checked" ';
													} 
													echo "type='checkbox' name='modules[]' value='$id' id='$id'><label for='$id'>$name</label></td>" ;
													
													if ($type==1){
														echo "</tr><tr>\r\n";
														find($list,$rolse,$id,$count+1) ;
													} else {
														$c++ ;
													}
												}
											}
											echo "</tr><tr>\r\n";
										}
										
//												$i = 0;
//												foreach ($list as $item){
//													$id = $item['id'] ;
//													$name = $item['name'] ;
//													echo "<td><input ";
//													if (in_array($id, $rolse['modules'])) {
//														echo 'checked="checked"';
//													} 
//													echo " type='checkbox' name='modules[]' value='$id' id='$id'><label for='$id'>$name</label></td>";
//													if($i>8){echo '<tr/><tr>';$i=0;}
//													$i++;
//												}
											?>	
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <table>
                                <tr><td class="RoleOfAdd-btn"><input type="submit" value="修改" name="sub"></td></tr>
                            </table>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>