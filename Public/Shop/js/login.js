/*登录按钮触发事件*/
$(function(){
    var telephone = window.localStorage.telephone;
    var password = window.localStorage.password;
    if (telephone) {
        $(".telephone").val(telephone);
    }
    if (password) {
        $(".password").val(password);
    }

    $("#login").click(function(){
        var post = {};
        post.telephone = $(".telephone").val();
        post.password = $(".password").val();
        post.url = $("#url").val();
        post.nowurl = $("#nowurl").val();
        post.type = $("#type").val();
        //  console.log(nowurl);
        //post.nowurl = "{$nowurl}";
        if (!post.telephone) {
            dialog.showTips("请填写手机号！", "warn");
            return false;
        }
        if (!post.telephone.match(/^1[345789][0-9]{9}$/)) {
            dialog.showTips("手机号码格式错误！", "warn");
            return false;
        }
        if(!post.password){
            alert("请填写密码");return false;
        }
        // if(!post.password.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
        //     alert("密码为6-20位数字和字母组成"); return false;
        // }
        //var ajaxurl = "{:U('Shop/User/doLogin')}";
        $.post(post.url, post, function (data) {
            if (data.status==2){
                dialog.showTips(data.info,'',data.url);
            }else if (data.status) {
                is_login = true;
                window.localStorage.telephone = post.telephone;
                window.localStorage.password  = post.password;
                window.location.href = data.url;
            }else {
                dialog.showTips(data.info, "warn");
            }
        })
        return false;
    });




    /*回车登录*/
    $(function () {
        document.onkeydown = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {

                dolog();
                $(".close1").click();
            }
        };
    });

    $( ".div_er" ).click( function() {

        if( $( this ).hasClass( "div_add" ) ) {

            $( ".div_er" ).removeClass( "div_add" );
            $( ".div_login_2" ).fadeIn();
            $( ".er_img1" ).fadeOut();
            $( ".er_img2" ).fadeIn();
        }
        else {
            $( ".div_er" ).addClass( "div_add" );
            $( ".div_login_2" ).fadeOut();
            $( ".er_img1" ).fadeIn();
            $( ".er_img2" ).fadeOut();
        }

    } )

    $( ".mima_den_a" ).click( function() {

        $( ".div_er" ).removeClass( "div_add" );
        $( ".div_login_2" ).fadeOut();
        $( ".er_img1" ).fadeIn();
        $( ".er_img2" ).fadeOut();

    } )
})