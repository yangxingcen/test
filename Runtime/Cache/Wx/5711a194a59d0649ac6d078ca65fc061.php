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
</body>
</html>
	<!--  / warpper  -->
	<div class="warpper" style=" background: #f5f5f9;">
		<div class="integral">
			<a href="javascript:history.go(-1)">
				<div class="screening_btn1">
					<span></span>
				</div>
			</a>
			<div class="tegral">购物车</div>
			<div class="collect_zt_btn1">编辑</div>
		</div>

		<div class="collect on" style="margin-top: 0%">
			<div class="collect_cont">
				<input name="user_id" id="user_id" type="hidden" value="<?php echo ($user_id); ?>">
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="collect_con clearfix" data-id="<?php echo ($val["id"]); ?>">
					<span class="uesr_check"></span>
					<div class="img"><a href="/wx_detail.html?id=<?php echo ($val["goods_id"]); ?>"><img src="<?php echo ($val["goodsinfo"]["logo_pic"]); ?>" width="100%"></a></div>
					<div class="collect_text">
						<div class="collect_text_con">
							<a href="##">
								<div class="title"><?php echo ($val["goodsinfo"]["goods_name"]); ?></div>
								<div class="tit"><?php echo ($val["goodsinfo"]["goods_des"]); ?></div>
							</a>
							<div class="text1"><?php echo ($val["goodsinfo"]["goods_ser"]); ?></div>
							<div class="price">
								<div class="num">￥<span><?php echo ($val["goodsinfo"]["price"]); ?></span> <p class="sh">￥<?php echo ($val["goodsinfo"]["oprice"]); ?></p></div>
								<div class="tx1">x<?php echo ($val["num"]); ?></div>
							</div>

							<div class="shop_con clearfix">
								<div class="left">
									<div class="shop_num clearfix">
										<span class="j"></span>
										<input type="text" class="goods_num" id="goods_num" value="<?php echo ($val["num"]); ?>">
										<input type="hidden" class = "goods_stock" id="goods_stock" value="<?php echo ($val["goods_stock"]); ?>">
										<span class="a"></span>
									</div>
									<div class="shop_text">￥<?php echo ($val["goodsinfo"]["price"]); ?></div>
									<div class="shop_tx" data-goodsid="<?php echo ($val["goods_id"]); ?>" data-type="<?php echo ($vl["goodsinfo"]["type"]); ?>"><?php echo ($val["goodsinfo"]["goods_name"]); ?><i class="fa fa-angle-down"></i></div>
								</div>
								<div class="center" data-id="<?php echo ($val["goods_id"]); ?>" data-type="<?php echo ($val["type"]); ?>">
									<div class="collection" data-id="<?php echo ($val["goods_id"]); ?>" data-type="<?php echo ($val["type"]); ?>"><?php if(!empty($val["rrr"])): ?>移除收藏夹<?php else: ?>移至收藏夹<?php endif; ?></div>
								</div>
								<div class="right shopcar_close" data-id="<?php echo ($val["id"]); ?>"><div>删除</div></div>
							</div>
						</div>

					</div>
					<!--<div class="collect_con_bg"></div>-->
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		
		</div>

	</div>

	<div class="pro_show_bg"></div>

	<div class="show_div show_xz">
		<!--<div class="show_div_con">-->
			<!--<div class="show_xz_t clearfix">-->
				<!--<img src="http://www.deyishop.com/Public/Wx/Images/order_pro2.jpg" width="100">-->
				<!--<h5>¥4000.00</h5>-->
				<!--<p>库存<span>30</span>件</p>-->
				<!--<p><b>配送至：</b><span>西湖区</span><span>已选</span>天然气</p>-->
			<!--</div>-->
			<!--<div class="show_div_cons" style="margin-top:92px; height:258px;">-->

				<!--<div class="show_xza">-->
					<!--<h5>配送区域<span>(配送地可能会影响库存，请正确选择)</span></h5>-->
					<!--<p><img src="http://www.deyishop.com/Public/Wx/Images/map1.png" width="15"> <span>浙江省</span><span>杭州市</span><span>西湖区</span>-->
						<!--文三路 <i class="fa fa-angle-right"></i></p>-->
					<!--<span>19:00前付款，承诺11月20送到，可选送货时间</span>-->
				<!--</div>-->
				<!--<div class="show_xzb">-->
					<!--<p><b>颜色分类</b></br>-->
						<!--<span class="show_xzb_on">不锈钢色</span>-->
					<!--</p>-->
					<!--<p><b>系列</b></br>-->
						<!--<span class="show_xzb_on">852E单烟机</span><span>825E+715B烟灶套装（天然气）</span><span>825E+715B烟灶套装（天然气） </span>-->
					<!--</p>-->

					<!--<div class="value">增值服务</div>-->
					<!--<p class="value_p"><img src="http://www.deyishop.com/Public/Wx/Images/safe.png" width="100%" class="safety"> <b>全面保障</b>-->
						<!--<i class="accident">无理由保修3年含性能/意外保障</i>  </br>-->
						<!--<span class="show_xzb_on">全保修三年 <i class="i_line"></i> ￥ 144.11 <i class="i_you">已省￥27</i> </span><span>全保修五年</span>-->
					<!--</p>-->
					<!--<p><img src="http://www.deyishop.com/Public/Wx/Images/safe2.png" width="100%" class="safety"> <b>厂保延长</b>   </br>-->
						<!--<span class="">延长保2年<i class="i_line"></i> ￥ 129.00</span><span>延长保3年<i class="i_line"></i> ￥ 299.00</span>-->
					<!--</p>-->
					<!--<p class="value_p"><img src="http://www.deyishop.com/Public/Wx/Images/safe3.png" width="100%" class="safety"> <b>意外保护</b></br>-->
						<!--<span class="">意外保2年 <i class="i_line"></i> ￥ 49.00 <i class="i_you">已省￥20</i></span><span>意外保3年<i class="i_line"></i> ￥ 55.00</span>-->
					<!--</p>-->
				<!--</div>-->

				<!--<div class="show_xzc">-->
					<!--<h5>购买数量-->
						<!--<span class="pro_jia">+</span><span class="pro_num">1</span><span class="pro_jian">-</span>-->
					<!--</h5>-->
				<!--</div>-->

			<!--</div>-->
		<!--</div>-->
		<!--<div class="show_xzd clearfix">-->
			<!--<a href="##" style="width:100%;">确定</a>-->
		<!--</div>-->

	</div>

	<div class="user_order_list_btn clearfix" style="bottom: 59px;display:block;border-bottom: 1px solid #e9e9e9;">
		<div class="user_order_list_btn_left"><span class="uesr_check"></span>全选</div>
		<a href="javascript:void(0);" id="nowbuy">结算</a>
		<div class="num">合计：<span>￥<?php echo ($price); ?></span></div>
	</div>
	<form id="buy" action="<?php echo U('Wx/Order/buy');?>" method="post">
		<input type="hidden" name="cart_ids">
	</form>
	<!--  / warpper  -->

</body>
<script src="http://www.deyishop.com/Public/Wx/Js/alert.js"></script>
<script>
    $('#nowbuy').click(function(){
    <?php if(empty($data)): ?>dialog.showTips('购物车内暂无商品','warn');
        return false;<?php endif; ?>

        if($('.collect_cont .on').length==0){
            dialog.showTips('请选择要购买的商品','warn');
            //alert('请选择要购买的商品');
            return false;
        }

        var str='-';
        $(".collect_cont .on").each(function(){
            str = str + $(this).attr('data-id') + '-';
        });
        $("#buy input").val(str);
        $("body").css('overflow',"hidden");
        $('.index_show').stop(true).fadeIn(1000)
        $("#buy").submit();
    })
$( document ).ready( function()
{
    $( ".pro_jia" ).click( function()
    {
        var no = $('.pro_num').html();
        var store = $(".kucun").html();
        no++
        if(no > store) {
            var no = store;
        }
        $( this ).parents().find( ".pro_num" ).html( no )

    } )
    $( ".pro_jian" ).click( function()
    {
        var no = $('.pro_num').html();
        var store = $(".kucun").html();
        if( no >= 2 )
        {
            no--;
        }
        $( this ).parents().find( ".pro_num" ).html( no )

    } )
    $( ".a" ).click( function()
    {
        console.log($(this));
        var no = $( this ).parents().find( ".goods_num" ).val();
        var store = $( this ).parents().find( ".goods_stock" ).val();
        no++
        if(no > store) {
            var no = store;
        }
        $( this ).parents().find( ".goods_num" ).val( no )

    } )
    $( ".j" ).click( function()
    {
        var no = $( this ).parents().find( ".goods_num" ).val();
        var store = $( this ).parents().find( ".goods_stock" ).val();
        if( no >= 2 )
        {
            no--;
        }
        $( this ).parents().find( ".goods_num" ).val( no )

    } )
    $(document).on('blur', '.pro_num', function() {
        var num = $( this ).parents().find( ".goods_num" ).val();
        var store = $( this ).parents().find( ".goods_stock" ).val();
        var re =  /^([1-9][0-9]*)$/;
        if(!re.test(num)){
            num = '1';
        }
        if(num.length > store.length) {
            num = store;
        }
        if(num > store) {
            num = store;
        }
        $( this ).parents().find( ".goods_num" ).val(num);

    })
	$( ".collect_zt_btn1" ).click( function()
	{
		if($(".collect" ).hasClass("on2")){
			$(".collect,.collect_con" ).removeClass("on2")
			$( ".collect_zt_btn1" ).text("编辑")
		}else{
			$(".collect" ).addClass("on2")
			$( ".collect_zt_btn1" ).text("完成")
		}
	} )

	$(".uesr_check" ).click(function(){
		var _this=$(this ).parents(".collect_con")
		if(_this.hasClass("on")){
			_this.removeClass("on")
			_this.siblings(".collect_top").removeClass("on")

		}else{
			_this.addClass("on")
		}

	})
	

	$(".user_order_list_btn_left" ).click(function(){
		var _this=$(this )
		if(_this.hasClass("on")){
			_this.removeClass("on")
			$(".collect_con").removeClass("on")

		}else{
			_this.addClass("on")
			$(".collect_con").addClass("on")
		}

	})

	$( '.shop_tx' ).click( function()
	{

        var goods_id = $(this).attr('data-goodsid');
        var type = $(this).attr('data-type');
        $.ajax({
            url:"Wx/Goods/detailById",
            type:'post',
            data:{'id':goods_id, 'type':type},
            datatyp:'json',
            cache:false,
            success:function(ret){
                if(ret.status==1) {
					var html= '';
                    html += '<div class="show_div_con">';
                    html += '<div class="show_xz_t clearfix">';
                    html += '<img src="'+ret.goodsInfo.logo_pic+'" width="100">';
                    html += '<h5>¥'+ret.goodsInfo.price+'</h5>';
                    html += '<p>库存<span>'+ret.goodsInfo.stock+'</span>件</p>';
                    html += '</div>';
                    html += '<div class="show_div_cons" style="margin-top:92px; height:258px;">';
                    html += '<div class="show_xza">';
                    html += '<h5>配送区域<span>(配送地可能会影响库存，请正确选择)</span></h5>';
                    html += '<a href="/wx_address.html?id="'+ret.goodsInfo.id+'"&type=1"><p><img src="http://www.deyishop.com/Public/Wx/Images/map1.png" width="15">';
                    if(ret.address != null){
                        html += '<span>'+ret.address.province+'</span><span>'+ret.address.city+'</span><span>'+ret.address.district+'</span>';
                        html +=  ret.address.place;
					}
                    html += '<i class="fa fa-angle-right"></i></p>';
                    html += '</a>';
                    html += '</div>';
					if(ret.goodsInfo.is_sku != ''){
                        html += '<div class="show_xzb">';
                        for (var i = ret.sku_item.length - 1; i >= 0; i--) {
                            html += '<p>';
                            html += '<b>'+ret.sku_item[i]['classname']+'</b></br>';
                            for(var ii = ret.sku_item[i]['subset'].length - 1; ii >= 0; ii--) {
                                html += '<span class="sku-item" data-id="'+ret.sku_item[i]['subset'][ii]['skuid']+'" data-pid="'+ret.sku_item[i]['skuid']+'">'+ret.sku_item[i]['subset'][ii]['classname']+'</span>';
                                html += '<input type="hidden" id="sku_"'+ret.sku_item[i]['subset'][ii]['skuid']+'" class="sku_id" value="">';
							}
							//html='</p>';
                        }
                        html += '</div>';
					}
                    html += '<div class="show_xzc">';
                    html += '<h5>购买数量';
                    html += '<span class="pro_jia">+</span><span class="pro_num">1</span><span class="pro_jian">-</span>';
                    html += '</h5>';
                    html += '</div>';
                    html += '<div class="show_xzd clearfix">';
                    html += '<a href="##" style="width:100%;">确定</a>';
                    html += '</div>';
                    $(".show_div").html(html);
                }
            }
        });
		$( '.pro_show_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.show_xz' ).stop( true, true ).animate( { bottom: "0" }, 500 );
	} )

    $( '.show_xzb p span' ).click( function()
    {
        $( this ).parent().find( 'span' ).removeClass( 'show_xzb_on' );
        $( this ).addClass( 'show_xzb_on' );
    } )

	$( '.pro_show_bg' ).click( function()
	{
		$( '.pro_show_bg' ).stop( true, true ).fadeOut( 300 );
		$( '.show_div' ).stop( true, true ).animate( { bottom: "-425px" }, 500 );
	} )
} )

/*删除购物车中一个商品*/
$(".shopcar_close").click(function (){
    var that = $(this);
    var id   = that.attr("data-id");
    dialog.showTips('是否删除？','firm',function (){
        $.ajax({
            url:"Wx/Order/delCart",
            type:'post',
            data:{'id':id},
            datatyp:'json'
        }).done(function(g){
            if(g.status==1){
                that.parent().parent().parent().parent().remove();
                $('.wap_tanc').stop(true).fadeOut(600);
                $('.wap_tanc_con').stop(true).fadeOut(600);
            }
        })
    });
})


/*添加收藏 mtf*/
$('.collection').click(function() {
    var that = $(this);
    var goods_id=that.attr("data-id");
    //var cnums=parseInt($('#c_nums').html());
    var isactivity=that.attr("data-type");
    var user_id = $('#user_id').val();
    if(user_id) {
        $.ajax({
            url:"/Wx/Goods/addcollect",
            type:'post',
            data:{'goodsid':goods_id, 'isactivity':isactivity},
            dataType:'json',
            cache:false,
            success:function(ret){
                if(ret['status']==1)
                {
                    //$('#c_nums').html(cnums+1);      //收藏成功
                    ///$(".collection").addClass("pro_scon");
                    $(".collection").html('移除收藏夹');
                    alert('移动至收藏夹成功！');
                    //alert(ret['info']);
                }else{
                    //$('#c_nums').html(cnums-1);     //取消收藏
                   //$(".collection").removeClass("pro_scon");
                    $(".collection").html('移至收藏夹');
                    alert('收藏夹移除成功！');
                    //alert(ret['info']);
                }
            }
        })

    } else {
        window.location.href="/login.html";
    }
})
</script>
</html>