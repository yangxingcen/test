<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta name="author" content="UNOHACHA-高端网站设计-http://www.unohacha.com-杭州吾诺瀚卓网络科技有限公司 策划、设计、开发"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	<link rel="shortcut icon" href="http://www.deyishop.com/Public/Wx/Images/logo.ico"/>
	<title>德意电器</title>
	<meta name="keywords" content=" "/>
	<meta name="description" content=" "/>

    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/bootstrap.css">
    <!--d地图-->
    <script src="http://www.deyishop.com/Public/Wx/Js/zepto.min.js"></script>
    <script src="http://www.deyishop.com/Public/Wx/Js/base.js"></script>
    <script src="http://www.deyishop.com/Public/Wx/Js/sidebar.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/base.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/ws.css">
    <!--d地图-->
    <!--<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/swiper-3.4.1.min.css">-->
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/style.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/common.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">

</head>
<body>

	<div class="integral">

		<a href="javascript:history.go(-1)">
			<div class="screening_btn1">
				<span></span>
			</div>
		</a>

		<div class="tegral">添加新地址</div>
		<a href="javascript:volid();">
			<div class="baocun" onclick="sub_address();">保存</div>
		</a>
	</div>
	<!--  / warpper  -->
	<div class="warpper" style="background: #f9f9f9; padding-bottom: 0%">

		<div class="edit_address">

			<div class="consignee">

				<div class="signee clearfix"><span>收货人:</span> <input type="text" name="consignee" maxlength="10"></div>
				<div class="signee clearfix"><span>手机号:</span> <input type="tel" name="telephone" placeholder="请输入手机号" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></div>

				<div class="  ui-form-item ui-form-item-link ui-border-b" id="select-region">
					<span style="width: 70px;">地址:</span>
                    <span id="region" style="padding-left: 10px;color: #959595;">
                        选择所在地区
                    </span>
					<input type="hidden" id="province" value="{twotree#$info.province_id}">
					<input type="hidden" id="city" value="{twotree#$info.city_id}">
					<input type="hidden" id="district" value="{twotree#$info.district_id}">

					<input type="hidden" id="province1" >
					<input type="hidden" id="city1" >
					<input type="hidden" id="district1" >
				</div>

				<div class=" signee  signee_y clearfix">

					<textarea name="palce" onFocus="this.value = '';" onBlur="if(this.value == '') {this.value = '详细地址';}"></textarea>

				</div>

			</div>

		</div>
		<a href="javascript:volid();">
			<div id="dft" class="quies drawal_ad_bg ">
				<p>设为默认地址 <span></span></p>
			</div>
		</a>
	</div>
	<!--  / warpper  -->
	<div id="menuSidebar">
		<div class="ui-menu-sidebar-mask" style="display: none;"></div>
		<div class="ui-menu-sidebar-content"
			 style="opacity: 1; transform-origin: 0px 0px 0px; transform: scale(1, 1); display: none;">
			<div class="ui-menu-sidebar-container ui-menu-sidebar-region-group">
				<ul class="ui-list ui-list-text ui-border-t" style="display: block;">
					<li class="li-active" style="padding: 5px 0px;margin: 0px 3px;">
						<i class="ui-icon-return" style="position: absolute;left: 0;font-size: 26px;line-height: 34px;top: 0;"></i>
						<span style="text-align: center;display: block;width: 100%;font-weight: bold;">常住地址</span>
					</li>
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
$( document ).ready( function()
{

	var hh1 = $( window ).height();
	$( ".warpper" ).css( "min-height", hh1 )


	$(".quies" ).click(function(){
		var _this=$(this)
		if(_this.hasClass("drawal_ad_bg")){
			_this.removeClass("drawal_ad_bg")
		}
		else{
			_this.addClass("drawal_ad_bg")

		}
	})
} )

</script>

<script>

(function()
{
	$( '#btn-cancel' ).on( "click", function()
	{
		history.back();
	} );
	$( "#btn-add" ).click( function()
	{
		var post_data = {};

		post_data.address = $( "input[name='address']" ).val();
		post_data.province_id = $( "#province" ).val();		//省份id
		post_data.city_id = $( "#city" ).val();				// 城市id
		post_data.district_id = $( "#district" ).val();		//地区id

		if( post_data.address == '' )
		{
			$.tips( {
				content: '请填写详细地址',
				stayTime: 2000,
				type: "warn"
			} );
			return false;
		}
		if( post_data.province_id == '' )
		{
			$.tips( {
				content: '请选择省份',
				stayTime: 2000,
				type: "warn"
			} );
			return false;
		}
		if( post_data.city_id == '' )
		{
			$.tips( {
				content: '请选择城市',
				stayTime: 2000,
				type: "warn"
			} );
			return false;
		}
		if( post_data.district_id == '' )
		{
			$.tips( {
				content: '请选择区县',
				stayTime: 2000,
				type: "warn"
			} );
			return false;
		}
		var el = $.loading( { content: '保存中...' } );
		$.post( "{twotree#:U('Ajax/address_add')}", post_data, function( data )
		{
			el.hide();
			$.tips( {
				content: '保存成功',
				stayTime: 500,
				type: "success"
			} );
			setTimeout( 'history.back()', 500 );
		} );
	} );

	$( "#select-region" ).on( "click", function( e )
	{
		e.preventDefault();
		e.stopPropagation();
		$( "html" ).removeClass( "sidebar-back" );
		$( "html" ).addClass( "sidebar-move" );
		$( ".ui-menu-sidebar-mask" ).css( "display", "block" );
		$( ".ui-menu-sidebar-content" ).css( "display", "block" );
	} );
	$( ".ui-menu-sidebar-mask,.ui-icon-return" ).on( "click", function( e )
	{
		e.preventDefault();
		e.stopPropagation();
		$( "html" ).addClass( "sidebar-back" );
		setTimeout( function()
		{
			$( "html" ).removeClass( "sidebar-back" );
			$( "html" ).removeClass( "sidebar-move" );
		}, 300 );
		$( ".ui-menu-sidebar-mask" ).css( "display", "none" );
		$( ".ui-menu-sidebar-content" ).css( "display", "none" );
	} );
	$( "#menuSidebar" ).sliderAddress( {
		change: function( p, c, d )
		{
			$( "#region" ).html( p.name + c.name + d.name );
			$( "#province" ).val( p.id );
			$( "#city" ).val( c.id );
			$( "#district" ).val( d.id );

			$( "#province1" ).val( p.name );
			$( "#city1" ).val( c.name );
			$( "#district1" ).val( d.name );
		},
		id: "addressList"
	} );
	FastClick.attach( document.body );
})();
</script>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/alert.js"></script>
<script type="text/javascript" src="http://www.deyishop.com/Public/Wx/Js/ucenter/add_address.js"></script>
<html>