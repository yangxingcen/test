//修改默认
function up_default(obj){
    var id = $(obj).attr("id");
    var is_default = $(obj).attr("data-status");
    $.ajax({
        url:'/Wx/Ucenter/up_zhif_default',
        type:'post',
        data:{'id':id,is_default:is_default},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                dialog.showTips(res.info, "", 1);
                return false;
            }else{
                dialog.showTips(res.info ,'warn');
                return false;
            }
        }
    })
}
// 添加银行卡
function add_bank(){
    var telephone = $("input[name='telephone']").val();
    var bank_no = $("input[name='bank_no']").val();
    $.ajax({
        url:'/Wx/Ucenter/add_bank',
        type:'post',
        data:{'telephone':telephone,bank_no:bank_no},
        dataType:'json',
        cache:false,
        success:function(res){
            if(res.status == 1){
                window.location.href="/wx_user_zhif.html";
            }else{
                dialog.showTips(res.info ,'warn');
                return false;
            }
        }
    })
}