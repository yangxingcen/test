
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
    $("input[name='pics[]']").each(function(){
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
/*获取商品参数 2*/
/*上传图片 1*/
$(function(){
    var percent = $('.xuanze_percent');
    var progress = $('.xuanze_progress');
    $("#xuanze").wrap("<form id='myupload1' action='/Admin/Index/addimage' method='post' enctype='multipart/form-data'></form>");
    $("#xuanze").change(function(){ //选择文件
        $("#myupload1").ajaxSubmit({
            dataType:  'json', //数据格式为json
            beforeSend: function() { //开始上传
                $("#xuanze").addClass("disabled");
                progress.show(); //显示进度条
                var percentVal = '0%';
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%'; //获得进度
                percent.html(percentVal); //显示上传进度百分比
            },
            success: function(data) { //成功
                var img = '<img src="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'" height="80" ><input type="hidden" name="share_logo" value="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'"></input>';
                $('.xuanze_showimge').html(img);
                progress.hide();
                $("#xuanze").removeClass("disabled");
            },
            error:function(xhr){ //上传失败
                //console.log(xhr.status)
                $("#xuanze").removeClass("disabled");
            }
        });
    });
    var percent = $('.duoxuan_percent');
    var progress = $('.duoxuan_percent');
    $("#duoxuan").wrap("<form id='myupload' action='/Admin/Index/addimage' method='post' enctype='multipart/form-data'></form>");
    $("#duoxuan").change(function(){ //选择文件
        $("#myupload").ajaxSubmit({
            dataType:  'json', //数据格式为json
            beforeSend: function() { //开始上传
                $("#duoxuan").addClass("disabled");
                progress.show(); //显示进度条
                var percentVal = '0%';
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%'; //获得进度
                percent.html(percentVal); //显示上传进度百分比
            },
            success: function(data) { //成功
                var img = '<img src="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'" height="80"  class="mgr10 mgt10 " onclick="delImg(this)"><input type="hidden" name="detailpic" value="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'"></input>';
                // console.log(img);
                $('.duoxuan_showimge').append(img);
                progress.hide();
                $("#duoxuan").removeClass("disabled");
            },
            error:function(xhr){ //上传失败
                //console.log(xhr.status)
                $("#duoxuan").removeClass("disabled");
            }
        });
    });
    var percent = $('.baotuan_percent');
    var progress = $('.baotuan_percent');
    $("#baotuan").wrap("<form id='baotuan1' action='/Admin/Index/addimage' method='post' enctype='multipart/form-data'></form>");
    $("#baotuan").change(function(){ //选择文件
        $("#baotuan1").ajaxSubmit({
            dataType:  'json', //数据格式为json
            beforeSend: function() { //开始上传
                $("#baotuan").addClass("disabled");
                progress.show(); //显示进度条
                var percentVal = '0%';
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%'; //获得进度
                percent.html(percentVal); //显示上传进度百分比
            },
            success: function(data) { //成功
                //console.log(data);
                var img = '<img src="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'" height="80" ><input type="hidden" name="logo" value="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'"></input>';
                $('.baotuan_showimge').html(img);
                progress.hide();
                $("#baotuan").removeClass("disabled");
            },
            error:function(xhr){ //上传失败
                //console.log(xhr.status)
                $("#baotuan").removeClass("disabled");
            }
        });
    });
});
/*上传图片 2*/

    /*商品分类 1*/
    $("input[name='type']").change(function () {
        var type_id = $("input[name='type']:checked").val();
        if (type_id == 2) {
            $(".pifagoods").hide();
            $(".xunigoods").show();
            $(".goods_price").show();
        } else if (type_id == 3) {
            $(".xunigoods").hide();
            $(".goods_price").hide();
            $(".pifagoods").show();
        } else {
            $(".xunigoods").hide();
            $(".pifagoods").hide();
            $(".goods_price").show();
        }
    });
    /**商品分类 2*/

    /*添加商品参数 1*/
    $("#add_param").click(function () {
        var html = "<tr>" +
            "<td> <input type=\"text\" class=\"input\" name=\"param_name\" /></td>" +
            "<td> <input type=\"text\" class=\"input large\" name=\"param_val\"/> </td>" +
            "<td style='width:30px'>" +
            /*"<span class=\"thisparam\" title='点击删除' style=\"width: 10px;height: 10px;border: 1px solid red;border-radius: 50%;background: red;color: #fff;padding: 5px;cursor: pointer;\">—</span>"+*/
            "<span class=\"thisparam gicon-remove\" title='删除' style=\"padding-top:2px;cursor:pointer;\"></span>" +
            "</td>" +
            "</tr>";
        $(this).parent().parent().find("#goodsparamtable").append(html);
        $(".thisparam").bind('click', function () {
            $(this).parent().parent().remove();
        })
    })

    /*添加商品参数 2*/


    /***商品分类搜索S***/
    $(".select-fenlei .search_category").click(function () {
        var category = $.trim($(".select-fenlei input[name='search_category']").val());
        if (category) {
            var stat = true;
            $(".select-fenlei #select_class_id option").each(function () {
                var txt = $.trim($(this).text());
                if (txt.indexOf(category) != -1) {
                    $(this).attr("selected", "selected");
                    stat = false;
                    return false;
                }
            });
            if (stat) {
                dialog.showTips('没有找到相关分类', 'warn');
            }
        } else {
            dialog.showTips('请输入分类标题', 'warn');
        }
    });
    /***商品分类搜索S***/

    /*请选择商品分类 1*/
    $(".search_booking_bathgoods_ok").click(function () {
        var option = $("#select_class_id").val();
        var option_html = $("#select_class_id option:selected").attr('name');
        var bathgoods_ids = $("#booking_bathgoods_ids").val();
        //判断分类是否选择
        var getDataIds = bathgoods_ids.split(",");
        var a = getDataIds.indexOf(option);
        if (a > -1) {
            alert("此分类已选择");
            return false;
        }
        if (option > 0) {
            var html = "<li class='li' onclick='booking_delli(this);'  data-id='" + option + "'>" + option_html + "</li>"
            $(".booking_ul").append(html);
            var bathgoodsids = [];
            if (bathgoods_ids == 0) {
                $("#booking_bathgoods_ids").val(option);
                bathgoodsids.push(option);
            } else {
                $('.booking_ul li').each(function () {
                    bathgoodsids.push($(this).attr('data-id'));
                })
            }
            var idstr = bathgoodsids.join(",");
            $("#booking_bathgoods_ids").val(idstr);
            // $("#cateid").val(idstr);
        }
    })
    $("#select_class").click(function () {
        var bathgoods_ids_str = $("#booking_bathgoods_ids").val();
        $("#cateid").val(bathgoods_ids_str);
        var html = $.trim($(".booking_bathgoods_names").text());
        $("#class_name").text(html);
        //console.log(bathgoods_ids_str,html);
        $(this).parent().parent('.jbox').hide();
        $('#albums-overlay').hide();
    })
    /*请选择商品分类 2*/
    /*商品分类 1*/
    $("#j-select_category_id").click(function () {
        $('.select-fenlei').show();
        $('#albums-overlay').show();
    })
    /*商品分类 1*/
    /*是否开启SKU 1*/
    $("input[name='is_sku']").change(function () {
        var id = $("input[name='is_sku']:checked").val();
        if (id == 1) {
            var price = parseFloat($("input[name='price']").val());
            var oprice = parseFloat($("input[name='oprice']").val());
            var costprice = parseFloat($("input[name='costprice']").val());
            var goodscode = $.trim($("input[name='goodscode']").val());
            var store = parseFloat($("#store").val());

            $(".div_contentlist2 .pi_oprice").val(oprice);
            $(".div_contentlist2 .pi_price").val(price);
            $(".div_contentlist2 .pi_fprice").val(costprice);
            $(".div_contentlist2 .pi_number").val(goodscode);
            $(".div_contentlist2 #pi_store").val(store);
            $(".j-showinhyd").show();
        } else {
            $(".j-showinhyd").hide();
        }
    })
    /*是否开启SKU 2*/
    /*添加商品 1*/
    $(document).ready(function () {
        $("#saveGoods").click(function () {
            var post = {};
            post.isactivity= parseInt($("input[name='isactivity']").val());            //活动
            post.id = parseInt($("input[name='goodsid']").val());                       //商品ID
            post.sorts = parseInt($("input[name='sorts']").val());                         //排序
            post.title = $.trim($("input[name='title']").val());                           //商品名称
            post.subtitle = $.trim($("input[name='subtitle']").val());                        //商品简介
            post.goods_ser = $.trim($("input[name='goods_ser']").val());                        //商品服务
            post.keywords = $.trim($("input[name='keywords']").val());                        //关键字
            post.cateid = $.trim($("input[name='cateid']").val());                          //分类id
            post.catepid = $.trim($("input[name='catepid']").val());                          //分类id
            post.type = $.trim($("input[name='type']").val());                          //商品类型 1普通商品 2套餐商品
            if(post.isactivity == '1') {
                post.timepoint = $.trim($("select[name='timepoint']").val());                    //场次时间点
                if (post.buysome == '') {
                    alert('请选择场次');
                    return false;
                }
                post.buysome = $.trim($("input[name='buysome']").val());                          //活动标签
                post.limited_time_start = $("input[name='limited_time_start']").val();
                post.limited_time_end   = $("input[name='limited_time_end']").val();
                if (post.buysome == '') {
                    alert('请填写活动标签');
                    return false;
                }
                if(!post.limited_time_start || !post.limited_time_end){
                    dialog.showTips('请选择秒杀场次时间段','warn');return false;
                }
            }
            post.ischoice = parseInt($("input[name='ischoice']:checked").val());              //推荐
            post.ishot = parseInt($("input[name='ishot']:checked").val());                 //热卖
            post.isnew = parseInt($("input[name='isnew']:checked").val());                 //新品
            post.price = parseFloat($("input[name='price']").val());                       //商品价格售价
            post.oprice = parseFloat($("input[name='oprice']").val());                      //商品价格原价
            post.costprice = parseFloat($("input[name='costprice']").val());                   //商品价格成本价
            post.logo = $.trim($("input[name='logo']").val());                            //商品logo图片
            post.detailpic = get_many_pic();
            post.issale = parseInt($("input[name='issale']:checked").val());                //上架
            post.is_new = parseInt($("input[name='is_new']:checked").val());                //新品
            post.goodscode = $.trim($("input[name='goodscode']").val());                       //产品编码
            post.stock = parseInt($("input[name='stock']").val());                         //库存
            post.is_sku = parseInt($("input[name='is_sku']:checked").val());                //是否启用SKU
            post.guige = $.trim($("input[name='guige']").val());                           //规格
            post.goods_param = $.trim($("#select_parameter_id").val());             //商品参数
            post.detail = UE.getEditor('editor').getContent();                              //商品详情
            post.share_title = $.trim($("input[name='share_title']").val());                     //分享标题
            post.share_desc = $.trim($("textarea[name='share_desc']").val());                   //分享描述
            post.share_logo = $.trim($("input[name='share_logo']").val());                      //分享图片
            post.goods_param = get_goods_param();                                                //商品参数
            console.log(post);
            if (post.title == '') {
                alert('请填写商品名称');
                return false;
            }
            if (post.subtitle == '') {
                alert('请填写商品简介');
                return false;
            }
            if (post.goods_ser == '') {
                alert('请填写商品服务');
                return false;
            }
            if (!post.cateid) {
                dialog.showTips('请选择商品分类', 'warn');
                return false;
            }
            if (post.logo == '' || post.logo == null) {
                alert('请上传商品LOGO!');
                return false;
            }
            if (post.detailpic == '') {
                alert('请上传商品轮播图');
                return false;
            }
            if (post.goodscode == '') {
                alert('请填写商品编号');
                return false;
            }
            if (post.stock == '') {
                alert('请填写商品库存');
                return false;
            }
            if (post.price == '') {
                alert('请填写商品现价');
                $('.price').focus();
                return false;
            }
            if (post.oprice == '') {
                alert('请填写商品原价');
                $('.oprice').focus();
                return false;
            }
            if (post.is_sku == 1) {
                post.skulistidarr = get_sku_idarr();                                                //skuid
                post.skulistarr = make_sku_to_arr();                                              //SKU数组
                if (post.skulistarr == false) {
                    return false;
                }
                var count_txt_store = parseInt($(".Count_Txt_Store").val());                          //库存
                post.stock = count_txt_store ? count_txt_store : post.stock;
            }
            if (post.detail == '') {
                alert('请填写商品详情');
                return false;
            }

            var _protocol = window.location.protocol;
            var _host = window.location.host;
            var _url = _protocol + "//" + _host + "/Admin/Goods/addgoods";
            console.log(_url);
            console.log(100);
            console.log(post);
            $.post(_url, post, function (g) {
                console.log(g);
                if (g.status == 1) {
                    var p = parseInt($("input[name='page']").val());
                    dialog.showTips(g.info, '', g.url + '/p/' + p);
                    return false;
                } else {
                    dialog.showTips(g.info, 'warn');
                    return false;
                }
            }, "JSON").error(function () {
                console.log("处理失败");
            });
        });
    })
    /*添加商品 2*/
    /*修改限时特惠部分数据*/
    $(document).ready(function () {
    $("#saveSpkGoods").click(function () {
        var post = {};
        post.isactivity= parseInt($("input[name='isactivity']").val());            //活动
        post.id = parseInt($("input[name='goodsid']").val());                       //商品ID
        if(post.id) {
            post.timepoint = $.trim($("select[name='timepoint']").val());                    //场次时间点
            if (post.buysome == '') {
                alert('请选择场次');
                return false;
            }
            post.buysome = $.trim($("input[name='buysome']").val());                          //活动标签
            post.limited_time_start = $("input[name='limited_time_start']").val();
            post.limited_time_end   = $("input[name='limited_time_end']").val();
            if (post.buysome == '') {
                alert('请填写活动标签');
                return false;
            }
            if(!post.limited_time_start || !post.limited_time_end){
                dialog.showTips('请选择秒杀场次时间段','warn');return false;
            }
        } else {
            post.sorts = parseInt($("input[name='sorts']").val());                         //排序
            post.title = $.trim($("input[name='title']").val());                           //商品名称
            post.subtitle = $.trim($("input[name='subtitle']").val());                        //商品简介
            post.goods_ser = $.trim($("input[name='goods_ser']").val());                        //商品服务
            post.keywords = $.trim($("input[name='keywords']").val());                        //关键字
            post.cateid = $.trim($("input[name='cateid']").val());                          //分类id
            post.catepid = $.trim($("input[name='catepid']").val());                          //分类id
            if(post.isactivity == '1') {
                post.timepoint = $.trim($("select[name='timepoint']").val());                    //场次时间点
                if (post.buysome == '') {
                    alert('请选择场次');
                    return false;
                }
                post.buysome = $.trim($("input[name='buysome']").val());                          //活动标签
                post.limited_time_start = $("input[name='limited_time_start']").val();
                post.limited_time_end   = $("input[name='limited_time_end']").val();
                if (post.buysome == '') {
                    alert('请填写活动标签');
                    return false;
                }
                if(!post.limited_time_start || !post.limited_time_end){
                    dialog.showTips('请选择秒杀场次时间段','warn');return false;
                }
            }
            post.ischoice = parseInt($("input[name='ischoice']:checked").val());              //推荐
            post.ishot = parseInt($("input[name='ishot']:checked").val());                 //热卖
            post.isnew = parseInt($("input[name='isnew']:checked").val());                 //新品
            post.price = parseFloat($("input[name='price']").val());                       //商品价格售价
            post.oprice = parseFloat($("input[name='oprice']").val());                      //商品价格原价
            post.costprice = parseFloat($("input[name='costprice']").val());                   //商品价格成本价
            post.logo = $.trim($("input[name='logo']").val());                            //商品logo图片
            post.detailpic = get_many_pic();
            post.issale = parseInt($("input[name='issale']:checked").val());                //上架
            post.is_new = parseInt($("input[name='is_new']:checked").val());                //新品
            post.goodscode = $.trim($("input[name='goodscode']").val());                       //产品编码
            post.stock = parseInt($("input[name='stock']").val());                         //库存
            post.is_sku = parseInt($("input[name='is_sku']:checked").val());                //是否启用SKU
            post.guige = $.trim($("input[name='guige']").val());                           //规格
            post.goods_param = $.trim($("#select_parameter_id").val());             //商品参数
            post.detail = UE.getEditor('editor').getContent();                              //商品详情
            post.share_title = $.trim($("input[name='share_title']").val());                     //分享标题
            post.share_desc = $.trim($("textarea[name='share_desc']").val());                   //分享描述
            post.share_logo = $.trim($("input[name='share_logo']").val());                      //分享图片
            post.goods_param = get_goods_param();                                                //商品参数
            console.log(post);
            if (post.title == '') {
                alert('请填写商品名称');
                return false;
            }
            if (post.subtitle == '') {
                alert('请填写商品简介');
                return false;
            }
            if (post.goods_ser == '') {
                alert('请填写商品服务');
                return false;
            }
            if (!post.cateid) {
                dialog.showTips('请选择商品分类', 'warn');
                return false;
            }
            if (post.logo == '' || post.logo == null) {
                alert('请上传商品LOGO!');
                return false;
            }
            if (post.detailpic == '') {
                alert('请上传商品轮播图');
                return false;
            }
            if (post.goodscode == '') {
                alert('请填写商品编号');
                return false;
            }
            if (post.stock == '') {
                alert('请填写商品库存');
                return false;
            }
            if (post.price == '') {
                alert('请填写商品现价');
                $('.price').focus();
                return false;
            }
            if (post.oprice == '') {
                alert('请填写商品原价');
                $('.oprice').focus();
                return false;
            }
            if (post.is_sku == 1) {
                post.skulistidarr = get_sku_idarr();                                                //skuid
                post.skulistarr = make_sku_to_arr();                                              //SKU数组
                if (post.skulistarr == false) {
                    return false;
                }
                var count_txt_store = parseInt($(".Count_Txt_Store").val());                          //库存
                post.stock = count_txt_store ? count_txt_store : post.stock;
            }
            if (post.detail == '') {
                alert('请填写商品详情');
                return false;
            }
        }

        var _protocol = window.location.protocol;
        var _host = window.location.host;
        var _url = _protocol + "//" + _host + "/Admin/Goods/addgoods";
        console.log(_url);
        console.log(100);
        console.log(post);
        $.post(_url, post, function (g) {
            console.log(g);
            if (g.status == 1) {
                var p = parseInt($("input[name='page']").val());
                dialog.showTips(g.info, '', g.url + '/p/' + p);
                return false;
            } else {
                dialog.showTips(g.info, 'warn');
                return false;
            }
        }, "JSON").error(function () {
            console.log("处理失败");
        });
    });
})


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