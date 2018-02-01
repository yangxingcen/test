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

	<!--  / warpper  -->
	<div class="warpper" style="padding-bottom: 50px;padding-top: 40px;">

		<div class="culars_yy">

			<div class="culars_yy1 clearfix">

				<a href="javascript:history.go(-1)">
					<div class="screening_btn1">
						<span></span>
					</div>
				</a>
				<div class="screening_yy">
					<ul class="clearfix">
						<li class="bord_li"><a href="/wx_detail.html?id=<?php echo ($goodsinfo["id"]); ?>">商品</a></li>
						<li><a href="/wx_detail.html?id=<?php echo ($goodsinfo["id"]); ?>#xq">详情</a></li>
						<li><a href="/wx_product_pj.html">评价</a></li>
					</ul>
				</div>

				<div class="pro_share"></div>
				<div class="pro_share1">

					<div class="pro_share_rig">

						<span></span>

						<div class="message">
							<ul class="message_ul">
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
		</div>

		<div class="products_inner">

			<div class="partic">
				<div class="swiper-container swiper1">
					<div class="swiper-wrapper">
						<?php if(is_array($goodsinfo["pics"])): $i = 0; $__LIST__ = $goodsinfo["pics"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img src="<?php echo ($vo); ?>" width="100%"></div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>

					<div class="pagination pagination_gr"></div>
				</div>
			</div>

			<div class="products_inner_zi">
				<div class="products_inner_zi1">
					<h5><?php echo ($goodsinfo["goods_name"]); ?></h5>
					<div class="model"><?php echo ($goodsinfo["goods_code"]); ?></div>
					<p>¥<span class="present"><?php echo ($goodsinfo["price"]); ?> </span>
						<?php if($goodsinfo['is_new'] == 1 ): ?><span class="promotion">新品</span><?php endif; ?>
						<?php if($goodsinfo['is_cuxiao'] == 1): ?><span class="deduction">促销</span><?php endif; ?>
					</p>
					<div class="ginal">原价<i>¥<?php echo ($goodsinfo["oprice"]); ?></i></div>
					<div class="products_inner_zi1s clearfix">
						<p>月销<?php echo ($goodsinfo["sales"]); ?>笔</p>
					</div>
				</div>
			</div>
			<div class=" insurance ">

				<div class="insurance1 clearfix">
					<div class="insur_on">
						<img src="http://www.deyishop.com/Public/Wx/Images/gou.png" width="100%">全场包邮
					</div>
					<div class="insur_on">
						<img src="http://www.deyishop.com/Public/Wx/Images/gou.png" width="100%">用心臻选
					</div>
					<div class="insur_on">
						<img src="http://www.deyishop.com/Public/Wx/Images/gou.png" width="100%">正品保证
					</div>
					<div class="insur_on">
						<img src="http://www.deyishop.com/Public/Wx/Images/gou.png" width="100%">破损无忧
					</div>

				</div>

				<img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more.png" width="100%">
			</div>

			<div class="products_inner_jf">

				<div class="products_inner_jf1">
					<p><span> <i class="youhui1"></i>优惠<i class="youhui2"></i><i class="youhui3"></i></span>点击领取优惠券
						<img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more.png" width="100%"></p>
				</div>

				<div class="products_inner_jf2">
					<p><span>积分</span>购买可获得400积分 <img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more.png" width="100%"></p>
				</div>
				<div class="products_inner_jf3">
					<p>售后保障
						<img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more.png" width="100%">
					</p>
				</div>
			</div>

			<div class="products_inner_zi2">
				<h5><b>配送至：</b><img src="http://www.deyishop.com/Public/Wx/Images/map1.png" width="100%" class="map1">
					<span>浙江省</span><span>杭州市</span><span>西湖区</span>
					<br>
					<span style="color: #aaaaaa; padding-left: 52px;">最快2017-11-13日送到</span>
					<img class="pro_more" style="margin-top:12px;" src="http://www.deyishop.com/Public/Wx/Images/pro_more.png" width="20">
				</h5>
			</div>

			<div class="products_inner_pj">
				<div class="products_inner_pjt">
					<h5>商品评价<span>(999)</span> <a href="product_pj.html">查看全部 <img src="http://www.deyishop.com/Public/Wx/Images/pro_more.png"> </a></h5>

				</div>

				<div class="products_inner_pja">
					<span>快递不错(33)</span>
					<span>服务态度好(45)</span>
					<span>质量不错(36)</span>
					<span>性价比很高(27)</span>
					<span class="inner_pja_hui">价格贵(46)</span>
				</div>

				<div class="products_inner_pj_list">
					<div class="products_inner_pj_list1 clearfix">
						<h5 class="clearfix">

							<div class="portrait"><img src="http://www.deyishop.com/Public/Wx/Images/user_tx.jpg" width="100%"></div>

							<b>霸气女王范</b>
							<span class="dengji"></span> <i class="pro_day">2017-08-28</i></h5>

					</div>
					<div class="products_inner_pj_list2">
						<p>安装师傅人特别好，有耐心，收费透明公开，机器外观新 颖，后期使用情况，待更新！</p>
						<span>系列：852E单烟机</span>
					</div>

				</div>
				<div class="products_inner_pj_list products_inner_pj_list_2">
					<div class="products_inner_pj_list1 clearfix">
						<h5 class="clearfix">
							<div class="portrait"><img src="http://www.deyishop.com/Public/Wx/Images/user_tx1.jpg" width="100%"></div>
							<b>勿忘我</b>
							<span class="dengji"></span> <i class="pro_day">2017-08-28</i></h5>

					</div>
					<div class="products_inner_pj_list2">
						<p>第一次购买，满意，推荐！快递超快，第二天就收到了。</p>
						<span>系列：852E单烟机</span>

						<div class="picture">

							<img src="http://www.deyishop.com/Public/Wx/Images/ping1.jpg" width="100%"><img src="http://www.deyishop.com/Public/Wx/Images/ping2.jpg" width="100%"><img src="http://www.deyishop.com/Public/Wx/Images/ping3.jpg" width="100%">

						</div>
					</div>

				</div>
			</div>

			<div class="similar  ">

				<h4>相似商品</h4>
				<div class="clearfix">
					<?php if(is_array($xs_goods)): $i = 0; $__LIST__ = $xs_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="similar_one">

							<img src="<?php echo ($vo["logo_pic"]); ?>" width="100%">

							<div class="similar_txt">
								<h5><?php echo ($vo["goods_name"]); ?></h5>
								<p>¥ <?php echo ($vo["price"]); ?> <span>已售<?php echo ($vo["sales"]); ?>件</span></p>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

			</div>
			<div class="particulars" id="xq">

				<div class="culars"><span class="ticulars"></span>详情</div>

				<div class="part_line"></div>
			</div>

			<div class="proinner_nav">

				<a href="##" class="proinner_nav_on"><span>商品介绍</span></a>
				<a href="##"><span>规格参数</span>
					<i class="mobb1"></i>
					<i class="mobb2"></i>
				</a>
				<a href="##"><span>优惠套装</span></a>
			</div>

			<div class="pro_box_ls">

				<div class="products_inner_con" style="display:block;">
					<div class="inner_con_tit">
						<h5>产品详情 </h5>
						<span></span>
					</div>

					
					<?php echo ($goodsinfo["detail"]); ?>
				</div>
				<div class="products_inner_con">
					<div class="inner_con_tit">
						<h5 class="inner_con_tit">规格参数</h5>
						<span></span>
					</div>

					<div class="specif">

						<table class="table-bordered">
							
							<tr class="main_tab">
								<td colspan="2"><?php echo ($goodsinfo["goods_name"]); ?>规格</td>
							</tr>
							<?php if(is_array($goods_param)): $i = 0; $__LIST__ = $goods_param;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo ($vo["0"]); ?></td>
									<td><?php echo ($vo["1"]); ?></td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>

					</div>
				</div>
				<div class="products_inner_con products_inner_con3">

					<div class="inner_con_tit">
						<h5 class="inner_con_tit">优惠套装</h5>
						<span></span>
					</div>

					<div class="meal">
						<div class="meal_one treat">
							<h5 class="taocan  ">优惠套餐1<span class="meal_money">￥3029.00</span>
								<span class="meal_money1">立省5元</span><img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more2.png" width="100%">
							</h5>
							<div class="treatment clearfix" style="display: none">
								<div class="tment_img">
									<img src="http://www.deyishop.com/Public/Wx/Images/meal1.jpg" width="100%">
								</div>
								<div class="add">
									<img src="http://www.deyishop.com/Public/Wx/Images/jia.jpg" width="28">
								</div>
								<div class="tment_img">
									<img src="http://www.deyishop.com/Public/Wx/Images/meal2.jpg" width="100%">
								</div>
							</div>
							<div class="meal_set" style="display: block;">
								<div class="meal_set_one clearfix">
									<div class="set_one_img">
										<img src="http://www.deyishop.com/Public/Wx/Images/meal1.jpg" width="100%">
									</div>
									<div class="set_one_txt">
										<h5>德意（DE&E）852E智能强排近吸式抽油烟 机(天然气) CXW-150-HJ852E</h5>
										<p>烟灶天然气套餐 烟机灶具</p>
									</div>
								</div>
								<div class="meal_set_one meal_set_one2 clearfix">
									<div class="set_one_img">
										<img src="http://www.deyishop.com/Public/Wx/Images/meal2.jpg" width="100%">
									</div>
									<div class="set_one_txt">
										<h5>德意（DE&E）852E智能强排近吸式 抽油烟机</h5>
										<p>烟灶天然气套餐 烟机灶具</p>
									</div>
								</div>
								<div class="add_cart"><a href="##">加入购物车</a></div>
							</div>
						</div>
						<div class="backg"></div>
						<div class="meal_one">
							<h5 class="taocan">优惠套餐2<span class="meal_money">￥3029.00</span>
								<span class="meal_money1">立省5元</span><img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more2.png" width="100%">
							</h5>
							<div class="treatment clearfix">
								<div class="tment_img">
									<img src="http://www.deyishop.com/Public/Wx/Images/meal3.jpg" width="100%">
								</div>
								<div class="add">
									<img src="http://www.deyishop.com/Public/Wx/Images/jia.jpg" width="28">
								</div>
								<div class="tment_img">
									<img src="http://www.deyishop.com/Public/Wx/Images/meal4.jpg" width="100%">
								</div>
							</div>
							<div class="meal_set">
								<div class="meal_set_one clearfix">
									<div class="set_one_img">
										<img src="http://www.deyishop.com/Public/Wx/Images/meal3.jpg" width="100%">
									</div>
									<div class="set_one_txt">
										<h5>德意（DE&E）852E智能强排近吸式抽油烟 机(天然气) CXW-150-HJ852E</h5>
										<p>烟灶天然气套餐 烟机灶具</p>
									</div>
								</div>
								<div class="meal_set_one meal_set_one2 clearfix">
									<div class="set_one_img">
										<img src="http://www.deyishop.com/Public/Wx/Images/meal4.jpg" width="100%">
									</div>
									<div class="set_one_txt">
										<h5>德意（DE&E）852E智能强排近吸式抽油烟 机(天然气) CXW-150-HJ852E</h5>
										<p>烟灶天然气套餐 烟机灶具</p>
									</div>
								</div>
								<div class="add_cart"><a href="##">加入购物车</a></div>
							</div>
						</div>

						<div class="backg"></div>

						<div class="meal_one">
							<h5 class="taocan">优惠套餐3<span class="meal_money">￥3029.00</span>
								<span class="meal_money1">立省5元</span><img class="pro_more" src="http://www.deyishop.com/Public/Wx/Images/pro_more2.png" width="100%">
							</h5>
							<div class="treatment clearfix">
								<div class="tment_img">
									<img src="http://www.deyishop.com/Public/Wx/Images/meal3.jpg" width="100%">
								</div>
								<div class="add">
									<img src="http://www.deyishop.com/Public/Wx/Images/jia.jpg" width="28">
								</div>
								<div class="tment_img">
									<img src="http://www.deyishop.com/Public/Wx/Images/meal5.jpg" width="100%">
								</div>
							</div>
							<div class="meal_set">
								<div class="meal_set_one clearfix">
									<div class="set_one_img">
										<img src="http://www.deyishop.com/Public/Wx/Images/meal3.jpg" width="100%">
									</div>
									<div class="set_one_txt">
										<h5>德意（DE&E）852E智能强排近吸式抽油烟 机(天然气) CXW-150-HJ852E</h5>
										<p>烟灶天然气套餐 烟机灶具</p>
									</div>
								</div>
								<div class="meal_set_one meal_set_one2 clearfix">
									<div class="set_one_img">
										<img src="http://www.deyishop.com/Public/Wx/Images/meal5.jpg" width="100%">
									</div>
									<div class="set_one_txt">
										<h5>德意（DE&E）852E智能强排近吸式抽油烟 机(天然气) CXW-150-HJ852E</h5>
										<p>烟灶天然气套餐 烟机灶具</p>
									</div>
								</div>
								<div class="add_cart"><a href="##">加入购物车</a></div>
							</div>

						</div>
					</div>

				</div>
			</div>

		</div>

		<div class="load_dh">
			<div class="load_dh_bg"></div>
			<div class="load8">

				<div class="load8-container load81">
					<div class="circle1"></div>
					<div class="circle2"></div>
					<div class="circle3"></div>
					<div class="circle4"></div>
				</div>

				<div class="load8-container load82">
					<div class="circle1"></div>
					<div class="circle2"></div>
					<div class="circle3"></div>
					<div class="circle4"></div>
				</div>

				<div class="load8-container load83">
					<div class="circle1"></div>
					<div class="circle2"></div>
					<div class="circle3"></div>
					<div class="circle4"></div>
				</div>

			</div>
		</div>

	</div>
	<!--  / warpper  -->

	<div class="pro_show_bg">

	</div>

	<div class="show_div show_jf">
		<div class="show_div_con">
			<h5>商城优惠券</h5>
			<div class="show_div_cons ">
				<div class="user3_list">
					<div class="user_r3_j1">
						<span class="jiaqian"><b>￥</b><i>100</i></span>
						<p>有效期 2017.08.29-2017.09.30</p>
						<div class="user_r3_j2">
							现金抵用券<br>
							<span>消费满2000元使用</span>
						</div>

					</div>

					<div class="user_r3_j3">
						领取
					</div>

				</div>

				<div class="user3_list">
					<div class="user_r3_j1">
						<span class="jiaqian"><b>￥</b><i>100</i></span>
						<p>有效期 2017.08.29-2017.09.30</p>
						<div class="user_r3_j2">
							现金抵用券<br>
							<span>消费满2000元使用</span>
						</div>

					</div>

					<div class="user_r3_j3">
						领取
					</div>

				</div>
				<div class="user3_list">
					<div class="user_r3_j1">
						<span class="jiaqian"><b>￥</b><i>100</i></span>
						<p>有效期 2017.08.29-2017.09.30</p>
						<div class="user_r3_j2">
							现金抵用券<br>
							<span>消费满2000元使用</span>
						</div>

					</div>

					<div class="user_r3_j3">
						领取
					</div>

				</div>

			</div>
		</div>
		<a href="##">完成</a>
	</div>

	<div class="show_div show_jifen">
		<div class="show_div_con">
			<h5>积分</h5>
			<div class="show_div_cons ">
				<div class="show_jjfens">
					<p><span>积分</span>购买可获得400积分</p>
				</div>
			</div>
		</div>
		<a href="##">完成</a>
	</div>

	<div class="show_div show_xz">
		<div class="show_div_con">
			<div class="show_xz_t clearfix">
				<img src="<?php echo ($goodsinfo["logo_pic"]); ?>" width="100">
				<h5 class="price">¥<?php echo ($goodsinfo["price"]); ?></h5>
				<p>库存<span class="kucun"><?php echo ($goodsinfo["stock"]); ?></span>件</p>
				<!-- <p><b>配送至：</b><span>西湖区</span><span>已选</span>天然气</p> -->
			</div>
			<div class="show_div_cons" style="margin-top:92px; height:258px;">

				<div class="show_xza">
					<h5>配送区域<span>(配送地可能会影响库存，请正确选择)</span></h5>
					<a href="/wx_address.html?id=<?php echo ($goodsinfo["id"]); ?>&type=1"><p><img src="http://www.deyishop.com/Public/Wx/Images/map1.png" width="15">
						<span><?php echo ($address["province"]); ?></span><span><?php echo ($address["city"]); ?></span><span><?php echo ($address["district"]); ?></span>
						<?php echo ($address["place"]); ?> <i class="fa fa-angle-right"></i></p></a>
					<!-- <span>19:00前付款，承诺11月20送到，可选送货时间</span> -->
				</div>
				<?php if(!empty($goodsinfo['is_sku'])): ?><div class="show_xzb">
						<?php if(is_array($sku_item)): $i = 0; $__LIST__ = $sku_item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><b><?php echo ($vo["classname"]); ?></b></br>
								<?php if(is_array($vo["subset"])): $k = 0; $__LIST__ = $vo["subset"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xo): $mod = ($k % 2 );++$k;?><span class="sku-item" data-id="<?php echo ($xo["skuid"]); ?>" data-pid="<?php echo ($vo["id"]); ?>"><?php echo ($xo["classname"]); ?></span>
										<input type="hidden" id="sku_<?php echo ($xo["skuid"]); ?>" class="sku_id" value=""><?php endforeach; endif; else: echo "" ;endif; ?>
							</p><?php endforeach; endif; else: echo "" ;endif; ?>
					</div><?php endif; ?>
				<div class="show_xzc">
					<h5>购买数量
						<span class="pro_jia">+</span><span class="pro_num">1</span><span class="pro_jian">-</span>
					</h5>
				</div>

			</div>
		</div>
		<div class="show_xzd clearfix">
			<a href="javascropt:volid(0);" onclick="ok_sku();" style="width:100%;">确定</a>
		</div>
	</div>

	<div class="pro_share_con">
		<div class="inner_con_tit">
			<h5 class="inner_con_tit">分享到</h5>
			<span></span>
		</div>
		<div class="pro_share_icon">
			<a href="##"><i class="fa fa-qq"></i></a>
			<a href="##"><i class="fa fa-weixin " style="background: #29b01c;"></i></a>
			<a href="##"><i class="fa fa-weibo" style="background: #ea5d5c;"></i></a>

		</div>

	</div>

	<div class="show_div show_fw">
		<div class="show_div_con">
			<h5>德意商城服务</h5>
			<div class="show_div_cons">
				<div class="show_fws">
					<p><img src="http://www.deyishop.com/Public/Wx/Images/pro_fw1.svg" width="20">德意唯一官方商城
						<span>德意承诺送货入户</span>
					</p>
					<p><img src="http://www.deyishop.com/Public/Wx/Images/pro_fw2.svg" width="20">全国联保
						<span>消费者购买带有“预约安装”标识的商品后，服务商将在签收商品后的24小时内主动联系消费者，预约提供上门安装的时间。</span>
					</p>
					<p><img src="http://www.deyishop.com/Public/Wx/Images/pro_fw3.svg" width="20">全场包邮
						<span>该商品由中国人保承保正品保证险</span>
					</p>
					<p><img src="http://www.deyishop.com/Public/Wx/Images/pro_fw4.svg" width="20">七天无理由退换
						<span>消费者在满足7天无理由退换货申请条件的前提下，可以提出“7天无理由退换货”的申请</span>
					</p>
				</div>
			</div>
		</div>
		<a href="##">完成</a>
	</div>
	<div class="show_div show_sh">
		<div class="show_div_con">
			<h5>德意售后保障</h5>
			<div class="show_div_cons">
				<div class="show_fws">
					<ul class="rowNormal">
						<li>
							<span class="">厨电产品5年包修 </span>
							<p>推出厨电产品五年质保，可靠的质量让您的使用更有保障，厨房生活，方太一路相随！</p>
							<p>吸油烟机、嵌入式灶具、嵌入式消毒柜、嵌入式微波炉、嵌入式电烤箱、嵌入式电蒸箱、热水器包修五年。</p>
						</li>
						<li>
							<span>免费预埋烟管服务</span>
							<p>产品未到，服务先行，在您购买的产品还未收到时，方太服务工程师上门勘察安装环境，免费预埋烟管，避免拆吊顶等引起高安装费用，并延长使用年限，减少安全隐患。</p>
							<p>用户在厨房吊顶之前，可电话预约方太全国服务热线或当地服务中心预埋烟管，在约定好的时间内会有专业人员上门来先把烟管预埋好，同时对烟道改动、安装位置、插座位置做出专业指导，后期随着其他工序再安装抽油烟机，从而免去消费者装修中可能出现返工之苦。此项服务在服务范围内是免费的。</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<a href="##">完成</a>
	</div>
	<div class="products_inner_btn clearfix">
		<a class="pro_innera1 pro_innera11" href="##"><img src="http://www.deyishop.com/Public/Wx/Images/pro_inner_kf.png" width="100%"></br>
			<span>客服</span></a>
		<?php if($sc == 1): ?><a onclick="sc();" class="pro_innera1 pro_innera11 pro_innera_s on" href="javascript:volid(0);"><img src="http://www.deyishop.com/Public/Wx/Images/pro_inner_sc.png" width="100%" class="img1"><img src="http://www.deyishop.com/Public/Wx/Images/pro_inner_sc1.png" width="100%" class="img2"></br>
			<span>收藏</span></a>
		<?php else: ?>
			<a onclick="sc();" class="pro_innera1 pro_innera11 pro_innera_s" href="javascript:volid(0);"><img src="http://www.deyishop.com/Public/Wx/Images/pro_inner_sc.png" width="100%" class="img1"><img src="http://www.deyishop.com/Public/Wx/Images/pro_inner_sc1.png" width="100%" class="img2"></br>
			<span>收藏</span></a><?php endif; ?>
		<a class="pro_innera1 pro_innera11" href="/wx_cart"><img src="http://www.deyishop.com/Public/Wx/Images/pro_inner_gw.png" width="100%"></br>
			<span>购物车</span></a>

		<a class="pro_innera3" onclick="addcar();">加入购物车</a>
		<a class="pro_innera2" href="/wx_buy.html">立即购买</a>
	</div>
	<input type="hidden" id="user_id" value="<?php echo ($user_id); ?>">
	<input type="hidden" id="goodsid" value=<?php echo ($goodsinfo['id']); ?>>
	<input type="hidden" id="is_sku" value="<?php echo ($goodsinfo["is_sku"]); ?>">
	<input type="hidden" id="skuid" value="">
</body>
<script>

$( document ).ready( function()
{

	var mySwiper = new Swiper( '.swiper1', {
		pagination: '.pagination_gr',
		loop: true,
		autoplay: 3000,
		spaceBetween: 0,
		paginationClickable: true,
	} )

	//	     1优惠卷
	$( '.pro_show_bg' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeOut( 300 );
		$( '.pro_share_con' ).stop( true, true ).fadeOut( 300 );

		$( '.show_div' ).stop( true, true ).animate( { bottom: "-425px" }, 500 );
		$( 'body' ).removeClass( 'body_on' );
	} )
	$( '.pro_share' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.pro_share_con' ).stop( true, true ).fadeIn( 300 );
	} )
	$( '.show_div>a' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeOut( 300 );
		$( '.show_div' ).stop( true, true ).animate( { bottom: "-425px" }, 500 );
		$( 'body' ).removeClass( 'body_on' );
	} )
	$( '.products_inner_jf1' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_jf' ).stop( true, true ).animate( { bottom: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );
	} )

	$( '.products_inner_zi2' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_xz' ).stop( true, true ).animate( { bottom: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );
	} )

	$( '.pro_inner_cs1 h5' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_cs1' ).stop( true, true ).animate( { bottom: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );
	} )

	$( '.insurance' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_fw' ).stop( true, true ).animate( { bottom: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );
	} )

	$( '.products_inner_jf3' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_sh' ).stop( true, true ).animate( { bottom: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );
	} )

	$( '.show_xzb p span' ).click( function()
	{
		$( this ).parent().find( 'span' ).removeClass( 'show_xzb_on' );
		$( this ).addClass( 'show_xzb_on' );
	} )
	$( '.products_inner_jf2' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_jifen' ).stop( true, true ).animate( { bottom: "0" }, 500 );
		$( 'body' ).addClass( 'body_on' );
	} )

	var sco = $( ".proinner_nav" ).offset().top;

	$( '.proinner_nav a' ).click( function()
	{
		var s7 = $( this ).index();
		$( '.proinner_nav a' ).removeClass( 'proinner_nav_on' );
		$( this ).addClass( 'proinner_nav_on' );

		$( '.products_inner_con' ).stop( true ).fadeOut( 0 );
		$( '.products_inner_con' ).eq( s7 ).stop( true ).fadeIn( 300 );
		$( "html,body" ).animate( { scrollTop: sco - 40 }, 1000 )
	} )

	$( ".pro_innera_s" ).click( function()
	{
		var _this = $( this )
		if( _this.hasClass( "on" ) )
		{
			_this.removeClass( "on" )
		}
		else
		{
			_this.addClass( "on" )
		}
	} )

	$( window ).scroll( function()
	{

		if( $( window ).scrollTop() > sco )
		{
			$( ".proinner_nav" ).addClass( "proinn_fix" )

		}
		else
		{
			$( ".proinner_nav" ).removeClass( "proinn_fix" )
		}

	} )

	$( ".screening_yy ul li " ).click( function()
	{
		$( ".screening_yy ul li" ).removeClass();
		$( this ).addClass( "bord_li" );

	} )

	$( '.meal_one' ).click( function()
	{

		if( $( this ).hasClass( "treat" ) )
		{

			$( ".meal_one" ).removeClass( "treat" )
			$( ".meal_set" ).stop( true ).slideUp( 500 )
			$( ".treatment" ).stop( true ).slideDown( 500 )

		}
		else
		{
			$( ".meal_one" ).removeClass( "treat" )
			$( this ).addClass( "treat" );

			$( ".meal_set" ).stop( true ).slideUp( 500 )
			$( this ).find( ".meal_set" ).stop( true ).slideDown( 500 )
			$( ".treatment" ).stop( true ).slideDown( 500 )
			$( this ).find( ".treatment" ).stop( true ).slideUp( 500 )

		}

	} )

} )

</script>
<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/Goods/detail.js"></script>
<script>
var sku_id = 0;
    <?php if(!empty($goodsinfo['is_sku'])): if(!empty($sku_data)): ?>// alert(111);
        (function (){
            var discount = 1;
            var sku = <?php echo ($sku_data); ?>;                                      //当前商品的全部SKU数列
            $(".sku-item").click(function (){                        //触发
            	// alert(111);
                setTimeout(function(){                                  //
                    var keys = getSkuKey();                              //获取sku key值

                    var data = sku[keys];
                    if(data){
  
                        $(".price").html("¥"+data['price']);              //打折是在现价的基础上打折
                        $(".kucun").html(data['stock']);




                        sku_id = data['id'];
                    }else{
                        $(".kucun").html(0);
                        sku_id = 0;
                    }
                }, 0)
            })

            function getSkuKey(){
                var arr = [];
                $(".show_xzb_on").each(function (i){
                    arr.push($(this).attr('data-id'))
                })
                arr.sort(function (a, b){
                    return a-b;
                })
                return "-"+arr.join("-")+"-";
            }

            Array.prototype.zyffliter = function (str){
                var arr = [];
                for(var i=0;i<this.length;i++){
                    if(this[i] != str){
                        arr.push(this[i])
                    }
                }
                return arr;
            }

        }())<?php endif; endif; ?>
</script>
<script>
</script>
</html>