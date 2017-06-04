<?php
	include("../lib/logincheck.php");
	include "../lib/linkmysql.php";
	$usernum=$_POST['jlresetuser'];
	$userpass=$_POST['jlnewpass'];
	$username=$_POST['jlusername'];
	$userphoto=substr($_POST['img'],strrpos($_POST['img'],"/")+1);
	$sql="insert into attendance.user (usernum,userpass,username,userphoto,role) VALUES ('$usernum','$userpass','$username','$userphoto',1)";
	$result=$db->query($sql);
	if($result){
		$message="添加成功。";
		$src="addstudent.html";
		include "../lib/message.html";
	}else{
		$message="添加失败！";
		$src="addstudent.html";
		include "../lib/message.html";
	}
?>