/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*确认提交 1*/
function J_Confirm(obj) {
    var post     = {};
    post.id       = $('input[name=id]').val();
    post.per_name = $('input[name=per_name]').val();
    if (post.per_name == '') {
        alert("角色名称不能为空！");
        return false;
    }
    $.ajax({
        url: '/Admin/System/addRole',
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
    $('input[name=per_name]').val($(obj).attr('data-per_name'));
    $('input[name=id]').val($(obj).attr('data-id'));
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
            url: '/Admin/System/delRole',
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