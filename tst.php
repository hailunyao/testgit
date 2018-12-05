<?php 
include_once ('conn.php');
$pd=$pdo;
print_r($pd).'<br>';
function getList($pid=0,&$result=array(),$space=0){
	$space=$space+2;
	$sql="SELECE*FROM deepcate WHERE pid =$pid";
	$res=$pd->prepare($sql);
	$res->execute();
	while ($row=$res->fetch(PDO::FETCH_ASSOC)){
		// $row['catename']=str_repeat(' ',$space).'|--|'.$row['catename'];
		$row['catename']=str_repeat(' ',$space).'|--|'.$row['catename'];
		$result[]=$row;
		getList($row['id'],$result,$space);
	}
	return $result;
 }
 $rs=getList();
 print_r($rs);



 function displayCate($pid=0,$selected=1){
 	$rs=getList($pid);
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
 echo displayCate(0,2);
