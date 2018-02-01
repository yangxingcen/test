/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*确认提交 1*/
function J_Confirm(obj) {
    var post     = {};
    post.id       = $('input[name=id]').val();
    post.classname = $('input[name=classname]').val();
    post.sorts = $('input[name=sorts]').val();
    if (post.classname == '') {
        alert("名称不能为空！");
        return false;
    }
    $.ajax({
        url: '/Admin/Banner/bannerTypeAdd',
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


/*编辑弹框 1*/
function J_Edit(obj) {
    $('input[name=id]').val($(obj).attr('data-id'));
    $('input[name=classname]').val($(obj).attr('data-classname'));
    $('input[name=sorts]').val($(obj).attr('data-sorts'));
    $('.addfenlei').show();
    $('#albums-overlay').show();
}
/*编辑弹框 1*/

/*更新状态 删除 1*/
function J_Change(obj) {
    var post  = {};
    post.id   = $(obj).attr("data-id");
    post.item = $(obj).attr("data-item");
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        $.ajax({
            url: '/Admin/Banner/bannerTypeDel',
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