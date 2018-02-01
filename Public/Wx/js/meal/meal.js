/**
 * Created by Administrator on 2017/12/23 0023.
 */




$(function () {
    var curr = new Date().getFullYear();
    var opt = {
        'default': {
            theme: 'default',
            mode: 'scroller',
            display: 'modal',
            animate: 'fade'
        },
        'select': {
            preset: 'select'
        },
        'select-opt': {
            preset: 'select',
            group: true,
            width: 50
        }
    }
    $('.demo-test-select').scroller($.extend(opt['select'],opt['default']));
});


/*分类滚动 1*/
var mySwiperNav = new Swiper( '.swiper-container-nav', {
    autoplay: 4000,
    slidesPerView: 4,
    speed: 300,
    autoplayDisableOnInteraction: false,
    grabCursor: true,
    paginationClickable: true
} )
$( document ).ready( function()
{

    var clickNumber = 0;
    $( '.pro_share_rig' ).click( function()
    {
        if( clickNumber == 0 )
        {
            $( this ).find( ".message" ).fadeIn();
            clickNumber = 1;
        }
        else
        {

            $( this ).find( ".message" ).fadeOut();
            clickNumber = 0;
        }

    } )

} )

/*分类滚动 2*/

/*推荐 1*/
$('.groom').click(function(){
    window.location.href=window.location.protocol+'//'+window.location.host+'/wx_meal.html?is_groom=1';
})
/*推荐 2*/

/*人气 1*/
$('.rq').click(function(){
    var value= $(this).attr('data-value');
    if(!value){
        value=0;
    }
    window.location.href=window.location.protocol+'//'+window.location.host+'/wx_meal.html?is_rq='+value;
})
/*人气 2*/

/*人气 1*/
$('.jg').click(function(){
    var value= $(this).attr('data-value');
    if(!value){
        value=0;
    }
    window.location.href=window.location.protocol+'//'+window.location.host+'/wx_meal.html?jg='+value;
})
/*人气 2*/

$('.dwb0 ').click(function (){
    console.log(121);

})