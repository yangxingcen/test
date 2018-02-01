/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*确认提交 1*/
function J_Confirm(obj) {
    var id       = $('input[name=id]').val();
    var type     = $('.type').val();
    var pic      = $('input[name=pic]').val();
    if (type == '') {
        dialog.showTips("请选择分类", "warn");
        return false;
    }
    if (pic == '') {
        dialog.showTips("请上传图片", "warn");
        return false;
    }

    var post =$('#Form_one').serialize();
    $.ajax({
        url: '/Admin/Banner/bannerAdd',
        type: "post",
        dataType: "json",
        data: post,
    }).done(function (res) {
        if (res.status == 1) {
            dialog.showTips(res.info, "", 1);
            return false;
        } else {
            dialog.showTips(res.info, "warn");
            return false;
        }
    })
}
/*确认提交 2*/


/*编辑按钮 1*/
function J_Edit(obj) {
    $('input[name=id]').val($(obj).attr("data-id"));
    $('.type').val($(obj).attr("data-type"));
    $('input[name=title]').val($(obj).attr("data-title"));
    $('input[name=param]').val($(obj).attr("data-param"));
    $('input[name=sorts]').val($(obj).attr("data-sorts"));
    $('.images').find('img').attr('src',$(obj).attr("data-pic"));
    $('input[name=pic]').val($(obj).attr("data-pic"));
    $('.addfenlei').show();
    $('#albums-overlay').show();
}
/*编辑按钮 2*/


/*更新状态 删除 1*/
function J_Change(obj) {
    var post  = {};
    post.id   = $(obj).attr("data-id");
    post.item = $(obj).attr("data-item");
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        $.ajax({
            url: '/Admin/Banner/bannerDel',
            type: "post",
            dataType: "json",
            data: post,
        }).done(function (res) {
            if (res.status == 1) {
                dialog.showTips(res.info, "", 1);
                return false;
            } else {
                dialog.showTips(res.info, "warn");
                return false;
            }
        })
    })
}
/*更新状态 删除 2*/