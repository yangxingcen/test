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

	<!--  / warpper  -->
	<div class="warpper">

		<div class="screening clearfix">

			<a href="javascript:history.go(-1)">
				<div class="screening_btn">
					<span></span>
				</div>
			</a>

			<div class="serach">
				<input type="text" class="in_one" onFocus="this.value = '';" onBlur="if(this.value == '') {this.value = '油烟机';}" value="油烟机">

				<input type="button" class="in_one2">
			</div>

			<div class="pro_share1" style="    top: 13px;">

				<div class="pro_share_rig">

					<span></span>

					<div class="message"><ul class="message_ul">
						<li><a href="/wx_user_new.html"><img src="http://www.deyishop.com/Public/Wx/Images/mes1.png" width="100%"> 消息 <i>1</i></a></li>
<li><a href="/wx_ucenter.html"><img src="http://www.deyishop.com/Public/Wx/Images/mes6.png" width="100%"> 个人中心</a></li>
<li><a href="/wx_index.html"><img src="http://www.deyishop.com/Public/Wx/Images/mes2.png" width="100%"> 首页</a></li>
<li><a href="/wx_search.html"><img src="http://www.deyishop.com/Public/Wx/Images/mes3.png" width="100%"> 搜索</a></li>
<li><a href="/wx_collect.html"><img src="http://www.deyishop.com/Public/Wx/Images/mes4.png" width="100%"> 我的收藏</a></li>
<li><a href="/wx_browse.html"><img src="http://www.deyishop.com/Public/Wx/Images/mes5.png" width="100%"> 浏览记录</a></li>
					</ul>
						<div class="triangle">

						</div>
					</div>
				</div>

			</div>

		</div>

		<div class="fication">
			<div class="toggle">
				<div class="swiper-container swiper_fen">
					<div class="swiper-wrapper">
						<?php if(is_array($goods_type)): $i = 0; $__LIST__ = $goods_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
								<div class="ggle_txt <?php if(($cate_pid) == $vo["id"]): ?>bord_li<?php endif; ?>"><a href="/wx_product.html?cate_pid=<?php echo ($vo["id"]); ?>" <?php if(($cate_pid) == $vo["id"]): ?>class="bord_li"<?php endif; ?>><?php echo ($vo["classname"]); ?></a></div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>

				</div>

			</div>

			<div class="fication_im">
				<span></span>
			</div>

		</div>

		<div class="wap_tanc">
			<div class="pro_list_bg"></div>

			<div class="pro_list">

				<div class="all_fen">
					<h5>全部分类</h5>
					<span></span>
				</div>

				<div class="pro_list_fen">
					<div class="row">
						<?php if(is_array($goods_type)): $i = 0; $__LIST__ = $goods_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-4">
								<div class="pro_list_img">

									<img src="<?php echo ($vo["pic"]); ?>" width="100%">
									<p><?php echo ($vo["classname"]); ?></p>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="screen clearfix">

			<div class="screen_on screen_on_y">

				<div class="thesise">综合<span class="sapn"></span></div>

				<ul>
					<li>综合排序<img style="display:block;" src="http://www.deyishop.com/Public/Wx/Images//show_xb.png" width="20"></li>
					<li>上市时间<img src="http://www.deyishop.com/Public/Wx/Images//show_xb.png" width="20"></li>
					<li>价格最高<img src="http://www.deyishop.com/Public/Wx/Images//show_xb.png" width="20"></li>
					<li>价格最低<img src="http://www.deyishop.com/Public/Wx/Images//show_xb.png" width="20"></li>
				</ul>
			</div>
			<div class="screen_on">
				<div class="thesise thesise2">销量<span class="sapn"></span></div>
			</div>
			<div class="screen_on">

				<div class="thesise thesise3">价格<span class="sapn"></span></div>
			</div>
			<div class="screen_on screen_on4">
				<div class="thesise thesise4">筛选<span class="sapn1"></span></div>
			</div>

		</div>
		<div class="pro_lest">
			<div class="row clm5">
				<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="product_inner.html">
						<div class="col-xs-6 clp6">
							<div class="list_one">
								<div class="list_img">
									<img src="<?php echo ($vo["logo_pic"]); ?>" width="100%">
								</div>

								<div class="list_txt">
									<h5><?php echo ($vo["classname"]); echo ($vo["goods_name"]); ?></h5>
									<div class="labelling"><span><?php echo ($vo["goods_des"]); ?></span></div>
									<p class="piece">￥ <span>2600</span> <i class="install">分期免息</i></p>
									<div class="high_pj "><?php echo ($vo["comment_num"]); ?>条评价</div>
								</div>
							</div>
						</div>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>

		<div class="screening_bg"></div>
		<div class="screen_sai">

			<div class="screen_sai1">
				<h5>折扣</h5>
				<div class="discount discount_yy1">

					<a href="##">包邮</a>
					<a href="##">蚂蚁花呗</a>
					<a href="##">货到付款</a>
					<a href="##">7天内退货</a>
					<a href="##">货到付款</a>
					<a href="##">7天内退货</a>
				</div>

			</div>
			<div class="screen_sai1">
				<h5>系列</h5>
				<div class="discount discount_yy2">

					<a href="##">铭典系列</a>
					<a href="##">铭典系列</a>

				</div>

			</div>
			<div class="screen_sai1">
				<h5>型号</h5>
				<div class="discount discount_yy2">

					<a href="##">KWS2503</a>
					<a href="##">KWS2503</a>

				</div>

			</div>
			<div class="screen_sai1">
				<h5>颜色</h5>
				<div class="discount discount_yy2">

					<a href="##">黑色</a>
					<a href="##">灰色</a>

				</div>

			</div>
			<div class="screen_sai1">
				<h5>价格区间（元）</h5>
				<div class="discount1 clearfix">

					<div class="count1_left">
						<input class="input1" type="text" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '最低价';}" value="最低价"/>
					</div>
					<div class="count1_center">
						-
					</div>
					<div class="count1_right">
						<input class="input1" type="text" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '最高价';}" value="最高价"/>
					</div>

				</div>

			</div>

			<div class="resetting clearfix">
				<a href="##">重置</a>
				<a href="##" style="background: #ff5806">完成</a>
			</div>
		</div>

	</div>
	<!--  / warpper  -->

</body>
<script>

$( document ).ready( function()
{

	var mySwiper = new Swiper( '.swiper_fen', {
		slidesPerView: 4,

		spaceBetween: 0,
		paginationClickable: true,
	} )

	$( '.screen_on .thesise ' ).click( function()
	{
		var _this=$(this ).parents(".screen_on")

		if( _this.hasClass( 'products_pxon' ) )
		{
			_this.removeClass( 'products_pxon' );
			if(_this.hasClass("screen_on_y")){
				$( '.screen_on_y ul' ).stop( true ).slideUp( 300 );
			}
		}
		else
		{
			_this.addClass( 'products_pxon' );
			$( '.screen_on_y ul' ).stop( true ).slideUp( 300 );
			if(_this.hasClass("screen_on_y")){
				$( '.screen_on_y ul' ).stop( true ).slideDown( 300 );
			}
		}
	} )

	$( '.screen_on_y ul li' ).click( function()
	{
		$( '.screen_on_y ul li' ).find( 'img' ).fadeOut( 0 );
		$( this ).find( 'img' ).fadeIn( 0 );

		$( this ).parents(".screen_on").removeClass( 'products_pxon' );

		$( this ).parents("ul").stop( true ).slideUp( 300 );

	} )

	$( '.fication_im' ).click( function()
	{
		$( '.wap_tanc' ).stop( true ).fadeIn( 600 );
		$( '.pro_list' ).stop( true ).fadeIn( 600 );
	} )

	$( ".all_fen" ).click( function()
	{
		$( '.wap_tanc' ).stop( true ).fadeOut( 600 );
		$( '.pro_list' ).stop( true ).fadeOut( 600 );

	} )

	$( ".ggle_txt a" ).click( function()
	{

		$( ".ggle_txt a" ).removeClass();
		$( this ).addClass( "bord_li" );

	} )

	$( ".screen_sai" ).height( $( window ).height() )

	$( ".discount_yy1 a" ).click( function()
	{

		if( $( this ).hasClass( "disco_sp" ) )
		{
			//			$( ".discount a" ).removeClass( "disco_sp" )
		}
		else
		{

			$( this ).addClass( "disco_sp" )
		}

	} )


	$( ".discount_yy2 a" ).click( function()
	{

		if( $( this ).hasClass( "disco_sp" ) )
		{
			//			$( ".discount a" ).removeClass( "disco_sp" )
		}
		else
		{
			$( ".discount_yy2 a" ).removeClass( "disco_sp" )
			$( this ).addClass( "disco_sp" )
		}

	} )

	$( ".thesise4" ).click( function()
	{

		$( '.screening_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.screen_sai' ).stop( true, true ).animate( { right: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );

	} )

	$( ".resetting a " ).click( function()
	{
		$( '.screening_bg' ).stop( true, true ).fadeOut( 300 );
		$( '.screen_sai' ).stop( true, true ).animate( { right: "-85%" }, 500 );

	} )

} )

</script>
</html>