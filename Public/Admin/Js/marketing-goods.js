/***营销产品第二版***/
$(document).ready(function(){
    /***取消弹框S***/
    $(".cancle").click(function(){
        $('.jbox').hide();
        $('#albums-overlay').hide();
    });
    /***取消弹框E***/
    
    /***商品搜索S***/
    $(".content-right .search_goods").click(function(){
        $(".select-goods .select-goods-li").html('');
        var goods_keystr     = $.trim($(this).parent().find("input[name=search_goods_title]").val());
        var goods_isactivity = parseInt($(this).parent().find("input[name='search_goods_isactivity']").val());
        goods_isactivity     = goods_isactivity ? goods_isactivity : 1;
        if(goods_keystr.length > 1){
            var isactivity = parseInt($("input[name='addisactivity']").val());  console.log(isactivity);
            switch(isactivity){
                case 2:                                                         //团购
                    var controller = 'Tuangoods';
                break;
                case 3:
                    var controller = 'Discountgoods';                           //折扣
                break;
                case 4:
                    var controller = 'Bargaingoods';                            //砍价
                break;
                default:                                                        //秒杀
                    var controller = 'Spikegoods';
                break;
            }
            console.log(controller);
            var data = {action:'add_serch_goods',goods_keystr:goods_keystr,goods_isactivity:goods_isactivity};
            $.post('/Admin/Spikegoods/actionDo',data,function(g){
                console.log(g);
                if(g.status==1){
                    var html = '';
                    $.each(g.info,function(k,v){
                        html +='<li class="li"><u><a href="/Admin/'+controller+'/addedit/malltype/3/goodsid/'+v.goodsid+'">【'+v.goodsid+'】'+v.goods_name+'</a></u></li>';
                    });
                    $(".select-goods .select-goods-li").html(html);
                    $("#albums-overlay").show();
                    $(".select-goods").show();
                }else{
                    dialog.showTips(g.info,'warn');return false;
                }
            },'json');
        }else{
            dialog.showTips('请填写搜索商品标题','warn');  return false;
        }
    });
    /***商品搜索E***/
    
});