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
	

	<!--  / warpper  -->
	<div class="warpper" style="padding-top: 0%;">

		<div class="user">

			<div class="user_banner">
				<div class="setting clearfix">
					<p><a href="/wx_my_info.html">设置</a></p>
					<div class="setting_img"><a href="/wx_user_new.html"><img src="http://www.deyishop.com/Public/Wx/Images/mess.png" width="100%"></a></div>
				</div>

				<div class=" send clearfix">
					<div class="real">
						<div class="user_tx1_img">
							<img src="<?php echo ($info["person_img"]); ?>" width="100%">
						</div>
						<!--<span>待实名认证</span>-->

					</div>

					<div class="real_txt">
						<?php if($info['person_name']): ?><h5><?php echo ($info["person_name"]); ?></h5>
						<?php else: ?>
							<h5><?php echo ($info["telephone"]); ?></h5><?php endif; ?>
						<p>积分:<span><?php echo ($info["integral"]); ?></span><a href="wx_integral_info.html">明细</a></p>
					</div>

					<div class="sign" onclick="qiandao()">
						<img src="http://www.deyishop.com/Public/Wx/Images/qiandao.png" width="100%">
						<a href="javascript:volid(0);">签到送好礼</a>

					</div>
				</div>

			</div>

			<div class="personal">

				<div class="mine clearfix">
					<div class="mine_one">
						<h5>0</h5>
						<p>我的分享</p>
					</div>
					<div class="mine_one">
						<h5>0</h5>
						<p>交易记录</p>
					</div>
					<div class="mine_one">
						<h5>0</h5>
						<p>佣金记录</p>
					</div>
					<div class="mine_one">
						<h5>0</h5>
						<p>我的提现</p>
					</div>

				</div>
				<div class="user_list">
					<a href="/wx_order.html"><h5>
						我的订单
						<span>查看全部订单<i class="fa fa-angle-right"></i></span>
					</h5></a>
					<div class="user_lists ">
						<ul class="clearfix">
							<a href="/wx_order1.html">
								<li>
									<img src="http://www.deyishop.com/Public/Wx/Images/user_1.png" width="100%">
									<span>待付款</span>
								</li>
							</a>
							<a href="/wx_order2.html">
								<li>
									<img src="http://www.deyishop.com/Public/Wx/Images/user_2.png" width="100%">
									<span>待发货</span>
								</li>
							</a>
							<a href="/wx_order3.html">
								<li>
									<img src="http://www.deyishop.com/Public/Wx/Images/user_3.png" width="100%">
									<span>待收货</span>
								</li>
							</a>
							<a href="/wx_order4.html">
								<li>
									<img src="http://www.deyishop.com/Public/Wx/Images/user_4.png" width="100%">
									<span>待评价</span>
								</li>
							</a>
							<a href="/wx_order5.html">
								<li style="border-right:none;">
									<img src="http://www.deyishop.com/Public/Wx/Images/user_5.png" width="100%">
									<span>退款/售后</span>
								</li>
							</a>

						</ul>
					</div>
				</div>

				<div class="user_list">
					<a href="javascript:volid(0);"><h5>
						我的工具

					</h5></a>
					<div class="user_lists ">
						<div class=" tools ">
							<div class="tools1 clearfix">
								<a href="/wx_browse.html">
									<div class="tools_one">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj1.png" width="100%">
										<span>浏览记录</span>
									</div>
								</a>
								<a href="/wx_collect.html">
									<div class="tools_one">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj2.png" width="100%">
										<span>我的收藏</span>
									</div>
								</a>
								<a href="/wx_coupon.html">
									<div class="tools_one">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj3.png" width="100%">
										<span>我的优惠券</span>
									</div>
								</a>
								<a href="/wx_fen_x.html">
									<div class="tools_one">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj4.png" width="100%">
										<span>我的分销</span>
									</div>
								</a>
							</div>
							<div class="tools2 clearfix">
								<a href="/wx_user_pingj.html">
									<div class="tools_one" style="border-right:none;">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj5.png" width="100%">
										<span>我的评价</span>
									</div>
								</a>
								<a href="/wx_address.html">
									<div class="tools_one" style="border-right:none;">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj6.png" width="100%">
										<span>地址管理</span>
									</div>
								</a>
								<a href="/wx_integral_add.html">
									<div class="tools_one" style="border-right:none;">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj7.png" width="100%">
										<span>我的积分</span>
									</div>
								</a>
								<a href="/wx_user_fap.html">
									<div class="tools_one" style="border-right:none;">
										<img src="http://www.deyishop.com/Public/Wx/Images/gj8.png" width="100%">
										<span>发票信息</span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="will_value">

					<h5><img src="http://www.deyishop.com/Public/Wx/Images/huiy.png" width="100%"> 我的会值员</h5>

					<div class="super clearfix">

						<div class="super_on">

							<h4>1168 <i class="fa fa-long-arrow-up"></i></h4>
							<p class="super_p1"><img src="http://www.deyishop.com/Public/Wx/Images/jifen.png" width="100%"> 超级会员</p>
							<span>比上期+10</span>
						</div>

						<div class="super_on">
							<h4 class="traffic"><img src="http://www.deyishop.com/Public/Wx/Images/liuliang.png" width="100%"></h4>
							<p class="super_p2">积分兑换流量券</p>
							<span>满400分专享</span>
						</div>
					</div>

					<div class="pick_up"><a href="javascript:volid(0);">领取会员权益</a></div>
				</div>
			</div>

		</div>

	</div>

	<!--  / warpper  -->

</body>
<script>
function  qiandao() {
    var user_id=<?php echo ($userinfo['id']); ?>;
    if(confirm('测试签到'+user_id)){
        $.ajax({
            url: "<?php echo U('Wx/Ucenter/qiandao');?>",
            type:'get',
            data : 'user_id='+user_id ,
            success : function(data){
                if(data.status==1){
                    dialog.showTips(data.info, "",1);
                }else{
                    dialog.showTips(data.info, "warn");
                }
            }
        });
    }
}
</script>
</html>