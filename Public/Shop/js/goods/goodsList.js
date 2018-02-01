/**
 * Created by Administrator on 2017/12/20 0020.
 */

function J_getSon(obj){
    var id = $(obj).attr('data-id');
    var goodscate = J_goods_cate[id];
    if(goodscate){
        var str ='<i class="cate xilie">产品系列：</i> <span  class="s_series" data-id="">全部</span>';
        $.each(goodscate,function(key,value){
            str +='<span class="s_series"  data-id="'+value.id+'">'+value.classname+'</span>'
        })
    }
    var p_goodscate = J_goods_cate[0][id]['price_arr'];
    if(p_goodscate){
        var p_str='<i class="cate xilie">产品价格：</i> <span class="s_price" data-id="">全部</span>';
        $.each(p_goodscate,function(key,value){
            p_str +='<span class="s_price" >'+value[0]+'-'+value[1]+'</span>'
        })
    }

    $('.c_xilie').show().empty().html(str);
    $('.c_jiage').show().empty().html(p_str);
    str='';
    p_str='';

    $('.s_series').click(function(){
        $(this).css('color','#e50011').addClass('series_active');
        $(this).siblings().css('color','').removeClass('series_active');
        select();
    })

    $('.s_price').click(function(){
        $(this).css('color','#e50011').addClass('price_active');
        $(this).siblings().css('color','').removeClass('price_active');
        select();
    })

}




/*综合*/
$('.zonghe').click(function(){
    window.location.href='/goodslist.html';
})
/*时间*/
$('.shijian').click(function(){
    var sj = $(this).attr('data-val');
    if(!sj){
        sj=1;
    }else if(sj==1){
        sj=2
    }else if(sj==2){
        sj=1;
    }
    window.location.href='/goodslist.html?sj='+sj;
})
/*价格*/
$('.jiage').click(function(){
    var jg = $(this).attr('data-val');
    if(!jg){
        jg=1;
    }else if(jg==1){
        jg=2
    }else if(jg==2){
        jg=1;
    }
    window.location.href='/goodslist.html?jg='+jg;
})

/*分类*/
$('.s_cate').click(function(){
    $(this).css('color','#e50011').addClass('cate_active');
    $(this).siblings().css('color','').removeClass('cate_active');
    select();
})

/**/

function select(){
    var post={};
    post.cate   =$('.cate_active').attr('data-id');
    post.series =$('.series_active').attr('data-id');
    post.price  =$('.price_active').html();
    post.p      =$('.current').html();
    if(post.price=='全部'){
        post.price='';
    }
    $.post('/Shop/Goods/goodsList', post, function (res) {

        if (res['status']) {
            $('.clm6').empty().append(res.data[0]);
            $('.pro_page').empty().append(res.data[1]);
            $('.s_page').click(function(){
                $(this).css('color','#e50011').addClass('current');
                $(this).siblings().css('color','').removeClass('current');
                select();
            })
        } else {
            dialog.showTips(res.info, "warn");
        }
    })
}