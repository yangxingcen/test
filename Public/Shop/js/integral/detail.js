
    $( document ).ready( function()
{

    $( ".pro_jia" ).click( function()
    {
        var no = $( this ).parents( ".pro_inner_zi3" ).find( ".pro_num input" ).val();
        var store = $( this ).parents( ".pro_inner_zi3" ).find( ".kucun" ).html();
        no++
        if(no > store) {
            var no = store;
        }
        $( this ).parents( ".pro_inner_zi3" ).find( ".pro_num input" ).val( no )

    } )
    $( ".pro_jian" ).click( function()
    {
        var no = $( this ).parents( ".pro_inner_zi3" ).find( ".pro_num input" ).val();
        if( no >= 2 )
        {
            no--;
        }
        $( this ).parents( ".pro_inner_zi3" ).find( ".pro_num input" ).val( no )

    } )

    var hei = $( ".meal_img" ).width() + 75;

    $( ".div_img" ).height( (hei - 15) / 2 - 75 )

} )
    $( window ).resize( function()
    {

        //      $( ".swiper1" ).height( 600 )

    } )
    $( window ).scroll( function()
    {

        if( $( window ).scrollTop() > $( ".p_content" ).offset().top )
        {

            $( ".chandise" ).addClass( "fixedTop" )
            $( ".fixedTop" ).width( $( ".container" ).width() )

            var le = $( ".container" ).offset().left + 15;
            $( ".fixedTop" ).css( "left", le )
        }
        else
        {
            $( ".chandise" ).removeClass( "fixedTop" )
            $( ".fixedTop" ).css( "left", 0 );
            $( ".chandise" ).css( "left", "0" )
        }

    } )
    $( document ).ready( function()
    {

        $( '.pro_phfl' ).width( $( '.pro_hd1' ).width() );

        $( '.pro_xximg' ).width( $( '.pro_xx' ).width() - 123 )

        $( '.pro_inner_con_kj' ).height( ($( '.pro_inner_con_kj' ).width() - 123) * 680 / 750 );

        $( '.pro_xximg' ).height( $( '.pro_xximg' ).width() * 680 / 750 );

        $( window ).resize( function()
        {
            $( '.pro_xximg' ).width( $( '.pro_xx' ).width() - 123 )
            $( '.pro_inner_con_kj' ).height( ($( '.pro_inner_con_kj' ).width() - 123) * 680 / 750 );
            $( '.pro_xximg' ).height( $( '.pro_xximg' ).width() * 680 / 750 )
        } )

        var n = 0;
        $( '.pro_xximg>li' ).removeClass( 'pro_xximg_z' );
        $( '.pro_xximg>li' ).eq( 0 ).addClass( 'pro_xximg_z' );
        $( '.pro_xximg>li' ).eq( 0 ).addClass( 'pro_xximg_show' );
        $( '.pro_xx_s>li' ).removeClass( 'pro_xx_son' )
        $( '.pro_xx_s>li' ).eq( 0 ).addClass( 'pro_xx_son' )

        setTimeout( function()
        {
            $( '.pro_xximg>li' ).removeClass( 'pro_xximg_show' );
            $( '.pro_xximg>li' ).eq( 0 ).addClass( 'pro_xximg_show' );
        }, 300 )

        $( '.pro_xx_s>li' ).click( function()
        {
            var pro_num = $( this ).index();
            $( '.pro_xximg>li' ).removeClass( 'pro_xximg_z' );
            $( '.pro_xximg>li' ).eq( pro_num ).addClass( 'pro_xximg_z' );
            $( '.pro_xximg>li' ).eq( pro_num ).addClass( 'pro_xximg_show' );
            $( '.pro_xx_s>li' ).removeClass( 'pro_xx_son' )
            $( this ).addClass( 'pro_xx_son' )

            setTimeout( function()
            {
                $( '.pro_xximg>li' ).removeClass( 'pro_xximg_show' );
                $( '.pro_xximg>li' ).eq( pro_num ).addClass( 'pro_xximg_show' );
            }, 300 )

        } )

        $( '.pro_xx_s>li' ).hover( function()
        {
            $( this ).find( '.line_t' ).stop( true ).animate( { width: "100%" }, 300 )
            $( this ).find( '.line_r' ).stop( true ).animate( { height: "100%" }, 300 )
            $( this ).find( '.line_b' ).stop( true ).animate( { width: "100%" }, 300 )
            $( this ).find( '.line_l' ).stop( true ).animate( { height: "100%" }, 300 )
        }, function()
        {
            $( this ).find( '.line_t' ).stop( true ).animate( { width: "0" }, 300 )
            $( this ).find( '.line_r' ).stop( true ).animate( { height: "0" }, 300 )
            $( this ).find( '.line_b' ).stop( true ).animate( { width: "0" }, 300 )
            $( this ).find( '.line_l' ).stop( true ).animate( { height: "0" }, 300 )
        } )

        var xx = $( '.pro_xx_s>li' ).width();
        var ss = $( '.pro_xx_s>li' ).size();
        var xxx = xx + 13;
        $( '.pro_xx_s_box' ).height( $( '.pro_xximg' ).width() * 680 / 750 - 35 );

        $( '.pro_xx_s' ).height( xx * ss + 10 )

        $( '.pro_xx_next' ).click( function()
        {
            if( n > (ss - 5) )
            {
                $( '.pro_xx_s' ).stop( true ).animate( { top: 0 }, 300 )
                n = 0;
            }
            else
            {
                $( '.pro_xx_s' ).stop( true ).animate( { top: -xxx * (n + 1) }, 300 )
                n++;
            }
        } )

        $( '.pro_xx_prev' ).click( function()
        {
            if( n < 1 )
            {
                $( '.pro_xx_s' ).stop( true ).animate( { top: -(ss - 4) * xxx }, 300 )
                n = ss - 4;
            }
            else
            {
                $( '.pro_xx_s' ).stop( true ).animate( { top: -xxx * (n - 1) }, 300 )
                n--;
            }
        } )

        var lh = $( '.pro_lh' ).height();

        $( '.pro_boton_t ul li' ).hover( function()
        {

            var pin = $( this ).index();

            if( $( '.pro_boton_list' ).eq( pin ).css( "display" ) == "none" )
            {
                $( '.pro_boton_t ul li' ).removeClass( 'pro_lion' );
                $( '.pro_boton_t ul li' ).eq( pin ).addClass( 'pro_lion' );
                $( '.pro_boton_list' ).stop( true, true ).fadeOut( 0 );
                $( '.pro_boton_list' ).eq( pin ).stop( true, true ).fadeIn( 300 );
                $( '.pro_rh' ).css( "min-height", lh );
            }
            else
            {

            }

        }, function()
        {

        } )

        $( '.pro_rot ul li' ).click( function()
        {
            $( '.pro_boton_t ul li' ).removeClass( 'pro_lion' );
            $( '.pro_boton_t ul li' ).eq( 0 ).addClass( 'pro_lion' );
            $( '.pro_boton_list' ).stop( true, true ).fadeOut( 0 );
            $( '.pro_boton_list' ).eq( 0 ).stop( true, true ).fadeIn( 300 );
        } )

    } )

    $(document).on('blur', '.pro_num', function() {
        var num = $( this ).parents( ".pro_inner_zi3" ).find( ".pro_num input" ).val();
        var store = $( this ).parents( ".pro_inner_zi3" ).find( ".kucun" ).html();
        var re =  /^([1-9][0-9]*)$/;
        if(!re.test(num)){
            num = '1';
        }
        if(num > store) {
            num = store;
        }
        $( this ).parents( ".pro_inner_zi3" ).find( ".pro_num input" ).val(num);

    })
    $( '.pro_box_tit1 a' ).click( function()
    {
        var s7 = $( this ).index();
        $( '.pro_box_tit1 a' ).removeClass( 'pro_currt1' );
        $( this ).addClass( 'pro_currt1' );

        $( '.pro_b_a' ).stop( true ).fadeOut( 0 );
        $( '.pro_b_a' ).eq( s7 ).stop( true ).fadeIn( 300 );

    } )

    $( '.chandise h5' ).click( function()
    {
        var p = $( this ).index();
        if( $( this ).hasClass( 'on' ) )
        {

        }
        else
        {
            $( '.chandise h5' ).removeClass( 'on' );
            $( '.chandise h5' ).eq( p ).addClass( 'on' );
            $( '.p_content_list' ).stop( true ).fadeOut( 0 );
            $( '.p_content_list' ).eq( p ).stop( true ).fadeIn( 300 );
            $( ".chandise" ).css( "left", "0" )
        }
    } )

    var clickNumber = 0;
    $( '.pro_sc h5' ).click( function()
    {
        if( clickNumber == 0 )
        {
            $( this ).addClass( "pro_scon" )
            clickNumber = 1;
        }
        else
        {

            $( this ).removeClass( "pro_scon" )
            clickNumber = 0;
        }

    } )

    $( '.pro_inner_zi2 p span' ).click( function()
    {
        $( this ).parent().find( 'span' ).removeClass( 'pro_xz' );
        var id = $( this ).data('id');
        var pid = $( this ).data('pid');
        $('#sku_'+pid).val(id);
        $( this ).addClass( 'pro_xz' );
    } )

    /*****产品详情*****/
    $( window ).load( function()
    {
        $( "html,body" ).animate( { scrollTop: 0 }, 0 )
        var url = window.location.toString();
        var id = url.split( "#" )[ 1 ];

        if( id )
        {
            var t = $( "#" + id ).offset().top;
            $( "html,body" ).animate( { scrollTop: t - 50 }, 1000 )
        }

        $( 'a' ).click( function()
        {
            var a = $( this ).attr( "href" ).split( "#" )[ 1 ];
            var p = $( "#" + a ).offset().top;
            $( "html,body" ).animate( { scrollTop: p - 50 }, 1000 );
        } )

    } )

// 元素以及其他一些变量
    var eleFlyElement = document.querySelector( "#flyItem" ), eleShopCart = document.querySelector( "#shopCart" );
    var numberItem = 0;
// 抛物线运动
    var myParabola = funParabola( eleFlyElement, eleShopCart, {
        speed: 400, //抛物线速度
        curvature: 0.0008, //控制抛物线弧度
        complete: function()
        {
            eleFlyElement.style.visibility = "hidden";
            eleShopCart.querySelector( "span" ).innerHTML = ++numberItem;
        }
    } );
// 绑定点击事件
    if( eleFlyElement && eleShopCart )
    {

        [].slice.call( document.getElementsByClassName( "btnCart" ) ).forEach( function( button )
        {
            button.addEventListener( "click", function( event )
            {
                var src = $( this ).parents( ".pro_inner_con" ).find( ".pro_xx_son img" ).attr( "src" );
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

    // 加入购物
    $('.addcart').click(function(){
        var user_id = $('#user_id').val();
        if(user_id) {
            var nums=$('.nums').val();
            var kucun = parseInt($('.store').val());
            var sku_id = '';
            var goodsid = $('#goods_id').val();
            $(".sku_id").each(function(){
                sku_id += $(this).val()+',';
            });
            if (sku_id.length > 0) {
                sku_id = sku_id.substr(0, sku_id.length - 1);
            }

            var is_sku=$('#is_sku').val();
            if(!is_sku){
                sku_id=0;
            }
            if(is_sku && sku_id==0){
              
                alert('请选择正确的商品!');
                return false;
            }
            var url = $('#url').val();
            $.ajax({
                url:url,
                type:'post',
                data:{'goodsid':goodsid,'skuid':sku_id,'nums':nums},
                dataType:'json',
                cache:false,
                success:function(ret){
                    $("#JS_cart_num").html(ret.nums)
                    alert(ret['info']);
                }
            })
        } else {
            window.location.href="{:U('Shop/User/login',array('nowurl'=>$url))}"
        }

    })



