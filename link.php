<?php 
include("conn.php");
function getCatePath($conn,$cid=0,&$result=array()){
	$sql="SELECT * FROM deepcate WHERE id =$cid";
	$res=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($res);
	if ($row){
		$result[]=$row;
		getCatePath($conn,$row['pid'],$result);
	}
	krsort($result);
	return($result) ;
	}

function displayCatePath($conn,$cid=0,$url='link.php?cid='){
	$res=getCatePath($conn,$cid);
	$str='';
	 foreach ($res as $key => $val) {
        $str.= "<a href={$url}{$val['id']}>{$val['catename']}</a>>";
    }
    return $str;

	// foreach($res as $key => $value){
	// 	$str.="<a href={$url}{$value['id']}>{$value['catename']}</a>";
	// }
	// return $str;
}
echo displayCatePath($conn,11);
echo displayCatePath($conn,10);
echo displayCatePath($conn,12);
echo displayCatePath($conn,17);