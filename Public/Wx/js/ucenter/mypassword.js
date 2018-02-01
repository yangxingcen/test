function sub_pass(){
    var old_pass = $( "input[name='old_pass']" ).val();
    var pass = $( "input[name='pass']" ).val();
    var ok_pass = $( "input[name='ok_pass']" ).val();
    if(!old_pass){
        alert("请填写原密码");return false;
      }
      if(!old_pass.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
          alert("原密码为6-20位数字和字母组成"); return false;
      }
      if(!pass){
          alert("请填写现密码");return false;
      }
      if(!pass.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
          alert("现密码为6-20位数字和字母组成"); return false;
      }
      if(!ok_pass){
          alert("请填写确认密码");return false;
      }
      if(!ok_pass.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/)){
          alert("确认密码为6-20位数字和字母组成"); return false;
      }
      if(pass!=ok_pass){
          alert("两次密码不一致");return false;
      }
    $.ajax({
        url:'/Wx/Ucenter/up_pass_ajax',
        type:'post',
        data:{old_pass:old_pass,'pass':pass,'ok_pass':ok_pass},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                window.location.href="/wx_my_set.html";
            }else{
                alert(res.info);
            }
        }
    })
}
