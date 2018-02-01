function sub_login(){
	var post = {};
	post.telephone=$('input[name="telephone"]').val();
	post.password = $('input[name="password"]').val();
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
	$.ajax({
        url:'/Wx/User/validate_login',
        type:'post',
        data:{'data':post},
        dataType:'json',
        cache:false,
        success:function(res){
      		if(res.status == 1){
            dialog.showTips(res.msg, "",'/wx_ucenter.html');
      		}else{
      			dialog.showTips(res.msg, "warn");
      		}
        }
    })

}

function s_pass(obj){
  var status = $(obj).attr("data-status");
  if(status == 1){
    $("input[name='password']").attr('type','text');
    $(".eye1").attr('data-status','2');
  }else{
    $("input[name='password']").attr('type','password');
    $(".eye1").attr('data-status','1');
  }
}