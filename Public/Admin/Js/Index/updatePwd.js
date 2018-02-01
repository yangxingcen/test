/**
 * Created by Administrator on 2017/12/13 0013.
 */
function J_Submit(obj) {
    var post ={};
    post.password    = $('input[name=password]').val();
    post.re_password = $('input[name=re_password]').val();
    if (!post.password || !post.re_password) {
        dialog.showTips('请输入密码','warn');
        return false;
    }
    if (post.password != post.re_password) {
        dialog.showTips('两次密码不一致','warn');
        return false;
    }
    $.post('/Admin/Index/updatePwd', post, function (res) {
        if (res.status) {
            dialog.showTips(res.info, "", res.url);
        }
        dialog.showTips(res.info, "warn");
    }, "json")

}