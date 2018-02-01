/**
 * Created by Administrator on 2017/12/13 0013.
 */

/*清空输入框 1*/
$('.j-clearIpt').click(function(){
    $(this).parent().find('input').val('');
})
/*清空输入框 2*/

/*验证码 1*/
var captcha_img = $('#vcode')
var verifyimg = captcha_img.attr("src");
captcha_img.attr('title', '点击刷新');
captcha_img.click(function () {
    $(this).attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
});
/*验证码 2*/


/*提交 1*/
$("#btn_login").click(function () {
    var username = $('#ipt_account').val();
    var password = $('#ipt_pwd').val();
    var vcode = $('#ipt_code').val();
    if (username == '') {
        alert("请填写用户名！");
        $('#ipt_account').focus();
        return false;
    }
    if (password == "") {
        alert('密码必填');
        $('#ipt_pwd').focus();
        return false;
    }
    if (vcode == "") {
        alert('验证码必填');
        $('#ipt_code').focus();
        return false;
    }
    $.ajax({
        url: '/Admin/User/checkloginajax',
        type: "post",
        dataType: "json",
        data: {
            username: username,
            password: password,
            vcode: vcode
        }
    }).done(function (res) {
        if (res.status == 1) {
            window.location.href=res.url;
            // dialog.showTips(res.info, "", res.url);
            return false;
        } else {
            dialog.showTips(res.info, "warn");
            $('#vcode').attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            return false;
        }
    })

})
/*提交 2*/

/*按回车登录 1*/
$(function () {
    document.onkeydown = function (event) {
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if (e && e.keyCode == 13) {
            document.getElementById("btn_login").click(); //调用登录按钮的登录事件
        }
    };
});
/*按回车登录 2*/