function showtext(){
    var post = {};
    post.telephone=$('#telphone').val();
    post.pass=$('input[name="pass"]').val();
    post.okpass=$('input[name="ok_pass"]').val();
    if(!post.pass){
          alert("请填写密码");return false;
      }
      if(!post.pass.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
          alert("密码为6-20位数字和字母组成"); return false;
      }
      if(!post.okpass){
          alert("请填写确认密码");return false;
      }
      if(!post.okpass.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
          alert("确认密码为6-20位数字和字母组成"); return false;
      }
      if(post.pass!=post.okpass){
          alert("两次密码不一致");return false;
      }
    $.ajax({
          url:'/Wx/User/forget1_ajax',
          type:'post',
          data:{'data':post},
          dataType:'json',
          cache:false,
          success:function(res){
            if(res.status == 1){
              dialog.showTips(res.info, "",'/wx_login.html');
            }else{
              dialog.showTips(res.info, "warn");
            }
          }
      })
}