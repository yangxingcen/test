/**
 * Created by Administrator on 14-12-01.
 * 模拟淘宝SKU添加组合
 * 页面注意事项：
 * 1、.div_contentlist   这个类变化这里的js单击事件类名也要改
 * 2、.Father_Title      这个类作用是取到所有标题的值，赋给表格，如有改变JS也应相应改动
 * 3、.Father_Item       这个类作用是取类型组数，有多少类型就添加相应的类名：如: Father_Item1、Father_Item2、Father_Item3 ...
 */
$(".div_contentlist label").bind("change", function () {
    step.Creat_Table();
});


var step = {
    //Cyonger iwanjiao@qq 201711031132
    Creat_Table:function(){
        step.hebingFunction();                                                  //初始化表单
        var _parentPoint    = $(".Father_Item");                                //属性名
        var _babyPoint      = $(".Father_Title");                               //属性值组
        var _titleArr       = new Array();                                      //标题组
        var _valueArr       = new Array();                                      //值组
        var _columnArr      = new Array();                                      //指定列,用来合并哪些列
        var _powerOpen      = false;                                            //开关
        var _columnIndex    = 0;
        // console.log(1);
        //循环组合属性名和选中的属性值
        _babyPoint.each(function(x){
            _columnArr.push(_columnIndex);
            _columnIndex ++;
            var n = $(this).next().find('input[type=checkbox]:checked').length; //判断值有没有被选中
            if(n >0){                                                           //有被选中的值
                var _title = {};
                    _title['classname'] = $(this).find('li:nth-child(1)').html();
                    _title['skuid']     = parseInt($(this).find('li:nth-child(2)').find('input:nth-child(1)').attr('data-skuid'));
                var order = new Array();
                $(this).next().find('input[type=checkbox]:checked').each(function(i){
                    var _value = {};
                        _value['classname'] = $(this).val();
                        _value['skuid']     = parseInt($(this).attr('data-cskuid'));
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
        //var _titleStr = step.arrToStr(_titleArr);
        //console.log(_titleStr);
        //console.log(_valueArr);console.log(_powerOpen);
        //console.log(_valueArr.length);
        //return false;
        if(_valueArr.length){
            $("input[name='guige']").val(JSON.stringify(_titleArr));            //属性名
            $("input[name='guigeshuxing']").val(JSON.stringify(_valueArr));     //属性值
        }else{
            $("input[name='guige']").val('');                                   //属性名
            $("input[name='guigeshuxing']").val('');                            //属性值
        }
        if(_powerOpen== true){
            var strlist      = [];
            var strlistvalue = [];
            $('#process tbody tr').each(function(){                             //遍历 行元素
                var str = '';                                                   //获取每行的 sku 属性的组合拼接 如 ：红-3斤
                $(this).find('.skushuxing').each(function(){
                    if (str == '') {
                        str = $(this).html();
                    }else{
                        str = str+'-'+$(this).html();
                    }
                });
                var arr=[];                                                                                 //获取每行的sku 属性值 构成数组
                if(parseFloat($(this).find('.Txt_OPrice').val())){
                    arr.push(parseFloat($(this).find('.Txt_OPrice').val()));                                //原价
                }else{
                    arr.push($.trim($(this).find('.Txt_OPrice').val()));
                }
                if(parseFloat($(this).find('.Txt_Price').val())){
                    arr.push(parseFloat($(this).find('.Txt_Price').val()));                                 //售价
                }else{
                    arr.push($.trim($(this).find('.Txt_Price').val()));                                     //售价
                }
                if(parseFloat($(this).find('.Txt_FPrice').val())){
                    arr.push(parseFloat($(this).find('.Txt_FPrice').val()));                                //出厂价
                }else{
                    arr.push($.trim($(this).find('.Txt_FPrice').val()));                                    //出厂价
                }
                if(parseInt($(this).find('.Txt_Store').val())){
                    arr.push(parseInt($(this).find('.Txt_Store').val()));                                   //库存
                }else{
                    arr.push($.trim($(this).find('.Txt_Store').val()));                                     //库存
                }
                if(parseInt($(this).find('.Txt_Number').val())){
                    arr.push(parseInt($(this).find('.Txt_Number').val()));                                  //编码
                }else{
                    arr.push($.trim($(this).find('.Txt_Number').val()));                                    //编码
                }
                arr.push($.trim($(this).find('.Txt_Pic').val()));                                           //图片
                arr.push($.trim($(this).find("input[name='skulist[]']").attr('data-idstr')));               //skulistid
                if(parseInt($(this).find("input[name='skulist[]']").attr('data-attrskuid'))){
                    arr.push(parseInt($(this).find("input[name='skulist[]']").attr('data-attrskuid')));     //sku组合
                }else{
                    arr.push($.trim($(this).find("input[name='skulist[]']").attr('data-attrskuid')));       //sku组合
                }
                strlistvalue.push(arr);                 //如strlistvalue 数组 把“ 每行的sku 属性值 构成数组” 合并成一个数组
                strlist.push(str+'-');                  //如 strlist ：数组  把“获取每行的 sku 属性的组合拼接
            });
            //console.log(strlist);
            //var RowsCount = 0;                                                //初始化行数
            $("#createTable").html("");                                         //清空表单
            var table = $('<table id="process" border="1" cellpadding="1" cellspacing="0"></table>');
            table.appendTo($("#createTable"));                                  //appendTo() 在被选元素的结尾（仍然在内部）插入指定内容
            var thead = $("<thead></thead>");
            thead.appendTo(table);                                              //添加头部
            var trHead = $("<tr></tr>");
            trHead.appendTo(thead);                                             //添加一行
            $.each(_titleArr, function(index, item){
                //console.log(index);console.log(item);
                var td = $('<th align="center">' + item.classname + '<input type="hidden" name="skuid" value="'+item.skuid+'"></th>');
                td.appendTo(trHead);
            });
            //console.log(_valueArr);
            var zuheDate = step.doExchange(_valueArr);                          //规格属性组合数据
            //console.log(zuheDate);
            //console.log(zuheDate.length);
            if(!zuheDate){
                return false;
            }
            if(zuheDate.length > 0){
                var itemColumHead = $('<th class="width50 tbcenter">原价</th><th class="width50 tbcenter">售价</th><th class="width50 tbcenter">出厂价</th><th class="width50 tbcenter">库存</th><th class="width50 tbcenter">商品编码</th><th class="width70 tbcenter">LOGO图片</th>');
                itemColumHead.appendTo(trHead);
            }
            var tbody = $("<tbody></tbody>");                                   //创建表内容
                tbody.appendTo(table);
            if(zuheDate.length > 0){                                            //生成组合
                $.each(zuheDate, function(index, value){
                    $.each(value,function(i,item){
                        //console.log(item);
                        var td_array = item.classname.split(",");                   //字符串分割成为数组
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
                                td1 = $("<td ><input name=\"Txt_OPrice[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d\\.]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_OPrice input mini l-text\" type=\"text\" value=\""+strlistvalue[v][0]+"\" style=\"width:50px\">");
                                td2 = $("<td ><input name=\"Txt_Price[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d\\.]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_Price input mini l-text\" type=\"text\" style=\"width:50px\" value=\""+strlistvalue[v][1]+"\"></td>");
                                //出厂价
                                td3 = $("<td ><input name=\"Txt_FPrice[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d\\.]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_FPrice input l-text\" type=\"text\" style=\"width:50px\" value=\""+strlistvalue[v][2]+"\"></td>");
                                //库存
                                td4 = $("<td ><input name=\"Txt_Store[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_Store input l-text\" type=\"text\" style=\"width:50px\" value=\""+strlistvalue[v][3]+"\"></td>");
                                //商品编码
                                td5 = $("<td ><input name=\"Txt_Number[]\" class=\"Txt_Number input l-text\" type=\"text\" style=\"width:50px\" value=\""+strlistvalue[v][4]+"\"></td>");
                                //图片
                                td6 = $("<td ><div class=\"up_load_pic\">" +
                                     "<img  src=\""+strlistvalue[v][5]+"\"/>" +
                                     "<form class='upload_pic_form' action='/Admin/Index/addimage' method='post' enctype='multipart/form-data'>" +
                                        "<input type=\"file\" name='sku_pic' accept=\"image/jpg,image/jpeg,image/png\" class=\"upload_sku_pic\"  >" +
                                     "</form>" +
                                     "<input name=\"Txt_Pic[]\" class=\"Txt_Pic\" type=\"hidden\" value=\""+strlistvalue[v][5]+"\"> " +
                                     "</div>" +
                                     "<input name=\"skulist[]\" type=\"hidden\" data-attrskuid=\""+strlistvalue[v][7]+"\" data-idstr='"+item.skuid+"' value=\""+item.classname+"\"></td>");
                                s = 2;
                            }
                        });
                        if (s == 1) {
                            //原价
                             td1 = $("<td ><input name=\"Txt_OPrice[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d\\.]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_OPrice input mini l-text\" type=\"text\" value=\"\" style=\"width:50px\"></td>");
                            //售价
                             td2 = $("<td ><input  name=\"Txt_Price[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d\\.]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_Price input mini l-text\" type=\"text\" style=\"width:50px\" value=\"\"></td>");
                            //出厂价
                            td3 = $("<td ><input name=\"Txt_FPrice[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d\\.]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_FPrice input l-text\" type=\"text\" style=\"width:50px\" value=\"\"></td>");
                            //库存
                             td4 = $("<td ><input name=\"Txt_Store[]\" onkeyup=\"this.value=this.value.replace(\/[^\\d]+/g,'')\" onblur=\"this.value=this.value.replace(/(\\.\\d{2})\\d*$/,'\\$1')\" class=\"Txt_Store input l-text\" type=\"text\" style=\"width:50px\" value=\"\"></td>");
                            //商品编码
                             td5 = $("<td ><input  name=\"Txt_Number[]\" class=\" Txt_Number input l-text\" type=\"text\" style=\"width:50px\" value=\"\"></td>");
                             //图片
                             td6 = $("<td ><div class=\"up_load_pic\">" +
                                 "<img src=''>" +
                                 "<form class='upload_pic_form' action='/Admin/Index/addimage' method='post' enctype='multipart/form-data'>" +
                                    "<input type=\"file\" name='sku_pic' accept=\"image/jpg,image/jpeg,image/png\" class=\"upload_sku_pic\" >" +
                                 "</form>" +
                                 "<input name=\"Txt_Pic[]\" class=\"Txt_Pic\" type=\"hidden\" value=\"\"> " +
                                 "</div>" +
                                 "<input name=\"skulist[]\" type=\"hidden\" data-attrskuid=\"0\" data-idstr='"+item.skuid+"' value=\""+item.classname+"\"></td>");
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
            $('.Small_Txt_OPrice').val('');                                     //最低原价
            $('.Small_Txt_Price').val('');                                      //最低售价
            $('.Count_Txt_Store').val('');                                      //商品总库存
            $('.Txt_OPrice').bind('input propertychange', function() {
                jisuanyuanjia();                                                //计算商品最低原价
            });
            $('.Txt_Price').bind('input propertychange', function() {
                jisuanshoujia();                                                //计算商品最低售价
            });
            $('.Txt_FPrice').bind('input propertychange', function() {
                jisuanchuchangjia();                                            //计算商品最低出厂价
            });
            $('.Txt_Store').bind('input propertychange', function() {
                jisuanzongkucun();                                              //计算商品总库存
            });
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
                    item['classname'] = arr1[i]['classname'] + "," + arr2[j]['classname'];
                    item['skuid']     = arr1[i]['skuid'] + "," + arr2[j]['skuid'];
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
    /* arrToStr:function(arr){
        if(jQuery.isArray(str)){
            var str = '{';
            $.each(arr,function(index,item){
                if(jQuery.isArray(item)){
                    str = str +'"'+index+'":"'+item+'",';
                }
            });
            str = str + '}';
        }else{
            return arr;
        }
    }, */
}
/*上传图片  创建表格之后加载 1 */
$(function () {
    $(document).on('change','.upload_sku_pic',function(){ //选择文件
        $_this = $(this);
        $_this_p_form = $(this).parent();
        $_this_pp_div = $(this).parent().parent();
        $_this_p_td = $(this).parent().parent().parent();
        $(this).parent('.upload_pic_form').ajaxSubmit({
            dataType:  'json', //数据格式为json
            beforeSend: function() { //开始上传
                $_this.addClass("disabled");
            },
            uploadProgress: function(event, position, total, percentComplete) {
            },
            success: function(data) { //成功
                var img = '<div class="up_load_pic">' +
                    '<img src="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'" style="height：70px; width:70px;" >' +
                    "<form class='upload_pic_form' action='/Admin/Index/addimage' method='post' enctype='multipart/form-data'>" +
                    '<input type="file" name="sku_pic" accept="image/jpg,image/jpeg,image/png" class="upload_sku_pic"  >' +
                    '</form>' +
                    '<input name="Txt_Pic[]" class="Txt_Pic" type="hidden"  value="'+data[0]["savepath"].substr(1)+data[0]["savename"]+'">' +
                    '</div>';
                $_this_pp_div.remove();
                $_this_p_td.find("input").before(img);
                $_this.removeClass("disabled");
            },
            error:function(xhr){ //上传失败
                //console.log(xhr.status)
                $_this.removeClass("disabled");
            }
        });
    });
})
/*上传图片  创建表格之后加载 1 */
/*添加规格弹框 查询SKU  父级子集 1*/
function add_guige_tankuang(pid=0){
    //201711020615  Cyonger iwanjiao@qq.com  获取sku
    $.post('/Admin/integralgoods/skuNameList',{pid:pid},function(g){
        if(g.status==1){
            $('.addguige .jbox-container .form-controls').eq(0).html(g.info);
        }else if(g.status==2){
            $('.addguige .jbox-container .form-controls').eq(0).hide();
        }else{
            dialog.showTips(g.info,'warn'); return false;
        }
    },'json');
    $('.addguige .jbox-container .form-controls').find('input[name=newclass]').val('');
    $('#albums-overlay').show();
    $('.addguige').show();
}
/*添加规格弹框 2*/
/*添加规格属性按钮 1*/
/* $('.color_add').click(function(){
    $('#guigeshu_title').val('');
    $('#guigename').val($(this).parents('li').prev().html());
    $('.addguigeshuxing').show();
    $('#albums-overlay').show();
}); */
$('.color_add').click(function(){
    var skuid    = $(this).attr("data-skuid");
    if(skuid){
        $.post('/Admin/integralgoods/skuNameList',{pid:skuid},function(g){
            if(g.status==1){
                $('.addguigeshuxing .jbox-container .form-controls').eq(0).html(g.info);
            }else if(g.status==2){
                $('.addguigeshuxing .jbox-container .form-controls').eq(0).hide();
            }else{
                dialog.showTips(g.info,'warn'); return false;
            }
        },'json');
        $('.addguigeshuxing .jbox-container').find('input[name=guigename]').val($(this).parents('li').prev().text());  //规格名字
        $('.addguigeshuxing .jbox-container .form-controls').find('input[name=newclass]').val('');
        $('#albums-overlay').show();
        $('.addguigeshuxing').show();
    }else{
        dialog.showTips('获取父级ID错误','warn');return false;
    }
});
/*添加规格属性按钮 2*/
/*删除规格 1*/
$(function () {
    $(document).on('click','.delguige',function(){ //选择文件
        var _this = $(this);
        dialog.showTips('确认删除？', 'firm', function () {
            _this.parents('ul').next().remove();
            _this.parents('ul').remove();
            var i = 0;
            $('.Father_Item').each(function () {
                $(this).attr('class', 'Father_Item' + i + ' Father_Item');
                i++;
            });
            step.Creat_Table();
            jisuanyuanjia();
            jisuanshoujia();
            jisuanchuchangjia();
            jisuanzongkucun();
        });
        return false;
    });
})
/*删除规格 2*/
/*删除规格属性 1*/
$(function () {
    $(document).on('click','.delguigeshuxing',function(){ //选择文件
        var _this = $(this);
        dialog.showTips('确认删除？', 'firm', function () {
            _this.parents('li').remove();
            step.Creat_Table();
            jisuanyuanjia();
            jisuanshoujia();
            jisuanchuchangjia();
            jisuanzongkucun();
        });
        return false;
    });
})
/*删除规格属性 2*/
/*批量添加  1*/
$('#piliang').click(function(){
    var pi_oprice   = $(".pi_oprice").val();
    var pi_price    = $('.pi_price').val();
    var pi_fprice   = $('.pi_fprice').val();
    var pi_store    = $('.pi_store').val();
    var pi_number   = $('.pi_number').val();
    if ($('input').eq(0).length == 0){
        alert('请先设置规格属性');return false;
    }
    if (pi_oprice == '' && pi_price == '' && pi_fprice == '' && pi_store == '' && pi_number == '') {
        alert('规格属性值为空');return false;
    }
    if (pi_oprice != '') {
         $('.Txt_OPrice').val(pi_oprice);
    }
    if (pi_price != '') {
        $('.Txt_Price').val(pi_price);
    }
    if (pi_fprice != '') {
        $('.Txt_FPrice').val(pi_fprice);
    }
    if (pi_store != '') {
        $('.Txt_Store').val(pi_store);
    }
    if (pi_number != '') {
        $('.Txt_Number').val(pi_number);
    }
    var length = $('input').eq(0).length;
    if (length) {
        //最低原价
        if (pi_oprice) {
            $('.Small_Txt_OPrice').val(pi_oprice);
        }else{
            //获取商品价格
            jisuanyuanjia();
            /* $('.Txt_OPrice').bind('input propertychange', function() {
                var num = 0;
                var length = 0;
                var _this = '';
                $('#process tbody tr').each(function(){
                    length = $(this).find('td').length;
                    var nu = $(this).find('.Txt_OPrice').val();
                    if (nu != '') {
                        if (num == 0) {
                            num = nu;
                            _this = $(this);
                        }else{
                            if (parseFloat(nu) < parseFloat(num)) {
                                num = nu;
                                _this = $(this);
                            }
                        }
                    }
                });
                $('.Small_Txt_OPrice').val(num);
            }); */
        }
        //最低售价
        if (pi_price) {
            $('.Small_Txt_Price').val(pi_price);
        }else{
            jisuanshoujia();
            /* $('Txt_Price').bind('input propertychange', function() {
                var num = 0;
                var length = 0;
                var _this = '';
                $('#process tbody tr').each(function(){
                    length = $(this).find('td').length;
                    var nu = $(this).find('td:eq('+(length-5)+')').find('input').val();
                    if (nu != '') {
                        if (num == 0) {
                            num = nu;
                            _this = $(this);
                        }else{
                            if (parseFloat(nu) < parseFloat(num)) {
                                num = nu;
                                _this = $(this);
                            }
                        }
                    }
                });
                $('.Small_Txt_Price').val(num);
            }); */
        }
        //最低出厂价
        if (pi_fprice) {
            $('.Small_Txt_FPrice').val(pi_fprice);
        }else{
            jisuanchuchangjia();
            /* $('Txt_FPrice').bind('input propertychange', function() {
                var num = 0;
                var length = 0;
                var _this = '';
                $('#process tbody tr').each(function(){
                    length = $(this).find('td').length;
                    var nu = $(this).find('td:eq('+(length-5)+')').find('input').val();
                    if (nu != '') {
                        if (num == 0) {
                            num = nu;
                            _this = $(this);
                        }else{
                            if (parseFloat(nu) < parseFloat(num)) {
                                num = nu;
                                _this = $(this);
                            }
                        }
                    }
                });
                $('.Small_Txt_FPrice').val(num);
            }); */
        }
        //获取商品总库存
        jisuanzongkucun();
        /* var num = 0;
        $('#process tbody tr').each(function(){
            var length = $(this).find('td').length;
            if ($(this).find('td:eq('+(length-3)+')').find('input').val() != '') {
                num = num+parseInt($(this).find('td:eq('+(length-3)+')').find('input').val());
            }
        });
        $('#process tbody tr').each(function(){
            if ($(this).find('.Txt_Store').val() != '') {
                num = num+parseInt($(this).find('.Txt_Store').val());
            }
        });
        $('.Count_Txt_Store').val(num); */
        
    }
});
/*批量添加  2*/

/*添加规格-确定-function 1*/
function add_guige(_parent) {
    //201711021716  Cyonger iwanjiao@qq.com  确认规格
    var _parent  = $('.'+_parent);
    var title    = _parent.find('select[name=skuid]').find("option:selected").text();
    var skuid    = _parent.find('select[name=skuid]').val();
    var pid      = _parent.find('select[name=skuid]').attr("data-pid");
    var newclass = $.trim(_parent.find('input[name=newclass]').val());
    var title    = newclass ? newclass : title;
    if (title == '') {
        alert('请填写新规格名！');return false;
    }
    if(title.indexOf("/") >= 0 ){
        alert('规格名不能使用特殊字符！');return false;
    }
    if(title.indexOf(",") >= 0 ){
        alert('规格名不能使用特殊字符！');return false;
    }
    if(title.indexOf("*") >= 0 ){
        alert('规格名不能使用特殊字符！');return false;
    }
    if(newclass){
        $.ajax({
            url: "/Admin/Skuattr/addSku",
            type: "post",
            dataType: "json",
            data: {
                classname:newclass,
                fid:pid,
                sort:0,
            }
        }).done(function(g){
            if (g.status == 1) {
                skuid = g.pid;
            } else {
                dialog.showTips(g.info,"warn"); return false;
            }
        })
    }
    var num = $('.Father_Item').length; //规格属性的
    //遍历验证规格名称 是否和输入的规格名称相同
    var as = 1;
    $('.Father_Title li').each(function(){
        if (title == $(this).html()) {
            as = 2;
        }
    });
    if (as == 2) {
        alert('规格名重复！');
        return false;
    }
    $('.div_contentlist').append('<ul class="Father_Title" style="clear: both;padding-top: 20px;border-top: 1px solid #ccc;"> ' +
        '<li style="float:left;font-weight: bold;font-size: 16px;line-height:22px; margin-right:4px;">'+title+'</li>' +
        '<li class="li_width fl"><label>' +
        '<input type="button" class="btn btn-mini btn-primary color_add_'+num+'" value="选择属性值" data-skuid='+skuid+'><span class="li_empty">&nbsp;</span></label>'+
        '<label><input type="button" class="btn btn-mini btn-danger delguige" value="删除"><span class="li_empty"></span></label></li>' +
        '<div style="clear: both"></div></ul><ul class="Father_Item'+num+' Father_Item"></ul>');
    $('.color_add_'+num).click(function(){
        var skuid    = $(this).attr("data-skuid");
        if(skuid){
            $.post('/Admin/integralgoods/skuNameList',{pid:skuid},function(g){
                if(g.status==1){
                    $('.addguigeshuxing .jbox-container .form-controls').eq(0).html(g.info);
                    $('.addguigeshuxing .jbox-container .form-controls').eq(0).show();
                }else if(g.status==2){
                    $('.addguigeshuxing .jbox-container .form-controls').eq(0).hide();
                    $('.addguigeshuxing .jbox-container .form-controls').eq(0).html('');
                }else{
                    dialog.showTips(g.info,'warn'); return false;
                }
            },'json');
            $('.addguigeshuxing .jbox-container').find('input[name=guigename]').val($(this).parents('li').prev().text());  //规格名字
            $('.addguigeshuxing .jbox-container .form-controls').find('input[name=newclass]').val('');
            $('#albums-overlay').show();
            $('.addguigeshuxing').show();
        }else{
            dialog.showTips('获取父级ID错误','warn');return false;
        }
    });
    $('.addguige').hide();
    $('#albums-overlay').hide();
}
/*添加规格-确定-function 2*/

/*添加规格属性-function 1*/
function add_guige_shuxing(_parent){
    //201711021922  Cyonger iwanjiao@qq.com  确认子规格
    $('.addguigeshuxing').hide();
    $('#albums-overlay').hide();
    var _parent     = $('.'+_parent);
    var title       = _parent.find('select[name=skuid]').find("option:selected").text();
    var skuid       = _parent.find('select[name=skuid]').val();
    var pid         = _parent.find('select[name=skuid]').attr("data-pid");
    var newclass    = $.trim(_parent.find('input[name=newclass]').val());
    var guigename   = $.trim(_parent.find('input[name=guigename]').val());
    var name        = newclass ? newclass : title;
    if (name == '') {
        alert('规格值不能使用特殊字符！');return false;
    }
    if(name.indexOf("/") >= 0 ){
        alert('规格值不能使用特殊字符！');return false;
    }
    if(name.indexOf(",") >= 0 ){
        alert('规格值不能使用特殊字符！');return false;
    }
    if(name.indexOf("*") >= 0 ){
        alert('规格值不能使用特殊字符！');return false;
    }
    if(newclass){
        $.ajax({
            url: "/Admin/Skuattr/addSku",
            type: "post",
            dataType: "json",
            data: {
                classname:newclass,
                fid:pid,
                sort:0,
            }
        }).done(function (g) {
            if (g.status == 1) {
                skuid = g.pid;
            } else {
                dialog.showTips(g.info,"warn"); return false;
            }
        })
    }
    var _this = '';
    $('.Father_Title').each(function(){
        var ss = $(this).find('li').eq(0).html();
        if (ss == guigename) {
            _this = $(this);
        }
    });
    var as = 1;
    _this.next().find('li .chcBox_Width').each(function(n,s){
        if (name == $(this).val()) {
            as = 2;
            alert('规格属性值重复');return false;
        }
    });
    if (as == 2) {
        return false;
    }
    if (name == '') {
        alert('请填选择规格属性值');
    }else{
        _this.next().append('<li class="li_width" style="line-height:22px;margin-right:4px;"><label class="addsku"><input type="checkbox" class="checkbox chcBox_Width" value="'+name+'" data-cskuid="'+skuid+'" checked="checked"/>'+name+'&nbsp;</label><label><input type="button" class="btn btn-mini btn-danger delguigeshuxing" value="删除"></label></li>');
        $('.delguigeshuxing').click(function(){
            var _this = $(this);
            dialog.showTips('确认删除？','firm',function () {
                _this.parents('li').remove();
                step.Creat_Table();
                jisuanyuanjia();
                jisuanshoujia();
                jisuanchuchangjia();
                jisuanzongkucun();
            });
            return false;
        });
        $('.addsku').bind("change", function () {
            step.Creat_Table();return false;
        });
        step.Creat_Table();
    }
}
/*添加规格属性-function 2*/
/*计算商品最低原价 1*/
function jisuanyuanjia(){
    var num = 0;
    $('#process tbody tr').each(function(){
        var nu = $(this).find('.Txt_OPrice').val();//获取值
        if (nu != '') {
            if (num == 0) {
                num = nu;
            }else{
                if (parseFloat(nu) < parseFloat(num)) {
                    num = nu;
                }
            }
        }
    });
    $('.Small_Txt_OPrice').val(num);
}
/*计算商品最低原价 2*/
/*计算商品最低售价 1*/
function jisuanshoujia() {
    var num = 0;
    $('#process tbody tr').each(function(){
        var nu = $(this).find('.Txt_Price').val();
        if (nu != '') {
            if (num == 0) {
                num = nu;
            }else{
                if (parseFloat(nu) < parseFloat(num)) {
                    num = nu;
                }
            }
        }
    });
    $('.Small_Txt_Price').val(num);
}
/*计算商品最低售价 2*/
/*计算商品最低出厂价 1*/
function jisuanchuchangjia() {
    var num = 0;
    $('#process tbody tr').each(function(){
        var nu = $(this).find('.Txt_FPrice').val();
        if (nu != '') {
            if (num == 0) {
                num = nu;
            }else{
                if (parseFloat(nu) < parseFloat(num)) {
                    num = nu;
                }
            }
        }
    });
    $('.Small_Txt_FPrice').val(num);
}
/*计算商品最低出厂价 2*/
/*计算商品总库存 1*/
function jisuanzongkucun() {
    var num = 0;
    $('#process tbody tr').each(function(){
        if ($(this).find('.Txt_Store').val() != '') {
            num = num+parseInt($(this).find('.Txt_Store').val());
        }
    });
    $('.Count_Txt_Store').val(num);
}
/*计算商品总库存 2*/
step.Creat_Table();

