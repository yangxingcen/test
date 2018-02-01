/***商品公共模块***/
/***函数部分S*****/

/***搜索商品S***/
function searchGoods(param){
    $(".select-goods").hide();
    $("#albums-overlay").hide();
    var param = param ? parseInt(param) : 0;
    console.log(param)
    if(param > 0){
        $.post('/Admin/Spikegoods/retrieve',{goodsid:param},function(g){
            if(g.status==1){
                //fill_data_to_page(g.info);
            }else{
                dialog.showTips(g.info,'warn');return false;
            }
        },'json');
    }else{
        dialog.showTips('获取商品ID错误，请刷新页面重试','warn');
    }
}
/***搜索商品S***/

/***填充商品数据到页面S***/
function fill_data_to_page(data){
    if(data){
        console.log(data);
        $(".content-right input[name='malltype'][value='"+data.malltype+"']").prop("checked", "checked");       //商品类型
        ////商品信息
        $(".content-right input[name='sorts']").val(data.sorts);                                                //排序
        $(".content-right input[name='title']").val(data.title);                                                //名称
        $(".content-right input[name='subtitle']").val(data.subtitle);                                          //副标题
        $(".content-right input[name='buysome']").val(data.buysome);                                            //买点
        $(".content-right input[name='keywords']").val(data.keywords);                                          //关键字
        $(".content-right input[name='isabroad'][value='"+data.isabroad+"']").prop("checked", "checked");       //海外
        $(".content-right input[name='type'][value='"+data.type+"']").prop("checked", "checked");               //类型
        $(".content-right input[name='ispresell'][value='"+data.ispresell+"']").prop("checked", "checked");     //预售设置
        //分类
        if(data.catetitles && data.cateid){
            var catehtmlo = '',catehtmlt='';
            $.each(data.catetitles,function(k,v){
                var temp = '';
                temp = "【"+v.id+"】"+v.classname;
                catehtmlo += temp;
                catehtmlt += '<li class="li" onclick="booking_delli(this);" data-id="'+v.id+'">'+temp+'</li>';
            });
            $(".content-right #class_name").text(catehtmlo);                                                    //内容部分显示
            $(".select-fenlei .booking_ul").html(catehtmlt);                                                    //弹框分类追加类别
            
            $(".content-right #cateid").val(data.cateid);                                                      //内容部分显示
            $(".select-fenlei #booking_bathgoods_ids").val(data.cateid);                                        //弹框分类追加类别
        }
        
        //属性
        $(".content-right input[name='ischoice'][value='"+data.ischoice+"']").prop("checked", "checked");       //推荐
        $(".content-right input[name='ishot'][value='"+data.ishot+"']").prop("checked", "checked");       //热卖
        $(".content-right input[name='isnew'][value='"+data.isnew+"']").prop("checked", "checked");       //新品
        $(".content-right input[name='isbaoyou'][value='"+data.isbaoyou+"']").prop("checked", "checked");       //包邮
        
        //$(".content-right select[='express_model']").val(express_model);        //运费模板
        
        //运费规则
        $(".content-right input[name='price']").val(data.price);       //价格
        $(".content-right input[name='oprice']").val(data.oprice);       //原价
        $(".content-right input[name='costprice']").val(data.costprice);       //成本价
        $(".content-right input[name='integralprice']").val(data.integralprice);       //可抵扣积分价
        //LOGO图片
        //轮播展示图
        $(".content-right input[name='virtualsales']").val(data.virtualsales);       //虚拟销量
        //买个ID限购
        //自定义标签
        $(".content-right input[name='issale'][value='"+data.issale+"']").prop("checked", "checked");       //上架
        $(".content-right input[name='istui'][value='"+data.istui+"']").prop("checked", "checked");       //支持退换货
        $(".content-right input[name='receivetime']").val(data.receivetime);       //确认收货时间
        //发货地
        ////库存
        $(".content-right input[name='goodscode']").val(data.goodscode);       //编码
        $(".content-right input[name='weight']").val(data.weight);       //重量
        $(".content-right input[name='stock']").val(data.stock);       //库存
        $(".content-right input[name='supplier']").val(data.supplier);       //供应商
        $(".content-right input[name='suppliercode']").val(data.suppliercode);       //供应商编码
        ////属性规格
        $(".content-right input[name='is_sku'][value='"+data.is_sku+"']").prop("checked", "checked");       //启用
        ////商品参数
        
        ////商品详情
        _initEditor(data.detail);
        ////购买权限
        $(".content-right input[name='is_buy_power'][value='"+data.is_buy_power+"']").prop("checked", "checked");       //开启
        ////会员折扣
        $(".content-right input[name='is_part_zhekou'][value='"+data.is_part_zhekou+"']").prop("checked", "checked");           //启用
        ////分销
        $(".content-right input[name='is_take_fenxiao'][value='"+data.is_take_fenxiao+"']").prop("checked", "checked");    //启用
        ////线下核销
        $(".content-right input[name='is_hexiao'][value='"+data.is_hexiao+"']").prop("checked", "checked");    //启用
        ////分享参数
        $(".content-right input[name='share_title']").val(data.share_title);       //分享标题
        $(".content-right textarea[name='share_desc']").val(data.share_desc);       //分享描素
        //分享图片
    }
    return false;
}
/***填充商品数据到页面E***/

/***初始化编辑器S***/
function _initEditor(content){
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
    if(content){
        ue.setContent(content);
    }
}
/***初始化编辑器E***/


/***移除分类S***/
function booking_delli(n){
    $(n).remove();
    var bathgoodsids=[];
    $('.booking_ul li').each(function(){
        bathgoodsids.push($(this).attr('data-id'));
    })
    var idstr = bathgoodsids.join(",");
    $("#booking_bathgoods_ids").val(idstr);
}
/***移除分类E***/

/***删除图片S***/
function delImg(obj){
    if(confirm("删除这张图片?")){
        var id = $(obj).attr("data-id")
        if(id){
            alert(1);return false;
        }
        $(obj).next("input").remove();
        $(obj).remove();
    }
    return false;
}
/***删除图片E***/

/***函数部分E***/

/***加载完初始化页面***/
$(document).ready(function(){
    /***商品搜索S***/
    $(".content-right .search_goods").click(function(){
        $(".select-goods .select-goods-li").html('');
        var goods_keystr = $.trim($(this).parent().find("input[name=search_goods_title]").val());
        if(goods_keystr.length > 1){
            $.post('/Admin/Spikegoods/actionDo',{action:'add_serch_goods',goods_keystr:goods_keystr},function(g){
                if(g.status==1){
                    var html = '';
                    $.each(g.info,function(k,v){
                        html +='<li class="li" onclick="searchGoods('+v.goodsid+');" data-id="'+v.goodsid+'"><u>【'+v.goodsid+'】'+v.title+'</u></li>';
                    });
                    $(".select-goods .select-goods-li").html(html);
                    $("#albums-overlay").show();
                    $(".select-goods").show();
                }else{
                    dialog.showTips(g.info,'warn');return false;
                }
            },'json');
        }else{
            dialog.showTips('请填写搜索商品标题','warn');  return false;
        }
    });
    /***商品搜索E***/
    
    /***商品类型S***/
    $("input[name='malltype']").change(function(){
        var typeid = parseInt($("input[name='malltype']:checked").val());
        console.log(typeid);
        switch(typeid){
            case 2:                                                             //积分
                $(".jifen_set").show();
                $(".kedikoujifen").show();
                $(".shifoushiyongjifen").hide();
            break;
            default:                                                            //普通
                $(".jifen_set").hide();
                $(".kedikoujifen").hide();
                $(".shifoushiyongjifen").hide();
            break;
        }
    });
    /***商品类型E***/
    
    /***团购限时S***/
    $("input[name=is_tuan_limited_time]").change(function(){
        var value = $(this).filter(':checked').val();
        if(value==1){
            $(".is_tuan_limited_time").show();
        }else{
            $(".is_tuan_limited_time").hide();
        }
    });
    /***团购限时S***/
    
    /***时间段S***/
    /* $.jeDate("input[name='limited_time_start']",{
        isinitVal:true,
        initDate:[{hh:00,mm:00,ss:00},false],
        format: "YYYY-MM-DD hh:mm:ss",
    }); */
    var isactivity = parseInt($(".content-right input[name='isactivity']").val());   console.log(isactivity);
    // if((isactivity ==3) || (isactivity ==4)){
        $.jeDate("input[name='limited_time_start']",{
            isinitVal:false,
            format: "YYYY-MM-DD hh:mm:ss",
        });
        $.jeDate("input[name='limited_time_end']",{
            isinitVal:false,
            format: "YYYY-MM-DD hh:mm:ss",
        });
    // }
    // else{
    //     $.jeDate("input[name='limited_time_start']",{
    //         isinitVal:false,
    //         isTime:false,
    //         //format: "YYYY-MM-DD hh:mm:ss",
    //         format: "YYYY-MM-DD",
    //     });
    //     $.jeDate("input[name='limited_time_end']",{
    //         isinitVal:false,
    //         isTime:false,
    //         //format: "YYYY-MM-DD hh:mm:ss",
    //         format: "YYYY-MM-DD",
    //     });
    // }
    
    /***时间段E***/
    
    /***取消弹框S***/
    $(".cancle").click(function(){
        $('.jbox').hide();
        $('#albums-overlay').hide();
    });
    /***取消弹框E***/
    
    /***商品类型S***/
    $("input[name='type']").change(function(){
        var type_id = $("input[name='type']:checked").val();    console.log(type_id)
        if(type_id==2){
            $(".pifagoods").hide();
            $(".xunigoods").show();
            $(".goods_price").show();
        }else if(type_id==3){
            $(".xunigoods").hide();
            $(".goods_price").hide();
            $("input[name='isautodelivery']").eq(0).attr("checked",'checked');
            $(".subxunigoods").hide();
            $(".pifagoods").show();
            
        }else{
            $(".xunigoods").hide();
            $(".pifagoods").hide();
            $(".subxunigoods").hide();
            $(".goods_price").show();
        }
    });
    /***商品类型E***/
    
    /***自动发货内容S***/
    $("input[name='isautodelivery']").change(function(){
        var value = parseInt($(this).filter(':checked').val());
        if(value==1){
            $(".subxunigoods").show();
        }else{
            $(".subxunigoods").hide();
        }
    });
    /***自动发货内容E***/
    
    /***批发价格S***/
    /***添加S***/
    $("#add_pifa").click(function(){
        var html = "<tr>"+
            "<td><input type=\"text\" class=\"input\" name=\"pifa_num\" onKeyUp=\"this.value=this.value.replace(/\\D/g,'')\" onafterpaste=\"this.value=this.value.replace(/\\D/g,'')\" maxlength=\"11\" /></td>"+
            "<td><input type=\"text\" class=\"input large\" name=\"pifa_price\" onkeyup=\"if(!/^(0|[1-9]\\d{0,8}?)(\\.\\d{0,2})?$/.test(this.value)){this.value='';}\" onafterpaste=\"if(!/^(0|[1-9]\\d{0,8}?)(\\.\\d{0,2})?$/.test(this.value)){this.value='';}\" /></td>"+
            "<td><span class=\"thisparam_del gicon-remove\" style=\"padding-top:2px;cursor:pointer;\" title=\"删除\"></span></td>"+
            "</tr>";
        $("#pijiaprice").after(html);
        $(".thisparam_del").bind('click',function(){
            $(this).parent().parent().remove();
        })
    });
    
    /***移除S***/
    $(".thisparam_del").click(function(){
        $(this).parent().parent().remove();
    });
    /***批发价格E***/
    
    /***商品分类S***/
    $("#j-select_category_id").click(function(){
        $('.select-fenlei').show();
        $('#albums-overlay').show();
    });
    /***商品分类E***/
    
    /***商品分类搜索S***/
    $(".select-fenlei .search_category").click(function(){
        var category = $.trim($(".select-fenlei input[name='search_category']").val());
        if(category){
            var stat = true;
            $(".select-fenlei #select_class_id option").each(function(){
                var txt = $.trim($(this).text());
                if(txt.indexOf(category) !=-1){
                    $(this).attr("selected","selected");
                    stat=false;
                    return false;
                }
            });
            if(stat){
                dialog.showTips('没有找到相关分类','warn');
            }
        }else{
            dialog.showTips('请输入分类标题','warn');
        }
    });
    /***商品分类搜索S***/
    
    /***请选择商品分类S***/
    $(".search_booking_bathgoods_ok").click(function(){
        var option          = $("#select_class_id").val();
        var option_html     = $("#select_class_id option:selected").attr('name');
        var bathgoods_ids   = $("#booking_bathgoods_ids").val();
        //判断分类是否选择
        var getDataIds=bathgoods_ids.split(",");
        var a = getDataIds.indexOf(option);
        if(a > -1){
            dialog.showTips('此分类已选择','warn');return false;
        }
        if(option>0){
            var html = "<li class='li' onclick='booking_delli(this);'  data-id='"+option+"'>"+option_html+"</li>"
            $(".booking_ul").append(html);
            var bathgoodsids=[];
            if(bathgoods_ids==0){
                $("#booking_bathgoods_ids").val(option);
                bathgoodsids.push(option);
            }else{
                $('.booking_ul li').each(function(){
                    bathgoodsids.push($(this).attr('data-id'));
                })
            }
            var idstr = bathgoodsids.join(",");
            $("#booking_bathgoods_ids").val(idstr);
        }
    });
    $("#select_class").click(function(){
        var bathgoods_ids_str = $("#booking_bathgoods_ids").val();
        $("#cateid").val(bathgoods_ids_str);
        var html = $.trim($(".booking_bathgoods_names").text());
        $("#class_name").text(html);
        $(this).parent().parent('.jbox').hide();
        $('#albums-overlay').hide();
    });
    /***请选择商品分类E***/
    
    /***包邮S***/
    $("input[name='isbaoyou']").change(function () {
        var id =parseInt($("input[name='isbaoyou']:checked").val());
        if(id==1){
            $(".set_yunfei").hide();
        }else{
            $(".set_yunfei").show();
        }
    });
    /***包邮E***/
    
    /***商品LOGOS***/
    $(".xuanze").change(function(){
        var _upImg   = $(this);
        var _field   = _upImg.attr('data-field');
        var _parent  = _upImg.parent().parent();
        var _speed   = _parent.find('span.xuanze_percent');
        var _showImg = _parent.find('div.xuanze_showimge');
        var _speedsn = _parent.find('div.xuanze_progress');
        _upImg.wrap("<form action='/Admin/Index/addImage' method='post' enctype='multipart/form-data'></form>");
        _parent.find("form").ajaxSubmit({
            dataType:  'json',                                      //数据格式为json
            beforeSend: function() {                                //开始上传
                _upImg.addClass("disabled");
                _speedsn.show();                                    //显示进度条
                var percentVal = '0%';
                _speed.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';                     //获得进度
                _speed.html(percentVal);                                    //显示上传进度百分比
            },
            success:function(g){
                _upImg.unwrap();
                _speedsn.hide();
                _upImg.removeClass("disabled");
                if(g.status ==0){
                    dialog.showTips(g.info,'warn');
                }else{
                    var data = g[0];
                    var img = '<img src="'+data.savepath.substring(1) + data.savename+'" height="80">';
                        img+= '<input type="hidden" name="'+_field+'" value="'+data.savepath.substring(1)+data.savename+'"></input>';
                        _showImg.html(img);
                }
            },
            error:function(xhr){            //上传失败
                //console.log(xhr.status)
                _upImg.removeClass("disabled");
            }
        });
    });
    /***商品logoE***/
    /***轮播展示图S***/
    $(".duoxuan_upLoadImg").change(function(){
        var _upImg   = $(this);
        var _field   = _upImg.attr('data-filed');
        var _parent  = _upImg.parent().parent();
        var _speed   = _parent.find('span.duoxuan_percent');
        var _showImg = _parent.find('ul.duoxuan_showimge');
        var _speedsn = _parent.find('div.duoxuan_progress');
        _upImg.wrap("<form action='/Admin/Index/addImage' method='post' enctype='multipart/form-data'></form>");
        _parent.find("form").ajaxSubmit({
            dataType:  'json',                                      //数据格式为json
            beforeSend: function() {                                //开始上传
                _upImg.addClass("disabled");
                _speedsn.show();                                    //显示进度条
                var percentVal = '0%';
                _speed.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';                     //获得进度
                _speed.html(percentVal);                                    //显示上传进度百分比
            },
            success:function(g){
                _upImg.unwrap();
                _speedsn.hide();
                _upImg.removeClass("disabled");
                if(g.status ==0){
                    dialog.showTips(g.info,'warn');
                }else{
                    var data = g[0];
                    var img = '<img src="'+data.savepath.substring(1) + data.savename+'" height="80" class="mgr10 mgt10 " onclick="delImg(this)">';
                        img+= '<input type="hidden" name="'+_field+'[]" value="'+data.savepath.substring(1)+data.savename+'"></input>';
                        _showImg.append(img);
                }
            },
            error:function(xhr){            //上传失败
                //console.log(xhr.status)
                _upImg.removeClass("disabled");
            }
        });
    });
    /***轮播展示图E***/
    
    
    /***自定义标签S***/
    /***发起自定义标签S***/
    $("#j-select_tag_id").click(function(){
        $('.select-tag').show();
        $('#albums-overlay').show();
    });

    /***删除商品标签S***/
    $(".deltag").bind('click',function(){
        $(this).remove();
    });
    
    /***选择商品标签S***/
    $(".tag").click(function(){
        var type = $(this).attr('data-type');
        var tagid = $(this).attr('data-id');
        var tag_id = $("#tag_id").val();
        var getDataIds = tag_id.split(",");
        var ddd = true;
        for (var i = 0; i < getDataIds.length; i++) {
            if(getDataIds[i] == tagid){
                ddd = false;
                return false;
            }
        }
        if(ddd){
            getDataIds.push(tagid);
        }
        idstr = getDataIds.join(",");
        $("#tag_id").val(idstr);
        data= {};
        data.taglist = idstr;
        $.post("/Admin/Goods/getSelectTagList",data,function(g){
            if(g.status==1){
                $("#select_tag_list").html(g.info);
                $(".deltag").bind('click',function(){
                    $(this).parent().remove();
                })
            }else{
                dialog.showTips(g.info,'warn');return false;
            }
        },"json");
    });
    /***自定义标签E***/
    
    /***退换货地址S***/
    $("input[name='istui']").change(function(){
        var type_id = parseInt($("input[name='istui']:checked").val());
        if(type_id==1){
            $(".tui_address").show();
        }else{
            $(".tui_address").hide();
        }
    });
    /***退换货地址E***/
    
    /***SKU S***/
    $("input[name='is_sku']").change(function () {
        var id =parseInt($("input[name='is_sku']:checked").val());
        if(id==1){
            var price          = parseFloat($("input[name='price']").val());
            var oprice         = parseFloat($("input[name='oprice']").val());
            var costprice      = parseFloat($("input[name='costprice']").val());
            var goodscode      = $.trim($("input[name='goodscode']").val());
            $(".div_contentlist2 .pi_oprice").val(oprice);
            $(".div_contentlist2 .pi_price").val(price);
            $(".div_contentlist2 .pi_fprice").val(costprice);
            $(".div_contentlist2 .pi_number").val(goodscode);
            $(".j-showinhyd").show();
        }else{
            $(".j-showinhyd").hide();
        }
    });
    /***SKU E***/
    
    /***商品添加参数S***/
    $("#add_param").click(function(){
        var html = "<tr>"+
            "<td><input type=\"text\" class=\"input\" name=\"param_name\" /></td>"+
            "<td><input type=\"text\" class=\"input large\" name=\"param_val\"/></td>"+
            "<td style='width:30px'><span class=\"thisparam gicon-remove\" title='删除' style=\"padding-top:2px;cursor:pointer;\"></span></td>"+
            "</tr>";
        $(this).parent().parent().find("#goodsparamtable").append(html);
        $(".thisparam").bind('click',function(){
            $(this).parent().parent().remove();
        })
    });
    /***商品添加参数E***/
    
    /***商品删除参数S***/
    $(".thisparam").bind('click',function(){
        $(this).parent().parent().remove();
    });
    /***商品删除参数E***/
    
    /***编辑器S***/
    _initEditor();
    /* var ue = UE.getEditor('editor',{
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
    }); */
    /***编辑器E***/
    
    /***购买权限S***/
    $("input[name='is_buy_power']").change(function(){
        var type_id = parseInt($("input[name='is_buy_power']:checked").val());
        if(type_id==1){
            $(".kaiqigoumaiqx").show();
        }else{
            $(".kaiqigoumaiqx").hide();
        }
    });
    /***购买权限E***/
    
    /***会员折扣S***/
    $("input[name='is_part_zhekou']").change(function () {
        var id =parseInt($("input[name='is_part_zhekou']:checked").val());
        if(id==1){
            $(".huiyuan_zhekou").show();
        }else{
            $(".huiyuan_zhekou").hide();
        }
    });
    /***会员折扣E***/
    
    /***参与分销S***/
    $("input[name='is_take_fenxiao']").change(function(){
        var type_id = $("input[name='is_take_fenxiao']:checked").val();
        if(type_id==1){
            $(".canyufenxiao").show();
        }else{
            $(".canyufenxiao").hide();
        }
    });
    /***参与分销E***/
    
    /***线下核销S***/
    $("input[name='is_hexiao']").change(function(){
        var type_id = $("input[name='is_hexiao']:checked").val();
        if(type_id==1){
            $(".zhichixianxiahexiao").show();
        }else{
            $(".zhichixianxiahexiao").hide();
            $(".duihuanxianshi2").hide();
        }
    });
    
    /***核销限时兑换S***/
    $("input[name='hexiao_type']").change(function (){
            var  id= $("input[name='hexiao_type']:checked").val()
            if(id =="0"){
                $(".duihuanxianshi1").show();
                $(".duihuanxianshi2").hide();
            }else if(id=="1"){
            $(".duihuanxianshi1").hide();
            $(".duihuanxianshi2").show();
        }
    });
    
    /***固定时间S***/
    $("input[name='youxiaoqi']").jeDate({
        format: "YYYY-MM-DD hh:mm:ss",
    });
    /***线下核销E***/
    
});