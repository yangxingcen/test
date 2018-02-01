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
<body style="background:#000022;">

	<div class="wapper">
		<div class="header list_header">
			奖品列表
			<a href="javascript:history.go(-1);" class="header_but"><img src="http://www.deyishop.com/Public/Wx/Images/l_left.png" width="100%"></a>
		</div>

		<div class="list_cont2">
            




			<?php if(is_array($yi)): foreach($yi as $k=>$v): if($v['type'] == 3 && $v['type'] != 4): ?><div class="prize_list clearfix">

					<div class="num_div">

						<?php switch($k): case "0": ?><img src="http://www.deyishop.com/Public/Wx/Images/num1.png" width="100%"><?php break;?>
							<?php case "1": ?><img src="http://www.deyishop.com/Public/Wx/Images/num2.png" width="100%"><?php break;?>
							<?php case "2": ?><img src="http://www.deyishop.com/Public/Wx/Images/num3.png" width="100%"><?php break;?>
							<?php case "3": ?><img src="http://www.deyishop.com/Public/Wx/Images/num4.png" width="100%"><?php break;?>
							<?php case "4": ?><img src="http://www.deyishop.com/Public/Wx/Images/num5.png" width="100%"><?php break;?>
							<?php case "5": ?><img src="http://www.deyishop.com/Public/Wx/Images/num6.png" width="100%"><?php break; endswitch;?>

					</div>

					<div class="prize_txt">
						<div class="prize_txt_cell"><?php echo (mb_substr($v["ii"]["0"]["goods_name"],0,8,'utf-8')); ?></div>
					</div>
					<div class="prize_img">
						<img src="<?php echo ($v["ii"]["0"]["logo_pic"]); ?>" width="100%">
					</div>
				</div>

				<?php elseif( $v['type'] != 4): ?>
					<div class="prize_list clearfix">
						<div class="num_div">
							<?php switch($k): case "0": ?><img src="http://www.deyishop.com/Public/Wx/Images/num1.png" width="100%"><?php break;?>
								<?php case "1": ?><img src="http://www.deyishop.com/Public/Wx/Images/num2.png" width="100%"><?php break;?>
								<?php case "2": ?><img src="http://www.deyishop.com/Public/Wx/Images/num3.png" width="100%"><?php break;?>
								<?php case "3": ?><img src="http://www.deyishop.com/Public/Wx/Images/num4.png" width="100%"><?php break;?>
								<?php case "4": ?><img src="http://www.deyishop.com/Public/Wx/Images/num5.png" width="100%"><?php break;?>
								<?php case "5": ?><img src="http://www.deyishop.com/Public/Wx/Images/num6.png" width="100%"><?php break; endswitch;?>
							</div>
							<div class="prize_txt">
							<div class="prize_txt_cell">
								<?php switch($v['type']): case "1": ?>优惠券<?php echo ($v["param"]); break;?>
									<?php case "2": ?>积分<?php echo ($v["param"]); break; endswitch;?>

							</div>
							</div>
							<div class="prize_img">
								<img src="http://www.deyishop.com/Public/Wx/Images/car6.jpg" width="100%">
							</div>
						</div><?php endif; endforeach; endif; ?>

		</div>


		<div class="list_bottom clearfix">
			<div class="list_bottom_con on"><a href="<?php echo U('Wx/Games/zajindanList');?>">奖品列表</a></div>
			<div class="list_bottom_con"><a href="<?php echo U('Wx/Games/zajindanCheck');?>">中奖查询</a></div>

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

	$(".list" ).css("min-height",$(window ).height())

	$(".prize_txt").height($(".prize_img").width())
} )
</script>
</html>