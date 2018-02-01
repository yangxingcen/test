/**
 * Created by Administrator on 14-12-01.
 * 模拟淘宝SKU添加组合
 * 页面注意事项：
 * 1、.div_contentlist   这个类变化这里的js单击事件类名也要改
 * 2、.Father_Title      这个类作用是取到所有标题的值，赋给表格，如有改变JS也应相应改动
 * 3、.Father_Item       这个类作用是取类型组数，有多少类型就添加相应的类名：如: Father_Item1、Father_Item2、Father_Item3 ...
 */

var step = {
    Creat_Table:function(){
        step.hebingFunction();                                                  //初始化表单
        var _babyPoint      = $(".Father_Title");                               //规格
        var _parentPoint    = $(".Father_Item");                                //属性
        var _titleArr       = new Array();                                      //标题组
        var _valueArr       = new Array();                                      //值组
        var _columnArr      = new Array();                                      //指定列,用来合并哪些列
        var _powerOpen      = false;                                            //开关
        var _columnIndex    = 0;

        //循环组合属性名和选中的属性值
        _babyPoint.each(function(x){
            var n = $(this).next().find('.Father_son').length;                  //当前规格的属性值
            if(n >0){                                                           //有被选中的值
                _columnArr.push(_columnIndex);
                _columnIndex ++;
                var _title = {};//规格
                    _title['classname'] = $(this).find('li').eq(0).html();
                    _title['skuid']     = $(this).find('li').eq(0).attr('data-skuid');
                var order = new Array();
                $(this).next().find('.Father_son').each(function(i){
                    var _value = {};//属性数组
                        _value['classname'] = $.trim($(this).find('label').eq(0).html());
                        _value['skuid']     = parseInt($(this).attr('data-skuid'));
                        order.push(_value);
                });
                _valueArr.push(order);
                    _title['subset'] = order;
                _titleArr.push(_title);
                if(order.length > 0){                                          //把数组中的所有元素放入一个字符串
                    _powerOpen = true;
                }
            }
        });
        //console.log(_powerOpen);
        //console.log(_titleArr);
        //console.log(_valueArr);
        //return false;
        if(_valueArr.length){
            $("input[name='goods_sku_info']").val(JSON.stringify(_titleArr));    //规格 goods表中的goods_sku_info
            $("input[name='guigeshuxing']").val(JSON.stringify(_valueArr));     //属性值
        }else{
            $("input[name='goods_sku_info']").val('');                                   //属性名
            $("input[name='guigeshuxing']").val('');                            //属性值
        }
        if(_powerOpen== true){
            var strlist      = [];
            var strlistvalue = [];
            $('#sku_table tbody tr').each(function(){                             //遍历 行元素
                var str = '';                                                   //获取每行的 sku 属性的组合拼接 如 ：红-3斤
                $(this).find('.skushuxing').each(function(){
                    if (str == '') {
                        str = $(this).html();
                    }else{
                        str = str+'-'+$(this).html();
                    }
                });
                var arr=[];                                                                             //获取每行的sku 属性值 构成数组
                arr.push($.trim($(this).find('.Txt_OPrice').val()));                                    //原价
                arr.push($.trim($(this).find('.Txt_Price').val()));                                     //现价
                arr.push($.trim($(this).find('.Txt_Cost_Price').val()));                                //成本价
                arr.push($.trim($(this).find('.Txt_Stock').val()));                                     //库存
                arr.push($.trim($(this).find('.Txt_Goods_Code').val()));                                //编码
                arr.push($.trim($(this).find('.Txt_Pic').val()));                                       //图片
                arr.push($.trim($(this).find('.Txt_sku_id').val()));                                    //skuid
                strlistvalue.push(arr);                 //如strlistvalue 数组 把“ 每行的sku 属性值 构成数组” 合并成一个数组
                strlist.push(str+'-');                  //如 strlist ：数组  把“获取每行的 sku 属性的组合拼接
            });
            $("#createTable").html("");                                         //清空表单
            var table = $('<table id="sku_table" border="1" cellpadding="1" cellspacing="0"></table>');
            table.appendTo($("#createTable"));                                  //appendTo() 在被选元素的结尾（仍然在内部）插入指定内容
            var thead = $("<thead></thead>");
            thead.appendTo(table);                                              //添加头部
            var trHead = $("<tr></tr>");
            trHead.appendTo(thead);                                             //添加一行
            $.each(_titleArr, function(index, item){
                var td = $('<th align="center">' + item.classname + '<input type="hidden" name="skuid" value="'+item.skuid+'"></th>');
                td.appendTo(trHead);
            });
            //console.log(_valueArr);
            var zuheDate = step.doExchange(_valueArr);                          //规格属性组合数据
            if(!zuheDate){
                return false;
            }
            if(zuheDate.length > 0){
                var itemColumHead = $('<th class="width50 tbcenter">原价</th><th class="width50 tbcenter">现价</th><th class="width50 tbcenter">成本价</th><th class="width50 tbcenter">库存</th><th class="width50 tbcenter">商品编码</th><th class="width70 tbcenter">LOGO图片</th>');
                itemColumHead.appendTo(trHead);
            }

            var tbody = $("<tbody></tbody>");                                   //创建表内容
                tbody.appendTo(table);
            if(zuheDate.length > 0){                                            //生成组合
                $.each(zuheDate, function(index, value){
                    $.each(value,function(i,item){
                        //console.log(item);
                        var td_array = item.classname.split("-");                   //字符串分割成为数组
                        var tr       = $('<tr></tr>');
                        tr.appendTo(tbody);
                        var str = '';
                        $.each(td_array, function(key, val){
                            if(str==''){
                                str = val;
                            }else{
                                str = str+'-'+val;
                            }
                            var td = $('<td class="skushuxing">'+val+'</td>');
                            td.appendTo(tr);
                        });
                        str     = str+'-';
                        var s   = 1;
                        var td1 = '';
                        var td2 = '';
                        var td3 = '';
                        var td4 = '';
                        var td5 = '';
                        var td6 = '';
                        //遍历 数组  把“获取每行的 sku 属性的组合拼接
                        $.each(strlist,function(v,n){
                            if((n.indexOf(str) >= 0) || (str.indexOf(n) >= 0)){
                                //原价
                                td1 = $('<td><input name="Txt_OPrice[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_OPrice input mini l-text" type="text" style="width:80px" value="'+strlistvalue[v][0]+'"></td>');
                                //现价
                                td2 = $('<td><input name="Txt_Price[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_Price input mini l-text" type="text" style="width:80px" value="'+strlistvalue[v][1]+'"></td>');
                                //成本价
                                td3 = $('<td><input name="Txt_Cost_Price[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_Cost_Price input l-text" type="text" style="width:80px" value="'+strlistvalue[v][2]+'"></td>');
                                //库存
                                td4 = $('<td><input name="Txt_Stock[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_Stock input l-text" type="text" style="width:80px" value="'+strlistvalue[v][3]+'"></td>');
                                //商品编码
                                td5 = $('<td><input name="Txt_Goods_Code[]" class="Txt_Goods_Code input l-text" type="text" style="width:100px" value="'+strlistvalue[v][4]+'"></td>');

                                //图片
                                td6 = $('<td >' +
                                        '<div class="input-group">'+
                                        '<img class="J_uploadImg" src="'+strlistvalue[v][5]+'"' +
                                        'onerror="this.src=\'http://dyshop.unohacha.com/Public/UploadImg/img/nopic.png\'; ' +
                                        'this.title=\'图片未找到\'"'+
                                        'width="50"/>'+
                                        '<input class="Txt_Pic" name="Txt_Pic[]" type="hidden" value="'+strlistvalue[v][5]+'">'+
                                        '</div>'+
                                        '<input class="Txt_sku_name_str" name="sku_name_str[]" type="hidden" value="-'+item.classname+'-">'+
                                        '<input class="Txt_sku_id_str" name="sku_id_str[]" type="hidden" value="-'+item.skuid+'-">'+
                                        '<input class="Txt_sku_id" name="sku_id[]" type="hidden" value="'+strlistvalue[v][6]+'"></td>');
                                s = 2;
                            }
                        });
                        /*
                        *sku_name_str属性'-'拼接
                        * sku_id_str 属性id的'-'拼接
                        * sku_id     编辑时数据库已存的skuid
                        * */
                        if (s == 1) {
                            //原价
                            td1 = $('<td ><input name="Txt_OPrice[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_OPrice input mini l-text" type="text" style="width:80px" value="" ></td>');
                            //售价
                            td2 = $('<td ><input  name="Txt_Price[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_Price input mini l-text" type="text" style="width:80px" value=""></td>');
                            //成本价
                            td3 = $('<td ><input name="Txt_Cost_Price[]" maxlength="10" onkeyup="this.value=this.value.replace(\/[^\\d\\.]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_Cost_Price input l-text" type="text" style="width:80px" value=""></td>');
                            //库存
                            td4 = $('<td ><input name="Txt_Stock[]" onkeyup="this.value=this.value.replace(\/[^\\d]+/g,\'\')" onblur="this.value=this.value.replace(/(\\.\\d{2})\\d*$/,\'\\$1\')" class="Txt_Stock input l-text" type="text" style="width:80px" value=""></td>');
                            //商品编码
                            td5 = $('<td ><input  name="Txt_Goods_Code[]" class="Txt_Goods_Code input l-text" type="text" style="width:100px" value=""></td>');
                             //图片
                             td6 = $('<td >' +
                                 '<div class="fl mgr10">' +
                                 '<img class="J_uploadImg" src=""'+
                                 'onerror="this.src=\'http://dyshop.unohacha.com/Public/UploadImg/img/nopic.png\'; ' +
                                 'this.title=\'图片未找到\'"'+
                                 'width="50"/>'+
                                 '<input name="Txt_Pic[]" class="Txt_Pic" type="hidden" value="">'+
                                 '</div>' +
                                 '<input class="Txt_sku_name_str" name="sku_name_str[]" type="hidden" value="-'+item.classname+'-">'+
                                 '<input class="Txt_sku_id_str" name="sku_id_str[]" type="hidden" value="-'+item.skuid+'-">'+
                                 '<input class="Txt_sku_id" name="sku_id[]" type="hidden" value="0">'+
                                 '</td>');
                        }
                        td1.appendTo(tr);
                        td2.appendTo(tr);
                        td3.appendTo(tr);
                        td4.appendTo(tr);
                        td5.appendTo(tr);
                        td6.appendTo(tr);
                    });
                });
            }                                                                   //结束组合
            _columnArr.pop();                                                   //删除数组中最后一项
            $(table).mergeCell({
                cols:_columnArr                                                 //配置cols项,用数组表示列的索引,从0开始
            });

            $('.Txt_OPrice').bind('input propertychange', function() {
                jisuan_small('Txt_OPrice','oprice');                                           //计算商品最低原价
            });
            $('.Txt_Price').bind('input propertychange', function() {
                jisuan_small('Txt_Price','price');                                               //计算商品最低售价
            });
            $('.Txt_Cost_Price').bind('input propertychange', function() {
                jisuan_small('Txt_Cost_Price','cost_price');                                            //计算商品最低出厂价
            });
            $('.Txt_Stock').bind('input propertychange', function() {
                jisuan_goodsStock();                                               //计算商品总库存
            });
            J_uploadImg_sku();
        }else{
            $("#createTable").html('');return false;
        }
    },
    //处理合并  初始化表单
    hebingFunction: function(){
        $.fn.mergeCell = function (options) {
            return this.each(function () {
                var cols = options.cols;
                for (var i = cols.length - 1; cols[i] != undefined; i--){
                    mergeCell($(this), cols[i]);
                }
                dispose($(this));
            });
        };
        function mergeCell($table, colIndex) {
            $table.data('col-content', '');                                     // 存放单元格内容
            $table.data('col-rowspan', 1);                                      // 存放计算的rowspan值 默认为1
            $table.data('col-td', $());                                         // 存放发现的第一个与前一行比较结果不同td(jQuery封装过的), 默认一个"空"的jquery对象
            $table.data('trNum', $('tbody tr', $table).length);                 // 要处理表格的总行数, 用于最后一行做特殊处理时进行判断之用
            $('tbody tr', $table).each(function (index) {                       // 进行"扫面"处理 关键是定位col-td, 和其对应的rowspan
                var $td = $('td:eq(' + colIndex + ')', this);                   // td:eq中的colIndex即列索引
                var currentContent = $td.html();                                // 取出单元格的当前内容
                if ($table.data('col-content') == '') {                         // 第一次时走此分支
                    $table.data('col-content', currentContent);
                    $table.data('col-td', $td);
                } else {
                    // 上一行与当前行内容相同
                    if ($table.data('col-content') == currentContent) {
                        // 上一行与当前行内容相同则col-rowspan累加, 保存新值
                        var rowspan = $table.data('col-rowspan') + 1;
                        $table.data('col-rowspan', rowspan);
                        // 值得注意的是 如果用了$td.remove()就会对其他列的处理造成影响
                        $td.hide();
                        // 最后一行的情况比较特殊一点
                        // 比如最后2行 td中的内容是一样的, 那么到最后一行就应该把此时的col-td里保存的td设置rowspan
                        if (++index == $table.data('trNum'))
                            $table.data('col-td').attr('rowspan', $table.data('col-rowspan'));
                    } else { // 上一行与当前行内容不同
                        // col-rowspan默认为1, 如果统计出的col-rowspan没有变化, 不处理
                        if ($table.data('col-rowspan') != 1) {
                            $table.data('col-td').attr('rowspan', $table.data('col-rowspan'));
                        }
                        // 保存第一次出现不同内容的td, 和其内容, 重置col-rowspan
                        $table.data('col-td', $td);
                        $table.data('col-content', $td.html());
                        $table.data('col-rowspan', 1);
                    }
                }
            });
        }
        // 同样是个private函数 清理内存之用
        function dispose($table) {
            $table.removeData();
        }
    },
    //组合数组
    doExchange: function (doubleArrays){
        var len = doubleArrays.length;
        if(len > 1){
            var arr1    = doubleArrays[0];              //console.log(arr1);
            var arr2    = doubleArrays[1];              //console.log(arr2);
            var len1    = doubleArrays[0].length;       //console.log(len1);
            var len2    = doubleArrays[1].length;       //console.log(len2);
            var newlen  = len1 * len2;                  //console.log(newlen);
            var temp    = new Array(newlen);
            var index   = 0;
            for (var i = 0; i < len1; i++) {
                for (var j = 0; j < len2; j++){
                    var item = new Array();
                    item['classname'] = arr1[i]['classname'] + "-" + arr2[j]['classname'];
                    item['skuid']     = arr1[i]['skuid'] + "-" + arr2[j]['skuid'];
                    temp[index]       = item;
                    index++;
                }
            }
            var newArray = new Array(len - 1);
            newArray[0] = temp;
            if (len > 2) {
                var _count = 1;
                for (var i = 2; i < len; i++) {
                    newArray[_count] = doubleArrays[i];
                    _count++;
                }
            }
            return step.doExchange(newArray);
        }else{
            return doubleArrays;
        }
    },
}

/*选择规格弹框 1*/
function J_add_guige_tankuang(obj){
    //已经选择的skuid
    var sku_id_checked  = '';
    $('.div_contentlist').find('.Father_Title').each(function(){
        sku_id_checked += '-'+$(this).attr('data-skuid');
    });

    $.post('/Admin/Goods/skuNameList',{pid:0,sku_id_checked:sku_id_checked},function(g){
        if(g.status==1){
            $('#Form_one .guige_content').parent().show();
            $('#Form_one .guige_content').empty().html(g.info);
        }else if(g.status==2){
            $('#Form_one .guige_content').parent().hide();
        }else{
            dialog.showTips(g.info,'warn'); return false;
        }
    },'json');
    $('#Form_one').find('.sku_id_checked_old').val(sku_id_checked);
    $('#Form_one').find('input[name=new_guige]').val('');
    $('#albums-overlay').show();
    $('.addguige').show();

}
/*选择规格弹框 1*/


/*添加规格 1*/
function J_add_guige(obj) {
    var post={};
    post =$("#Form_one").serializeArray();                                      //选择的规格
    var new_guige ='';
    new_guige = $.trim($('#Form_one').find('input[name=new_guige]').val());  //新增规格
    if(new_guige.indexOf("/") >= 0 ){
        alert('规格名不能使用特殊字符！');return false;
    }
    if(new_guige.indexOf(",") >= 0 ){
        alert('规格名不能使用特殊字符！');return false;
    }
    if(new_guige.indexOf("*") >= 0 ){
        alert('规格名不能使用特殊字符！');return false;
    }
    //遍历验证规格名称 是否和输入的规格名称相同
    var as = 1;
    $('#Form_one').find('input[type=checkbox]').each(function(n,s){
        if (new_guige == $(this).attr('data-value')) {
            as = 2;return;
        }
    });
    if (as == 2) {
        alert('规格名重复！');
        return false;
    }

    if(post.length ==1 && !new_guige){
        dialog.showTips('请选择规格/添加新规格','warn');return false;
    }
    var sku_arr_new = [];                           //新增的规格
    //重组选择的sku规格数组
    var sku_arr={};             //规格数组
    var sku_id_checked_new='';  //选择的规格
    $('#Form_one').find('input[type=checkbox]:checked').each(function(n,s){
        var sku_s={};
        sku_s['sku_name']=$(this).attr('data-value');
        sku_s['sku_id']=$(this).val();
        sku_arr[n]=sku_s;
        sku_id_checked_new +='-'+$(this).val();
    });

    if(new_guige){
        $.ajax({
            url: "/Admin/Skuattr/skuAttrAdd",
            type: "post",
            dataType: "json",
            async:false,
            data: {
                classname:new_guige,
                pid:0,
                sorts:0,
            }
        }).done(function(g){
            if (g.status == 1) {
                sku_arr_new=JSON.parse(g.data);
                //判断是否有新增的规格
                if(count(sku_arr_new)>0){
                    sku_arr[count(sku_arr)]=sku_arr_new; //追加到规格数组
                }
            } else {
                dialog.showTips(g.info,"warn"); return false;
            }
        })
    }
    //获取已经选择的规格
    var sku_id_checked_old = $(obj).prev().prev().val();


    //已有选择的sku
    if(sku_id_checked_old){
        var sku_id_checked_old_arr=[];
        var sku_id_checked_new_arr=[];
        sku_id_checked_old_arr = sku_id_checked_old.split("-");// 在每个(-)处进行分解。
        sku_id_checked_old_arr=$.grep(sku_id_checked_old_arr,function(n,i){return n;},false);//过滤空数组
        sku_id_checked_new_arr = sku_id_checked_new.split("-");// 在每个(-)处进行分解。
        sku_id_checked_new_arr=$.grep(sku_id_checked_new_arr,function(n,i){return n;},false);//过滤空数组
        //旧的有  新的没有
        var diff_old =get_diff(sku_id_checked_new_arr,sku_id_checked_old_arr);
        //删除旧的
        $.each(diff_old,function(key,value){
            $('.Father_Title'+value).remove();
            $('.Father_Item'+value).remove();
        })

        //新的有  旧的没有
        var diff_new =get_diff(sku_id_checked_old_arr,sku_id_checked_new_arr);
        //添加新的
        //获取新增的数组
        $.each(sku_arr,function(k,v){
            var _inexistence = $.inArray(v.sku_id,diff_new);//在数组中搜索指定的值，并返回其索引值
            if(_inexistence<0){
                delete sku_arr[k];
            }
        })
        var str ='';
        $.each(sku_arr,function(key,value){
            str += '<ul class="Father_Title Father_Title'+value['sku_id']+'" data-skuid=' + value['sku_id'] + ' style="clear: both;padding-top: 20px;border-top: 1px solid #ccc;"> ' +
                '<li data-skuid="' + value['sku_id'] +'" style="float:left;font-weight: bold;font-size: 16px;line-height:22px; margin-right:4px;">' + value['sku_name'] + '</li>' +
                '<li class="li_width fl">' +
                '<label>' +
                '<button type="button" class="btn btn-mini btn-primary" onclick="J_add_shuxing_tankuang(this)"  data-skuid="' + value['sku_id'] + '" value="选择属性值"><i class="gicon-edit white"></i></button><span class="li_empty"></span></label>' +
                '<label>' +
                '<button type="button" class="btn btn-mini btn-danger" onclick="J_del_guige(this)" data-skuid="' + value['sku_id'] + '" value="删除"><i class="gicon-trash white"></i></button>' +
                '<span class="li_empty"></span>' +
                '</label>' +
                '</li>' +
                '<div style="clear: both"></div></ul><ul class="Father_Item' + value['sku_id'] + ' Father_Item"></ul>'
        });
    }else {
        var str = '';
        $.each(sku_arr, function (key, value) {
            str += '<ul class="Father_Title Father_Title'+value['sku_id']+'" data-skuid=' + value['sku_id'] + ' style="clear: both;padding-top: 20px;border-top: 1px solid #ccc;"> ' +
                '<li  data-skuid="' + value['sku_id'] +'" style="float:left;font-weight: bold;font-size: 16px;line-height:22px; margin-right:4px;">' + value['sku_name'] + '</li>' +
                '<li class="li_width fl"><label>' +
                '<button type="button" class="btn btn-mini btn-primary" onclick="J_add_shuxing_tankuang(this)"  data-skuid=' + value['sku_id'] + ' value="选择属性值"><i class="gicon-edit white"></i></button><span class="li_empty"></span></label>' +
                '<label><button type="button" class="btn btn-mini btn-danger" onclick="J_del_guige(this)" data-skuid="' + value['sku_id'] + '" value="删除"><i class="gicon-trash white"></i></button><span class="li_empty"></span></label></li>' +
                '<div style="clear: both"></div></ul><ul class="Father_Item' + value['sku_id'] + ' Father_Item"></ul>'
        })
    }
    $('.div_contentlist').append(str);
    $('.addguige').hide();
    $('#albums-overlay').hide();
}
/*添加规格 2*/


/*删除规格 1*/
function J_del_guige(obj){
    var pid = $(obj).attr('data-skuid');
    $('.Father_Title'+pid).remove();
    $('.Father_Item'+pid).remove();
    step.Creat_Table();
}
/*删除规格 2*/


/*添加属性弹框 1*/
function J_add_shuxing_tankuang(obj){
    var pid    = $(obj).attr("data-skuid");
    var sku_id_checked  = '';
    $('.Father_Item'+pid).find('.btn-danger').each(function(){
        sku_id_checked += '-'+$(this).attr('data-skuid');
    });
    var post={};
    post['pid'] =pid;
    post['sku_id_checked'] =sku_id_checked;

    if(post){
        $.post('/Admin/Goods/skuNameList',post,function(g){
            if(g.status==1){
                $('.addguigeshuxing .shuxing_content').parent().show();
                $('.addguigeshuxing .shuxing_content').html(g.info);
            }else if(g.status==2){
                $('.addguigeshuxing .shuxing_content').parent().hide();
            }else{
                dialog.showTips(g.info,'warn'); return false;
            }
        },'json');

        $('.addguigeshuxing').find('input[name=new_shuxing]').val('');
        $('.addguigeshuxing').find('input[name=sku_pid]').val(pid);
        $('#albums-overlay').show();
        $('.addguigeshuxing').show();
    }else{
        dialog.showTips('获取父级ID错误','warn');return false;
    }
}
/*添加属性弹框 2*/


/*添加属性 1*/
function J_add_shuxing(obj){
    var post={};
    post =$("#Form_two").serializeArray();                                      //选择的属性

    var pid         = $('.addguigeshuxing').find('input[name=sku_pid]').val();
    var new_shuxing    = $.trim($('.addguigeshuxing').find('input[name=new_shuxing]').val());
    if(new_shuxing.indexOf("/") >= 0 ){
        alert('规格值不能使用特殊字符！');return false;
    }
    if(new_shuxing.indexOf(",") >= 0 ){
        alert('规格值不能使用特殊字符！');return false;
    }
    if(new_shuxing.indexOf("*") >= 0 ){
        alert('规格值不能使用特殊字符！');return false;
    }
    //遍历验证规格名称 是否和输入的规格名称相同
    var as = 1;

    $('.addguigeshuxing').find('input[type=checkbox]').each(function(n,s){
        if (new_shuxing == $(this).attr('data-value')) {
            as = 2;return;
        }
    });
    if (as == 2) {
        alert('属性名重复！');
        return false;
    }
    if(post.length ==1 && !new_shuxing){
        dialog.showTips('请选择规格/添加新规格','warn');return false;
    }

    //重组选择的sku属性数组
    var sku_arr={};
    $('.addguigeshuxing').find('input[type=checkbox]:checked').each(function(n,s){
        var sku_s={};
        sku_s['sku_name']=$(this).attr('data-value');
        sku_s['sku_id']=$(this).val();
        sku_arr[n]=sku_s;
    });

    if(new_shuxing){
        $.ajax({
            url: "/Admin/Skuattr/skuAttrAdd",
            type: "post",
            dataType: "json",
            async:false,
            data: {
                classname:new_shuxing,
                pid:pid,
                sorts:0,
            }
        }).done(function (g) {
            if (g.status == 1) {
                sku_arr_new=JSON.parse(g.data);
                //判断是否有新增的规格
                if(count(sku_arr_new)>0){
                    sku_arr[count(sku_arr)]=sku_arr_new;
                }
            } else {
                dialog.showTips(g.info,"warn"); return false;
            }
        })
    }

    var str ='';
    $.each(sku_arr,function(key,value){
        str +='<li data-skuid="' + value['sku_id'] +'" class="li_width Father_son Father_son'+value['sku_id']+'" style="line-height:22px;margin-right:4px;float: left;">' +
            '<label  data-skuid="' + value['sku_id'] +'">' + value['sku_name'] + '</label>' +
            '<label><button type="button" class="btn btn-mini btn-danger" data-skuid="'+value['sku_id']+'" onclick="J_del_shuxing(this)" value="删除"><i class="gicon-trash white"></i></button></label>' +
            '</li>'
    })
    $('.Father_Item'+pid).empty().append(str);
    $('.addguigeshuxing').hide();
    $('#albums-overlay').hide();
    step.Creat_Table();
    J_uploadImg_sku();
}
/*添加属性 2*/


/*删除属性 1*/
function J_del_shuxing(obj){
    var pid = $(obj).attr('data-skuid');
    $('.Father_son'+pid).remove();
    step.Creat_Table();
}
/*删除属性 2*/


/*输入商品价格时同步到批量设置 1*/
function J_set_pval(obj){
    var value=$(obj).val();
    var nam=$(obj).attr("name");
    $('input[name=P_'+nam+']').val(value);
}
/*输入商品价格时同步到批量设置 2*/

/*上传SKU单图 1*/
function J_uploadImg_sku(){
    K=KindEditor;
    var editor = K.editor({
        uploadJson : "/Admin/User/addImage/type/3",
        fileManagerJson : "/Admin/User/uploadImgList/type/3",
        allowFileManager : true
    });
    K('.J_uploadImg').click(function() {
        var _this = $(this);
        editor.loadPlugin('image', function() {
            editor.plugin.imageDialog({
                imageUrl : K('#url1').val(),
                clickFn : function(url, title, width, height, border, align) {
                    _this.parent().find("img").attr("src",url);
                    _this.parent().find("input").attr("value",url);
                    editor.hideDialog();
                }
            });
        });
    })
}
/*上传SKU单图 2*/




/*批量添加  1*/
$('#piliang').click(function(){
    var P_oprice    = $("input[name=P_oprice]").val();
    var P_price     = $("input[name=P_price]").val();
    var P_cost_price= $("input[name=P_cost_price]").val();
    var P_stock     = $("input[name=P_stock]").val();
    var P_goods_code= $("input[name=P_goods_code]").val();
    if (P_oprice != '') {
         $('.Txt_OPrice').val(P_oprice);
    }
    if (P_price != '') {
        $('.Txt_Price').val(P_price);
    }
    if (P_cost_price != '') {
        $('.Txt_Cost_Price').val(P_cost_price);
    }
    if (P_stock != '') {
        $('.Txt_Stock').val(P_stock);
    }
    if (P_goods_code != '') {
        $('.Txt_Goods_Code').val(P_goods_code);
    }

    jisuan_small('Txt_OPrice','oprice');
    jisuan_small('Txt_Price','price');
    jisuan_small('Txt_Cost_Price','cost_price');
    jisuan_goodsStock();
});
/*批量添加  2*/









/*获取对象长度、字符串 1*/
function count(obj){
    var objType = typeof obj;
    if(objType == "string"){
        return obj.length;
    }else if(objType == "object"){
        var objLen = 0;
        for(var i in obj){
            objLen++;
        }
        return objLen;
    }
    return false;
}
/*获取对象长度、字符串 2*/


/*求两个集合的差集 在array2 不在array1中的元素 1*/
function get_diff(array1,array2){
    var arr3 =[];
    for (key in array2) {
        var stra = array2[key];
        var count = 0;
        for(var j= 0; j < array1.length; j++){
            var strb = array1[j];
            if(stra == strb) {
                count++;
            }
        }
        if(count===0) {//表示数组1的这个值没有重复的，放到arr3列表中
            arr3.push(stra);
        }
    }
    return arr3;
}
/*求两个集合的差集 在array2 不在array1中的元素 2*/


/*删除对象数组元素 1*/
function remove(array,index) {
    if(index<=(array.length-1)){
        for(var i=index;i<array.length;i++){
            array[i]=array[i+1];
        }
    }else{
        throw new Error('超出最大索引！');
    }
    array.length=array.length-1;
    return array;
}
/*删除对象数组元素 2*/
/*计算商品最低原价 现价 成本价 1*/
function jisuan_small(name1,name2){
    var num = 0;
    $('#sku_table tbody tr').each(function(){
        var value = $(this).find('.'+name1).val();//获取值
        if (value != '') {
            if (num == 0) {
                num = value;
            }else{
                if (parseFloat(value) < parseFloat(num)) {
                    num = value;
                }
            }
            $('input[name='+name2+']').val(num);
        }
    });
}
/*计算商品最低原价 现价 成本价 2*/

/*计算商品总库存 1*/
function jisuan_goodsStock() {
    var num = 0;
    $('#sku_table tbody tr').each(function(){
        if ($(this).find('.Txt_Stock').val() != '') {
            num = num+parseInt($(this).find('.Txt_Stock').val());
        }
    });
    $('input[name=stock]').val(num);
}
/*计算商品总库存 2*/

step.Creat_Table();
J_uploadImg_sku();
J_del_guige();
J_del_shuxing();