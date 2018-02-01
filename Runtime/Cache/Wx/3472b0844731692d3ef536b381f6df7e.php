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

<div class="show_nav">
    <ul class="clearfix">
      <li class="on">
        <a href="/wx_index.html">
          <img class="show_nav_img1" src="http://www.deyishop.com/Public/Wx/Images/nav_1.png" width="100%">
          <img class="show_nav_img2" src="http://www.deyishop.com/Public/Wx/Images/nav_1a.png" width="100%">
          <h5>首页</h5>
        </a>
      </li>
      <li>
        <a href="/wx_cart.html">
          <img class="show_nav_img1" src="http://www.deyishop.com/Public/Wx/Images/nav_2.png" width="100%">
          <img class="show_nav_img2" src="http://www.deyishop.com/Public/Wx/Images/nav_2a.png" width="100%">
          <h5>购物车</h5>
        </a>
      </li>
      <li>
        <a href="tel:{<?php echo ($shop_config["servise_phone"]); ?>">
          <img class="show_nav_img1" src="http://www.deyishop.com/Public/Wx/Images/nav_3.png" width="100%">
          <img class="show_nav_img2" src="http://www.deyishop.com/Public/Wx/Images/nav_3a.png" width="100%">
          <h5>客服中心</h5>
        </a>
      </li>
      <li>
        <a href="/wx_goodslist.html">
          <img class="show_nav_img1" src="http://www.deyishop.com/Public/Wx/Images/nav_4.png" width="100%">
          <img class="show_nav_img2" src="http://www.deyishop.com/Public/Wx/Images/nav_4a.png" width="100%">
          <h5>商品分类</h5>
        </a>
      </li>
      <?php if($topInfo['id']): ?><li>
          <a href="/wx_ucenter.html">
            <img class="show_nav_img1" src="http://www.deyishop.com/Public/Wx/Images/nav_5.png" width="100%">
            <img class="show_nav_img2" src="http://www.deyishop.com/Public/Wx/Images/nav_5a.png" width="100%">
            <h5>个人中心</h5>
          </a>
        </li>
      <?php else: ?>
        <li class="on">
          <a href="/wx_login.html">
            <img class="show_nav_img1" src="http://www.deyishop.com/Public/Wx/Images/nav_5.png" width="100%">
            <img class="show_nav_img2" src="http://www.deyishop.com/Public/Wx/Images/nav_5a.png" width="100%">
            <h5>登录</h5>
          </a>
        </li><?php endif; ?>
    </ul>
  </div>


	<!--  / header  -->
	<div class="integral">
		<a href="javascript:history.go(-1)">
			<div class="screening_btn1">
				<span></span>
			</div>
		</a>
		<div class="tegral">抽奖游戏</div>
		<!--<div class="collect_zt_btn1">编辑</div>-->
	</div>

	<!--  / header  -->

	<!--  / warpper  -->
	<div class="warpper">
		<div class="ind_hot">
			<?php if(is_array($list_info)): foreach($list_info as $key=>$v): switch($v["id"]): case "2": ?><a href="/Wx/Games/zajindan.html">
				<div class="ind_hot_img">
					<img src="<?php echo ($v["list_pic"]); ?>" width="100%">
				</div>
				<div class="ind_time_h" style="padding:15px;">
					<h5><?php echo ($v["list_title"]); ?></h5>
					<span><?php echo ($v["list_desc"]); ?></span>
					<i>前往</i>
				</div>
				</a><?php break; endswitch; endforeach; endif; ?>

		</div>


		<div class="spacing10"></div>

		<div class="ind_hot">
			<?php if(is_array($list_info)): foreach($list_info as $key=>$v): switch($v["id"]): case "3": ?><a href="/Wx/Games/dazhuanpan.html">
				<div class="ind_hot_img">
					<img src="<?php echo ($v["list_pic"]); ?>" width="100%">
				</div>
				<div class="ind_time_h" style="padding:15px;">
					<h5><?php echo ($v["list_title"]); ?></h5>
					<span><?php echo ($v["list_desc"]); ?></span>
					<i>前往</i>
				</div>
			</a><?php break; endswitch; endforeach; endif; ?>


		</div>

		<div class="spacing10"></div>


		<div class="ind_hot">
			<?php if(is_array($list_info)): foreach($list_info as $key=>$v): switch($v["id"]): case "1": ?><a href="/Wx/Games/guaguale.html">
				<div class="ind_hot_img">
					<img src="<?php echo ($v["list_pic"]); ?>" width="100%">
				</div>
				<div class="ind_time_h" style="padding:15px;">
					<h5><?php echo ($v["list_title"]); ?></h5>
					<span><?php echo ($v["list_desc"]); ?></span>
					<i>前往</i>
				</div>
			</a><?php break; endswitch; endforeach; endif; ?>
		</div>

		<div class="spacing10"></div>



		<div class="ind_hot">
			<a href="##">
				<div class="ind_hot_img">
					<img src="http://www.deyishop.com/Public/Wx/Images/play_img4.jpg" width="100%">
				</div>
				<div class="ind_time_h" style="padding:15px;">
					<h5>红包雨｜瓜分红包</h5>
					<span>现金红包等你来拿</span>
					<i>前往</i>
				</div>
			</a>
		</div>
		<div class="spacing10"></div>




	</div>
	<!--  / warpper  -->

</body>
<script>
$( document ).ready( function()
{

	var mySwiperBanner = new Swiper( '.swiper-container-banner', {
		autoplay: 4000,
		loop: true,
		speed: 500,
		pagination: '.swiper-pagination-banner',
		paginationClickable: true,
		autoplayDisableOnInteraction: false,
	} )

	var mySwiperNav = new Swiper( '.swiper-container-nav', {
		autoplay: 4000,
		slidesPerView: 4,
		speed: 300,
		autoplayDisableOnInteraction: false,
		grabCursor: true,
		paginationClickable: true
	} )

	var mySwiperJf = new Swiper( '.swiper-container-jf', {
//		autoplay: 4000,
		speed: 500,
		slidesPerView: 2,
		spaceBetween: 6,
		paginationClickable: true,
		autoplayDisableOnInteraction: false,
	} )

	var mySwiperNew = new Swiper( '.swiper-container-new', {
//		autoplay: 4000,
		speed: 300,
		slidesPerView: 2.5,
		spaceBetween: 10,
		paginationClickable: true,
		autoplayDisableOnInteraction: false,
	} )

} )
</script>

<script>
$(document ).ready(function(){
	$(".header_n" ).click(function(){
		$(".pro_show_bg" ).stop(true ).fadeIn(500)
		$(".home_menu").stop(true ).animate({"left":"0"},500)
	})
	$(".pro_show_bg").click(function(){
		$(".pro_show_bg" ).stop(true ).fadeOut(500)
		$(".home_menu").stop(true ).animate({"left":"-80%"},500)
	})



})


</script>
</html>