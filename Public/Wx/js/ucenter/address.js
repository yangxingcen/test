// 删除收货地址
$("#address_del").click(function(){
    var id = $("#address_del").attr('del_id');
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
})
//修改默认
function up_def(id,def){

   
    $.ajax({
        url:'/Wx/Ucenter/up_default',
        type:'post',
        data:{'id':id,def:def},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                 // dialog.showTips(data.info, "", 1);
                    window.location.href="/wx_address.html";
            }else{
                window.location.href="/wx_address.html";
            }
        }
    })
}