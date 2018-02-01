/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*添加 按钮  1*/
function J_Add(obj) {
    $("input[name=pid]").val($(obj).attr("data-id"));
    $('.addfenlei').show();
    $('#albums-overlay').show();
}
/*添加 按钮  2*/


/*编辑按钮 1*/
function J_Edit(obj) {
    $('input[name=id]').val($(obj).attr("data-id"));
    $('input[name=classname]').val($(obj).attr("data-classname"));
    $('input[name=controller]').val($(obj).attr("data-controller"));
    $('input[name=action]').val($(obj).attr("data-action"));
    $('input[name=sorts]').val($(obj).attr("data-sorts"));
    $('.addfenlei').show();
    $('#albums-overlay').show();
}
/*编辑按钮 2*/



/*确认提交 1*/
function J_Confirm(obj) {
    var post = {};
    post.id         = $('input[name=id]').val();
    post.pid        = $('input[name=pid]').val();
    post.classname  = $('input[name=classname]').val();
    post.sorts       = $('input[name=sorts]').val();
    post.controller = $('input[name=controller]').val();
    post.action     = $('input[name=action]').val();
    if (post.classname == '') {
        alert("节点名称不能为空！");
        $('.classname').focus();
        return false;
    }
    if (post.controller == '') {
        alert("控制器名不能为空！");
        $('.controller').focus();
        return false;
    }
    if (post.action == '') {
        alert("方法名不能为空！");
        $('.action').focus();
        return false;
    }

    $.ajax({
        url: '/Admin/System/addNode',
        type: "post",
        dataType: "json",
        data: post
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


/*更新状态 删除 1*/
function J_Change(obj) {
    var post  = {};
    post.id   = $(obj).attr("data-id");
    post.item = $(obj).attr("data-item");
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        $.ajax({
            url: '/Admin/System/delNode',
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