/**
 * Created by Administrator on 2017/12/13 0013.
 */


/*确认提交 1*/
function J_Confirm(obj) {
    var data = $("#Form_one").serialize();
    $.post('/Admin/Activity/activityConfigInfo', data, function (res) {
        if (res['status']) {
            dialog.showTips(res.info, "warn", function () {
                window.location.reload();
            });
        } else {
            dialog.showTips(res.info, "warn");
        }
    })
}
/*奖品配置确认提交 2*/

    function J_Confirm_prize() {

    $.ajax({
        type:"POST",
        url:"/Admin/Activity/activityConfigInfo_prize",
        data:$("#Form_two").serialize(),
        cache:false,
        async:false,
        dataType:"json",
        beforeSend:function(){
            //防止重复提交
        },
        success:function(res){
            if (res['status']) {

                dialog.showTips(res.info, "","1");
            } else {

                dialog.showTips(res.info, "warn");
            }

        },
        error: function(){

        }
    })
}





/*添加参数 1*/
function J_add_param(obj){
    var str='';
    var length=$(".jiang").length;
    var num = get_daxie(length);
    var num_shu = get_shuzi(length);
    str='<div class="panel-single jiang">'+
        '<a href="javascript:;" class="btn btn-danger btn-mini" style="float: right" onclick="J_del_param(this)" title="删除"><i class="gicon-minus white"></i></a>'+
        '<div class="formitems">'+
        '<label class="fi-name"><span class="colorRed">*</span>奖项'+num+'：</label>'+
        '   <input name="ben_id[]" value="" type="hidden">'+

        '<div class="form-controls">'+
        '<input type="text" class="input mini" name="percent[]" value="" placeholder="中奖百分比">%'+
        '</div>'+
        '</div>'+
        '<div class="formitems">'+
        '<label class="fi-name"><span class="colorRed">*</span>奖品：</label>'+
        '<div class="form-controls">'+
        '<div class="radio-group">'+
        '<label><input type="radio" name="type['+num_shu+']" value="1" checked>优惠券</label>'+
        ' '+
        '<label><input type="radio" name="type['+num_shu+']" value="2">积分</label><input type="hidden" name="jiang_id[]"value="'+num_shu+'">'+
        '<label><input type="radio" name="type['+num_shu+']" value="3">积分商品</label>'+
        '<label><input type="radio" name="type['+num_shu+']" value="4">未中奖</label>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '<div class="formitems">'+
        '<label class="fi-name"><span class="colorRed">*</span>参数：</label>'+
        '<div class="form-controls">'+
        '<input type="text" class="input mini fl" name="param[]" value="" >'+
        '<span class="fi-help-text">请填写：优惠券面额/积分值/积分商品ID</span>'+
        '</div>'+
        '</div>'+
        '</div>';
    $('.jiangxiang:last').append(str);
}
/*添加参数 2*/

function get_daxie(a) {
    var str;
    switch (a) {
        case 1:
            str = "二";
            break;
        case 2:
            str = "三";
            break;
        case 3:
            str = "四";
            break;
        case 4:
            str = "五";
            break;
        case 5:
            str = "六";
            break;
        case 6:
            str = "七";
            break;
        case 7:
            str = "八";
            break;
        default:
            str = "";
    }
    return str;
}

function get_shuzi(a) {
    var str;
    switch (a) {
        case 1:
            str = "1";
            break;
        case 2:
            str = "2";
            break;
        case 3:
            str = "3";
            break;
        case 4:
            str = "4";
            break;
        case 5:
            str = "5";
            break;
        case 6:
            str = "6";
            break;
        case 7:
            str = "7";
            break;
        default:
            str = "";
    }
    return str;
}


function J_del_param(obj){
        // alert(111);
    $(obj).parents('.jiang').remove();
}

/*删除数据
 */
function  J_del_del(id) {


    $.ajax({
        type:"POST",
        url:"/Admin/Activity/activityConfigInfo_prize_del",
        data:"id="+id,
        cache:false,
        async:false,
        dataType:"json",
        beforeSend:function(){
            //防止重复提交
        },
        success:function(res){
            if (res['status']) {
                dialog.showTips(res.info, "","1");
            } else {
                dialog.showTips(res.info, "warn");
            }

        },
        error: function(){

        }
    })

}

