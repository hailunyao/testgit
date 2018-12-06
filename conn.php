<?php 
header("Constant-Type:text/html;charset=utf8");
$dbname='db_database';
$user='root';
$pass='root';
$host='localhost';
$conn=mysqli_connect($host,$user,$pass,$dbname);
	if (!$conn) {	
		die('连接失败'.mysqli_connect_error());
	}
	mysqli_query($conn,'set names utf8');
// $dsn="$dbms:host=$host;dbname=$dbname";
// try{
// 	$pdo=new PDO($dsn,$user,$pass);
// 	echo "PDO连接成功！";
//  }catch(Execption $e){
//  	echo $e->getMessage();
//  }
