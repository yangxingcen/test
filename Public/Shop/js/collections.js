$(function(){
    $('.soucang').click(function(){
        var that = $(this);
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var isactivity = $(this).attr('data-isactivity');
        var goods_id = $(this).attr('data-goodsid');
        if(isactivity == '1'){
            var type = '3';
        }
        $.ajax({
            url : "/Shop/Ucenter/delCollections",
            type: 'get',
            data : {'id':id, 'type':type, 'goods_id':goods_id},
            success : function(data){
                if(data.status==0){
                    dialog.showTips(data.info, "warn");
                }else{
                    that.parent().parent().parent().parent().parent().remove();
                    var num = $('.user_r8_list').length;
                    if(num == '0') {
                        window.location.href = '/my_collections.html';
                    }
                }
            }
        });
    });
})