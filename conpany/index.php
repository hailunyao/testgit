<?php 
$c=!empty($_GET['c'])?$_GET['c']:'admin';
$p=!empty($_GET['p'])?$_GET['p']:'back';
define("PALT", $p);
define(DS, DIRECTORY_SEPARATOR);//directory_separator;
define("ROOT",__DRI__.DS);
define("APP",ROOT.'company'.DS);


 ?>