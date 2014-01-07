<?php
/**
 * MVC框架的核心加载
 */

require FRAME_PATH. 'Import.php';

//加载基类
require FRAME_PATH . 'app' . DS . 'Object.php';

//加载框架父类
require FRAME_PATH . 'app' . DS . 'view' . DS . 'View.php';
require FRAME_PATH . 'app' . DS . 'controller' . DS . 'Controller.php';
require FRAME_PATH . 'app' . DS . 'model' . DS . 'Model.php';

if(file_exists(CONTROLLER_PATH . 'BaseController.php')){
	require CONTROLLER_PATH . 'BaseController.php';
}
if(file_exists(MODEL_PATH . 'BaseModel.php')){
	require MODEL_PATH . 'BaseModel.php';
}

//设置默认控制器
$dir = empty($_GET['dir']) ? '' : $_GET['dir'];
$control = empty($_GET['control']) ? 'index' : $_GET['control'] ;
$action = empty($_GET['action']) ? 'execute' : $_GET['action'];

//$control .= "Controller" ;
$action .= "Action" ;

//加载控制层
$class = Import::importController($control,$dir);
$class->$action() ;

?>