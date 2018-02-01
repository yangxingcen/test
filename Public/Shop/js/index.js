// JavaScript Document

/***************手机导航***************/
$( document ).ready( function()
{
	$( '.phone_header_btn' ).click( function()
	{
		$( ".header_menu" ).fadeIn( "fast" )
		$( ".header_menu_con" ).animate( { "left": "0px" }, 1000 )
		$( ".header_menu_bg" ).animate( { "opacity": "1" }, 500 )

	} )
	$( ".header_menu_bg" ).click( function()
	{
		$( ".header_menu" ).fadeOut( "fast" )
		$( ".header_menu_con" ).animate( { "left": "-300px" }, 1000 )
		$( ".header_menu_bg" ).animate( { "opacity": "0" }, 500 )

	} )

	$( '.serach' ).css( "right", ($( window ).width() - $( '.container' ).width()) / 2 );

	$( ".weixin" ).hover( function()
	{

		$( ".weixin_box" ).fadeIn( 500 );

	}, function()
	{

		$( ".weixin_box" ).fadeOut( 500 );

	} )

} )
/***************手机导航***************/

$( document ).ready( function()
{
	//回到头部：
	$( ".hui" ).click( function()
	{

		$( "html,body" ).stop().animate( { "scrollTop": 0 }, 800 );
	} )

	$( ".serach_input input" ).click( function()
	{

		$( ".serach " ).css( "width", "160" )
	} )

	$( ".serach_input input" ).blur( function()
	{

		$( ".serach " ).css( "width", "130" )
	} )

	$( window ).scroll( function()
	{

		if( $( window ).scrollTop() > 100 )
		{

			$( ".menu_right" ).css( "opacity", "1" )
		}

		else
		{
			$( ".menu_right" ).css( "opacity", "0" )
		}

	} )

} )
/***导航***/

$( document ).ready( function()
{
	$( ".header_menu_bg" ).height( $( window ).height() - $( ".header" ).height() )

	$( window ).resize( function()
	{
		$( ".header_menu_bg" ).height( $( window ).height() - $( ".header" ).height() )

	} )

	$( ".header_bot li" ).hover( function()
	{
		var _this = $( this )
		var now = _this.attr( "data-id" )
		if( _this.hasClass( "hd_nav_o" ) )
		{
			_this.addClass( "on" ).siblings( "li" ).removeClass( "on" )
			//$( ".header_nav" ).stop( true ).slideDown( 500 )

			$( ".header_nav_cont" ).stop( true ).fadeOut( 500 );
			$( ".header_nav_cont" ).eq( now ).stop( true ).fadeIn( 500 );

			//$( ".header_nav" ).find()
		}
		else
		{
			$( ".header_bot li" ).removeClass( "on" )

			$( ".header_nav_cont" ).stop( true ).fadeOut( 500 );
		}
	} )

	$( ".header_bot" ).hover( function()
	{

	}, function()
	{
		$( ".header_bot li" ).removeClass( "on" )
		$( ".header_nav_cont" ).stop( true ).fadeOut( 500 )
	} )

	$( '.erji_nav>ul>li' ).hover( function()
	{
		$( this ).find( '.erji_li>span' ).stop( true ).fadeIn( 0 );
		$( this ).find( '.snaji_nav' ).stop( true ).fadeIn( 0 );
	}, function()
	{
		$( this ).find( '.erji_li>span' ).stop( true ).fadeOut( 0 );
		$( this ).find( '.snaji_nav' ).stop( true ).fadeOut( 0 );
	} )




	$( window ).scroll( function()
	{



		if( $( window ).scrollTop() > 300 )
		{

			if($("body").height()>$(".header").height()+$(".footer" ).height() +750)
			{
				$( ".header_bot" ).addClass( "scroll" );
				$( ".header_top" ).addClass( "scroll1" );
				$( '.serach' ).fadeIn()
			}


		}
		else
		{
			$( ".header_bot" ).removeClass( "scroll" )
			$( '.serach' ).hide()
			$( ".header_top" ).removeClass( "scroll1" );
		}
	} )





} )

/*******产品评价*******/
$( document ).ready( function()
{
	var pjDiv;
	var pjPrev;
	var pjNext;
	var pjClose;
	var pjUl;
	var pjLi;
	var pjW;
	var pjS;
	var pjImg1;
	var t = 0;
	var i = 0;
	var pi = 0;

	$( '.pingj_t p' ).click( function()
	{
		$( '.pingj_t p' ).removeClass( 'pingj_on' );
		$( this ).addClass( 'pingj_on' );
		var pj = $( this ).index();
		$( '.pingj_con>ul' ).stop( true, true ).fadeOut( 0 );
		$( '.pingj_con>ul' ).eq( pj ).stop( true, true ).fadeIn( 300 );
	} )

	$( '.ping_img img' ).click( function()
	{

		pjDiv = $( this ).parents( '.pingj_con_zi' ).find( '.ping_img_cons' );
		pjLi = $( this ).parents( '.pingj_con_zi' ).find( '.ping_img_cons li' );
		pjUl = $( this ).parents( '.pingj_con_zi' ).find( '.ping_img_cons ul' );
		pjPrev = $( this ).parents( '.pingj_con_zi' ).find( '.ping_img_con_prev' );
		pjNext = $( this ).parents( '.pingj_con_zi' ).find( '.ping_img_con_next' );
		pjClose = $( this ).parents( '.pingj_con_zi' ).find( '.ping_img_con_close' );
		pjImg1 = $( this ).parent().find( 'img' );
		i = $( this ).parent().attr( 'id' );
		if( pi == i )
		{
		}
		else
		{
			t = 0;
		}
		pi = i;

		if( $( this ).hasClass( 'ping_on' ) )
		{
			$( '.ping_img_con' ).removeClass( 'ping_img_con_on' );
			$( '.ping_img img' ).removeClass( 'ping_on' );
		}
		else
		{
			var n = $( this ).index();
			$( '.ping_img_con' ).removeClass( 'ping_img_con_on' );
			$( this ).parents( '.pingj_con_zi' ).find( '.ping_img_con' ).addClass( 'ping_img_con_on' );

			pjS = pjLi.size();
			pjUl.height( pjLi.eq( n ).height() );

			$( '.ping_img img' ).removeClass( 'ping_on' );
			$( this ).addClass( 'ping_on' );
			pjLi.stop( true, true ).fadeOut( 0 );
			pjLi.eq( n ).stop( true, true ).fadeIn( 0 );

			pjClose.click( function()
			{
				$( '.ping_img_con' ).removeClass( 'ping_img_con_on' );
				$( '.ping_img img' ).removeClass( 'ping_on' );
			} )

			if( t == 0 )
			{
				pingjia();
				t = 1;
				return;
			}

		}

		function pingjia()
		{

			pjNext.click( function()
			{
				pingjia1();
			} )

			pjPrev.click( function()
			{
				pingjia2();
			} )
		}

		function pingjia1()
		{
			if( n > (pjS - 2) )
			{
				n = 0;
				pjUl.height( pjLi.eq( n ).height() );
				pjLi.stop( true, true ).fadeOut( 0 );
				pjLi.eq( n ).stop( true, true ).fadeIn( 0 );
				$( '.ping_img img' ).removeClass( 'ping_on' );
				pjImg1.eq( n ).addClass( 'ping_on' );

			}
			else
			{
				n++;
				pjUl.height( pjLi.eq( n ).height() );
				pjLi.stop( true, true ).fadeOut( 0 );
				pjLi.eq( n ).stop( true, true ).fadeIn( 0 );
				$( '.ping_img img' ).removeClass( 'ping_on' );
				pjImg1.eq( n ).addClass( 'ping_on' );
			}
		}

		function pingjia2()
		{
			if( n < 1 )
			{
				n = pjS - 1;
				pjUl.height( pjLi.eq( n ).height() );
				pjLi.stop( true, true ).fadeOut( 0 );
				pjLi.eq( n ).stop( true, true ).fadeIn( 0 );
				$( '.ping_img img' ).removeClass( 'ping_on' );
				pjImg1.eq( n ).addClass( 'ping_on' );
			}
			else
			{
				n--;
				pjUl.height( pjLi.eq( n ).height() );
				pjLi.stop( true, true ).fadeOut( 0 );
				pjLi.eq( n ).stop( true, true ).fadeIn( 0 );
				$( '.ping_img img' ).removeClass( 'ping_on' );
				pjImg1.eq( n ).addClass( 'ping_on' );
			}
		}

	} )

} )
/*******产品评价*******/




$(document).ready(function(){

    /*
    (function(){

        var screenWidth=$(window).width();
        if(screenWidth>=1460){
            document.body.className=document.body.className+" root-body";window.LOAD=true;
        }else{
            window.LOAD=false;
        }

        $(window).resize(function(e) {
        var screenWidth1=$(window).width();
        if(screenWidth1>=1460){
            $("body").addClass("root-body")
        }else{
            $("body").removeClass("root-body")
        }
        });
    })()*/


    var li_height=$(".right_con_list li").height();
    $('.swiper-container2').css('height',li_height);


    $(window).resize(function (){
        var sheight = $(window).height();
        $('.DB_bgSet li').css("height",sheight-91)
        $(".DB_tab25").css("height",sheight-91);
    })

    var h02 = $(".chugui .col-lg-3 img").height();
    $(".chugui .col-lg-6 img").css("height",h02);


    var h03 = $(".com_index_apply_lc").height();
    $('.com_index_apply_com').css("height",h03)
    $('.com_index_apply_sj').css("height",h03)

    $(window).resize(function (){
        var sheight = $(window).height();
        $('.DB_bgSet li').css("height",sheight-91)
        $(".DB_tab25").css("height",sheight-91);

        var h02 = $(".chugui .col-lg-3 img").height();
        $(".chugui .col-lg-6 img").css("height",h02);

    })

})

$(".map-item ").hover(
    function(){
        $(this).siblings().find(".sub").stop().fadeOut(200);
        $(this).find(".sub").fadeIn(200);
    },function(){
        $(this).find(".sub").stop().fadeOut(200);
    })


$(window).scroll(function(){
    var w_t = $(window).scrollTop();
    if(w_t>(500)){

        $(".as-total-container").stop(true,false).animate({"top":"0px"},200)
        $(".default_stairs_w").stop(true,false).fadeIn(200)

    }else{
        $(".as-total-container").stop(true,false).animate({"top":"-60px"},200)
        $(".default_stairs_w").stop(true,false).fadeOut(200)
    }
    try{
        if(w_t>($("#jm").offset().top-500) && w_t<=($("#arn").offset().top-500)){

            $(".spanshowone").stop(true,false).animate({"opacity":"1"},200,'easeOutExpo').parent().siblings().find(".spanshow").stop(true,false).animate({"opacity":"0"},200);
        }

    }catch(e){

    }

    try{
        if(w_t>($("#arn").offset().top-500) && w_t<=($("#fsm").offset().top-500)){
            $(".spanshowtwo").stop(true,false).animate({"opacity":"1"},200,'easeOutExpo').parent().siblings().find(".spanshow").stop(true,false).animate({"opacity":"0"},200);
        }


        if(w_t>($("#fsm").offset().top-500)){
            $(".spanshowthree").stop(true,false).animate({"opacity":"1"},200,'easeOutExpo').parent().siblings().find(".spanshow").stop(true,false).animate({"opacity":"0"},200);
        }

    }catch(e){}

})











$(function(){
    $('.stairs_nav').eq(0).click(function(){
        var h1=$('#jm').offset().top-60;
        $('body,html').stop(true,false).animate({scrollTop:h1},1000)
    })
    $('.stairs_nav').eq(1).click(function(){
        var h2=$('#arn').offset().top-60;
        $('body,html').stop(true,false).animate({scrollTop:h2},1000)
    })
    $('.stairs_nav').eq(2).click(function(){
        var h3=$('#fsm').offset().top-60;
        $('body,html').stop(true,false).animate({scrollTop:h3},1000)
    })


})



//var swiper1 = new Swiper('.swiper1', {
//    paginationClickable: true,
//    loop: true,
//    pagination: '.swiper-pagination1',
//    nextButton: '.swiper-button-next1',
//    prevButton: '.swiper-button-prev1',
//    loop:true,
//    grabCursor: true,
//    autoplay:3000,
//    spaceBetween: 0,
//    paginationClickable: true,
//    autoplayDisableOnInteraction : false
//});
//
//var mySwiper = new Swiper('.swiper-container1',{
//    loop:true,
//    grabCursor: true,
//    autoplay:3000,
//    spaceBetween: 0,
//    slidesPerView : 4,
//    slidesPerGroup : 1,
//    paginationClickable: true
//})
//var mySwiper = new Swiper('.swiper-container2',{
//    loop:true,
//    grabCursor: true,
//    autoplay:3000,
//    spaceBetween: 0,
//    slidesPerView : 4,
//    slidesPerGroup : 1,
//    paginationClickable: true
//})
//var swiper0 = new Swiper('.swiper0', {
//    paginationClickable: true,
//    pagination: '.swiper-pagination0',
//    spaceBetween: 0,
//    autoplay:3000,
//});
//
//var swiper2 = new Swiper('.swiper2', {
//    paginationClickable: true,
//    pagination: '.swiper-pagination2',
//    spaceBetween: 0,
//    autoplay:3000,
//});
//
//
//var swiper3 = new Swiper('.swiper3', {
//    paginationClickable: true,
//    pagination: '.swiper-pagination3',
//    spaceBetween: 0,
//    autoplay:3000,
//});
//
//
//var swiper4 = new Swiper('.swiper4', {
//    paginationClickable: true,
//    pagination: '.swiper-pagination4',
//    spaceBetween: 0,
//    autoplay:3000,
//});
//
//
//var swiper5 = new Swiper('.swiper5', {
//    paginationClickable: true,
//    pagination: '.swiper-pagination5',
//    spaceBetween: 0,
//    autoplay:3000,
//});




$(".map-item ").hover(
    function(){
        $(this).siblings().find(".sub").stop().fadeOut(200);
        $(this).find(".sub").fadeIn(200);
    },function(){
        $(this).find(".sub").stop().fadeOut(200);
    })






$(function(){
    $('.stairs_nav').eq(0).click(function(){
        var h1=$('#jm').offset().top-60;
        $('body,html').stop().animate({scrollTop:h1},2000)
    })
    $('.stairs_nav').eq(1).click(function(){
        var h2=$('#arn').stop().offset().top-60;
        $('body,html').animate({scrollTop:h2},2000)
    })
    $('.stairs_nav').eq(2).click(function(){
        var h3=$('#fsm').offset().top-60;
        $('body,html').stop().animate({scrollTop:h3},2000)
    })


})






/*****��Ʒ����*****/
$(document).ready(function(){

    $('.pro_phfl').width($('.pro_hd1').width());


    $('.pro_xximg').width($('.pro_xx').width()-123)
    $('.pro_inner_con_kj').height(($('.pro_inner_con_kj').width()-123)*680/750);
    $('.pro_xximg').height($('.pro_xximg').width()*680/750);

    $(window).resize(function(){
        $('.pro_xximg').width($('.pro_xx').width()-123)
        $('.pro_inner_con_kj').height(($('.pro_inner_con_kj').width()-123)*680/750);
        $('.pro_xximg').height($('.pro_xximg').width()*680/750)
    })


    var n=0;


    $('.pro_xximg>li').removeClass('pro_xximg_z');
    $('.pro_xximg>li').eq(0).addClass('pro_xximg_z');
    $('.pro_xximg>li').eq(0).addClass('pro_xximg_show');
    $('.pro_xx_s>li').removeClass('pro_xx_son')
    $('.pro_xx_s>li').eq(0).addClass('pro_xx_son')

    setTimeout(function(){
        $('.pro_xximg>li').removeClass('pro_xximg_show');
        $('.pro_xximg>li').eq(0).addClass('pro_xximg_show');
    },300)


    $('.pro_xx_s>li').click(function(){
        var pro_num=$(this).index();
        $('.pro_xximg>li').removeClass('pro_xximg_z');
        $('.pro_xximg>li').eq(pro_num).addClass('pro_xximg_z');
        $('.pro_xximg>li').eq(pro_num).addClass('pro_xximg_show');
        $('.pro_xx_s>li').removeClass('pro_xx_son')
        $(this).addClass('pro_xx_son')

        setTimeout(function(){
            $('.pro_xximg>li').removeClass('pro_xximg_show');
            $('.pro_xximg>li').eq(pro_num).addClass('pro_xximg_show');
        },300)

    })



    $('.pro_xx_s>li').hover(function(){
        $(this).find('.line_t').stop(true).animate({width:"100%"},300)
        $(this).find('.line_r').stop(true).animate({height:"100%"},300)
        $(this).find('.line_b').stop(true).animate({width:"100%"},300)
        $(this).find('.line_l').stop(true).animate({height:"100%"},300)
    },function(){
        $(this).find('.line_t').stop(true).animate({width:"0"},300)
        $(this).find('.line_r').stop(true).animate({height:"0"},300)
        $(this).find('.line_b').stop(true).animate({width:"0"},300)
        $(this).find('.line_l').stop(true).animate({height:"0"},300)
    })

    $('.pro_xx_s>li').width($('.pro_xx_s_box').width());
    var xx=$('.pro_xx_s>li').width();
    var ss=$('.pro_xx_s>li').size();
    var xxx=xx+13;

    $('.pro_xx_s_box').height(xx*4+60);

    $('.pro_xx_s').height(xx*ss+10)

    $('.pro_xx_next').click(function(){
        if(n>(ss-5)){
            $('.pro_xx_s').stop(true).animate({top:0},300)
            n=0;
        }else{
            $('.pro_xx_s').stop(true).animate({top:-xxx*(n+1)},300)
            n++;
        }
    })

    $('.pro_xx_prev').click(function(){
        if(n<1){
            $('.pro_xx_s').stop(true).animate({top:-(ss-4)*xxx},300)
            n=ss-4;
        }else{
            $('.pro_xx_s').stop(true).animate({top:-xxx*(n-1)},300)
            n--;
        }
    })



    $('.pro_boton_t ul li').hover(function(){

        var pin=$(this).index();

        if($('.pro_boton_list').eq(pin).css("display")=="none"){
            $('.pro_boton_t ul li').removeClass('pro_lion');
            $('.pro_boton_t ul li').eq(pin).addClass('pro_lion');
            $('.pro_boton_list').stop(true,true).fadeOut(0);
            $('.pro_boton_list').eq(pin).stop(true,true).fadeIn(300);
        }else{

        }

    },function(){

    })



})

/*****��Ʒ����*****/




/*****��������*****/
$(document).ready(function(){

    $('.user_r5>h5>a').click(function(){
        $('.dizhi').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_con').addClass('dizhi_con_on');
        },300)
    })

    $('.user_r2_btn>a').click(function(){
        $('.dizhi').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_con').addClass('dizhi_con_on');
        },300)
    })

    $('.order_shon2>span').click(function(){
        $('.dizhi').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_con').addClass('dizhi_con_on');
        },300)
    })

    $('.order_shone1>a').eq(0).click(function(){
        $('.order_shond').stop(true).slideDown(300);
        $('.order_shone1>a').eq(0).stop(true).fadeOut(0);
        $('.order_shone1>a').eq(1).stop(true).fadeIn(0);
    })

    // $('.order_shonc li').click(function(){
    //     $('.order_shonc li').removeClass('order_shoncon');
    //     $(this).addClass('order_shoncon');
    // })

    $('.order_shonc li a').click(function(){
        $('.dizhi').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_con').addClass('dizhi_con_on');
        },300)
    })

    $('.order_shone1>a').eq(1).click(function(){
        $('.dizhi').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_con').addClass('dizhi_con_on');
        },300)
    })


    $('.dizhi_bj').click(function(){
        $('.dizhi').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_con').addClass('dizhi_con_on');
        },300)
    })

    $('.dizhi_btn1>a.cancel').click(function(){
        $('.dizhi').stop(true).fadeOut(1000);
        $('.dizhi_con').removeClass('dizhi_con_on');
    })

    $('.dizhi_con>img').click(function(){
        $('.dizhi').stop(true).fadeOut(1000);
        $('.dizhi_con').removeClass('dizhi_con_on');
    })


    $('.order_shon2>a').click(function(){
        $('.dizhi_change').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.dizhi_change_con').addClass('dizhi_change_con_on');
        },300)
    })

    $('.dizhi_change_btn1>a').click(function(){
        $('.dizhi_change').stop(true).fadeOut(1000);
        $('.dizhi_change_con').removeClass('dizhi_change_con_on');
    })

    $('.dizhi_change_con>img').click(function(){
        $('.dizhi_change').stop(true).fadeOut(1000);
        $('.dizhi_change_con').removeClass('dizhi_change_con_on');
    })


    $('.dizhi_change_lista>a').click(function(){
        $('.dizhi_change').stop(true).fadeOut(1000);
        $('.dizhi_change_con').removeClass('dizhi_change_con_on');

        setTimeout(function(){

            $('.dizhi').stop(true).fadeIn(1000);
            setTimeout(function(){
                $('.dizhi_con').addClass('dizhi_con_on');
            },300)

        },600)

    })


    $('.frist_log').click(function(){
        $('.bd_show').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.bd_cona').addClass('bd_con_on');
        },300)
    })

    $('.login_other p').click(function(){
        $('.bd_show').stop(true).fadeIn(1000);
        setTimeout(function(){
            $('.bd_conb').addClass('bd_con_on');
        },300)
    })

    $('.bd_conb_close').click(function(){
        $('.bd_show').stop(true).fadeOut(1000);
        $('.bd_conb').removeClass('bd_con_on');
    })


    $('.xgmm>input').click(function(){
        if($('.xgmm_con').css("display")=="none"){
            $('.xgmm_con').stop(true).slideDown(300);
        }else{
            $('.xgmm_con').stop(true).slideUp(300);
        }
    })

    $('.dizhi_change_list').click(function(){
        $('.dizhi_change_list').removeClass('dizhi_change_list_on');
        $(this).addClass('dizhi_change_list_on');
    })


    $('.soucang').click(function(){
        $(this).toggleClass('soucang_on');
    })

    // $('.j_checkbox').click(function(){
    //  $(this).toggleClass('j_checkbox_on')
    //  })

    $('.user_r4_btn a').click(function(){
        $('.user_r4_cons').stop(true).slideDown(600);
    })

    // $('.user_r4 .user8_con2>a').click(function(){
    //  $('.user_r4_cons').stop(true).slideUp(600);
    //  })

    $('.order_shona').click(function(){
        $('.order_shona').removeClass('pro_xz');
        $(this).addClass('pro_xz');
    })


})
/*****��������*****/











/*****��Ʒ����****/
$(window).load(function(){

    $('.xinp_con>ul>li').width($('.xinp_con').width());
    var xpW=$('.xinp_con>ul>li').width();
    var xpS=$('.xinp_con>ul>li').size();
    $('.xinp_con>ul').width(xpW*xpS+1000);

    $(window).resize(function(){
        $('.xinp_con>ul>li').width($('.xinp_con').width());
        var xpW=$('.xinp_con>ul>li').width();
        var xpS=$('.xinp_con>ul>li').size();
        $('.xinp_con>ul').width(xpW*xpS+1000);
    })

    /*setInterval(function(){
        $('.xinp_con>ul').stop(true,true).animate({marginLeft:-xpW},800,function(){
          $('.xinp_con>ul').find('li:first-child').appendTo($('.xinp_con>ul'));
          $('.xinp_con>ul').css({marginLeft:0})
          })
        },5000)*/

})
/*****��Ʒ����****/


$(window).load(function(){

    $('.caigou1_2_list input').width($('.caigou1_2_list').width()-90);
    $('.caigou1_2_list1 textarea').width($('.caigou1_2_list1').width()-90);

    $('.main_rm_l1').height($('.main_rm_l2').height());
    $('.main_rm_r').height($('.main_rm_l').height()-1);

    $('.main_rm_r>ul li').height($('.main_rm_r').height()/5);

    $(window).resize(function(){
        $('.main_rm_l1').height($('.main_rm_l2').height());
        $('.main_rm_r').height($('.main_rm_l').height()-1);
        $('.main_rm_r>ul li').height($('.main_rm_r').height()/5);

        $('.caigou1_2_list input').width($('.caigou1_2_list').width()-90);
        $('.caigou1_2_list1 textarea').width($('.caigou1_2_list1').width()-90);

    })

})


$(document).ready(function(){

    $('.wap_weixin').find('.wap_weixin_show').stop(true).fadeIn(0);
    $('.wap_weixin').find('p').stop(true,true).fadeIn(0);

    $('.back_top').click(function(){
        $("html,body").animate({scrollTop:0}, 1000);
    })

    $('.wap_weixin>span').click(function(){
        $(this).parent().find('.wap_weixin_show').stop(true,true).fadeIn(300);
        $(this).parent().find('p').stop(true,true).fadeIn(300);
    })

    $('.pro_inner_zi4 span').hover(function(){
        $(this).find('.pro_inner_zi4_img').stop(true,true).fadeIn(300);
    },function(){
        $(this).find('.pro_inner_zi4_img').stop(true,true).fadeOut(300);
    })

    $('.wap_weixin_show>a').click(function(){
        $('.wap_weixin').find('.wap_weixin_show').stop(true,true).fadeOut(300);
        $('.wap_weixin').find('p').stop(true,true).fadeOut(300);
    })

    $('.sec3_list').hover(function(){
        $(this).find('.youhuo').stop(true,true).fadeIn(300);
    },function(){
        $(this).find('.youhuo').stop(true,true).fadeOut(300);
    })

    $('.pro_phone').hover(function(){
        $('.pro_phone_show').stop(true,true).fadeIn(300)
    },function(){
        $('.pro_phone_show').stop(true,true).fadeOut(300)
    })

    $('.order1_yh_con1>ul li').click(function(){

        var or=$(this).index();
        $('.order1_yh_con1 ul li').removeClass('order1_yhon');
        $(this).addClass('order1_yhon');

        $('.order1_yh_list').stop(true,true).fadeOut(0);
        $('.order1_yh_list').eq(or).stop(true,true).fadeIn(300);

    })


    $('.order1_yh_list1>ul>li>input').click(function(){
        $('.order1_yh_list1>ul>li>input').removeClass('j_checkbox_on');
        $(this).addClass('j_checkbox_on');
        $('.order1_yh_list1 .user8_con2').stop(true).slideUp(300);
    })

    $('.j_checkbox_xz').click(function(){
        $('.order1_yh_list1 .user8_con2').stop(true).slideDown(300);
    })


    $('.order1_yh_con2>ul>li .j_checkbox').click(function(){

        $('.order1_yh_con2>ul>li .j_checkbox').removeClass('j_checkbox_on');
        $(this).addClass('j_checkbox_on');

    })


    $('.pro_pht span').hover(function(){
        var pt=$(this).index();

        if($('.pro_ph_con1').eq(pt).css("display")=="none"){
            $('.pro_pht span').removeClass('pro_phton');
            $('.pro_pht span').eq(pt).addClass('pro_phton');

            $('.pro_ph_con1').stop(true,true).fadeOut(0);
            $('.pro_ph_con1').eq(pt).stop(true,true).fadeIn(300);

        }

    },function(){})


    $('.pro_inner_zi2 p span').click(function(){
        $(this).parent().find('span').removeClass('pro_xz');
        $(this).addClass('pro_xz');
    })


    $('.pro_sc h5').click(function(){
        $(this).toggleClass('pro_scon')
    })

    $('.pro_ph_list h5').click(function(){
        $(this).find('i').toggleClass('fa-angle-down');
        $(this).parent().find('ul').stop(true,true).slideToggle(300);
    })



    $('.ktlb').click(function(){
        $(this).toggleClass('ktlb_on');
        $(this).find('ul').stop(true).slideToggle(300);
    })

    $('.btn01').click(function(){
        $('.caigou_two_bz_box').stop(true,true).slideToggle(300);
    })


})



/*******�����̳�*******/
$(document).ready(function(){

    var y1=$('.jfdh_con>ul>li').size();
    var x1=$('.jfdh_con>ul>li').height();
    var play=0;
    var x=0;
    var d=0;
    $('.jfdh_con').height(x1*5);

    function gd(){


        function gundong(){
            if(y1>5){
                play=setInterval(function(){
                    if(x>x1){
                        x=0;
                        $('.jfdh_con>ul').find('li:first-child').appendTo($('.jfdh_con>ul'));
                        $('.jfdh_con>ul').css({marginTop:0});
                        $('.jfdh_con>ul').stop(true,true).animate({marginTop:-x},0,'linear');
                    }else{
                        $('.jfdh_con>ul').stop(true,true).animate({marginTop:-x},1,'linear');
                        x++;
                    }
                },40);
            }
        }

        gundong();



        $('.jfdh_con').hover(function(){
            d=0;
            clearInterval(play)
        },function(){
            if(d==0){
                gundong();
                d=1;
                return;
            }
        })



    }


    gd();


})


/*******�����̳�*******/





/*******��Ʒ����*******/
$(document).ready(function(){
    var pjDiv;
    var pjPrev;
    var pjNext;
    var pjClose;
    var pjUl;
    var pjLi;
    var pjW;
    var pjS;
    var pjImg1;
    var t=0;
    var i=0;
    var pi=0;

    $('.pingj_t p').click(function(){
        $('.pingj_t p').removeClass('pingj_on');
        $(this).addClass('pingj_on');
        var pj=$(this).index();
        $('.pingj_con>ul').stop(true,true).fadeOut(0);
        $('.pingj_con>ul').eq(pj).stop(true,true).fadeIn(300);
    })

    $('.ping_img img').click(function(){

        pjDiv=$(this).parents('.pingj_con_zi').find('.ping_img_cons');
        pjLi=$(this).parents('.pingj_con_zi').find('.ping_img_cons li');
        pjUl=$(this).parents('.pingj_con_zi').find('.ping_img_cons ul');
        pjPrev=$(this).parents('.pingj_con_zi').find('.ping_img_con_prev');
        pjNext=$(this).parents('.pingj_con_zi').find('.ping_img_con_next');
        pjClose=$(this).parents('.pingj_con_zi').find('.ping_img_con_close');
        pjImg1=$(this).parent().find('img');
        i=$(this).parent().attr('id');
        if(pi==i){
        }else{
            t=0;
        }
        pi=i;


        if($(this).hasClass('ping_on')){
            $('.ping_img_con').removeClass('ping_img_con_on');
            $('.ping_img img').removeClass('ping_on');
        }else{
            var n=$(this).index();
            $('.ping_img_con').removeClass('ping_img_con_on');
            $(this).parents('.pingj_con_zi').find('.ping_img_con').addClass('ping_img_con_on');

            pjS=pjLi.size();
            pjUl.height(pjLi.eq(n).height());

            $('.ping_img img').removeClass('ping_on');
            $(this).addClass('ping_on');
            pjLi.stop(true,true).fadeOut(0);
            pjLi.eq(n).stop(true,true).fadeIn(0);

            pjClose.click(function(){
                $('.ping_img_con').removeClass('ping_img_con_on');
                $('.ping_img img').removeClass('ping_on');
            })

            if(t==0){
                pingjia();
                t=1;
                return;
            }

        }


        function pingjia(){

            pjNext.click(function(){
                pingjia1();
            })

            pjPrev.click(function(){
                pingjia2();
            })
        }

        function pingjia1(){
            if(n>(pjS-2)){
                n=0;
                pjUl.height(pjLi.eq(n).height());
                pjLi.stop(true,true).fadeOut(0);
                pjLi.eq(n).stop(true,true).fadeIn(0);
                $('.ping_img img').removeClass('ping_on');
                pjImg1.eq(n).addClass('ping_on');

            }else{
                n++;
                pjUl.height(pjLi.eq(n).height());
                pjLi.stop(true,true).fadeOut(0);
                pjLi.eq(n).stop(true,true).fadeIn(0);
                $('.ping_img img').removeClass('ping_on');
                pjImg1.eq(n).addClass('ping_on');
            }
        }


        function pingjia2(){
            if(n<1){
                n=pjS-1;
                pjUl.height(pjLi.eq(n).height());
                pjLi.stop(true,true).fadeOut(0);
                pjLi.eq(n).stop(true,true).fadeIn(0);
                $('.ping_img img').removeClass('ping_on');
                pjImg1.eq(n).addClass('ping_on');
            }else{
                n--;
                pjUl.height(pjLi.eq(n).height());
                pjLi.stop(true,true).fadeOut(0);
                pjLi.eq(n).stop(true,true).fadeIn(0);
                $('.ping_img img').removeClass('ping_on');
                pjImg1.eq(n).addClass('ping_on');
            }
        }


    })


})
/*******��Ʒ����*******/




$(window).load(function(){

    try{
        var s1,s2,s3,s4,timer1;
        s1=getid("gp1");
        s2=getid("gp2");
        s3=getid("gp3");
        s4=getid("gp_con1");
        s3.innerHTML=s2.innerHTML;
        s4.style.width=(s2.offsetWidth*2+100)+"px";


        function mar1(){

            if(s2.offsetWidth<=s1.scrollLeft){
                s1.scrollLeft-=s2.offsetWidth;

            }else{s1.scrollLeft++;}

        }
        function getid(id){
            return document.getElementById(id);
        }

        function init1(){
            timer1=setInterval(function(){
                mar1()
            },45)
        }
        init1();

        $('#gp1').hover(function(){
            clearInterval(timer1);
        },function(){
            init1();
        })

    }catch(e){}
})





