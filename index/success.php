<?php
	include("../lib/logincheck.php");
	include "successdata.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>学生签到信息</title>
		<link rel="stylesheet" type="text/css" href="../static/css/success.css"/>
	</head>
	<body>
		<header class="jl-bartop">
			<a class="jl-sign" href="success.php">学生签到信息</a>
		</header>
		<div class="content">
			<div class="left">
				<div class="photo">
					<span>照片</span>
					<img src="<?php echo $userphoto;?>"/>
				</div>
				<div>
					<span>姓名</span>
					<span><?php echo $username;?></span>
				</div>
				<div>
					<span>学号</span>
					<span><?php echo $usernum;?></span>
				</div>
				<div>
					<span>注册时间</span>
					<span><?php echo $usertime;?></span>
				</div>
			</div>
			<div class="right">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr><th>打卡时间</th><th>备注</th></tr>
					<?php
						$sql="select * from attendance.clocktime";
						$result=$db->query($sql);
						if($row=$result->fetch_all(MYSQLI_ASSOC)){
							foreach($row as $value){
								echo "<tr><td>{$value['clocktime']}</td><td>{$value['message']}</td></tr>";
							}
						}
					?>
					
				</table>
			</div>
		</div>
	</body>
</html>
