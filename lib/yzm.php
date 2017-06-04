<?php
	header("content-type:image/png");
	$drr=array_merge(range(0,9),range('a','z'),range('A','Z'));	
	
	$img=imagecreate(100,30);
	imagefill($img,0,0,getColor($img));
	for($i=0;$i<10;$i++){
		imageline($img,mt_rand(0,100),mt_rand(0,30),mt_rand(0,100),mt_rand(0,30),getColor($img));
	}
	for($j=0;$j<40;$j++){
		imagesetpixel($img,mt_rand(0,100),mt_rand(0,30),getColor($img));
	}
	$yzm='';
	for($y=0;$y<4;$y++){
		$result=$drr[mt_rand(0,count($drr)-1)];
		$yzm1=imagettftext($img,25,mt_rand(-30,30),5+20*$y,25,getColor($img,'d'),'MFYueHei.otf',$result);
		$yzm.=$result;
	}
	//获取颜色
	function getColor($img,$type='l'){
		if($type=='l'){
			$min=120;
			$max=240;
		}else if($type=='d'){
			$min=20;
			$max=100;
		}
		return imagecolorallocate($img,mt_rand($min,$max),mt_rand($min,$max),mt_rand($min,$max));
	}
	imagepng($img);
	imagedestroy($img);
	session_start();
	$_SESSION['yzm']=$yzm;		//将yzm存储在session中
?>