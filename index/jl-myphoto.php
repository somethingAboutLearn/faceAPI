<?php
	include("../lib/logincheck.php");
	include "../lib/linkmysql.php";
	$usernum=$_SESSION["usernum"];
	$sql="select * from attendance.user WHERE usernum='$usernum'";
	$result=$db->query($sql);
	$row=$result->fetch_assoc();
	if($row["userphoto"]==""){
		$message="匹配失败！请先在数据库中存入图片信息。";
		$src="jl-clock.php";
		include "../lib/message.html";
	}else{
		$dbphoto="C:/wamp/www/face/uploadfile/".$row["userphoto"];
		$yzphoto=$_POST["myphoto"];
		
		$file=fopen($dbphoto,"rb",0);
		$size=filesize($dbphoto);
		$re_dbphoto=chunk_split(base64_encode(fread($file,$size)));
		
			
			
		$re_yzphoto=explode(",",$yzphoto)[1];
		
		function send_post($url, $post_data) {
		    $postdata = http_build_query($post_data);
		        $options = array(
		            'http' => array(
		            'method' => 'POST',
		            'header' => '',
		            'content' => $postdata,
		            'timeout' => 15 * 60 // 超时时间（单位:s）
		        )
		    );
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		
		return $result;
		}
		
		//判断数据库中是否存在人脸
		$post_data = array(
		    'api_key' => 'qrp6ZakSGHbCEYIdnb64GigQ9BmkiVmv',
		    'api_secret' => 'jZEFkFOTgmI8f9-CqDs9_IG1eB9uhYiX',
		    'image_base64' => $re_dbphoto,
		);
		$result = send_post('https://api-cn.faceplusplus.com/facepp/v3/detect', $post_data);
		$re=json_decode($result,true);
		if($re["faces"]){
			$post_data = array(
			    'api_key' => 'qrp6ZakSGHbCEYIdnb64GigQ9BmkiVmv',
			    'api_secret' => 'jZEFkFOTgmI8f9-CqDs9_IG1eB9uhYiX',
			    'image_base64' => $re_yzphoto,
			);
			$result = send_post('https://api-cn.faceplusplus.com/facepp/v3/detect', $post_data);
			$re=json_decode($result,true);
			if($re["faces"]){
				//判断是否为同一张人脸
				$post_data = array(
				    'api_key' => 'qrp6ZakSGHbCEYIdnb64GigQ9BmkiVmv',
				    'api_secret' => 'jZEFkFOTgmI8f9-CqDs9_IG1eB9uhYiX',
				    'image_base64_1' => $re_dbphoto,
				    'image_base64_2' => $re_yzphoto
				);
				$result = send_post('https://api-cn.faceplusplus.com/facepp/v3/compare', $post_data);
				$re=json_decode($result,true);
				if($re["confidence"]>=80){
					$time=date('Y/m/d  H:i:s',time());		//记录签到时间
					$sql="insert into attendance.clocktime (usernum,clocktime) VALUES ('$usernum','$time')";
					$result=$db->query($sql);
					if($result){
						$message="签到成功！";
						$src="success.php";
						include "../lib/message.html";
					}else{
						$message="签到时间出错！";
						$src="jl-clock.php";
						include "../lib/message.html";
					}
					
					
				}else{
					$message="匹配失败，请重新拍照！";
					$src="jl-clock.php";
					include "../lib/message.html";
				}
			}else{
				$message="拍照图片未检测到人脸信息，请重新拍照！";
				$src="jl-clock.php";
				include "../lib/message.html";
			}
		}else{
			$message="数据库中的图片未检测到人脸信息！";
			$src="jl-clock.php";
			include "../lib/message.html";
		}
	}
?>