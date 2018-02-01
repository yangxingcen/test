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

	<!--  / warpper  -->
	<div class="warpper" style=" background: #f9f9f9">

		<div class="integral">

			<a href="/wx_ucenter.html">
				<div class="screening_btn1">
					<span></span>
				</div>
			</a>

			<div class="tegral">设置</div>

		</div>

		<div class="administer">
			<div class="user6" style="padding:0;">

				<div class="user_r6" style="padding:0; border-bottom:none;">
					<div class="user_1b">

						<ul>

							<li style="padding:10px; position: relative;  " class="clearfix">
								<img src="<?php echo ($info["person_img"]); ?>" width="50" style="border-radius:100%; float: left">
								<div class="user_name">
									<?php if($info['person_name']): ?><div class="user_name1"><?php echo ($info["person_name"]); ?></div>
									<?php else: ?>
										<div class="user_name1"><?php echo ($info["telephone"]); ?></div><?php endif; ?>
									<div class="user_name2">用户ID: <?php echo ($info["telephone"]); ?></div>
								</div>
								<a href="/wx_my_set.html" class="geren">个人设置 <i class="fa fa-angle-right"></i></a>
							</li>

							<a href="/wx_address.html">
								<li>我的收货地址 <span><i class="fa fa-angle-right"></i></span></li>
							</a>
							<a href="##">
								<li>账号管理 <span><i class="fa fa-angle-right"></i></span></li>
							</a>
							<a href="##">
								<li>钱包余额 <span><i class="fa fa-angle-right"></i></span></li>
							</a>
							<a href="##">
								<li>邀请码 <span><i class="fa fa-angle-right"></i></span></li>
							</a>
						</ul>
					</div>
				</div>

			</div>
			<div class="user6" style="padding:0;">

				<div class="user_r6" style="padding:0; border-bottom:none;">
					<div class="user_1b">
						<ul><a href="##">
							<li>绑定手机 <span><b>138****5803</b><i class="fa fa-angle-right"></i></span></li>
						</a>
							<a href="/wx_user_zhif.html">
								<li>支付设置 <span><i class="fa fa-angle-right"></i></span></li>
							</a>
						</ul>
					</div>
				</div>
			</div>

			<!--
			<div class="user6" style="padding:0;">

				<div class="user_r6" style="padding:0; border-bottom:none;">
					<div class="user_1b">
						<ul>
							<a href="##">
								<li>求助反馈 <span><i class="fa fa-angle-right"></i></span></li>
							</a>

						</ul>
					</div>
				</div>

			</div>
			-->
		</div>

	</div>
	<!--  / warpper  -->

</body>
</html>