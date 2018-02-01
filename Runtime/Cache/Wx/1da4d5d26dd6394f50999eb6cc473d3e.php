<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>德意微商城</title>


	<link rel="shortcut icon" href="http://www.deyishop.com/Public/Wx/Images/logo.ico"/>
	<meta http-equiv="cache-control" content="no-transform">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<!-- <script src="./js/hm.js"></script>
	<script async="" src="./js/analytics.js"></script> -->

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/dazhuanpan/css/bootstrap.css">
	<link href="http://www.deyishop.com/Public/Wx/dazhuanpan/css/index1.css" rel="stylesheet">

	<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/dazhuanpan/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/dazhuanpan/js/awardRotate.js"></script>
	<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/dazhuanpan/js/scroll.js"></script>


	<style>
		body {
			background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			-o-background-size: cover;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src='http://www.deyishop.com/Public/Wx/Images/bj.png', sizingMethod='scale');
		}
	</style>
</head>

<body style="background-color: #fdd727;">

<!--<div class="header list_header" style="background: #ffffff">-->
<!--幸运大转盘-->
<!--<a href="javascript:history.go(-1);" class="header_but"><img src="http://www.deyishop.com/Public/Wx/Images/l_left.png" width="100%"></a>-->
<!--</div>-->
<div class="integral">
	<a href="javascript:history.go(-1)">
		<div class="screening_btn1">
			<span></span>
		</div>
	</a>
	<div class="tegral">幸运大转盘</div>
	<!--<div class="collect_zt_btn1">编辑</div>-->
</div>
<div class="luck_bg1">

</div>
<div class="luck_bg2">
	<img src="http://www.deyishop.com/Public/Wx/Images/luck_dai.png" width="100%">
</div>
<div class="warpper" style="z-index: 1;position: relative; padding-top:43px;">
	<div class="luck_gift clearfix">
		<div class="l_gift_box">
			<span class="gift_img"><img src="http://www.deyishop.com/Public/Wx/Images/gift.png" width="100%"></span>
			<a href="<?php echo U('/Wx/Games/dazhuanpan_inner');?>">
				<span class="gift_text">我的奖品</span></a>
		</div>
	</div>
	<div class="luck_tit">
		<div class="luck_tit_img">
			<img src="http://www.deyishop.com/Public/Wx/Images/luck_tit.png" width="100%">
		</div>
		<div class="luck_tit_text">
			<!--<h4>第 001 期</h4>-->
			<p style="margin-top: 10px;    font-size: 13px;">
				<span>抽奖日 ：</span>
				<?php echo ($start_time); ?>-<?php echo ($end_time); ?>
			</p>
		</div>
	</div>
	<div class="luck_box">
		<div class="pc_yaojiang_imgs">

		</div>
		<div class="pc_banner">
			<div class="pc_turnplate" style="background-image:url(http://www.deyishop.com/Public/Wx/Images/cj_bg.png);background-size:100% 100%;">
				<canvas class="pc_item" id="pc_wheelcanvas" width="422px" height="422px"></canvas>
				<img class="pc_pointer" src="http://www.deyishop.com/Public/Wx/Images/jt2.png">
			</div>
		</div>

	</div>
	<div class="luck_box2">
		<div class="luck_box2_top">
			<img src="http://www.deyishop.com/Public/Wx/Images/luck2_1.png" width=100%>
		</div>
		<div class="lick_box2_center">
			<div class="lick_box2_tit">
				<span class="one">最新参与</span>
				<a href="http://www.deyishop.com/Wx.html"> <span class="two">前往商城</span></a>
			</div>
			<p class="lick_box2_tit_p1">参与可获得一份精美礼品</p>
			<div class="lick_box2_wei clearfix">
				<?php if(is_array($zhongj)): foreach($zhongj as $k=>$v): if($k <= 2): ?><div class="lick_box2_wei_box">
					<span><img src="<?php echo ($v["person_imqg"]); ?>" width="100%"></span>
					<p><?php echo (mb_substr($v["person_name"],0,4,'utf-8')); ?></p>
					<div class="fiver">获得<?php switch($v["prize_type"]): case "1": echo ($v["goods_name"]); break; case "2": echo ($v["goods_name"]); break; case "3": echo (mb_substr($v["goods_name"],0,6,'utf-8')); break; endswitch;?></div>
				</div><?php endif; endforeach; endif; ?>

			</div>
			<p class="lick_box2_tit_p2">尚未浏览过本商城的好友才有效哦~</p>
		</div>

	</div>
	<div class="luck_box3">
		<div class="luck_box3_tit">
			好友运气
		</div>
		<div class="luck_box_con">
			<ul>
				<?php if(is_array($zhongj)): foreach($zhongj as $k=>$v): if($k > 2): ?><li>
						<span>
							<img src="<?php echo ($v["person_imqg"]); ?>" width="100%">
						</span>
					<p><?php echo (mb_substr($v["person_name"],0,3,'utf-8')); ?>抽奖获得<?php switch($v["prize_type"]): case "1": echo ($v["goods_name"]); break; case "2": echo ($v["goods_name"]); break; case "3": echo (mb_substr($v["goods_name"],0,10,'utf-8')); break; endswitch;?></p>
				</li><?php endif; endforeach; endif; ?>
			</ul>
		</div>
	</div>



	<div class="luck_box3 luck_box4">
		<div class="luck_box3_tit">
			游戏规则
		</div>

		<div class="limit" >
			<textarea style="width: 100%;background-color: #f8657c;border-color: #f8657c;min-height: 300px;resize: none;" disabled ><?php echo ($describe); ?></textarea>
		</div>
	</div>



	<div id="pc_mark">

		<div class="pc_mark_box">
			<div class="pc_mark_box_img">
				<div class="div_close">

				</div>
				<img src="http://www.deyishop.com/Public/Wx/Images/tan.png" width="100%">


				<div class="mark_box_img">

					<h5 class="one">恭喜您获得</h5>
					<h3></h3>
					<h5 class="two" id="tianxie"><a href="##" class="tianxie">填写物流信息</a> </h5>

				</div>
			</div>

		</div>
	</div>

</div>
<div style="display: none" id="name_name"><?php if(is_array($list_datad)): foreach($list_datad as $i=>$v): switch($v["type"]): case "1": echo ($v['param']); ?>优惠券<?php break;?>
			<?php case "2": echo ($v['param']); ?>积分<?php break;?>
			<?php case "3": echo (mb_substr($v['yui']['goods_name'],0,6,'utf-8')); break;?>
			<?php case "4": echo ($v['param']); break; endswitch; if($v['yu'] != count($list_datad)): ?>,<?php endif; endforeach; endif; ?></div>
<div style="display: none" id="name_color"><?php if(is_array($list_datad)): $i = 0; $__LIST__ = $list_datad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if(($mod) == "0 "): ?>#5fcbd4<?php endif; if(($mod) == "1"): ?>#ffffff<?php endif; ?>	<?php if($v['yu'] != count($list_datad)): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>
</body>




<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">

<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/dazhuanpan/js/luck.js"></script>
<script type="text/javascript">

    $( function()
    {
        $( ".luck_box_con" ).myScroll( {
            speed: 60, //数值越大，速度越慢
            rowHeight: 152 //li的高度
        } );

    } );



    $(".div_close" ).click(function()
    {
        $(".pc_mark" ).fadeOut()

    })
</script>
</html>