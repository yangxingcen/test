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

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">
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

		<div class="tegral">登录</div>

	</div>
	<!-- top end -->
	<!-- user -->
	<div class="warpper" style="padding-bottom: 0;">
		<div class="login">
			<div class="userlogin">
				<ul>
					<li>
						<img src="http://www.deyishop.com/Public/Wx/Images/user.png" alt="">
						<input type="tel" name="telephone" placeholder="请输入手机号" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
					</li>
					<li>
						<img src="http://www.deyishop.com/Public/Wx/Images/password.png" alt="">
						<input type="password" name="password" maxlength="20" placeholder="请输入密码">
						<div onclick="s_pass(this);" data-status="1" class="eye1"></div>
					</li>

				</ul>
			</div>
			<div class="fpassword">
				<a href="/wx_forget_password.html">忘记密码</a>
			</div>
			<div class="yeslog newuser" onclick="sub_login();"><a href="javascript:volid();">登录</a></div>
			<div class="yeslog1"><a href="/wx_register.html">新用户注册</a></div>
			<!-- kuaisulogin -->
			<div class="third">
				<div class="kuaisu">
					<ul>
						<li class="kuaisul"></li>
						<li class="kuaisum">快速登录</li>
						<li class="kuaisul kuaisur"></li>
					</ul>
				</div>
				<div class="pro_share_icon">
					<a href="##"><i class="fa fa-qq"></i></a>
					<a href="##"><i class="fa fa-weixin " style="background: #29b01c;"></i></a>
					<a href="##"><i class="fa fa-weibo" style="background: #ea5d5c;"></i></a>

				</div>
				<div class="tishi">
					<div>未注册过的用户将直接为您创建德意账户</div>
				</div>
			</div>
		</div>
	</div>
	<!-- kuaisulogin end -->
	<!-- user end -->
	
</body>
</html>
<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>

<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/user/login.js"></script>