/**
 * Created by Administrator on 2017/12/14 0014.
 */
/*添加商品弹框 1*/
function J_Add(obj,num){
    $('input[name=isactivity]').val(num);
    $('#albums-overlay').show();
    $('.select-goods').show();
}
/*添加商品弹框 2*/

/*取消 1*/
$(".cancle").click(function () {
    $('.addfenlei').hide();
    $('#albums-overlay').hide();
})
/*取消 2*/


/*营销活动添加商品 搜索商品 1*/
function J_SelectGoods(obj){
    var post ={};
    post.keyword = $(obj).prev().find('input').val();
    post.isactivity = $('input[name=isactivity]').val();
    if(!post.keyword){
        dialog.showTips('请输入搜索的商品标题');
    }
    if(!post.isactivity){
        dialog.showTips('活动类型错误');return false;
    }
    $(".loader" ).fadeIn("fast");
    $.post("/Admin/Goods/goodsSelect", post, function (result) {

        $(".loader" ).fadeOut("fast");
        if (result.status == 1) {
            $(".goods_list").empty().append(result.data);
            return false;
        }
        dialog.showTips(result.info,'warn');
        return false;
    }, "json")
}
/*营销活动添加商品 搜索商品 2*/



/*营销活动搜索商品 确定选择 1*/
function J_Confirm_Select(obj){
    var post     = {};
    var goods_ids= '';
    $("input[type=checkbox]:checked").each(function(){
        var id =$(this).val()?$(this).val():"";
        goods_ids +=','+id;
    })
    if(!goods_ids){
        dialog.showTips('请选择操作对象','warn');return false;
    }

    post.goods_ids  = goods_ids;
    post.isactivity = $('input[name=isactivity]').val();
    if(!post.isactivity){
        dialog.showTips('活动类型错误');return false;
    }
    $(".loader" ).fadeIn("fast");
    console.log(post);
    $.post("/Admin/Goodsmarket/goodsSubmit", post, function (res) {
        $(".loader" ).fadeOut("fast");
        if (res.status == 1) {
            dialog.showTips(res.info,'',1);
            return false;
        }
        dialog.showTips(res.info,'warn');
        return false;
    }, "json")

}
/*营销活动搜索商品 确定选择 2*/



/*单个、批量 更新商品上架-下架 删除-恢复 1*/
function J_ChangeStatus(obj) {

    var post    = {};
    post.ids    = $(obj).attr("data-id");   //商品id
    post.item   = $(obj).attr("data-item"); //操作字段
    post.tt     = '1';                      //区分营销活动
    post.value   = $(obj).attr("data-value"); //字段的值
    if(!post.ids){
        var ids='';
        $("input[type=checkbox]:checked").each(function(){
            var id =$(this).val()?$(this).val():"";
            ids +=','+id;
        })
        if(!ids){
            dialog.showTips('请选择操作对象','warn');return false;
        }
        post.ids=ids;
    }
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        $.post("/Admin/Goods/changeStatus", post, function (result) {
            if (result.status == 1) {
                dialog.showTips(result.info, "", "1");
                return false;
            }
            dialog.showTips(result.info,'warn');
            return false;
        }, "json")
    })
}
/*单个、批量 更新商品上架-下架 删除-恢复 2*/



