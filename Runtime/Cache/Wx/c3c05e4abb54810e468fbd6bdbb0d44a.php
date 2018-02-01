<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	<link rel="shortcut icon" href="images/logo.ico"/>
	<title>德意微商城</title>
	<meta name="keywords" content=" "/>
	<meta name="description" content=" "/>

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/style.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/common.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/base.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/zajindan/css/ws.css">

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">


	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/lib/zepto.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/base.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/sidebar.js"></script>

	<!--[if lte IE 9]>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/js/respond.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/zajindan/js/js/html5shiv.js"></script>
	<![endif]-->

</head>
<style>
	.wap_tanc_con{
		padding: 0px;
	}

</style>

<body >


<div class="wapper">
	<div class="header list_header">
		信息填写
		<a href="javascript:history.go(-1);" class="header_but"><img src="http://www.deyishop.com/Public/Wx/Images/l_left.png" width="100%"></a>
	</div>


	<div class="infor_bot">
		<div class="infor_bot_title">ERP系统电子物流</div>
		<div class="ui-form-item ui-form-item-link ui-border-b" id="select-region">
			<label>
				所在地区
			</label>
			<span id="region" style="padding-left: 75px;color: #959595;">
                        选择所在地区
                    </span>
			<input type="hidden" id="province" value="{twotree#$info.province_id}">
			<input type="hidden" id="city" value="{twotree#$info.city_id}">
			<input type="hidden" id="district" value="{twotree#$info.district_id}">
		</div>
		<div class="infor_top_con">
			<span>详细地址</span>
			<input type="text" name="del_add" id="del_add">
		</div>
		<div class="infor_top_con">
			<span>收件人</span>
			<input type="text" name="realname" id="realname">
		</div>
		<div class="infor_top_con">
			<span>手机号</span>
			<input type="text" name="tel" id="tel">
		</div>
		<div class="ui-btn-group">
			<button id="btn-add" class="ui-btn-lg ui-btn-primary">
				保存
			</button>
			<button id="btn-cancel" class="ui-btn-lg">
				取消
			</button>
		</div>

	</div>




</div>

<div class="foot">
	<ul class="clearfix">
		<a href="<?php echo U('Wx/Games/zajindanList');?>"><li>奖品列表</li></a>
		<a href="<?php echo U('Wx/Games/zajindanCheck');?>"><li>中奖查询</li></a>
		<span></span>
	</ul>
</div>

<div id="menuSidebar">
	<div class="ui-menu-sidebar-mask" style="display: none;"></div>
	<div class="ui-menu-sidebar-content"
		 style="opacity: 1; transform-origin: 0px 0px 0px; transform: scale(1, 1); display: none;">
		<div class="ui-menu-sidebar-container ui-menu-sidebar-region-group">
			<ul class="ui-list ui-list-text ui-border-t" style="display: block;">
				<li class="li-active" style="padding: 5px 0px;margin: 0px 3px;">
					<i class="ui-icon-return" style="position: absolute;left: 0;font-size: 26px;line-height: 34px;top: 0;"></i>
					<span style="text-align: center;display: block;width: 100%;font-weight: bold;">常住地址</span></li>
			</ul>
			<div class="ui-menu-sidebar-region-wrapper" id="addressList">
				<ul id="auxDeliverList1" level="1" class="ui-list ui-list-text ui-border-tb cur"></ul>
				<ul id="auxDeliverList2" level="2" class="ui-list ui-list-text ui-border-tb">1</ul>
				<ul id="auxDeliverList3" level="3" class="ui-list ui-list-text ui-border-tb">2</ul>
			</div>
		</div>
	</div>
</div>
</body>

<script>
    var mobile=function(content){
        var regex = /^(13[0-9]|15[012356789]|17[012356789]|18[0123456789]|14[57])[0-9]{8}$/;
        if (regex.test(content)) {
            return true;
        }else{
            return false;
        }
    };

    (function (){
        $('#btn-cancel').on("click", function(){
            history.back();
        });
        $("#btn-add").click(function(){
            var post_data={};

            post_data.id=<?php echo ($id); ?>;
            post_data.address=$("#region").html();

            post_data.del_add=$("#del_add").val();
            if( post_data.del_add==""){
                dialog.showTips("请填写详细地址","warn");
                return false;
            }
            post_data.realname=$("#realname").val();
            if( post_data.realname==""){
                dialog.showTips("请填写收件人","warn");
                return false;
            }
            post_data.tel=$("#tel").val();
            if( post_data.tel==""){
                dialog.showTips("请填写手机号","warn");
                return false;
            }


            post_data.province_id=$("#province").val();		//省份id
            post_data.city_id=$("#city").val();				// 城市id
            post_data.district_id=$("#district").val();		//地区id

            $.post("<?php echo U('Wx/Games/infor');?>",post_data,function(data){
                dialog.showTips("保存成功", "",1);
            });
        });




        $("#select-region").on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $("html").removeClass("sidebar-back");
            $("html").addClass("sidebar-move");
            $(".ui-menu-sidebar-mask").css("display", "block");
            $(".ui-menu-sidebar-content").css("display", "block");
        });
        $(".ui-menu-sidebar-mask,.ui-icon-return").on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $("html").addClass("sidebar-back");
            setTimeout(function () {
                $("html").removeClass("sidebar-back");
                $("html").removeClass("sidebar-move");
            }, 300);
            $(".ui-menu-sidebar-mask").css("display", "none");
            $(".ui-menu-sidebar-content").css("display", "none");
        });
        $("#menuSidebar").sliderAddress({
            change: function (p, c, d) {
                $("#region").html(p.name+c.name+d.name);
                $("#province").val(p.id);
                $("#city").val(c.id);
                $("#district").val(d.id);
            },
            id:"addressList"
        });
        FastClick.attach(document.body);
    })();
</script>
<script>
    $( document ).ready( function()
    {

        $(".list" ).css("min-height",$(window ).height())
    } )
</script>



<script src="http://www.deyishop.com/Public/Wx/Js/jquery-1.11.1.min.js"></script>


<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>

</html>