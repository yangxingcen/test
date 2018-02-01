$(function(){
    $("#save").click(function () {
        var post = {};
        post.person_name = $("input[name=person_name]").val();
        post.realname = $("input[name=realname]").val();
        post.telephone = $("input[name=telephone]").val();
        post.sex = $("input[name=sex]:checked").val();
        post.birth = $("#birth").val();
        post.email = $("input[name=email]").val();
        post.QQ = $("input[name=QQ]").val();
        post.weibo = $("input[name=weibo]").val();
        post.wx_number = $("input[name=wx_number]").val();
        post.IDcard = $("input[name=IDcard]").val();
        post.address = $("input[name=address]").val();
        var url = $("#url").val();

        if (post['birth'] && !post['birth'].match(/^(19|20)\d{2}-(1[0-2]|0?[1-9])-(0?[1-9]|[1-2][0-9]|3[0-1])$/)) {
            dialog.showTips("生日格式错误！", "warn");
            return false;
        }
        if (post['email'] && !post['email'].match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)) {
            dialog.showTips("邮箱格式错误", "warn");
            return false;
        }
        if (post['IDcard'] && !post['IDcard'].match(/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/)|(/^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}$/)) {
            dialog.showTips("身份证号格式错误", "warn");
            return false;
        }
        if (post['QQ'] && !post['QQ'].match(/[1-9][0-9]{4,14}/)) {
            dialog.showTips("QQ号格式错误", "warn");
            return false;
        }

        $.post(url, post, function (data) {
            if (data.status == 1) {
                dialog.showTips(data.info, "", 1);
            } else {
                dialog.showTips(data.info, "warn");
            }
        }, "json")
    })
})

J(function () {
    J('#birth').calendar({format: 'yyyy-MM-dd'});
});