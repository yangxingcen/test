/*组装规格属性1*/
function make_sku_to_arr(){
    var _point = $("#process tbody tr");
    if(_point.length){
        var skuarr = new Array();
        var title  = '';
        _point.each(function(x){
            var skuidstr  = $.trim($(this).find("input[name='skulist[]']").attr('data-idstr'));
            var skulistid = parseInt($(this).find("input[name='skulist[]']").attr('data-attrskuid'));
            var oprice    = parseFloat($(this).find(".Txt_OPrice").val());
            var price     = parseFloat($(this).find(".Txt_Price").val());
            var fprice    = parseFloat($(this).find(".Txt_FPrice").val());
            var num       = parseInt($(this).find(".Txt_Store").val());
            var number    = $.trim($(this).find(".Txt_Number").val());
            var pic       = $.trim($(this).find('img').attr('src'));
            var arr       = {};
                arr['skulistid'] = skulistid ? skulistid : 0;
                arr['oprice']    = oprice ? oprice : 0;
                arr['fprice']    = fprice ? fprice : 0;
                arr['pic']       = pic ? pic : '';
            var j=x+1;
            if(skuidstr){
                arr['skuidstr'] = skuidstr;
            }else{
                title ='SKU属性第'+j+'行ID丢失,请刷新重试';
                return false;
            }
            if(price > 0){
                arr['price'] = price;
            }else{
                title ='SKU属性第'+j+'行请填写商品售价';
                return false;
            }
            if(num > 0){
                arr['num'] = num;
            }else{
                title ='SKU属性第'+j+'行请填写商品库存';
                return false;
            }
            if(number){
                arr['number'] = number;
            }else{
                title ='SKU属性第'+j+'行请填写商品编码';
                return false;
            }
            skuarr.push(arr);
            title='';
        });
        if(title){
            dialog.showTips(title,'warn');return false;
        }else{
            return skuarr;
        }
    }else{
        dialog.showTips("SKU属性错误",'warn');return false;
    }
}
/*组装规格属性2*/

/*获取sku 1*/
function get_sku_value(name) {
    var data = new Array();
    $("input[name='"+name+"[]']").each(function(){
        data.push($(this).val());
    });
    return data;
}
/*获取sku 2*/
/*获取skuidarr 1*/
function get_sku_idarr() {
    var data = new Array();
    var i=0;
    $("input[name='skulist[]']").each(function(x){
        var id = parseInt($(this).attr('data-attrskuid'));
        if(id > 0){
            data.push(id);
        }
    });
    return data;
}
/*获取skuidarr 2*/


/*获取商品轮播图 1*/
function get_many_pic() {
    var detailpic = '';
    $("input[name='pic1[]']").each(function(){
        var value = $.trim($(this).val());
        if(value.length > 5){
            detailpic += value + ',';
        }
    });
    if(detailpic){
        detailpic = detailpic.substring(0,detailpic.length-1);
    }
    return detailpic;
}
/*获取商品轮播图 2*/

/*获取商品参数 1*/
function get_goods_param() {
    var param = {};
    $("input[name='param_name']").each(function(index,element){
        var param_name = $(this).val();
        if(param_name.length > 1){
            var param_val = $("input[name='param_val']").eq(index).val();
            if(param_val.length > 1){
                param[index] = param_name+"-"+param_val;
            }
        }
    })
    return param ? param : '';
}

$(function(){
    });
/*编辑器 1*/
    var ue = UE.getEditor('editor',{
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
            elementPathEnabled:false,
            autoHeightEnabled:false,
            initialFrameHeight:500,
        });
/*编辑器 2*/
/*添加商品参数 1*/
    $("#add_param").click(function(){
        var parameter = new Array();
        var parameter = $('#parameter').val();

        var html = "<tr>"+
            "<tb>"+
            "<label class=\"fi-name\" style=\"width:135px;\"><span class=\"colorRed\"></span>选择商品参数：</label>"+
            "<div class=\"form-controls\">"+
            "<div class=\"formitems\">"+
            "<select name=\"select_class_id\" id=\"select_parameter_id\" class=\"select\">"+
            "<option>请选择商品参数</option>"+
            "<foreach name=\"parameter\" item=\"val\">"+
            "<option disabled value=\"{$val.id}\" name='【{$val.id}】{$val.classname}'>{$val.classname}</option>"+
            "<volist name='val.parameter' id='val1'>"+
            "<option value=\"{$val1.id}\" name='【{$val1.id}】{$val1.classname}'> &nbsp;&nbsp; |--{$val1.classname}</option>"+
            "</volist>"+
            "</foreach>"+
            "</select>"+
            "</div>"+
            "</div>"+
            /*"<span class=\"thisparam\" title='点击删除' style=\"width: 10px;height: 10px;border: 1px solid red;border-radius: 50%;background: red;color: #fff;padding: 5px;cursor: pointer;\">—</span>"+*/
            "<span class=\"thisparam gicon-remove\" title='删除' style=\"padding-top:2px;cursor:pointer;\"></span>"+
            "</td>"+
            "</tr>";

        $(this).parent().parent().find("#goodsparamtable").append(html);
        $(".thisparam").bind('click',function(){
            $(this).parent().parent().remove();
        })
    })
/*获取商品参数*/
    function get_goods_param() {
        var param = {};
        $("input[name='select_parameter_id']").each(function(index,element){
            var param_name = $(this).val();
            alert(param_name);exit;
            if(param_name.length > 1){
                var param_val = $("input[name='param_val']").eq(index).val();
                if(param_val.length > 1){
                    param[index] = param_name+"-"+param_val;
                }
            }
        })
        return param ? param : '';
    }
/*添加商品参数 2*/
/*删除商品参数 1*/
    $(".thisparam").bind('click',function(){
        $(this).parent().parent().remove();
    })
/*删除商品参数 2*/
/*是否开启SKU 1*/
    $("input[name='is_sku']").change(function () {
        var id =$("input[name='is_sku']:checked").val();
        if(id==1){
            var price          = parseFloat($("input[name='price']").val());
            var oprice         = parseFloat($("input[name='oprice']").val());
            var costprice      = parseFloat($("input[name='costprice']").val());
            var goodscode      = $.trim($("input[name='goodscode']").val());
            var store      = parseFloat($("#store").val());

            $(".div_contentlist2 .pi_oprice").val(oprice);
            $(".div_contentlist2 .pi_price").val(price);
            $(".div_contentlist2 .pi_fprice").val(costprice);
            $(".div_contentlist2 .pi_number").val(goodscode);
            $(".div_contentlist2 #pi_store").val(store);
            $(".j-showinhyd").show();
        }else{
            $(".j-showinhyd").hide();
        }
    })
/*是否开启SKU 2*/

/*添加商品 1*/

    $("#saveGoods").click(function(){
        var post={};
        post.isactivity     = parseInt($("input[name='isactivity']:checked").val());            //活动
        post.id             = parseInt($("input[name='goodsid']").val());                       //商品ID
        post.sorts          = parseInt($("input[name='sorts']").val());                         //排序
        post.title          = $.trim($("input[name='title']").val());                           //商品名称
        post.subtitle       = $.trim($("input[name='subtitle']").val());                        //商品简介
        post.goods_ser       = $.trim($("input[name='goods_ser']").val());                        //商品服务
        post.keywords       = $.trim($("input[name='keywords']").val());                        //关键字
        post.cateid         = $.trim($("#cateid").val());                          //分类id
        if(!post.cateid){
            dialog.showTips('请选择商品分类','warn');return false;
        }
        post.ischoice       = parseInt($("input[name='ischoice']:checked").val());              //推荐
        post.ishot          = parseInt($("input[name='ishot']:checked").val());                 //热卖
        post.isnew          = parseInt($("input[name='isnew']:checked").val());                 //新品
        post.price          = parseFloat($("input[name='price']").val());                       //商品价格售价
        post.oprice         = parseFloat($("input[name='oprice']").val());                      //商品价格原价
        post.costprice      = parseFloat($("input[name='costprice']").val());                   //商品价格成本价
        post.logo           = $.trim($("input[name='logo']").val());                            //商品logo图片
        post.detailpic      = get_many_pic();                                                   //商品图片(多选)
        post.issale         = parseInt($("input[name='issale']:checked").val());                //上架
        post.goodscode      = $.trim($("input[name='goodscode']").val());                       //产品编码
        post.stock          = parseInt($("input[name='stock']").val());                         //库存
        post.is_sku         = parseInt($("input[name='is_sku']:checked").val());                //是否启用SKU
        post.guige          = $.trim($("input[name='guige']").val());                           //规格
        post.goods_param    = $.trim($("#select_parameter_id").val());             //商品参数
        post.detail         = UE.getEditor('editor').getContent();                              //商品详情
        post.share_title    = $.trim($("input[name='share_title']").val());                     //分享标题
        post.share_desc     = $.trim($("textarea[name='share_desc']").val());                   //分享描述
        post.share_logo     = $.trim($("input[name='share_logo']").val());                      //分享图片
        if(post.is_sku == 1){
            post.skulistidarr   = get_sku_idarr();                                                //skuid
            post.skulistarr     = make_sku_to_arr();                                              //SKU数组
            if(post.skulistarr == false){
                return false;
            }
            var count_txt_store = parseInt($(".Count_Txt_Store").val());                          //库存
                post.stock      = count_txt_store ? count_txt_store : post.stock;
        }
        // console.log(post);
        if(post.title == ''){
            alert('请填写商品名称');return false;
        }
        if(post.subtitle == ''){
            alert('请填写商品简介');return false;
        }
        if(post.goods_ser == ''){
            alert('请填写商品服务');return false;
        }
        if(post.price == ''){
            alert('请填写商品价格');$('.price').focus();return false;
        }
        if(post.oprice == ''){
            alert('请填写商品原价');$('.oprice').focus();return false;
        }
        if(post.logo == '' || post.logo == null){
            alert('请上传商品LOGO!');return false;
        }
        if(post.detailpic == ''){
            alert('请上传商品轮播图');return false;
        }
        if(post.goodscode == ''){
            alert('请填写商品编号');return false;
        }
        if(post.stock == ''){
            alert('请填写商品库存');return false;
        }
        if(post.detail == ''){
            alert('请填写商品详情');return false;
        }
        var _protocol = window.location.protocol;
        var _host     = window.location.host;
        var _url      = _protocol+"//"+_host+"/Admin/integralgoods/addgoods"; 
        // console.log(_url);
        // console.log(100);
        // console.log(post);
        $.post(_url,post,function(g){
            console.log(g);
            if(g.status==1){
                var p = parseInt($("input[name='page']").val());
                dialog.showTips(g.info,'',g.url+'/p/'+p);return false;
            }else{
                dialog.showTips(g.info,'warn');return false;
            }
        },"JSON").error(function(){
            console.log("处理失败");
        });
    });

/*添加商品 2*/