/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*折叠 1*/
$(document).ready(function(){
    $(".cate").click(function(){
        var _pid    = parseInt($(this).attr('data-id'));
        var _open   = parseInt($(this).attr('data-open'));
        var _parent = $(this).parent().parent();
        if(_pid){
            _open   = _open ? 0 : 1;
            $(this).attr('data-open',_open);
            var txt = _open ? '-' : '+';
            $(this).find("span").text(txt)
            _parent.find("tr[class^='subcate_"+_pid+"_']").toggle();
        }
    });
});
/*折叠 2*/


/*确认提交 1*/
function J_Confirm(obj) {
    var classname  = $('input[name=classname]').val();
    if (!classname) {
        alert("分类名称不能为空！");
        return false;
    }
    var post =$("#Form_one").serialize();
    $.post('/Admin/Goodscate/goodsCateAdd', post, function (res) {
        if (res.status == 1) {
            dialog.showTips(res.info, '', 1);
            return false;
        } else {
            dialog.showTips(res.info, 'warn');
            return false;
        }
    }, "json");
}
/*确认提交 2*/



/*编辑弹框 1*/
function J_Edit(obj) {
    $('input[name=id]').val($(obj).attr('data-id'));
    $('select[name=pid]').val($(obj).attr('data-pid'));
    $("input[name=is_tui][value='" + $(obj).attr('data-is_tui') + "']").prop("checked", "checked");
    $('input[name=classname]').val($(obj).attr('data-classname'));
    $('.images').find('img').attr('src',$(obj).attr("data-pic"));
    $('input[name=pic]').val($(obj).attr("data-pic"));
    $('.pic_s').find('img').attr('src',$(obj).attr("data-pic_s"));
    $('input[name=pic_s]').val($(obj).attr("data-pic_s"));
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
            url: '/Admin/Goodscate/goodsCateDel',
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



