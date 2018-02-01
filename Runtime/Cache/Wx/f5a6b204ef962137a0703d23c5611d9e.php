<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no" />

<title>德意微商城</title>
<meta name="keywords" content=" " />
<meta name="description" content=" " />

	<link rel="shortcut icon" href="http://www.deyishop.com/Public/Wx/Images/logo.ico"/>


<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/bootstrap.css">
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery-1.11.1.min.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/bootstrap.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery-ui.min.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/easing.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/index.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/main.js"></script>
	<script type="text/javascript"  src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery-1.9.1.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/swiper-3.4.1.min.css">
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/swiper-3.4.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/style.css">
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/common.css">
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/font-awesome.css">

<!-- <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/swiper.css">
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/swiper.min.js"></script> -->


</head>



<!--外-->
<script type="text/javascript">
    var _htmlFontSize = (function () {
        var clientWidth = document.documentElement ? document.documentElement.clientWidth : document.body.clientWidth;
        if (clientWidth > 640) clientWidth = 640;
        document.documentElement.style.fontSize = clientWidth * 1 / 16 + "px";
        return clientWidth * 1 / 16;
    })();
</script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/base.min.css"/>



<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery.eraser.js"></script>
<!--外-->

<body >

<div class="header list_header">


	德意刮刮乐
	<a href="javascript:history.go(-1);" class="header_but"><img src="http://www.deyishop.com/Public/Wx/Images/l_left.png" width="100%"></a>

</div>
<!--  / header  -->
<div class="banner">





	<img src="http://www.deyishop.com/Public/Wx/Images/banner.png" width="100%">


	<div class="banner_txt">



	</div>
	<div class="banner_txt">

		<span>您今天还有<?php echo ($jinri); ?>次机会，<?php echo ($yr["integral"]); ?>积分一次</span>


	</div>

</div>
<!--  / header  -->

<div class="warpper">


	<div class="box">

		<div class="content">
			<div id="mask_img_bg" style="font-size: 1rem;color: #ff5b3f"><span class="cont-span"></span>

			</div>
			<img id="redux" src="http://www.deyishop.com/Public/Wx/Images/layer.png"/>
		</div>

	</div>


	<div id="bg1"></div>
	<div id="show" style="position:absolute;" align="center">
		<img id="show_img" src="http://www.deyishop.com/Public/Wx/Images/dialog_bg.png" width="100%" height="100%">
		<div style="margin-top:-145px;margin-left:40px;padding-right: 40px;line-height:1.5;color:#000000;font-size: 17px;font-family: '黑体'" >
			亲，您今天的机会已经用完了~明天再接再励！
		</div>
		<img id="show_btn" src="http://www.deyishop.com/Public/Wx/Images/btn_sure.png" style="margin-top: 30px;" onclick="hidediv()">
	</div>




	<div class="agin_o" >
		<a href=""style="margin-top: 10px"><img src="http://www.deyishop.com/Public/Wx/Images/btnn.png" width="100%"> </a>
	</div>
	<div class="zhong_list">
		<h5>中奖名单</h5>
		<div class="bggg">
			<img src="http://www.deyishop.com/Public/Wx/Images/bggg.png" width="100%">
		</div>
		<div class="index_zx_con_lbox">

			<ul class="clearfix">
				<li>


					<?php if(is_array($zhongj_all)): foreach($zhongj_all as $key=>$v): ?><div class="jfdh_con clearfix">

						<div class="left"><?php echo ($v["telephone"]); ?> </div>
						<div class="center"><?php echo ($v["person_name"]); ?></div>
						<div class="right"><?php echo ($v["goods_name"]); ?></div>

					</div><?php endforeach; endif; ?>

				</li>

			</ul>


		</div>

	</div><notempty>
	<div class="prizes">


		<h5>我的奖品</h5>
		<?php if(is_array($zhongj)): foreach($zhongj as $key=>$v): ?><div class="prizes_1 clearfix">
			<p>恭喜您获得<?php echo ($v["goods_name"]); ?> </p>
		</div><?php endforeach; endif; ?>
	</div>

</notempty>
	<div class="rules">
		<h5>活动规则</h5>

		<textarea style="width: 100%;min-height: 80px;max-height:180px;resize: none;background-color: #ffe3c2;border-color: #ffe3c2;"><?php echo ($yr["describe"]); ?></textarea>


	</div>

</div>
<div class="hint-show">
	<img class="hint-img" src="http://www.deyishop.com/Public/Wx/Images/hint.png">
	<img class="colour-img" src="http://www.deyishop.com/Public/Wx/Images/colour.png">
	<!--<img class="prize-img"/>-->
	<span class="prize-span"></span>
	<h1 class="prize-span_h1" style="display: none"></h1>
	<a class="close"></a>
	<a href="javascript:;" class="btn" id="url_jie"></a>
	<!--<a class="btn close"></a>-->
</div>

<div style="display: none" id="name_name"><?php if(is_array($list_datad)): foreach($list_datad as $i=>$v): switch($v["type"]): case "1": echo ($v['param']); ?>元优惠券<?php break;?>
	<?php case "2": echo ($v['param']); ?>积分<?php break;?>
	<?php case "3": echo (mb_substr($v['yui']['goods_name'],0,6,'utf-8')); break;?>
	<?php case "4": echo ($v['param']); break; endswitch; if($v['yu'] != count($list_datad)): ?>,<?php endif; endforeach; endif; ?></div>



<input id="jiang_id" value="" hidden >

</body>
<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">

<script>

    $(document).ready(function(){

    })
</script>

<script>
    /*******中奖名单**********/

    $( document ).ready( function()
    {
        var y1 = $( '.index_zx_con_lbox>ul>li' ).size();
        var x1 = $( '.index_zx_con_lbox>ul>li' ).height() ;
        var play = 0;
        var x = 0;
        var d = 0;

        function gundong()
        {
            if( y1 > 1 )
            {

                play = setInterval( function()
                {
                    if( x > x1 )
                    {
                        x = 0;
                        $( '.index_zx_con_lbox>ul' ).find( 'li:first-child' ).appendTo( $( '.index_zx_con_lbox>ul' ) );
                        $( '.index_zx_con_lbox>ul' ).css( { marginTop: 0 } );
                        $( '.index_zx_con_lbox>ul' ).stop( true, true ).animate( { marginTop: -x }, 0, 'linear' );
                    }
                    else
                    {
                        $( '.index_zx_con_lbox>ul' ).stop( true, true ).animate( { marginTop: -x }, 1, 'linear' );
                        x++;
                    }
                }, 40 );
            }
        }

        gundong();

    } )

    /*******中奖名单**********/
</script>

<script type="text/javascript">
    var thanks;
    $(window).load(function () {
        //动态添加大转盘的奖品与奖品区域背景颜色
        var html= $("#name_name").html();
        ss =html.split(",");// 在每个逗号(,)处进行分解。

        var imgarr = ss;
        var clickNum = 10;
        if(clickNum>=1){

            $('.clicknum').text(clickNum);
            $('#redux').eraser({

                size: 50,   //设置橡皮擦大小
                completeRatio: .7, //设置擦除面积比例
                completeFunction: showResetButton   //大于擦除面积比例触发函数
            });
			/*获取随机数*/
            $.ajax({
                type:"POST",
                url:"/Wx/Games/guaguale_chou.html",
                data:'id='+1,
                cache:false,
                async:false,
                dataType:"json",
                beforeSend:function(){

                },
                success:function(data){
                    if(data.status=="success"){
                        var info =data.jiang_id;
						/*通过判断设置出现概率*/
                        if(info){

                            arrinfo = imgarr[info];
                            thanks = true;
                        }
                        $("#mask_img_bg>span").text(arrinfo);
                        $("#jiang_id").val(info);

                        $(" .hint-show .close,.main_box .hint-show .btn").click(function () {
                            $(".hint-show,.main_box .mask").fadeOut(300);
                        });
                    }
                },
                error: function(){

                }
            })



        }else {
            alert("123")
        }

   	 })

    function showResetButton() {

var idd=  $("#jiang_id").val();
       var d= ajax_into(idd);

    }

    //插入数据库id
	function ajax_into(jiang_id) {

        $.ajax({
            type:"POST",
            url:"/Wx/Games/guaguale_chou.html",
            data:{
                id			:2,
                jiang_id	:jiang_id,
			},
            cache:false,
            async:false,
            dataType:"json",
            beforeSend:function(){

            },
            success:function(data){

               		if(data.status=='success'){
                        $(".prize-span").text(arrinfo);
                        if (thanks == true) {
                            $(".hint-show,.main_box .mask").fadeIn(300)
                        }

                        if(data.case_status==3){
                            	$("#url_jie").attr("href","/Wx/Games/infor/id/"+data.id);
						}

					}
               		if(data.status=='error_er'){
                        alert(data.html);
                        return false;
					}
               		if(data.status=='error'){

                          alert(data.html);
							return false;
					}


            },
            error: function(){

            }
        })

    }
</script>
</html>