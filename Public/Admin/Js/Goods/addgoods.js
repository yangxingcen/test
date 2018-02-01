/*标签分页 1*/
function tab_show(obj, i) {
    $(obj).addClass('active').siblings().removeClass('active');
    $('#tab'+i).show().siblings().hide();
}
/*标签分页 2*/

/*选择分类 1*/
function J_Select_Cate(obj){
    var id=$(obj).val();
    var cate_data_new= {};
    cate_data_new =j_goods_cate[id];
    var str ='<option value=""> 请选择商品二级分类</option>';
    $.each(cate_data_new,function(key,value){
        str +='<option value="'+value.id+'">'+value.classname+'</option>'
    })
    $('select[name=cate_id]').empty().html(str);
    str='';
}
/*选择分类 2*/

/*编辑时商品分类 1*/
function set_category(ids,id,o,i){
    var cate_data_new= {};
    cate_data_new =j_goods_cate[ids];
    var str ='<option value=""> 请选择商品'+i+'级分类</option>';
    $.each(cate_data_new,function(key,value){
        str +='<option value="'+value.id+'">'+value.classname+'</option>'
    })
    $('select[name='+o+']').empty().html(str);
    $('select[name='+o+']').val(id);
}
/*编辑时商品分类 2*/

/*添加商品参数 1*/
function J_add_param(obj) {
    var html = "<tr>" +
        "<td> <input type=\"text\" class=\"input\" name=\"param_name[]\" /></td>" +
        "<td> <input type=\"text\" class=\"input large\" name=\"param_val[]\"/> </td>" +
        "<td style='width:30px'>" +
        "<span class=\"thisparam gicon-remove\" onclick='J_del_param(this)' title='删除' style=\"padding-top:2px;cursor:pointer;\"></span>" +
        "</td>" +
        "</tr>";
    $(obj).parent().parent().find("#goodsparamtable").append(html);
    J_del_param();
}
/*添加商品参数 2*/

/*删除参数 1*/
function J_del_param(obj){
    $(obj).parent().parent().remove();
}
/*删除参数 2*/


/*下一步 1*/
function J_tab_show(obj,i){
    var num =i-1;
    var flag = $("#Form_"+num).valid();
    if(!flag){
        //没有通过验证
        return;
    }
    $('.tab'+i).addClass('active').siblings().removeClass('active');
    $('#tab'+i).show().siblings().hide();
}
/*下一步 2*/

/*validate验证 1*/
var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() {  }
    });

    /*验证多个相同的name时 1*/
    if ($.validator) {
        $.validator.prototype.elements = function () {
            var validator = this,
                rulesCache = {};
            // select all valid inputs inside the form (no submit or reset buttons)
            return $(this.currentForm)
                .find("input, select, textarea")
                .not(":submit, :reset, :image, [disabled]")
                .not(this.settings.ignore)
                .filter(function () {
                    if (!this.name && validator.settings.debug && window.console) {
                        console.error("%o has no name assigned", this);
                    }
                    //注释这行代码
                    // select only the first element for each name, and only those with rules specified
                    //if ( this.name in rulesCache || !validator.objectLength($(this).rules()) ) {
                    //    return false;
                    //}
                    rulesCache[this.name] = true;
                    return true;
                });
        }
    }
    /*验证多个相同的name时 2*/

    $().ready(function() {
        debug: true,
            // validate signup form on keyup and submit
            $("#Form_1").validate({
                rules: {
                    sorts: {
                        required: true,
                        digits:true,
                        maxlength:6,
                    },
                    goods_name: {
                        required: true,
                        isFigure:true,
                    },
                    goods_des:{
                        required: true,
                    },
                    goods_ser: {
                        required: true,
                    },
                    cate_pid: {
                        required: true,
                    },
                    cate_id: {
                        required: true,
                    },
                    is_sale: {
                        required: true,
                    },
                    is_new: {
                        required: true,
                    },
                    is_cuxiao: {
                        required: true,
                    },
                    is_groom: {
                        required: true,
                    },
                    type:{
                        required: true,
                    }

                },
                messages: {

                },
            });

        $("#Form_2").validate({
            rules: {
                goods_code: {
                    required: true,
                    chrnum:true,
                },
                virtual_sales: {
                    required: true,
                    digits:true,
                },
                integral: {
                    required: true,
                    digits:true,
                },

                oprice: {
                    required: true,
                    isFloat:true,
                    isFloatGteZero:true,
                    minNumber:true,
                },
                price: {
                    required: true,
                    isFloat:true,
                    isFloatGteZero:true,
                    minNumber:true,
                },
                cost_price: {
                    required: true,
                    isFloat:true,
                    isFloatGteZero:true,
                    minNumber:true,
                },
                stock: {
                    required: true,
                    digits:true,
                },
                goods_unit: {
                    required: true,
                },
                is_sku:{
                    required: true,
                },
            },
            messages: {


            },
        });

        $("#Form_4").validate({
            rules: {
                logo: {
                    required: true,
                },
                detail: {
                    required: true,
                },
            },
            messages: {

            },
        });


        $("#Form_5").validate({
            rules: {
                share_title: {
                    required: true,
                },
                share_desc: {
                    required: true,
                },
                share_logo: {
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
    var flag = $("#Form_5").valid();
    if(!flag){
        //没有通过验证
        return;
    }
    var post1=[];
    var post2=[];
    var post3=[];
    var post4=[];
    var post5=[];
    var post6=[];
    var post7=[];
    var post8=[];
    var post9=[];
    var post=[];
    post1 =$("#Form_1").serializeArray();
    post2 =$("#Form_2").serializeArray();
    post3 =$("#Form_3").serializeArray();
    post4 =$("#Form_4").serializeArray();
    post5 =$("#Form_5").serializeArray();

    for (var key in post1) {
        post.push(post1[key])
    }
    for (var key in post2) {
        post.push(post2[key])
    }
    for (var key in post3) {
        post.push(post3[key])
    }
    for (var key in post4) {
        post.push(post4[key])
    }
    for (var key in post5) {
        post.push(post5[key])
    }
    dialog.showTips("确定要进行操作吗?", "firm", function () {
        if (uno) return;
        uno = true;
        //$(obj).attr({"disabled": "disabled"});
        $(".loader" ).fadeIn("fast");
        $.post("/Admin/Goods/addgoods", post, function (result) {
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
var ue = UE.getEditor('editor', {
    toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
        'simpleupload', 'insertimage', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'pagebreak', 'template', 'background', '|',
        'horizontal', 'spechars', 'snapscreen', 'wordimage', '|',
        'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
        'preview', 'searchreplace',
    ]],
    elementPathEnabled: false,
    autoHeightEnabled: false,
    initialFrameHeight: 500,
});
/*编辑器 2*/


/*取消 1*/
$(".cancle").click(function () {
    $('.addfenlei').hide();
    $('#albums-overlay').hide();
})
/*取消 2*/


