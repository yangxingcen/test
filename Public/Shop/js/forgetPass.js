$(function () {
    $("#reg").click(doreg)
    $("#form").submit(doreg);
    function doreg() {
        var post = {};
        post.telephone = $(".telephone").val();
        post.password = $(".password").val();
        post.repassword = $(".repassword").val();
        post.url = $("#url").val();
        post.code = $("#code").val();
        if (!post.telephone) {
            dialog.showTips("请填写手机号！", "warn");
            return false;
        }
        if (!post.telephone.match(/^1[345789][0-9]{9}$/)) {
            dialog.showTips("手机号码格式错误！", "warn");
            return false;
        }
        if (!post.password) {
            dialog.showTips("请填写密码！", "warn");
            return false;
        }
        if (!post.password.match(/^.{6,24}$/)) {
            dialog.showTips("密码长度必须是6-20位！", "warn");
            return false;
        }
        if(!post.password.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
            alert("密码为6-20位数字和字母组成"); return false;
        }
        if (!post.repassword) {
            dialog.showTips("请填写确认密码！", "warn");
            return false;
        }
        if (!post.repassword.match(/^.{6,24}$/)) {
            dialog.showTips("确认密码长度必须是6-20位！", "warn");
            return false;
        }
        if(!post.repassword.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
            alert("确认密码为6-20位数字和字母组成"); return false;
        }
        if(post.password !=post.repassword){
            dialog.showTips("两次密码不一致！","warn");
            return false;
        }
        if (!post.code) {
            dialog.showTips("请填写验证码！", "warn");
            return false;
        }
        $.post(post.url, post, function (data) {
            if (data.status == 1) {
                dialog.showTips(data.info, "", data.url);
            } else {
                dialog.showTips(data.info, "warn");
            }
        }, "json")
        return false;
    }
})