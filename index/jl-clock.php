<?php
	include("../lib/logincheck.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>身份验证</title>
		<link rel="stylesheet" type="text/css" href="../static/css/jl-index.css"/>
		<script src="../static/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="../static/js/webcam.js" type="text/javascript" charset="utf-8"></script>
		<script src="../static/js/jl-clock.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<section class="jl-content">
			<div class="jl-ver">
				<div>
					<span><?php echo $_SESSION['username'];?>  同学</span>
					<span>学号：<?php echo $_SESSION['usernum'];?></span>
				</div>
				<div>签到</div>
				<div>
					<a href="../index.html">退出</a>
				</div>
			</div>
			<section class="jl-lt">
			</section>
			<section class="jl-rt">
			</section>
			<section class="jl-lb">
			</section>
			<section class="jl-rb">
			</section>
			<div id="jl-webcam">
				<div id="jl-camera"></div>
				<div id="jl-pre-take-button">
					<div class="jl-take">采样</div>
				</div>
				<div id="jl-post-take-button">
					<div class="jl-back">撤销</div>
					<div class="jl-save">保存</div>
				</div>
			</div>
			<div id="jl-result"></div>
			<form action="jl-myphoto.php" method="post" id="jl-form">
				<input type="hidden" name="myphoto" id="myphoto" value="" />
				<input type="submit" value="确定" id="jl-true" />
			</form>
			<div class="jl-punch-card">验证</div>
		</section>
	</body>
</html>