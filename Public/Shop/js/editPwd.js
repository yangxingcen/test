$(function(){

    $('#btn').bind('click', function () {
        var data = {};
        data.nowpassword = $('input[name=nowpassword]').val();
        data.newpassword = $('input[name=newpassword]').val();
        data.rnewpassword = $('input[name=rnewpassword]').val();
        if (data.nowpassword == "") {
            dialog.showTips("请填写原密码！", "warn");
            return false;
        }
        if (!data.nowpassword.match(/.{6,20}/)) {
            dialog.showTips("原密码格式错误！", "warn");
            return false;
        }

        if (data.newpassword == "") {
            dialog.showTips("请填写新密码！", "warn");
            return false;
        }
        if (!data.newpassword.match(/.{6,20}/)) {
            dialog.showTips("新密码格式错误！", "warn");
            return false;
        }
        if(!post.newpassword.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
            alert("密码为6-20位数字和字母组成"); return false;
        }

        if (data.rnewpassword == "") {
            dialog.showTips("请重复新密码！", "warn");
            return false;
        }
        if (!data.rnewpassword.match(/.{6,20}/)) {
            dialog.showTips("重复新密码格式错误！", "warn");
            return false;
        }
        if(!post.rnewpassword.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
            alert("密码为6-20位数字和字母组成"); return false;
        }
        if (data['newpassword'] !== data['rnewpassword']) {
            dialog.showTips("两次密码不一致！", "warn");
            return false;
        }
        $.ajax({
            url: "{:U('Shop/Ucenter/editPwd')}",
            type: 'post',
            data: data,
            datatype: 'json',
            success: function (data) {
                if (data.status == 1) {
                    dialog.showTips(data.info, "", 1);
                } else {
                    dialog.showTips(data.info, "warn");
                }
            }
        });
    });

})