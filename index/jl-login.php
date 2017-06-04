<?php
	include_once "../lib/linkmysql.php";
	$inputyzm=$_POST['jl_yzm'];		//获取验证码
	session_start();
	$yzm=$_SESSION['yzm'];
	if(!(strtolower($inputyzm)==strtolower($yzm))){
		$message="验证码错误！";
		$src="../index.html";
		include "../lib/message.html";
		exit();
	}
	$usernum=$_POST['jl_usernum'];		//获取输入的账号名
	$userpass=$_POST['jl_userpass'];		//获取输入的密码
	$sql="select role from attendance.admin WHERE adminuser='$usernum'";		//判断角色
	$result=$db->query($sql);
	if($row=$result->fetch_assoc()&&$row["role"]==0){
		$sql="select adminuser,adminpass,adminname from attendance.admin WHERE adminuser='$usernum'";		//查找数据库语句
		$result=$db->query($sql);
		$row=$result->fetch_assoc();
		if($row['adminuser']==$usernum){
			$_SESSION['usernum']=$usernum;
			$_SESSION['userpass']=$userpass;
			$_SESSION['username']=$row['adminname'];
			if($row['adminpass']==$userpass){
				$message="登录成功！";
				$src="../admin/addstudent.html";
				include "../lib/message.html";
			}else{
				$message="密码错误！";
				$src="../index.html";
				include "../lib/message.html";
			}
		}else{
			$message="账号有误！";
			$src="../index.html";
			include "../lib/message.html";
		}
	}else{
		$sql="select usernum,userpass,username from attendance.user WHERE usernum='$usernum'";		//查找数据库语句
		$result=$db->query($sql);
		$row=$result->fetch_assoc();
		if($row['usernum']==$usernum){
			$_SESSION['usernum']=$usernum;
			$_SESSION['userpass']=$userpass;
			$_SESSION['username']=$row['username'];
			if($row['userpass']==$userpass){
				$message="登录成功！";
				$src="jl-clock.php";
				include "../lib/message.html";
			}else{
				$message="密码错误！";
				$src="../index.html";
				include "../lib/message.html";
			}
		}else{
			$message="账号有误！";
			$src="../index.html";
			include "../lib/message.html";
		}
	}
	
	
	
	
	
?>