//获取分类的积分区间和已选条件
function all_price(id,title){
    if(id){
        var a = $("#"+id);
        a.css('color','#e50011');
        a.siblings().css('color','');
        $.ajax({
        url: "/shop/integral/all_price",
        type: "post",
        dataType: "json",
        data: {
            id: id,
        }
        }).done(function (res) {
            //积分区间
            $("#all_price").children().remove();
            var html = '';
            html+= '<span onclick="type_price();" calss="all_p" style="color:#e50011;">全部</span>';
           for (var i = 0; i < res.length; i++) {
                html+= '<span  onclick="type_price(id,title);" id="'+res[i]['id']+'" title="'+res[i]['price']+'">'+res[i]['price']+'</span>';
           }

           $("#all_price").append(html);
           $("#all_price").show();
           //已选条件
           var choose = '';
           $("#choose").children().remove();
           choose+='<span style="color:red;" onclick="all_choose(this);" id="'+id+'" name="type" data-title="type">'+title+'</span>'
           $("#choose").append(choose);
           all_choose(this);
           
        })
    }else{
        var a= $("#all_type_price").find("span").first();
        a.css('color','#e50011');
        a.siblings().css('color','');
        $("#all_price").hide();
        $("#choose").children().remove();
        all_choose();
    }  
}
function type_price(id,title){
    if(id){
        var a = $("#"+id);
        // a.slibing().css('color','red');
        a.css('color','#e50011');
        a.siblings().css('color','');
        $("span[name='price']").remove();
        var choose = '';
        choose+='<span style="color:red;"  onclick="all_choose(this);" name="price" title="'+title+'" data-title="price">'+title+'</span>'
        $("#choose").append(choose);
        all_choose(this);
    }else{
        var a= $("#all_price").find("span").first();
        a.css('color','#e50011');
        a.siblings().css('color','');
        $("span[name='price']").remove();
        all_choose();
    }
    
}
//获取商品
$(document).ready(function(){ 
    var cate = $("#s_cate_id").val();
    $.ajax({
        url: "/shop/integral/goods_list",
        type: "post",
        dataType: "json",
        data: {
		'cate' : cate
        }
        }).done(function (res) {
            var html= '';
            for (var i = 0; i < res['res'].length; i++) {
                html += '<div class="col-sm-3">';
                html += '<a href="/integral_del.html?id='+res['res'][i].id+'">';
                html += '<div class="lation">';
                html += '<div class="line_one"></div>';
                html += '<div class="lation_img">';
                html += '<img src="'+res['res'][i].logo_pic+'" width="100%" height="244px">';
                html += '</div>';
                html += '<div class="lation_txt">';
                html += '<h5>'+res['res'][i].goods_name+'</h5>';
                html += '<p class="clearfix">';
                html += '<span>'+res['res'][i].price+'积分</span>';
                html += '<i>'+res['res'][i].volume+'人已兑换</i>';
                html += '</p>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</div>';
            }
            $("#integral_goods").html(html);
            //分页
            var num = '';
            num += '<a href="javascript:;" onclick="all_choose(this);" name="all_page" data-page="1">首页</a>';
            for (var i = 1; i <= res['num']; i++) {
                if(i==1){
                    num += '<a class="current" href="javascript:;" class="num" onclick="all_choose(this);" name="all_page" data-page="'+i+'">'+i+'</a>';
                }else{
                    num += '<a href="javascript:;" onclick="all_choose(this);" name="all_page" data-page="'+i+'">'+i+'</a>';
                }
                
            }
            num += '<a href="javascript:;" class="num" onclick="all_choose(this);" name="all_page" data-page="'+res['num']+'">尾页</a>';
            if(res['num']>1){
                $("#page_num").append(num);
            }
            
            // all_choose();

        })
    
});
function all_choose(obj){
    $(obj).css('color','#e50011');
    $(obj).siblings().css('color','');
    var post={};
    var page = $(obj).attr('data-page');    
    var sorts = $(obj).attr('data-title');
    
    if(page){
        post.page = page;
    }

    var price_arr = $("span[name='price']");
    var type_arr = $("span[name='type']");
    if(type_arr){
        post.typeid = type_arr.attr('id');
    }
    if(price_arr){
        post.price = price_arr.attr('title');
        post.data = price_arr.attr('data-title');
        post.sorts = sorts;
    }
    $.ajax({
        url: "/shop/integral/goods_list",
        type: "post",
        dataType: "json",
        data: {
            'post':post
        }
        }).done(function (res) {
            if(res['sorts'] == '按积分'){
                $("#where_price").attr('data-title','按积分1')
            }else if(res['sorts'] == '按积分1'){
                 $("#where_price").attr('data-title','按积分')
            }else if(res['sorts'] == '按时间'){
                 $("#where_time").attr('data-title','按时间1')
            }else{
                $("#where_time").attr('data-title','按时间')
            }
            // $("#where_price").attr('data-title',);
            $("#integral_goods").empty();
            var html= '';
            for (var i = 0; i < res['res'].length; i++) {
                html += '<div class="col-sm-3">';
                html += '<a href="/integral_del.html?id='+res['res'][i].id+'">';
                html += '<div class="lation">';
                html += '<div class="line_one"></div>';
                html += '<div class="lation_img">';
                html += '<img src="'+res['res'][i].logo_pic+'" width="100%" height="244px">';
                html += '</div>';
                html += '<div class="lation_txt">';
                html += '<h5>'+res['res'][i].goods_name+'</h5>';
                html += '<p class="clearfix">';
                html += '<span>'+res['res'][i].price+'积分</span>';
                html += '<i>'+res['res'][i].volume+'人已兑换</i>';
                html += '</p>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</div>';
            }
            $("#integral_goods").html(html);
            //分页
            $("#page_num").empty();
            var num = '';
            num += '<a href="javascript:;"  onclick="all_choose(this);" name="all_page" data-page="1">首页</a>';
            for (var i = 1; i <= res['num']; i++) {
                if(page == i){
                    num += '<a class="current" href="javascript:;"  onclick="all_choose(this);" name="all_page" data-page="'+i+'">'+i+'</a>';
                }else{
                    num += '<a  href="javascript:;"   onclick="all_choose(this);" name="all_page" data-page="'+i+'">'+i+'</a>';
                }
                
            }
            num += '<a href="javascript:;" onclick="all_choose(this);" name="all_page" data-page="'+res['num']+'">尾页</a>';

            if(res['num']>1){
                $("#page_num").append(num);
            }
        })
}