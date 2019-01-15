<?php  

$q=isset($_GET['q'])?$_GET['q']:'admin';
define("PLAT", $q);
define("DS", DIRECTORY_SEPARATOR);//directory_separator
define("ROOT", __DIR__.DS);//框架目录
define("WEB", ROOT.'company.DS');//根目录
define("FROMWORK", ROOT.'fromwork'.DS);//框架基础目录
define("PLAT_PATH", WEB.PLAT.DS);//品台所在
define("CTRL_PATH", PLAT_PATH.'Controllers'.DS);
define("MODEL_PATH", PLAT_PATH.'Models'.DS);
define("VIEW_PATH", PLAT_PATH.'Views'.DS);
function my_autoloader($class){
	$base_class=array("conn",'baseModel','ModelFactory','baseController');
	if (in_array($class, $base_class)) {
		require FROMWORK.$class.".class.php";
	}else if (substr($class,-5)=="Model") {
		require MODEL_PATH.$class.".class.php";
	}else if (substr($class, -10)=="Controller") {
		require CTRL_PATH.$calss.".class.php";
	}
}
//注册给定的函数作为 __autoload 的实现
spl_autoload_register('my_autoloader');

//控制器
$c=isset($_GET['c'])?$_GET['c']:'';
$con_name=$c."Controller";
$ctrl=new $con_name();
$act=isset($_GET['act'])?$_GET['act']:'index';
$action=$act."Action";
$ctrl->$action();



?>
