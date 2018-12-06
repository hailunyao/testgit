<?php 
include_once "conn.php";
function getList($conn,$pid=0,&$result=array(),$space=0){
	$space=$space+2;
	$sql="SELECT*FROM deepcate WHERE pid =$pid";
	$res=mysqli_query($conn,$sql);
	while ($row=mysqli_fetch_assoc($res)){
		// $row['catename']=str_repeat(' ',$space).'|--|'.$row['catename'];
		$row['catename']=str_repeat("&nbsp;",$space).'|--|'.$row['catename'];
		$result[]=$row;
		getList($conn,$row['id'],$result,$space);
	}

	return $result;
 }
 function displayCate($conn,$pid=0,$selected=1,$result){
 	$rs=getList($conn);
 	$str='';
 	$str.="<select name='cate' >";
 	foreach ($rs as $key => $value) {
 		$selectedstr='';
 		if ($value['id']==$selected) {
 			$selectedstr="selected";
 		}
 		$str.="<option {$selectedstr}>{$value['catename']}</option>";
 	}
 	return $str.='</select>';	
 }
 echo displayCate($conn,0,2,$result);