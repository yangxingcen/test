/**
 * Created by Administrator on 2017/12/22 0022.
 */
/*单个、批量 更新商品上架-下架 删除-恢复 提交审核 1*/
function J_ChangeStatus(obj) {

    var post={};
    post.ids=$(obj).attr("data-id");
    post.item = $(obj).attr("data-item");
    post.value = $(obj).attr("data-value");//启用-禁用  删除-恢复
    if(!post.ids){
        var ids='';
        $("input[type=checkbox]:checked").each(function(){
            var id =$(this).val()?$(this).val():"";
            ids +=','+id;
        })
        if(!ids){
            dialog.showTips('请选择操作对象');return false;
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
/*单个、批量 更新商品上架-下架 删除-恢复 提交审核 2*/
