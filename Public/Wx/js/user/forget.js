/*验证码 1*/
var captcha_img = $('#vcode')
var verifyimg = captcha_img.attr("src");
captcha_img.attr('title', '点击刷新');
captcha_img.click(function () {
    $(this).attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
});
var wait = 60;
//获取手机验证码
function get_yzm(obj){
	var post = {};
	_this = $(obj);
	post.telephone=$('input[name="telephone"]').val();
	post.vcode = $('input[name="vcode"]').val();
	post.type = 6;
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
function next(){
	var post = {};
	post.telephone=$('input[name="telephone"]').val();
  post.telcode=$('input[name="telcode"]').val();
	$.ajax({
        url:'/Wx/User/forget_zy_tel',
        type:'post',
        data:{'data':post},
        dataType:'json',
        cache:false,
        success:function(res){
      		if(res.status == 1){
      			// dialog.showTips(res.msg, "",1);
      			window.location.href="/wx_forget_password1.html?tel="+res.info;
      		}else{
      			dialog.showTips(res.info, "warn");
      		}
        }
    })
}