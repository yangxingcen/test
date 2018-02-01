/***秒杀商品添加修改S***/

/*商品分类E*/
function cates(){
    var str = '';
    for(var i=1;i<6;i++){
        var temp= getCates(i);
        if(temp){
            if(i==1){
                str = temp;
            }else{
                str =str +","+ temp;
            }
        }
    }
    return str;
}
function getCates(id){
    id = id ? id : 1;
    var oneid   = parseInt($(".subclass"+id+" select[name='one']").find('option:selected').attr('value'));
    var twoid   = parseInt($(".subclass"+id+" select[name='two']").find('option:selected').attr('value'));
    var threeid = parseInt($(".subclass"+id+" select[name='three']").find('option:selected').attr('value'));
    if(oneid && twoid && threeid){
        return "-"+oneid+"-"+twoid+"-"+threeid+"-";
    }
    return "";
}
/*商品分类E*/


/***获取批发价格S***/
function get_pifa_price() {
    var param = {};
    var r = true;
    $("input[name='pifa_num']").each(function(index,element){
        var pifa_num = $(this).val();
        if(pifa_num == ''){
            r=false;
            dialog.showTips('购买件数有为空的','warn');return false;
        }
        var pifa_price = $("input[name='pifa_price']").eq(index).val();
        if(pifa_price == ''){
            r=false;
            dialog.showTips('商品单价有为空的','warn');return false;
        }
        param[index] = pifa_num+"-"+pifa_price;
    })
    if(!r){
        return false;
    }
    return param;
}
/***获取批发价格E***/

/***获取商品轮播图S***/
function get_many_pic() {
    var detailpic = '';
    $("input[name^='detailpic']").each(function(){
        var value = $.trim($(this).val());
        if(value.length > 5){
            detailpic += value + ',';
        }
    });
    if(detailpic){
        detailpic = detailpic.substring(0,detailpic.length-1);
    }
    return detailpic;
}
/***获取商品轮播图E***/

/***获取自定义标签S***/
function get_tagid() {
    var tagid = '';
    $("#select_tag_list li").each(function(){
        var value = $(this).attr('data-id');
        tagid += value + ',';
    })
    tagid = tagid.substring(0,tagid.length-1);
    return tagid;
}
/***获取自定义标签E***/

/***获取商品参数S***/
function get_goods_param() {
    var param = {};
    $("input[name='param_name']").each(function(index,element){
        var param_name = $(this).val();
        if(param_name.length > 1){
            var param_val = $("input[name='param_val']").eq(index).val();
            if(param_val.length > 1){
                param[index] = param_name+"-"+param_val;
            }
        }
    })
    return param ? param : '';
}
/***获取商品参数E***/

/***获取会员等级购买权限S***/
function get_member_grade() {
    var mid = "";
    $("input[name='buy_grade_power']:checked").each(function(){
        var value = $.trim($(this).val());
        if(value){
            mid += value + ',';
        }
    })
    if(mid){
        mid = mid.substring(0,mid.length-1);
    }
    return mid;
}
/***获取会员等级购买权限E***/
/***获取会员折扣S***/
function get_member_zhekou() {
    var param={},info=0;
    $("input[name='member_grade']").each(function(index,element){
        var member_grade = $(this).val();
        var buy_grade_zhekou = $("input[name='buy_grade_zhekou']").eq(index).val();
        var buy_grade_money  = $("input[name='buy_grade_money']").eq(index).val();
        if(buy_grade_money || buy_grade_zhekou){
            param[member_grade] = buy_grade_zhekou+"-"+buy_grade_money;
        }else{
            info = 1;
        }
    });
    return {param:param,info:info};
}
/***获取会员折扣E***/

/***分销佣金设置S***/
function get_fenxiao_set() {
    var param = {};
    $("input[name='fenxiao_grade']").each(function(index,element){
        var fenxiao_grade = $(this).attr("data-id");
        var one_level = $("input[name='one_level']").eq(index).val();
        var two_level = $("input[name='two_level']").eq(index).val();
        if(one_level || two_level){
            param[fenxiao_grade] = one_level+"-"+two_level;
        }
    })
    return param;
}
/***分销佣金设置E***/

/***获取skuidarrS***/
function get_sku_idarr() {
    var data = new Array();
    var i=0;
    $("input[name='skulist[]']").each(function(x){
        var id = parseInt($(this).attr('data-attrskuid'));
        if(id > 0){
            data.push(id);
        }
    });
    return data;
}
/***获取skuidarrE***/

/***获取sku列表E***/
/***组装规格属性S***/
function make_sku_to_arr(){
    var _point = $("#process tbody tr");
    if(_point.length){
        var skuarr = new Array();
        var title  = '';
        _point.each(function(x){
            var skuidstr  = $.trim($(this).find("input[name='skulist[]']").attr('data-idstr'));
            var skulistid = parseInt($(this).find("input[name='skulist[]']").attr('data-attrskuid'));
            var oprice    = parseFloat($(this).find(".Txt_OPrice").val());
            var price     = parseFloat($(this).find(".Txt_Price").val());
            var fprice    = parseFloat($(this).find(".Txt_FPrice").val());
            var num       = parseInt($(this).find(".Txt_Store").val());
            var number    = $.trim($(this).find(".Txt_Number").val());
            var pic       = $.trim($(this).find('img').attr('src'));
            var arr       = {};
                arr['skulistid'] = skulistid ? skulistid : 0;
                arr['oprice']    = oprice ? oprice : 0;
                arr['fprice']    = fprice ? fprice : 0;
                arr['pic']       = pic ? pic : '';
            var j=x+1;
            if(skuidstr){
                arr['skuidstr'] = skuidstr;
            }else{
                title ='SKU属性第'+j+'行ID丢失,请刷新重试';
                return false;
            }
            if(price > 0){
                arr['price'] = price;
            }else{
                title ='SKU属性第'+j+'行请填写商品售价';
                return false;
            }
            if(num > 0){
                arr['num'] = num;
            }else{
                title ='SKU属性第'+j+'行请填写商品库存';
                return false;
            }
            if(number){
                arr['number'] = number;
            }else{
                title ='SKU属性第'+j+'行请填写商品编码';
                return false;
            }
            skuarr.push(arr);
            title='';
        });
        if(title){
            dialog.showTips(title,'warn');return false;
        }else{
            return skuarr;
        }
    }else{
        dialog.showTips("SKU属性错误",'warn');return false;
    }
}
/***组装规格属性S***/

/***获取秒杀时间点S***/
function get_miaosha_time(){
    var id = '-';
    $("input[name='miaosha_time']:checked").each(function(){
        id += $(this).val()+'-';
    })
    return id;
}
/***获取秒杀时间点E***/
