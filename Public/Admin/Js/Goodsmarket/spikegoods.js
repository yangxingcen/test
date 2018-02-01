/**
 * Created by Administrator on 2017/12/22 0022.
 */
/*秒杀配置按钮 1*/
function J_Config(obj){
    $('input[name=id]').val($(obj).attr('data-id'));
    if($(obj).attr('data-promotion_label')) {
        $('input[name=limited_time]').val($(obj).attr('data-limited_time'));
        $('input[name=promotion_label]').val($(obj).attr('data-promotion_label'));
        $('input[name=is_preference][value="' + $(obj).attr('data-is_preference') + '"]').prop("checked", "checked")

    }
    $('#albums-overlay').show();
    $('.config').show();
}
/*秒杀配置按钮 2*/



/*确认限时特惠配置 1*/
function J_Submit_Config(obj){
    var post ={};
    post.id                 = $('input[name=id]').val();
    post.isactivity         = $('input[name=isactivity]').val();
    post.limited_time       = $('input[name=limited_time]').val();
    post.promotion_label    = $('input[name=promotion_label]').val();
    post.is_preference      = $('input[name=is_preference]:checked').val();
    var s=1;
    $.each(post,function(key,value){
        console.log(value);
        if(!value){
            s=2;return;
        }
    })
    if(s==2){
        alert('参数请填写完整');return false;
    }
    console.log(post);
    $(".loader" ).fadeIn("fast");
    $.post("/Admin/Goodsmarket/goodsMarketConfig", post, function (res) {
        $(".loader" ).fadeOut("fast");
        if (res.status == 1) {
            dialog.showTips(res.info,'',1);
            return false;
        }
        dialog.showTips(res.info,'warn');
        return false;
    }, "json")

}
/*确认限时特惠配置 2*/