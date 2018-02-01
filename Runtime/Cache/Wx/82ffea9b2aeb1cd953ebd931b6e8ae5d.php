<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	<link rel="shortcut icon" href="http://www.deyishop.com/Public/Wx/Images/logo.ico"/>
	<title>德意微商城</title>
	<meta name="keywords" content=" "/>
	<meta name="description" content=" "/>

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/style.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/common.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/swiper-3.4.1.min.css">

	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/jquery-1.11.1.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/bootstrap.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/jquery-ui.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/easing.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/swiper-3.4.1.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/index.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/main.js"></script>
	<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">
	<!--[if lte IE 9]>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/respond.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/html5shiv.js"></script>
	<![endif]-->

</head>
<style>
	.wap_tanc_con{
		padding: 0px;
	}
</style>

<body>

	<div class="wapper check">
		<div class="header list_header">
			中奖查询
			<a href="javascript:history.go(-1);" class="header_but"><img src="http://www.deyishop.com/Public/Wx/Images/l_left.png" width="100%"></a>
		</div>

		<div class="check_cont">
			<img src="http://www.deyishop.com/Public/Wx/Images/c_ti.png" width="100%" class="check_tit">

			<?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="sah_ib">
				<img src="http://www.deyishop.com/Public/Wx/Images/c_3.png" width="100%">
				<div class="sah_ib2">
					<div class="check_con clearfix">
						<div class="check_con_img">
							<?php if($v['prize_type'] != 3): ?><img src="http://www.deyishop.com/Public/Wx/Images/djj.png" width="100%">
							<?php else: ?>
								<img src="<?php echo ($v["goods_pic"]); ?>" width="100%"><?php endif; ?>
						</div>
						<div class="check_con_txt">
							<h5><?php echo (mb_substr($v["goods_name"],0,13,'utf-8')); ?></h5>
							<p><?php echo (date("Y.m.d H:i",$v["addtime"])); ?></p>
						</div>
					</div>
				</div>

			</div><?php endforeach; endif; ?>


			<div class="list_bottom clearfix">
				<div class="list_bottom_con"><a href="<?php echo U('Wx/Games/zajindanList');?>">奖品列表</a></div>
				<div class="list_bottom_con on"><a href="<?php echo U('Wx/Games/zajindanCheck');?>">中奖查询</a></div>

			</div>
		</div>
	</div>

</body>
<script>
$( document ).ready( function()
{

	var mySwiper1 = new Swiper( '.swiper-container-dan', {
		autoplay: 4000,
		loop: true,
		slidesPerView: 3,
		speed: 400,
		paginationClickable: true,
		autoplayDisableOnInteraction: false,
	} )

	$( ".check" ).css( "min-height", $( window ).height() )
} )
</script>
</html>