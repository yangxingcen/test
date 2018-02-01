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
    <div class="header">
        <div class="logo">
            <a href="/wx_index.html"><img src="http://www.deyishop.com/Public/Wx/Images/logo.png" width="120"></a>
        </div>
        <div class="shop">
            <a href="/wx_cart.html"><img src="http://www.deyishop.com/Public/Wx/Images/header_car.png" width="20"></a>
        </div>
        <div class="header_search">
            <a href="/wx_search.html"><img src="http://www.deyishop.com/Public/Wx/Images/header_search.png" width="20"></a>
        </div>
        <div class="header_n">
            <img src="http://www.deyishop.com/Public/Wx/Images/si9.png" width="24" style="vertical-align: -6px;">
            <span>菜单</span>
        </div>

    </div>
	<!--  / warpper  -->
	<div class="warpper">

		<div class="banner">
			<div class="swiper-container swiper-container-banner">
				<div class="swiper-wrapper">
					<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img src="<?php echo ($vo["pic"]); ?>" width="100%"></div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="swiper-pagination swiper-pagination-banner"></div>
			</div>
		</div>
		<div class="head_gong">
			<a href="/wx_detail.html">
				<marquee direction="left" scrollamount="3" onmouseover="stop()" onmouseout="start()">
					<?php echo ($gundong_gonggao); ?>
				</marquee>
			</a>


		</div>

		<div class="ind_dg">
			<ul class="clearfix">
				<li>
					<img src="http://www.deyishop.com/Public/Wx/Images/duigou.png" width="16">品质保证
				</li>
				<li>
					<img src="http://www.deyishop.com/Public/Wx/Images/duigou.png" width="16">14天退货
				</li>
				<li>
					<img src="http://www.deyishop.com/Public/Wx/Images/duigou.png" width="16">48小时发货
				</li>
			</ul>
		</div>

		<div class="spacing10"></div>

		<div class="ind_class">
				<div class="row">
					<div class="col-xs-3">
						<a href="/wx_activity.html">
							<div class="menu_con">
									<img src="http://www.deyishop.com/Public/Wx/Images/si1.png" width="42">
								<h5>活动专区</h5>
							</div>
						</a>
					</div>
					<div class="col-xs-3">
						<a href="/wx_meal.html">
							<div class="menu_con">
									<img src="http://www.deyishop.com/Public/Wx/Images/si2.png" width="42">
								<h5>热卖组合</h5>
							</div>
						</a>
					</div>
					<div class="col-xs-3">
						<a href="/wx_integral.html">
							<div class="menu_con">
									<img src="http://www.deyishop.com/Public/Wx/Images/si3.png" width="42">
								<h5>积分商城</h5>
							</div>
						</a>
					</div>
					<div class="col-xs-3">
						<a href="wx_product.html">
							<div class="menu_con">
									<img src="http://www.deyishop.com/Public/Wx/Images/si4.png" width="42">
								<h5>全部产品</h5>
							</div>
						</a>
					</div>
				</div>
		</div>

		<div class="spacing10"></div>

		<!--<div class="guanggao">-->

			<!--<img src="http://www.deyishop.com/Public/Wx/Images/guanggao.jpg" width="100%">-->
		<!--</div>-->
		<div class="ind_new">
			<div class="ind_new_h">
				<h5>人气推荐· 新品上市</h5>
				<a href="wx_product.html">查看全部<i class="fa fa-angle-right"></i></a>
			</div>
			<div class="ind_new_con">
				<div class="swiper-container swiper-container-new">
					<div class="swiper-wrapper">
						<?php if(is_array($isnew)): $i = 0; $__LIST__ = $isnew;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
								<a href="/wx_detail.html?id=<?php echo ($vo["id"]); ?>">
									<div class="ind_new_list">
										<div class="ind_new_img">
											<img src="<?php echo ($vo["logo_pic"]); ?>" width="100%">
										</div>
										<div class="ind_new_zi">
											<span><i>新品</i></span>
											<h5><?php echo ($vo["goods_name"]); ?></h5>
											<p><?php echo ($vo["goods_des"]); ?></p>
											<b>￥<?php echo ($vo["price"]); ?></b>
										</div>
									</div>
								</a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="spacing10"></div>
		<div class="ind_time">
			<h5><i></i>定时促销<i></i><a href="/wx_sale.html">更多<span class="fa fa-angle-right"></span></a></h5>
			<a href="/wx_detail.html?id=<?php echo ($express["id"]); ?>">
				<div class="ind_time_list">

					<div class="ind_time_bg1" style="background:#d2d2d2;"></div>
					<div class="ind_time_bg2" style="background:#DCDCDC;"></div>
					<img src="<?php echo ($express["logo_pic"]); ?>" width="40%">	
					<div id="djx" class="ind_time_num">
						<!-- <span>据结束<i><?php echo ($express["hour"]); ?></i>:<i><?php echo ($express["minute"]); ?></i>:<i><?php echo ($express["second"]); ?></i>秒</span> -->
					</div>
					<div class="ind_time_zi">
						<h5><?php echo ($express["goods_name"]); ?></h5>
						<span><i style="right:105%;"></i>CXW-230-HJ9855<i style="left:105%;"></i></span>
						<p><?php echo ($express["goods_des"]); ?></p>
					</div>

				</div>
				<input id="sec" type="hidden" value=<?php echo ($express["sec"]); ?>>
				<div class="ind_time_h">
					<h5><?php echo ($express["classname"]); ?></h5>
					<span><?php echo ($express["goods_des"]); ?></span>
					<div class="ind_time_h_ri">
						<i>¥<?php echo ($express["price"]); ?></i>
						<div>¥<?php echo ($express["oprice"]); ?></div>
					</div>

				</div>
			</a>

		</div>

		<div class="spacing10"></div>


		<div class="ind_hot">
			<h5><i></i>热卖组合<i></i><a href="/wx_meal.html">更多<span class="fa fa-angle-right"></span></a></h5>
			<div class="main_sec3_con clearfix">

				<div class="main_sec3_con1 clearfix">
					<a href="/wx_detail.html?id=<?php echo ($r_shop["id"]); ?>">
						<div class="main_sec3_con1_zi">

							<h5><?php echo ($r_shop["goods_name"]); ?><br/><span><?php echo ($r_shop["goods_des"]); ?></span></h5>
							<p><span>￥<?php echo ($r_shop["price"]); ?></span></p>
						</div>
						<div class="main_sec3_con1_img">
							<img src="<?php echo ($r_shop["logo_pic"]); ?>" width="100%">
						</div>
					</a>
				</div>

				<div class="main_sec3_con2">
					<?php if(is_array($r_shop2)): $i = 0; $__LIST__ = $r_shop2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/wx_detail.html?id=<?php echo ($vo["id"]); ?>">
							<div class="main_sec3_con2s clearfix">
								<div class="main_sec2_zi">

									<h5><?php echo ($vo["goods_name"]); ?><br/><span><?php echo ($vo["goods_des"]); ?></span></h5>
									<p><span>￥<?php echo ($vo["price"]); ?></span></p>
								</div>
								<div class="main_sec2_img"><img src="<?php echo ($vo["logo_pic"]); ?>" width="100%"></div>
							</div>
						</a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>

		<div class="spacing10"></div>


		<div class="ind_hb">
			<a href="<?php echo U('/Wx/Index/games');?>">
				<img src="<?php echo ($banner2["pic"]); ?>" width="100%">
			</a>
		</div>
		<div class="spacing10"></div>

		<div class="ind_jf">
			<h5><i></i>积分活动<i></i><a href="wx_integral.html">更多<span class="fa fa-angle-right"></span></a></h5>
			<div class="swiper-container swiper-container-jf">
				<div class="swiper-wrapper">
					<?php if(is_array($integral)): $i = 0; $__LIST__ = $integral;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
							<a href="/wx_integral_detail.html?id=<?php echo ($vo["id"]); ?>">
								<div class="ind_jf_list">
									<h5>热门兑换<i class="fa fa-angle-double-right"></i></h5>
									<p><?php echo ($vo["tname"]); ?></p>
									<div class="ind_jf_list_img">
										<img src="<?php echo ($vo["logo_pic"]); ?>" width="100%" height="164px">
										<span><?php echo ($vo["price"]); ?><i></i></span>
									</div>
									<h4><?php echo ($vo["goods_name"]); ?> <i>兑换</i></h4>
								</div>
							</a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
		<div class="spacing10"></div>

		<?php if(is_array($cate_info)): $i = 0; $__LIST__ = $cate_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['goods'] ): ?><div class="index_titlt">
					<h5 class="tii"><img src="http://www.deyishop.com/Public/Wx/Images/line1.png" width="100%"> <?php echo ($vo["classname"]); ?> <img src="http://www.deyishop.com/Public/Wx/Images/line2.png" width="100%">
					</h5>
					<div class="ind_pro">
						<div class="row clm5">
							<?php if(is_array($vo["goods"])): $i = 0; $__LIST__ = $vo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zo): $mod = ($i % 2 );++$i;?><div class="col-xs-6 clp5">
									<a href="/wx_detail.html?id=<?php echo ($zo["id"]); ?>">
										<div class="ind_pro_list">
											<div class="ind_pro_img">
												<img src="<?php echo ($zo["logo_pic"]); ?>" width="100%">
											</div>
											<div class="ind_pro_zi">
												<h5><?php echo ($zo["goods_name"]); ?></h5>
												<h5><?php echo ($zo["goods_des"]); ?></h5>
												<span>￥<?php echo ($zo["price"]); ?></span>
											</div>
										</div>
									</a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<div class="read_more">
							<a href="/wx_product.html?cate_pid=<?php echo ($vo["id"]); ?>">查看更多</a>
						</div>
					</div>
				</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<!--  / warpper  -->

	<div class="pro_show_bg"></div>
	<div class="home_menu">
		<div class="home_menu_se"><input type="text"><img src="http://www.deyishop.com/Public/Wx/Images/mes3_1.png" width="25"></div>
		<div class="home_menu_tx"><a href="/wx_login.html">登录</a> | <a href="/wx_register.html ">注册</a></div>
		<div class="home_menu_nav">
			<ul>
				<li><a href="/wx_ucenter.html"><img src="http://www.deyishop.com/Public/Wx/Images/si5.png">个人中心 <i class="fa fa-angle-right"></i></a></li>
				<li><a href="/wx_integral.html"><img src="http://www.deyishop.com/Public/Wx/Images/si6.png">积分商城 <i class="fa fa-angle-right"></i></a></li>
				<li><a href="/wx_product.html"><img src="http://www.deyishop.com/Public/Wx/Images/si7.png">全部产品 <i class="fa fa-angle-right"></i></a></li>
				<li><a href="/wx_sale.html"><img src="http://www.deyishop.com/Public/Wx/Images/si10.png">限时促销 <i class="fa fa-angle-right"></i></a></li>
				<li><a href="/wx_fen_x.html"><img src="http://www.deyishop.com/Public/Wx/Images/si11.png">邀请码 <i class="fa fa-angle-right"></i></a></li>
				<li><a href="javascript:volid(0);" onclick="tui_login();"><img src="http://www.deyishop.com/Public/Wx/Images/si11.png">退出登录 <i class="fa fa-angle-right"></i></a></li>
				<li><a href="http://dyshop.unohacha.com"><img src="http://www.deyishop.com/Public/Wx/Images/si8.png">德意官网 <i class="fa fa-angle-right"></i></a></li>

			</ul>
		</div>
	</div>

</body>
<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
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
<!-- 倒计时 -->
<script>
	//声明 要倒计时 的秒数
	var seconds = $("#sec").val();
	
	//调用run
	run();
	
	//定时函数
	var timer = setInterval(run, 1000);
	
	//定义函数
	function run(){
		//判断 倒计时结束
		// if (seconds <= 0) {
		// 	document.getElementById('box').innerHTML = "<a href='fu/hehe.html'><button>抢购</button></a>";
		// 	clearInterval(timer);
		// 	return;
		// }
		//取出 时间中 的小时数
		var h = Math.floor(seconds / 3600);
		//获取分钟数
		var s = seconds - h * 3600;
		var i = Math.floor(s / 60);
		//获取秒数
		s -= i * 60;
		
		//处理 时分秒 的格式
		h = (h > 9)?h:'0'+h;
		i = (i > 9)?i:'0'+i;
		s = (s > 9)?s:'0'+s;
		
		//把时分秒 输出 到指定位置
		
		var timeStr = '<span>据结束<i>'+h+'</i>:<i>'+i+'</i>:<i>'+s+'</i>秒</span>';
		document.getElementById('djx').innerHTML = timeStr;
		
		//秒数 -1
		seconds --;
	}
function tui_login(){
	$(".pro_show_bg" ).stop(true ).fadeOut(500);
	$(".home_menu").stop(true ).animate({"left":"-80%"},500);
	var id=1;
	dialog.showTips("确定要退出登录吗?", "firm", function () {
        $.ajax({
	        url:'<?php echo U("Wx/User/tlogin");?>',
	        type:'post',
	        data:{'id':id},
	        dataType:'json',
	        cache:false,
	        success:function(res){
	          if(res.status == 1){   
	            window.location.href="/wx_login.html";
	          }else{
	            dialog.showTips(res.msg, "warn");
	          }
	        }
	    })
    })
}
</script>
</html>