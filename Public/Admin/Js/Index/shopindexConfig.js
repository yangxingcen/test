/**
 * Created by Administrator on 2017/12/13 0013.
 */

/*确认提交 1*/
function J_Confirm(obj) {
    var data = $("#web_config_form").serialize();
    $.post('/Admin/Index/shopindexConfig', data, function (res) {
        if (res['status']) {
            dialog.showTips(res.info, "warn", function () {
                window.location.reload();
            });
        } else {
            dialog.showTips(res.info, "warn");
        }
    })
}
/*确认提交 2*/