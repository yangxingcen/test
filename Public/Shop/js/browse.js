//批量删除
function del_all(id){
	$.ajax({
        url:'/Shop/Ucenter/del_browse',
        type:'post',
        data:{'id':id},
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