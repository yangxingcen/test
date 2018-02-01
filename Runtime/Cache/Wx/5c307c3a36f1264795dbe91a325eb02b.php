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

	<div class="integral">

		<a href="javascript:history.go(-1)">
			<div class="screening_btn1">
				<span></span>
			</div>
		</a>

		<div class="tegral">地址管理</div>

	</div>
	<!--  / warpper  -->
	<div class="warpper" style="background: #f9f9f9">

		<div class="user_dizhi">
			<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="dizhi_list">

					<h5><?php echo ($vo["consignee"]); ?><span><?php echo ($vo["telephone"]); ?></span></h5>
					<p><?php echo ($vo["province"]); echo ($vo["city"]); echo ($vo["district"]); echo ($vo["place"]); ?></p>

					<div class="acquie clearfix">
						
						<?php if($vo['isdefault'] == 1 ): ?><div class="acquie_left" onclick="up_def(<?php echo ($vo['id']); ?>,<?php echo ($vo['isdefault']); ?>);" ><span class="bg_nn"></span>默认地址</div>
						<?php else: ?>
							<div class="acquie_left" onclick="up_def(<?php echo ($vo['id']); ?>,<?php echo ($vo['isdefault']); ?>);" ><span class=""></span>默认地址</div><?php endif; ?>
						<div class="acquie_right">
							<a href="/wx_update_address.html?id=<?php echo ($vo["id"]); ?>" class="click_upd"> <img src="http://www.deyishop.com/Public/Wx/Images/upda.png" width="100%">编辑</a>
							<a href="javascript:volid();" class="click_del" id="<?php echo ($vo["id"]); ?>"> <img src="http://www.deyishop.com/Public/Wx/Images/dele.png" width="100%">删除</a>
						</div>
					</div>

				</div><?php endforeach; endif; else: echo "" ;endif; ?>

		</div>
		<div class="userdizhi_xj">
			<a href="/wx_add_address.html">

				<img src="http://www.deyishop.com/Public/Wx/Images/add1.png" width="100%">添加新地址
			</a>
		</div>
		<div class="refunds_bg"></div>

		<div class="deleting">
			<h5>确认要删除该地址吗？</h5>
			<p><a href="javascript:volid();">取消</a><a href="javascript:volid();" id="address_del" class="delet">删除</a></p>

		</div>

	</div>
	<!--  / warpper  -->

</body>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/alert.js"></script>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/ucenter/address.js"></script>
<script>
$( document ).ready( function()
{

	$( ".acquie_left " ).click( function()
	{
		var _this = $( this ).find( "span" );
		console.log( _this )
		if( _this.hasClass( "bg_nn" ) )
		{
			$( ".acquie_left span" ).removeClass( "bg_nn" )

		}
		else
		{

			$( ".acquie_left span" ).removeClass( "bg_nn" )
			_this.addClass( "bg_nn" );

		}
	} )

	$( ".click_del " ).click( function()
	{	
		var del_id = '';
		del_id = $(this).attr('id');
		
		$("#address_del").attr("del_id",del_id);
		$( '.refunds_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.deleting' ).stop( true, true ).fadeIn( 300 );
	} )
	$( ".deleting a " ).click( function()
	{

		$( '.refunds_bg' ).stop( true, true ).fadeOut( 300 );
		$( '.deleting' ).stop( true, true ).fadeOut( 300 );
	} )

} )

</script>

<html>