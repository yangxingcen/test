/**
 * Created by Administrator on 2017/12/13 0013.
 */

/*确认提交 1*/
function J_Confirm(obj) {
    var data = $("#Form_one").serialize();
    $.post('/Admin/Goodscate/goodscateInfo', data, function (res) {
        if (res['status']) {
            dialog.showTips(res.info, "warn", function () {
                window.location.reload();
            });
        } else {
            dialog.showTips(res.info, "warn");
        }
    })
}
/*确认提交 2*/



/*添加分类价格区间 1*/
$("#add_param").click(function(){
    var html = "<tr>"+
        "<td> <input type=\"text\" class=\"input\" name=\"small[]\" /></td>"+
        "<td> <input type=\"text\" class=\"input large\" name=\"big[]\"/> </td>"+
        "<td style='width:30px'>"+
            /*"<span class=\"thisparam\" title='点击删除' style=\"width: 10px;height: 10px;border: 1px solid red;border-radius: 50%;background: red;color: #fff;padding: 5px;cursor: pointer;\">—</span>"+*/
        "<span class=\"thisparam gicon-remove\" title='删除' style=\"padding-top:2px;cursor:pointer;\"></span>"+
        "</td>"+
        "</tr>";
    $(this).parent().parent().find("#goodsparamtable").append(html);
    $(".thisparam").bind('click',function(){
        $(this).parent().parent().remove();
    })
})
/*添加分类价格区间 2*/
/*删除分类价格区间 1*/
$(".thisparam").bind('click',function(){
    $(this).parent().parent().remove();
})
/*删除分类价格区间 2*/