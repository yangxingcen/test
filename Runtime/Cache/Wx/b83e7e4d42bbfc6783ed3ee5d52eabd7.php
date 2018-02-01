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

    <link rel="stylesheet" href="http://www.deyishop.com/Public/Wx/Css/bootstrap.css" type="text/css"/>
    <script src="http://www.deyishop.com/Public/Wx/Js/jquery-1.11.1.min.js"></script>
    <script src="http://www.deyishop.com/Public/Wx/Js/bootstrap.js"></script>
    <script src="http://www.deyishop.com/Public/Wx/Js/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/common.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">
    <link rel="stylesheet" href="http://www.deyishop.com/Public/Wx/Css/style.css">
</head>

<body>
	<!-- top -->
	<div class="integral">

		<a href="javascript:history.go(-1)">
			<div class="screening_btn1">
				<span></span>
			</div>
		</a>

		<div class="tegral">新用户注册</div>

	</div>
	<!-- top end -->
	<!-- user -->
	<div class="warpper" style="padding-bottom: 0;">
		<div class="login">
			<div class="userdes">
				<ul>
					<li>
						<input type="tel" name="telephone" placeholder="请输入手机号" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">

					</li>
					<li>
						<input type="text" name="vcode" placeholder="请输入验证码" maxlength="4" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" style="padding-right: 100px;">
					
						<img style="width: 84px;height: 40px; position: absolute;right: 0;top: 0;margin-top: 4px;" width="100%" height="100%" id="vcode"  alt="验证码" src="<?php echo U('/Wx/User/verify_c',array());?>" title="点击刷新">
						
					</li>
					<li>
						<input type="text" name="telcode" placeholder="请输入手机验证码" style="padding-right: 100px;" maxlength="6" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
						<div class="getyzm" onclick="get_yzm(this);">获取验证码</div>
					</li>
					<li>
						<input type="password" name="password" placeholder="请输入密码" maxlength="20">
						<div class="eye" id="eye1" onclick="s_pass(this);" data-status="1">
							<img src="http://www.deyishop.com/Public/Wx/Images/eye.png" alt="">
						</div>
					</li>
					<li>
						<input type="password" name="ok_password" placeholder="请再次输入密码" maxlength="20">
						<div class="eye" id="eye2" onclick="s_pass1(this);" data-status="1">
							<img src="http://www.deyishop.com/Public/Wx/Images/eye.png" alt="">
						</div>
					</li>
				</ul>
			</div>
			<div onclick="sub_reg();" class="yeslog newuser"><a href="javascript:volid();">注册</a></div>
			<div class="xieyi">
				<ul>
					<li class="tongyi2 clearfix on"><span class="uesr_check"></span>同意德意 <a href="/wx_use.html">《用户使用协议》</a></li>
				</ul>
			</div>
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
<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/user/reg.js"></script>
<script>
$( ".tongyi2" ).click( function()
{
	var _this = $( this )
	if( _this.hasClass( "on" ) )
	{
		_this.removeClass( "on" )
	}
	else
	{
		_this.addClass( "on" )
	}
} )

</script>
</html>