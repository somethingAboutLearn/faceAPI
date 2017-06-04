<?php
	session_start();
	if(!isset($_SESSION['usernum'])){
		$message="未登录，请登录。";
		$src="../index.html";
		include "../lib/message.html";
		exit();
	}
?>