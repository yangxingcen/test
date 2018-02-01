<?php if (!defined('THINK_PATH')) exit();?>	<!DOCTYPE html>
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
	<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/iscroll.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/common1.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/catalog.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/seacher.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/style.css">
	<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/index.js"></script>

	<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/jquery.lazyload.min.js"></script>
	<script type="text/javascript">
	var myScroll, myScrollri;
	var $ulLeft;
	var cataId = 0;

	function pullUpAction()
	{
		setTimeout( function()
		{
			myScrollri.refresh();
		}, 500 );
	}

	function init_left_li()
	{
		var total_hei = $ulLeft.height();//总高度
		var li_height = $ulLeft.find( "li" ).height();//单个li高度
		var li_num = $ulLeft.find( "li" ).length;//个数
		console.log( $ulLeft.find( ".off" ).offset().top );
	}
	/**
	 * 初始化iScroll控件
	 */
	function loaded()
	{
		$ulLeft = $( "#con_left" );
		myScroll = new IScroll( "#con_left", {
			mouseWheel: true,
			click: true,
			preventDefault: false,
			preventDefaultException: { tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT|A)$/ }
		} )
		myScrollri = new IScroll( "#con_right", {
			mouseWheel: true, click: true
		} )
		myScrollri.on( "scrollStart", function()
		{
			pullUpAction();
		} );
		myScrollri.on( "scroll", function()
		{
			pullUpAction();
		} );
		myScrollri.on( "scrollEnd", function()
		{
			$( '.fr_ite_' + cataId ).find( "img" ).lazyload( {
				threshold: 200
			} ).on( 'load', function()
			{
				pullUpAction();
			} );
		} );
		$( '.job_sub li' ).eq( 0 ).click();
	}
	//初始化绑定iScroll控件
	document.addEventListener( 'touchmove', function( e )
	{
		e.preventDefault();
	}, false );
	document.addEventListener( 'DOMContentLoaded', loaded, false );

	/* 切换内容*/
	$( function()
	{
		$( '.job_sub li' ).click( function()
		{
			$( this ).addClass( 'off' ).siblings().removeClass( 'off' );
			var str = "#con_left li:nth-child(" + ($( this ).index() + 1) + ")";
			setTimeout( function()
			{
				myScroll.scrollToElement( document.querySelector( str ) );
			}, 300 );
			cataId = $( this ).attr( "data-cataId" );
			$( '.fr_ite_' + $( this ).attr( "data-cataId" ) ).removeClass( 'disp' ).siblings().addClass( 'disp' );
			/* $('.fr_ite_'+$(this).attr("data-cataId")).find("img").lazyload({effect: "fadeIn"}); */
			pullUpAction();
			myScrollri.scrollTo( 0, 0, 100, IScroll.utils.ease.elastic );
			/* myScrollri = new IScroll("#con_right",{
			 mouseWheel: true, click: true
			 }) */
		} );
		$( ".fr_ite ul" ).each( function()
		{
			if( $( this ).find( "li" ).length == 1 )
			{
				$( this ).addClass( "left_num1" );
			}
			else
				if( $( this ).find( "li" ).length == 2 )
				{
					$( this ).addClass( "left_num2" );
				}
		} )
		$( ".img_lazy" ).lazyload( { effect: "fadeIn" } );
	} );


	setInterval( "myInterval()", 1000 );//1000为1秒钟
	function myInterval()
	{
		$( "body" ).height( $( window ).height() );
	}

	</script>
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

	<div class="new_wap_con" style="max-width:100%;">
		<div class="integral">

				<div class="screening_btn1">
					<a href="javascript:history.go(-1)">
					<span></span>
					</a>
				</div>

			<div class="tegral">商品分类</div>
			<a href="search.html"><input type="button" class="in_one2 in_one3"></a>
		</div>
		<div class="l_left" id="con_left">
			<!--标题-->
			<ul class="job_sub" id="scroller1">
				<?php if(is_array($goods_type)): $i = 0; $__LIST__ = $goods_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i == 1 ): ?><li class="off" data-cataid="<?php echo ($vo["id"]); ?>"><a href="javascript:void(0)"><?php echo ($vo["classname"]); ?></a></li>
					<?php else: ?>
						<li data-cataid="<?php echo ($vo["id"]); ?>" class=""><a href="javascript:void(0)"><?php echo ($vo["classname"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>		
			</ul>
		</div>
		<div class="l_right" id="con_right">
			<div class="rightBox" id="scroller" >
				<!-- 二级  -->
				<?php if(is_array($goods_type)): $i = 0; $__LIST__ = $goods_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i == 1 ): ?><div class="fr_ite   fr_ite_<?php echo ($vo["id"]); ?>" data-cataid="<?php echo ($vo["id"]); ?>">
							<a href="javascript:void(0)">
								<img class="img1 img_lazy" src="<?php echo ($vo["pic5"]); ?>">
							</a>
							<!-- 二级数据显示 -->
							<?php if(is_array($vo["son_type"])): $i = 0; $__LIST__ = $vo["son_type"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zo): $mod = ($i % 2 );++$i;?><div class="sub_ites">
									<span><?php echo ($zo["classname"]); ?></span>
									<a href="/wx_product.html?cate_id=<?php echo ($zo["id"]); ?>">全部商品</a>
								</div>
							<!-- 三级显示 -->
								<ul>
									<?php if(is_array($zo["goods"])): $i = 0; $__LIST__ = $zo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xo): $mod = ($i % 2 );++$i;?><li>
											<a href="wx_detail.html?id=<?php echo ($xo["id"]); ?>">
												<img class="img_lazy"  src="<?php echo ($xo["logo_pic"]); ?>"><br>
												<span><?php echo ($xo["goods_name"]); ?></span>
											</a>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							<a class="all_cata" href="/wx_product.html?cate_pid=<?php echo ($xo["id"]); ?>">
									<span>浏览全部产品</span>
							</a>
						</div>
					<?php else: ?>
						<div class="fr_ite   fr_ite_<?php echo ($vo["id"]); ?> disp" data-cataid="<?php echo ($vo["id"]); ?>">
							<a href="javascript:void(0)">
								<img class="img1 img_lazy" src="<?php echo ($vo["pic5"]); ?>">
							</a>
							<!-- 二级数据显示 -->
							<?php if(is_array($vo["son_type"])): $i = 0; $__LIST__ = $vo["son_type"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zo): $mod = ($i % 2 );++$i;?><div class="sub_ites">
									<span><?php echo ($zo["classname"]); ?></span>
									<a href="/wx_product.html?cate_id=<?php echo ($zo["id"]); ?>">全部商品</a>
								</div>
							<!-- 三级显示 -->
								<ul>
									<?php if(is_array($zo["goods"])): $i = 0; $__LIST__ = $zo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xo): $mod = ($i % 2 );++$i;?><li>
											<a href="/wx_detail.html?id=<?php echo ($xo["id"]); ?>">
												<img class="img_lazy"  src="<?php echo ($xo["logo_pic"]); ?>"><br>
												<span><?php echo ($xo["goods_name"]); ?></span>
											</a>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							<a class="all_cata" href="/wx_product.html?cate_pid=<?php echo ($xo["id"]); ?>">
									<span>浏览全部产品</span>
							</a>
						</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>


</body>
</html>