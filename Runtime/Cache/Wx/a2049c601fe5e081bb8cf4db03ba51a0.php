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
<body style="background-color: #fdd727; padding-top: 30px;">


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
		<div class="tegral">我的奖品</div>
		<!--<div class="collect_zt_btn1">编辑</div>-->
	</div>
	<!--<div class="luck_bg1">-->

	<!--</div>-->

	<div class="warpper" style="z-index: 1;position: relative; padding-top:43px;">

		

		<div class="my_jiangg">


			<h5><i class="">我的奖品</i></h5>

			<?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="prize clearfix">
			<div class="prize_img">

				<?php switch($v["prize_type"]): case "3": ?><img src="<?php echo ($v["goods_pic"]); ?>" width="100%"><?php break;?>
					<?php default: ?><img src="http://www.deyishop.com/Public/Wx/Images/djj.png" width="100%"><?php endswitch;?>
			</div>

				<div  class="prize_txt">
				<p>	<?php echo ($v["goods_name"]); ?></p>
				<span>中奖时间：<?php echo (date("Y年m月d日",$v["addtime"])); ?></span>
				</div>
			</div><?php endforeach; endif; ?>


		</div>

	
		
		
		
	</div>
	

	

</body>
<script type="text/javascript">



</script>
</html>