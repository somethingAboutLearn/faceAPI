<?php
	include_once "../lib/linkmysql.php";
	$newusernum=$_POST['jlresetuser'];
	$sql="select usernum from attendance.user WHERE usernum='$newusernum'";
	$result=$db->query($sql);
	$row=$result->fetch_assoc();
	if($row){		//判断所输入的账号是否存在
		$username=$_POST['jlusername'];
		$sql="select username from attendance.user WHERE username='$username'";
		$result=$db->query($sql);
		$row=$result->fetch_assoc();
		if($row){		//判断所输入的用户名是否正确
			$newuserpass=$_POST['jlnewpass'];
			$newuserpassagrin=$_POST['jlnewpassagain'];
			if($newuserpass==$newuserpassagrin){
				$sql="update attendance.user set userpass='$newuserpass' WHERE usernum='$newusernum'";
				$result=$db->query($sql);
				$message="密码修改成功！";
				$src="../index.html";
				include "../lib/message.html";
			}else{
				$message="两次密码输入不一致！";
				$src="jl-forgetpass.html";
				include "../lib/message.html";
			}
		}else{
			$message="验证错误！";
			$src="jl-forgetpass.html";
			include "../lib/message.html";
		}
	}else{
		$message="账号不存在！";
		$src="jl-forgetpass.html";
		include "../lib/message.html";
	}
	
	
	
?>