/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*确认提交 1*/
function J_Confirm(obj) {
    var id       = $('input[name=id]').val();
    var username = $('input[name=username]').val();
    var password = $('input[name=password]').val();
    var cate     = $('.cate').val();
    if (username == '') {
        $('.username').focus();
        dialog.showTips("请填写帐号", "warn");
        return false;
    }
    if(!id){
        if (password == '') {
            $('.password').focus();
            dialog.showTips("请填写密码", "warn");
            return false;
        }
    }
    var post =$('#Form_one').serialize();
    $.ajax({
        url: '/Admin/System/addAdmin',
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
    console.log($(obj).attr("data-info"));
    $('.addfenlei').show();
    $('#albums-overlay').show();
    $('input[name=username]').val($(obj).attr('data-username'));
    $('input[name=id]').val($(obj).attr('data-id'));
    $('.cate').val($(obj).attr('data-cate'));
}
/*编辑弹框 1*/

/*更新状态 删除 1*/
function J_Change(obj) {
    var post ={};
    post.id = $(obj).attr("data-id");
    post.item = $(obj).attr("data-item");
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        $.ajax({
            url: '/Admin/System/ableAdmin',
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