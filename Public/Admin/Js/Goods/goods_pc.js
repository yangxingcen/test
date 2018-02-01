/*validate验证 1*/
var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() {  }
    });

    $().ready(function() {
        debug: true,
            // validate signup form on keyup and submit
            $("#Form_1").validate({
                rules: {
                    sorts_pc: {
                        required: true,
                        digits:true,
                        maxlength:6,
                    },
                    en_goods_name_pc: {
                        required: true,
                        isFigure:true,
                    },

                    pic1_pc: {
                        required: true,
                    },
                    pic2_pc: {
                        required: true,
                    },
                    pic_install_pc: {
                        required: true,
                    },
                },
                messages: {

                },
            });


    });
}();
/*validate验证 2*/


/*提交保存 1*/
var uno =false; //设置一个对象来控制是否进入AJAX过程
function J_Submit(obj) {
    var flag = $("#Form_1").valid();
    if(!flag){
        //没有通过验证
        return;
    }
    var post=[];
    post =$("#Form_1").serializeArray();
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        if (uno) return;
        uno = true;
        //$(obj).attr({"disabled": "disabled"});
        $(".loader" ).fadeIn("fast");
        $.post("/Admin/Goods/goods_pc", post, function (result) {
            $(".loader" ).fadeOut("fast");
            uno = false; //在提交成功之后将标志标记为可提交状态
            $(obj).removeAttr("disabled");
            if (result.status == 1) {
                var p = parseInt($("input[name='page']").val());
                dialog.showTips(result.info, "", result.url+ '/p/' + p);
                return false;
            }
            dialog.showTips(result.info,'warn');
            return false;
        }, "json")
    })
}
/*提交保存 2*/



/*编辑器 1*/
UE.getEditor('goods_tedian_pc', {
    toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',

    ]],
    elementPathEnabled: false,
    autoHeightEnabled: false,
    initialFrameHeight: 300,
});
/*编辑器 2*/


/*编辑器 1*/
UE.getEditor('detail_pc', {
    //toolbars: [[
    //    'fullscreen', 'source', '|', 'undo', 'redo', '|',
    //    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
    //    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
    //    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
    //    'directionalityltr', 'directionalityrtl', 'indent', '|',
    //
    //]],
    elementPathEnabled: false,
    autoHeightEnabled: false,
    initialFrameHeight: 300,
});
/*编辑器 2*/
