<?php
	header("Content-type:text/html;charset='utf-8");		//设置字符集
	date_default_timezone_set('Asia/Shanghai');		//设置时区
	$file=$_FILES['img'];
	$path='../uploadfile';
	if(!file_exists($path)){
	    mkdir($path);
	}
	$name=explode('.',$file['name']);
	$name[0]=time();
	$newname=$name[0].".".$name[1];
	if(is_uploaded_file($file['tmp_name'])){		//是否有图片上传
		$result=move_uploaded_file($file['tmp_name'],$path.'/'.$newname);		//存储
		if($result){
			echo 'http://localhost/face/uploadfile'.'/'.$newname;
		}
	}
?>