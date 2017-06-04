<?php
	header("content-type:text/html;charset='utf-8'");		//设置当前脚本输出的字符集类型
	date_default_timezone_set('Asia/Shanghai');		//设置当前脚本的时区
	$db=new mysqli('localhost','root','','attendance');		//连接数据库
	$db->query('set names utf8');
?>