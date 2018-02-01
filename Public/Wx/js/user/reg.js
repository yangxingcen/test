/*验证码 1*/
var captcha_img = $('#vcode')
var verifyimg = captcha_img.attr("src");
captcha_img.attr('title', '点击刷新');
captcha_img.click(function () {
    $(this).attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
});

function sub_reg(){
  var clearfix = $(".xieyi").find('li').attr('class');
  var post = {};
  post.telephone=$('input[name="telephone"]').val();
  post.vcode = $('input[name="vcode"]').val();
  post.telcode = $('input[name="telcode"]').val();
  post.password = $('input[name="password"]').val();
  post.ok_password = $('input[name="ok_password"]').val();
  if(!post.telephone){
      alert("请输入手机号");return false;
  }
  if (!post.telephone.match(/^1[345789][0-9]{9}$/)) {
        dialog.showTips("手机号码格式错误", "warn");
        return false;
  }
  if(!post.password){
      alert("请填写密码");return false;
  }
  if(!post.password.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
      alert("密码为6-20位数字和字母组成"); return false;
  }
  if(!post.ok_password){
      alert("请填写确认密码");return false;
  }
  if(!post.ok_password.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
      alert("确认密码为6-20位数字和字母组成"); return false;
  }
  if(post.password!=post.ok_password){
      alert("两次密码不一致");return false;
  }
  post.clearfix = clearfix;
  $.ajax({
        url:'/Wx/User/validate_reg',
        type:'post',
        data:{'data':post},
        dataType:'json',
        cache:false,
        success:function(res){
          if(res.status == 1){
            dialog.showTips(res.msg, "",'/wx_login.html');
            // window.location.href="/wx_login.html";
          }else{
            dialog.showTips(res.msg, "warn");
          }
        }
    })

} 
var wait = 60;
function get_yzm(obj){
  var post = {};
  _this = $(obj);
  post.telephone=$('input[name="telephone"]').val();
  post.vcode = $('input[name="vcode"]').val();
  post.type = 3;
  $.ajax({
        url:'/Wx/User/validate_telcode',
        type:'post',
        data:{'data':post},
        dataType:'json',
        cache:false,
        success:function(res){
          if(res.status == 1){
            dialog.showTips(res.msg, "warn");
            time(_this);
          }else{
            captcha_img.attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            dialog.showTips(res.msg, "warn");
          }
        }
    })
}

function time(obj) {
  // console.log(wait);
  // console.log(obj);
  if (wait == 0) {
    obj.attr("onclick","get_yzm(this)");
    
    obj.html("重新获取");
    wait = 60;
  } else {
    obj.removeAttr('onclick');
    obj.html("重新发送(" + wait + ")");
    wait--;
    setTimeout(function () {
      time(obj)
    }, 1000);
  }
}
// 查看密码
function s_pass(obj){
  var status = $(obj).attr("data-status");
  if(status == 1){
    $("input[name='password']").attr('type','text');
    $("#eye1").attr('data-status','2');
  }else{
    $("input[name='password']").attr('type','password');
    $("#eye1").attr('data-status','1');
  }
}

// 查看密码
function s_pass1(obj){
  var status = $(obj).attr("data-status");
  if(status == 1){
    $("input[name='ok_password']").attr('type','text');
    $("#eye2").attr('data-status','2');
  }else{
    $("input[name='ok_password']").attr('type','password');
    $("#eye2").attr('data-status','1');
  }
}