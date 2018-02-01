function sub_name(){
    var person_name = $( "input[name='person_name']" ).val();
    $.ajax({
        url:'/Wx/Ucenter/up_name_ajax',
        type:'post',
        data:{person_name:person_name},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                window.location.href="/wx_my_set.html";
            }
        }
    })
    
}