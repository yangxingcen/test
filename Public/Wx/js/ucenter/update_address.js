function sub_address(){
    var post = {};
    post.id = $("#update_id").val();
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
                    window.location.href="/wx_address.html";
            }else{
                dialog.showTips(res.info, "warn");
            }
        }
    })

}
// 删除地址
function del_address(){
    var id = $("#update_id").val();
    $.ajax({
        url:'/Wx/Ucenter/delAddress',
        type:'post',
        data:{'id':id},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                    window.location.href="/wx_address.html";
            }else{
                dialog.showTips(res.info, "warn");
            }
        }
    })
}