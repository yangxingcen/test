function sub_address(){
    var post = {};
    post.default = 1;
    var classname  = $('#dft').attr('class');
    if(classname=='quies'){
        post.default = 0 ;//不是默认地址为0 默认地址为1
    }
    post.consignee=$('input[name="consignee"]').val();
    post.telephone = $('input[name="telephone"]').val();
    post.province = $("#province1").val();
    post.city = $("#city1").val();
    post.district = $("#district1").val();
    post.place = $('textarea[name="palce"]').val();
    
    $.ajax({
        url:'/Wx/Ucenter/addAddress',
        type:'post',
        data:{'post':post},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                // dialog.showTips(res.msg, "",1);
                window.location.href="/wx_address.html";
            }else{
                dialog.showTips(res.info, "warn");
            }
        }
    })

}   