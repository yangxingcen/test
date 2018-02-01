$(function(){

    var mySwiper1 = new Swiper( '.swiper1', {
        pagination: '.swiper-pagination1',
        loop: true,
        autoplay: 5000,
        spaceBetween: 0,
        paginationClickable: true,
        speed: 1500,

    } )
    $( '.banner_left' ).on( 'click', function( e )
    {
        e.preventDefault()
        mySwiper1.swipePrev()
    } )

    $( '.banner_right' ).on( 'click', function( e )
    {
        e.preventDefault()
        mySwiper1.swipeNext()
    } )

    var mySwiper2 = new Swiper( '.swiper2', {
        pagination: '.swiper-pagination2',
        loop: true,
        autoplay: 5000,
        spaceBetween: 0,
        paginationClickable: true,
        speed: 1500,

    } )
    var mySwiper3 = new Swiper( '.swiper3', {
        pagination: '.swiper-pagination3',
        loop: true,
        autoplay: 5000,
        spaceBetween: 0,
        paginationClickable: true,
        speed: 1500,

    } )
    var mySwiper4 = new Swiper( '.swiper4', {
        pagination: '.swiper-pagination4',
        loop: true,
        autoplay: 5000,
        spaceBetween: 0,
        paginationClickable: true,
        speed: 1500,

    } )

    $( document ).ready( function()
    {


        //	倒计时7
        function GetRTime7()
        {
            var EndTime = new Date( '2017/11/15 20:00:00' );
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
            document.getElementById( "t_h7" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m7" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s7" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime7, 0 );

        //	倒计时8
        function GetRTime8()
        {
            var EndTime = new Date( '2017/11/15 22:00:00' );
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
            document.getElementById( "t_h8" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m8" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s8" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime8, 0 );

        //	倒计时9
        function GetRTime9()
        {
            var EndTime = new Date( '2017/11/15 22:30:00' );
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
            document.getElementById( "t_h9" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m9" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s9" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime9, 0 );

        //	倒计时10
        function GetRTime10()
        {
            var EndTime = new Date( '2017/11/15 23:00:00' );
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
            document.getElementById( "t_h10" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m10" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s10" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime10, 0 );

        //	倒计时11
        function GetRTime11()
        {
            var EndTime = new Date( '2017/11/15 23:00:00' );
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
            document.getElementById( "t_h11" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m11" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s11" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime11, 0 );

        //	倒计时11
        function GetRTime12()
        {
            var EndTime = new Date( '2017/11/15 23:20:00' );
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
            document.getElementById( "t_h12" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m12" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s12" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime12, 0 );

        //	倒计时13
        function GetRTime13()
        {
            var EndTime = new Date( '2017/11/15 19:20:00' );
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
            document.getElementById( "t_h13" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m13" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s13" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime13, 0 );

        //	倒计时14
        function GetRTime14()
        {
            var EndTime = new Date( '2017/11/15 18:20:00' );
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
            document.getElementById( "t_h14" ).innerHTML = h < 10 ? "0" + h : h;
            document.getElementById( "t_m14" ).innerHTML = m < 10 ? "0" + m : m;
            document.getElementById( "t_s14" ).innerHTML = s < 10 ? "0" + s : s;
        }

        setInterval( GetRTime14, 0 );

    } )

    //	$( ".swiper1" ).height( 600 )

    $( window ).load( function()
    {

    } )
    $( window ).resize( function()
    {

        //      $( ".swiper1" ).height( 600 )

    } )
    $( window ).scroll( function()
    {

    } )
})