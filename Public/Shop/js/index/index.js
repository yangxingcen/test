/*首页收藏*/
$('.collection1').click(function() {
    var goods_id=$('#goods_id1').val();
    var isactivity=$('#isactivity').val();
    var user_id = $('#user_id').val();
    var img_url = $('#img_url').val();
    if(user_id) {
        $.ajax({
            url:"/Shop/Goods/addcollect",
            type:'post',
            data:{'goods_id':goods_id, 'isactivity':isactivity},
            dataType:'json',
            cache:false,
            success:function(ret){
                if(ret['status']==1)
                {
                    //收藏成功
                    $(".collection1").css("background-image", 'url('+img_url+'/love2.png)');
                    //alert(ret['info']);
                }else{
                    //取消收藏
                    $(".collection1").css("background-image", 'url('+img_url+'/love3.png)');
                    //alert(ret['info']);
                }
            }
        })

    } else {
        window.location.href="/login.html";
    }
})

$('.collection2').click(function() {
    var goods_id=$('#goods_id2').val();
    var isactivity=$('#isactivity').val();
    var user_id = $('#user_id').val();
    var img_url = $('#img_url').val();
    console.log(goods_id);
    console.log(user_id);
    if(user_id) {
        $.ajax({
            url:"/Shop/Goods/addcollect",
            type:'post',
            data:{'goods_id':goods_id, 'isactivity':isactivity},
            dataType:'json',
            cache:false,
            success:function(ret){
                if(ret['status']==1)
                {
                    $(".collection2").css("background-image", 'url('+img_url+'/love2.png)');
                }else{
                    //取消收藏
                    $(".collection2").css("background-image", 'url('+img_url+'/love3.png)');
                }
            }
        })

    } else {
        window.location.href="/login.html";
    }
})

$('.collection3').click(function() {
    var goods_id=$('#goods_id3').val();
    var isactivity=$('#isactivity').val();
    var user_id = $('#user_id').val();
    var img_url = $('#img_url').val();
    console.log(goods_id);
    console.log(user_id);
    if(user_id) {
        $.ajax({
            url:"/Shop/Goods/addcollect",
            type:'post',
            data:{'goods_id':goods_id, 'isactivity':isactivity},
            dataType:'json',
            cache:false,
            success:function(ret){
                if(ret['status']==1)
                {
                    //收藏成功
                    $(".collection3").css("background-image", 'url('+img_url+'/love2.png)');
                    //alert(ret['info']);
                }else{
                    //取消收藏
                    $(".collection3").css("background-image", 'url('+img_url+'/love3.png)');
                    //alert(ret['info']);
                }
            }
        })

    } else {
        window.location.href="/login.html";
    }
})

$('.collection4').click(function() {
    var goods_id=$('#goods_id4').val();
    var isactivity=$('#isactivity').val();
    var user_id = $('#user_id').val();
    var img_url = $('#img_url').val();
    console.log(goods_id);
    console.log(user_id);
    if(user_id) {
        $.ajax({
            url:"/Shop/Goods/addcollect",
            type:'post',
            data:{'goods_id':goods_id, 'isactivity':isactivity},
            dataType:'json',
            cache:false,
            success:function(ret){
                if(ret['status']==1)
                {
                    //收藏成功
                    $(".collection4").css("background-image", 'url('+img_url+'/love2.png)');
                    //alert(ret['info']);
                }else{
                    //取消收藏
                    $(".collection4").css("background-image", 'url('+img_url+'/love3.png)');
                    //alert(ret['info']);
                }
            }
        })

    } else {
        window.location.href="/login.html";
    }
})

$( ".closer_y" ).click( function()
{

    $( ".home_sec1" ).animate( { height: "0" } );
} )

$( document ).ready( function()
{
    $( ".swiper_shu,.swiper_shu2,.swiper_shu3,.swiper_shu4,.swiper_shu_img" ).height( 200 );
    $( ".banner_left" ).css( "left", $( ".container" ).offset().left + 15 )
    $( ".banner_right" ).css( "right", $( ".container" ).offset().left + 15 )
    $( ".swiper1" ).height( 480 )
    $( ".home_sec2_right" ).height( $( ".home_sec2_left" ).width() * 441 / 926 )
    $( ".home_sec2_con_left" ).height( $( ".home_sec2_img" ).width() * 193 / 271 + $( ".home_sec2_text" ).outerHeight() )
    $( ".swiper2,.swiper3,.swiper4" ).height( $( ".home_sec4_img" ).width() * 300 / 393 )
    //	$( ".home_sec6_con" ).height( $( ".home_sec6_left" ).width() * 720 / 800 / 2 -2 )

    var home_se6h = $( ".home_sec6_con" ).width() * 0.75 * 400 / 500 + 110
    $( ".home_sec6_left_timg" ).height( home_se6h * 2 + 45 );
    $( ".hot_pro" ).height( $( ".home_sec6_left_timg" ).height() - 2 );
    $( ".home_sec6_con_img" ).height( $( ".home_sec6_con" ).width() * 0.75 * 400 / 500 )

    $( ".home_sec7_con" ).height( $( ".home_sec7_right" ).width() * 720 / 800 / 2 - 1 )
    $( ".home_sec7_con .img" ).outerHeight( $( ".home_sec7_con" ).height() * 0.9 - $( ".home_sec7_tx" ).height() - $( ".home_sec7_con .num" ).height() )

    //var hei = $( ".pro_b_a1" ).width() * 560 / 800 + 84
    var hei = $( ".pro_b_a1" ).width() * 680 / 750 + 94


    console.log(hei);
    $( ".ference_img" ).height( hei * 2 )

    $( window ).load( function()
    {

    } )
    $( window ).resize( function()
    {
        $( ".banner_left" ).css( "left", $( ".container" ).offset().left + 15 )
        $( ".banner_right" ).css( "right", $( ".container" ).offset().left + 15 )
        $( ".swiper1" ).height( $( ".banner_img" ).width() * 520 / 1400 )
        $( ".home_sec2_right" ).height( $( ".home_sec2_left" ).width() * 441 / 926 )
        $( ".home_sec2_con_left" ).height( $( ".home_sec2_img" ).width() * 193 / 271 + $( ".home_sec2_text" ).outerHeight() )
        $( ".swiper2,.swiper3,.swiper4" ).height( $( ".home_sec4_img" ).width() * 300 / 393 )
        //	$( ".home_sec6_con" ).height( $( ".home_sec6_left" ).width() * 720 / 800 / 2  -2)

        //$( ".home_sec7_con" ).height( $( ".home_sec7_right" ).width() * 692 / 800 / 2 -1 )
        $( ".home_sec6_left_timg" ).height( home_se6h * 2 + 45 );
        $( ".hot_pro" ).height( $( ".home_sec6_left_timg" ).height() - 2 );

        $( ".home_sec6_con_img" ).height( $( ".home_sec6_con" ).width() * 0.75 * 400 / 500 )
        //var hei = $( ".pro_b_a1" ).width() * 560 / 800 + 84
        var hei = $( ".pro_b_a1" ).width() * 680 / 750 + 94
        $( ".ference_img" ).height( hei * 2 )
    } )
    $( window ).scroll( function()
    {
        var lm = $( ".left_menu_list li" ).size();
        if( ($( window ).scrollTop() > $( ".home_sec6" ).offset().top - 500) && ($( window ).scrollTop() < $( ".in_news" ).offset().top - 500) )
        {
            $( ".left_menu" ).stop( true ).fadeIn( 500 );
            //			$(".left_menu_list li").find("a").removeClass("left_list_d")
            //			$(".left_menu_list li").eq(0).find("a").addClass("left_list_d");

        }
        else
        {
            $( ".left_menu" ).stop( true ).fadeOut( 500 );
        }

        if( ( $( window ).scrollTop() > $( ".home_sec6" ).offset().top - 500) && ( $( window ).scrollTop() < $( ".home_sec7_1" ).offset().top - 500) )
        {

            $( ".left_menu_list li" ).find( "a" ).removeClass( "left_list_d" )
            $( ".left_menu_list li" ).eq( 0 ).find( "a" ).addClass( "left_list_d" );

        }

        else
        {
            $( ".left_menu_list li" ).find( "a" ).removeClass( "left_list_d" )
            $( ".left_menu_list li" ).eq( 4 ).find( "a" ).addClass( "left_list_d" );
        }

    } )
} )

$( '.pro_box_tit2 a' ).hover( function()
{
    var s7 = $( this ).index();

    $( '.pro_box_tit2 a' ).removeClass( 'pro_currt2' );
    $( this ).addClass( 'pro_currt2' );

    $( '.pro_b_a2' ).stop( true ).fadeOut( 0 );
    $( '.pro_b_a2' ).eq( s7 ).stop( true ).fadeIn( 300 );

} )

$( '.pro_box_tit3 a' ).hover( function()
{
    var s8 = $( this ).index();

    $( '.pro_box_tit3 a' ).removeClass( 'pro_currt3' );
    $( this ).addClass( 'pro_currt3' );

    $( '.pro_b_a3' ).stop( true ).fadeOut( 0 );
    $( '.pro_b_a3' ).eq( s8 ).stop( true ).fadeIn( 300 );

} )

//3
$( '.pro_box_tit4 a' ).hover( function()
{
    var s9 = $( this ).index();

    $( '.pro_box_tit4 a' ).removeClass( 'pro_currt4' );
    $( this ).addClass( 'pro_currt4' );

    $( '.pro_b_a4' ).stop( true ).fadeOut( 0 );
    $( '.pro_b_a4' ).eq( s9 ).stop( true ).fadeIn( 300 );

} )
//4
$( '.pro_box_tit5 a' ).hover( function()
{
    var s11 = $( this ).index();

    $( '.pro_box_tit5 a' ).removeClass( 'pro_currt5' );
    $( this ).addClass( 'pro_currt5' );

    $( '.pro_b_a5' ).stop( true ).fadeOut( 0 );
    $( '.pro_b_a5' ).eq( s11 ).stop( true ).fadeIn( 300 );

} )

function GetRTime1()
{
    var num = $('.end_time').length;
    for(var i=2;i<=num+1;i++) {
        var second = $('#end_time_'+i).val();
        var EndTime = new Date(second);
        var NowTime = new Date();
        var t = EndTime.getTime() - NowTime.getTime();
        var d = 0;
        var h = 0;
        var m = 0;
        var s = 0;
        if( t >= 0 )
        {
            h = Math.floor( t / 1000 / 60 / 60 );
            m = Math.floor( t / 1000 / 60 % 60 );
            s = Math.floor( t / 1000 % 60 );
        }
        //document.getElementById("t_d").innerHTML = d + "天";

        document.getElementById( "t_h"+i ).innerHTML = h < 10 ? "0" + h : h;
        document.getElementById( "t_m"+i ).innerHTML = m < 10 ? "0" + m : m;
        document.getElementById( "t_s"+i ).innerHTML = s < 10 ? "0" + s : s;
    }
}

setInterval( GetRTime1, 0 );

//	场次倒计时
function GetRTime6()
{
    var EndTime = new Date( '2017/12/30 00:00:00' );
    var NowTime = new Date();
    var t = EndTime.getTime() - NowTime.getTime();
    var d = 0;
    var h = 0;
    var m = 0;
    var s = 0;
    if( t >= 0 )
    {
        //d=Math.floor(t/1000/60/60/24);
        //h=Math.floor(t/1000/60/60%24);
        h = Math.floor( t / 1000 / 60 / 60 );
        m = Math.floor( t / 1000 / 60 % 60 );
        s = Math.floor( t / 1000 % 60 );
    }
    //document.getElementById("t_d").innerHTML = d + "天";
    document.getElementById( "t_h6" ).innerHTML = h < 10 ? "0" + h : h;
    document.getElementById( "t_m6" ).innerHTML = m < 10 ? "0" + m : m;
    document.getElementById( "t_s6" ).innerHTML = s < 10 ? "0" + s : s;
}

setInterval( GetRTime6, 0 );


function J_shopCate(id) {
    if(id){
        $.ajax({
            url: "/shop/index/getIntGoods",
            type: "post",
            dataType: "json",
            data: {
                id: id,
            }
        }).done(function (res) {
            //商品
            $(".int_shop").children('div').remove();
            var shop_img = $('#shop_img').val();
            var html = '';
            for (var i = 0; i < res.length; i++) {
                var is= i+1;
                if(is % 3 == '0') {
                    html+='<div class="home_sec6_con mr">';
                } else {
                    html+='<div class="home_sec6_con">';
                }

                html+='<a href="/integral_del.html?id='+res[i]['id']+'">';
                html+='<div class="home_sec6_con_img">';
                html+='<img src="'+res[i]['logo_pic']+'" width="100%">';
                html+='<div class="hot2">';
                html+='<hot></hot>';
                html+='</div>';
                html+='</div>';
                html+='</a>';
                html+='<div class="home_sec6_con_text">';
                html+='<h5><a href="/integral_del.html?id='+res[i]['id']+'">'+res[i]['goods_name']+'</a></h5>';
                // html+='<div class="huo"><a href="/integral_del.html?id='+res[i][id]+'">'+res[i]['goods_des']+'</a></div>';
                html+='<div class="price_kk">';
                html+='<h4><span class="x">'+res[i]['price']+'</span>积分</h4>';
                html+='<div class="xiao">';
                html+='<a href="javascript:void(0);"><img src="'+shop_img+'/ji.png" width="100%" class="addcart"></a>';
                html+='</div>';
                html+='</div>';
                html+='<div class="chengjiao">该款月成交 <span>1000笔</span></div>';
                html+='</div>';
                html+='</div>';
            }

            $(".int_shop").append(html);

            //已选条件
            // var choose = '';
            // $("#choose").children().remove();
            // choose+='<span style="color:red;" onclick="all_choose(this);" id="'+id+'" name="type" data-title="type">'+title+'</span>'
            // $("#choose").append(choose);
            // all_choose(this);

        })
    }
}
function J_cate(id) {

    if(id){
        $.ajax({
            url: "/shop/index/getGoods",
            type: "post",
            dataType: "json",
            data: {
                id: id,
            }
        }).done(function (res) {
            console.log(id);
            //商品
            $(".shop").children('div').remove();
            var shop_img = $('#shop_img').val();
            var html = '';
            for (var i = 0; i < res.length; i++) {
                var is= i+1;
                if(is % 3 == '0') {
                    html+='<div class="home_sec6_con mr">';
                } else {
                    html+='<div class="home_sec6_con">';
                }
                html+='<a href="/detail.html?id='+res[i]['id']+'">';
                html+='<div class="home_sec6_con_img">';
                html+='<img src="'+res[i]['logo_pic']+'" width="100%">';
                html+='<div class="hot2">';
                html+='<hot></hot>';
                html+='</div>';
                html+='</div>';
                html+='</a>';
                html+='<div class="home_sec6_con_text">';
                html+='<h5><a href="/detail.html?id='+res[i]['id']+'">'+res[i]['pid_cate_name']+' '+res[i]['cate_name']+' '+res[i]['goods_name']+'</a></h5>';
                html+='<div class="huo"><a href="/detail.html?id='+res[i][id]+'">'+res[i]['goods_des']+'</a></div>';
                html+='<div class="price_kk">';
                html+='<h4>￥<span class="x">'+res[i]['price']+'</span><span class="y">￥'+res[i]['price']+'</span></h4>';
                html+='<div class="xiao">';
                html+='<a href="javascript:void(0);"><img src="'+shop_img+'/gou.png" width="100%" class="addcart"></a>';
                html+='</div>';
                html+='</div>';
                html+='<div class="chengjiao">该款月成交 <span>1000笔</span></div>';
                html+='</div>';
                html+='</div>';
            }

            $(".shop").append(html);

            //已选条件
            // var choose = '';
            // $("#choose").children().remove();
            // choose+='<span style="color:red;" onclick="all_choose(this);" id="'+id+'" name="type" data-title="type">'+title+'</span>'
            // $("#choose").append(choose);
            // all_choose(this);

        })
    }
}

var eleFlyElement = document.querySelector( "#flyItem" ), eleShopCart = document.querySelector( "#shopCart" );
var numberItem = 0;
//// 抛物线运动
//var myParabola = funParabola( eleFlyElement, eleShopCart, {
//	speed: 400, //抛物线速度
//	curvature: 0.0008, //控制抛物线弧度
//	complete: function()
//	{
//		eleFlyElement.style.visibility = "hidden";
//		eleShopCart.querySelector( "span" ).innerHTML = ++numberItem;
//	}
//} );

// 绑定点击事件
if( eleFlyElement && eleShopCart )
{

    [].slice.call( document.getElementsByClassName( "btnCart" ) ).forEach( function( button )
    {
        button.addEventListener( "click", function( event )
        {
            var src = $( this ).parents( ".product-preview__back" ).siblings( ".product-preview__front" ).find( "img" ).attr( "src" );
            //				console.log( $(this).parents(".product-preview__back" ).siblings(".product-preview__back").find("img").attr("src"))
            $( "#flyItem" ).find( "img" ).attr( "src", src );
            // 滚动大小
            var scrollLeft = document.documentElement.scrollLeft || document.body.scrollLeft || 0,
                scrollTop = document.documentElement.scrollTop || document.body.scrollTop || 0;
            eleFlyElement.style.left = event.clientX + scrollLeft + "px";
            eleFlyElement.style.top = event.clientY + scrollTop + "px";
            eleFlyElement.style.visibility = "visible";

            // 需要重定位
            myParabola.position().move();
        } );
    } );
}