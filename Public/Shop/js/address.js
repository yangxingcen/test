$(function(){
    //新增收货地址
    $('#btn').bind('click',function(){
        var data ={};
        data.id        = $('input[name=id]').val();
        data.telephone = $('input[name=telephone]').val();
        data.consignee = $('input[name=consignee]').val();
        data.city      = $('input[name=city]').val();
        data.place     = $('textarea[name=address]').val();
        data.url       = $('#url').val();
        var classname  = $('#dft').attr('class');
        if(classname=='j_checkbox'){
            data.default = 0 ;//不是默认地址为0 默认地址为1
        }else if(classname=='j_checkbox j_checkbox_on'){
            data.default = 1;
        }
        if(!data['consignee']) {
            dialog.showTips("请填写联系人！", "warn");return false;
        }
        if(!data['telephone']) {
            dialog.showTips("请填写联系电话！", "warn");return false;
        }
        if(data['telephone'] && !data['telephone'].match(/^1[3|4|5|7|8][0-9]\d{8}$/)) {
            dialog.showTips("手机号码格式错误！", "warn");return false;
        }
        if(!data['city']) {
            dialog.showTips("请选择城市！", "warn");return false;
        }
        if(!data['place']) {
            dialog.showTips("请填写详细地址！", "warn");return false;
        }
        $.ajax({
            url: data.url,
            type:'post',
            data : data,
            datatype :'json',
            success: function(data){
                if(data.status==1){
                    dialog.showTips(data.info, "",1);
                }else{
                    dialog.showTips(data.info, "warn");
                }
            }
        });
    });

    $(".edit").click(function(){
        //地址信息没有做
        var id        = $(this).attr("data-id");
        var consignee = $(this).attr("data-consignee");
        var province  = $(this).attr("data-province");
        var city      = $(this).attr("data-city");
        var district  = $(this).attr("data-district");
        var place     = $(this).attr("data-place");
        var telephone = $(this).attr("data-telephone");
        var def       = $(this).attr("data-default");
        // var address   = $(this).attr("data-address");
        $(".dizhi").find("input[name=id]").val(id);
        $(".dizhi").find("input[name=consignee]").val(consignee);
        $(".dizhi").find("input[name=telephone]").val(telephone);
        $("#city-picker3").val(province+"/"+city+"/"+district);
        $(".select-item[data-count=province]").html(province);
        $(".select-item[data-count=city]").html(city);
        $(".select-item[data-count=district]").html(district);
        $(".dizhi").find("textarea[name=address]").val(place);
        if(def==1){
            $(".w_chkbox input").addClass("j_checkbox_on").prop("checked", true);
        }else{
            $('.w_chkbox input').removeClass("j_checkbox_on").prop("checked", false);
        }
    });
    $(".add").click(function (){

        $('input[name=id]').val("");
        $('input[name=telephone]').val("");
        $('input[name=consignee]').val("");
        $('input[name=city]').val("");
        $('textarea[name=address]').val("");
        $('.w_chkbox input').removeClass("j_checkbox_on").prop("checked", false);
        $(".select-item[data-count=province]").html("选择省");
        $(".select-item[data-count=city]").html("选择市");
        $(".select-item[data-count=district]").html("选择区");
        $(".city-select.province .active").removeClass('active');
    })
    $(".del").click(function (){
        var id = $(this).attr("data-id");
        var url = $(this).attr("data-url");
        var that = $(this);
        dialog.showTips("确定要进行删除吗?", "firm", function () {
            $.post(url, {id:id}, function (result) {
                if (result.status == 1) {
                    dialog.showTips(result.info, "", "1");
                    return false;
                }
                dialog.showTips(result.info,'warn');
                return false;
            }, "json")
        })

        if(!id){
            dialog.showTips("无法删除！请刷新重试", "warn");
        }
        
    })

    $(".j_checkbox").click(function (){
        $(this).toggleClass("j_checkbox_on");
    })

    $('.dizhi_btn1>a.dizhi_btn1_on').click(function(){
        $('.dizhi').stop(true).fadeOut(1000);
        $('.dizhi').stop(true).fadeOut(1000);
        $('.dizhi_con').removeClass('dizhi_con_on');
    })
})