<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
</head>
<body>

<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>模块添加</h2></div>
        <form method="get" action="">
            <input type="hidden" value="admin" name="dir">
            <input type="hidden" value="module" name="control">
            <input type="hidden" value="add_sub" name="action">
            <div id="gamemain">
                <table>
                    <tbody>
                    <tr><td class="title"><b>模块名:</b></td><td><input type="text" name="name" size=30></td></tr>
                    <tr><td class="title"><b>模块链接:</b></td><td><input type="text" name="url" size=80></td></tr>
                    <tr><td class="title"><b>模块类型:</b></td><td><input type="radio" checked="" id="1" value="1" name="type"><label for="1">目录</label> <input type="radio" id="2" value="2" name="type"><label for="2">文件</label></td></tr>
                    <tr>
                        <td class="title"><b>上级模块:</b></td>
                        <td>
					<select name="parentid">
					<option value="0">根目录
								<?php 
								foreach ($list as $item){
									echo "<option value='".$item['id']."'>".$item['name'] ;
								}
								?>
                            </select>
                        </td>
                    </tr>
                    <tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>