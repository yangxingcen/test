<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta name="author" content="UNOHACHA-高端网站设计-http://www.unohacha.com-杭州吾诺瀚卓网络科技有限公司 策划、设计、开发"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	<link rel="shortcut icon" href="http://www.deyishop.com/Public/Wx/Images/logo.ico"/>
	<title>德意电器</title>
	<meta name="keywords" content=" "/>
	<meta name="description" content=" "/>

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/bootstrap.css">
	<script src="http://www.deyishop.com/Public/Wx/Js/jquery-1.11.1.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/bootstrap.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/jquery-ui.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/easing.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/index.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/swiper-3.4.1.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/main.js"></script>
	
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/swiper-3.4.1.min.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/style.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/common.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/font-awesome.css">
	

</head>

<body>
	<!-- top -->
	<div class="integral">

		<a href="javascript:history.go(-1)">
			<div class="screening_btn1">
				<span></span>
			</div>
		</a>

		<div class="tegral">修改昵称</div>

	</div>
	<!-- top end -->
	<!-- user -->
	<div class="warpper">
		<div class="bangding">
			<div class="forgetp2 xiugai">
				<ul>
					<li class="yzm yzm4">
						<span>我的昵称</span>
						<?php if($info['person_name']): ?><input type="text" name="person_name" value="<?php echo ($info['person_name']); ?>">
						<?php else: ?>
							<input type="text" name="person_name" value="<?php echo ($info['telephone']); ?>"><?php endif; ?>
						
					</li>
				</ul>
			</div>
			<div class="nextp">
				<a href="javascript:volid(0);" onclick="sub_name();">提交</a>
			</div>
		</div>
	</div>

		<!-- user end -->

</body>
</html>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/ucenter/myname.js"></script>