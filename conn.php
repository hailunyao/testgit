<?php 
header("Constant-Type:text/html;charset=utf8");
$dbms='mysql';
$dbname='db_database';
$user='root';
$pass='root';
$host='localhost';
$dsn="$dbms:host=$host;dbname=$dbname";
try{
	$pdo=new PDO($dsn,$user,$pass);
	echo "PDO连接成功！";
 }catch(Execption $e){
 	echo $e->getMessage();
 }
