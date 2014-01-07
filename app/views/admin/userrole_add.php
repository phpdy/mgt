<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>角色添加</title>
<link rel="stylesheet" href="manager/css/style.css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>用户角色添加</h2></div>
        <form method="get" action="">
            <input type="hidden" value="admin" name="dir">
            <input type="hidden" value="userrole" name="control">
            <input type="hidden" value="add_sub" name="action">
            <div id="gamemain">
                <table>
                    <tbody><tr>
                        <td class="title"><b>用户:</b></td>
                        <td>
                            <select name="userid">
		                    <?php 
								foreach ($user_list as $item){
									$id = $item['id'] ;
									$name = $item['name'] ;
//									$realname = iconv('GBK', 'UTF-8' , $item['realname']) ;
									$username = $item['username'] ;
									echo "<option value='$id'>$name-$username" ;
								}
							?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="title"><b>角色:</b></td>
                        <td><table class="RoleOfAdd-listTab"><tbody><tr>
								<?php 
								$i = 0;
								foreach ($rolse_list as $item){
									$id = $item['id'] ;
									$name = $item['rolse'] ;
									echo "<td><input type='checkbox' name='rolses[]' value='$id' id='$id'><label for='$id'>$name</label></td>" ;
									if($i>8){echo '<tr/><tr>';$i=0;}
									$i++;
								}
								?>
                        </tr></tbody>
                        </table></td>
                    </tr>
                    <tr>
                        <table>
                            <tr><td class="RoleOfAdd-btn"><input type="submit" value="提  交" name="sub"></td></tr>
                        </table>
                    </tr>
                    </tbody></table>
            </div>
        </form>
    </div>
</div>
</body>
</html>