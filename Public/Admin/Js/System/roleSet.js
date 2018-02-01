/**
 * Created by Administrator on 2017/12/13 0013.
 */
$(".check-all").click(function () {
    $("input[type=checkbox]").prop("checked", $("input[type=checkbox]").prop("checked") ^ 1);
})

/*确认提交 1*/
function J_Submit(obj) {
    var post={};
    post.id = $(obj).attr('data-id');
    var str = "";
    $("input[type=checkbox]:checked").each(function (i) {
        str += $(this).val() + ",";
    })
    post.ids =str;
    $.post('/Admin/System/roleSet', post, function (res) {
        if (res.status) {
            dialog.showTips(res.info, "", res.url);
        }
        dialog.showTips(res.info, "warn");
    }, "json")
}
/*确认提交 2*/


$(".wxtables input[type=checkbox]").click(function () {
    var that = $(this);
    setTimeout(function () {
        var id = that.val();
        var status = that.prop("checked");
        $("input[type=checkbox][data-pid=" + id + "]").prop("checked", status);
        $("input[type=checkbox][data-pid2=" + id + "]").prop("checked", status);
        $("input[type=checkbox][data-pid3=" + id + "]").prop("checked", status);
    }, 0)
})