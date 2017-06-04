<?php
	include("../lib/logincheck.php");
	include "../lib/linkmysql.php";
	$usernum=$_SESSION["usernum"];
	$sql="select * from attendance.user WHERE usernum='$usernum'";
	$result=$db->query($sql);
	$row=$result->fetch_assoc();
	if($row){
		$username=$row["username"];
		$usertime=$row["usertime"];
		$userphoto="../uploadfile/".$row["userphoto"];
		
	}else{
		echo 0;
	}
?>