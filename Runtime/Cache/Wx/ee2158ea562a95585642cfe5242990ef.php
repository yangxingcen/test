<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no" />

<title>德意微商城</title>
<meta name="keywords" content=" " />
<meta name="description" content=" " />

	<link rel="shortcut icon" href="http://www.deyishop.com/Public/Wx/Images/logo.ico"/>


<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/bootstrap.css">
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery-1.11.1.min.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/bootstrap.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery-ui.min.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/easing.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/index.js"></script>
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/main.js"></script>
	<script type="text/javascript"  src="http://www.deyishop.com/Public/Wx/guaguale/js/jquery-1.9.1.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/swiper-3.4.1.min.css">
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/swiper-3.4.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/style.css">
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/common.css">
<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/font-awesome.css">

<!-- <link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/guaguale/css/swiper.css">
<script src="http://www.deyishop.com/Public/Wx/guaguale/js/swiper.min.js"></script> -->


</head>


<body >





		<div id="gua1" style="margin:0 auto; padding: 7px; width:280px; height: 140px; position: relative;">

			<div class="gua2_img">
				<img src="http://www.deyishop.com/Public/Wx/Images/gua_image1.png" width="100%" height="100%">


			</div>
			<img id="gua1_img" src="http://www.deyishop.com/Public/Wx/Images/gua_image.png" style="position: absolute;">

		</div>



</body>





<!--刮刮乐-->

<script type="text/javascript">
var gua = 1,re = 2;
var imgSrc = 'http://www.deyishop.com/Public/Wx/Images/aa.png';

function showdiv() {
	document.getElementById("bg1").style.display ="block";
	document.getElementById("show").style.display ="block";
}

function hidediv() {
	document.getElementById("bg1").style.display ='none';
	document.getElementById("show").style.display ='none';
}

$(function(){
	var width = $("#show_img").width();
	var height = $("#show_img").height();
	var winheight=$(window).height();
	var winwidth=$(window).width();
	$("#show").css({"width":280+"px","height":140+"px","overflow":"hidden","margin-left":(winwidth-280)/2+"px","margin-top":winheight/3+"px"});
	$("#show_btn").css({"width":176*0.5+"px","height":76*0.5+"px"});
	$("#gua_div").html("x"+gua);
	$("#re_div").html("x"+re);

	if(gua == 0){
		showdiv();
	}
})

$("img").load(function(){
	var body_width = $(window).width();
	var body_height = $(window).height();
	$("#gua1_img").width(280).height(140);
	var height = 140;
	var width  = 280;
	var bg2_width = $("#bg2_img").width();
	var bg2_height = $("#bg2_img").height();

//	$("#gua1").css({"margin-top":"20px"});

	$("#notify").css({"margin-top":"200px"});
	$("#nImg").width(300).height(101);

	$("#di").css({"margin-top":"50px"});
	$("#di_img").width(414*0.7).height(24*0.7);


	$("#gua").width(width/10).height(width/10);
	$("#gua_div").css({"line-height":width/10+"px","width":width/10+"px","height":width/10+"px","margin-top":"-"+($("#gua").height())+"px","margin-left":$("#gua").height()+5+"px","font-size": $("#gua").height()/1.6+"px"});
	$("#re").width(width/10).height(width/10);
	$("#re_div").css({ "line-height":width/10+"px","width":width/10+"px","height":width/10+"px","margin-top":"-"+($("#gua").height())+"px","margin-left":$("#gua").height()+5+"px","font-size": $("#gua").height()/1.6+"px"});
	var gua1_img_width = $("#gua1_img").width();
	$("#front").css({"width":280+"px","height":140+"px"});



	$("#bg").width("100%").height($(window).height()-1);
	if(gua > 0){
		bodys(height,width);
	}
});
function bodys(height,width){
	var img = new Image();
	var canvas = document.querySelector('canvas');
	canvas.style.position = 'absolute';
	img.addEventListener('load',function(e){
		var ctx;
		var w = width, h = height;
		var offsetX = canvas.offsetLeft, offsetY = canvas.offsetTop;
		var mousedown = false;

		function layer(ctx){
			var ctx=canvas.getContext("2d");
			var imgx = new Image();  //生成能够使用背景图案的Image对象
			imgx.src = 'http://www.deyishop.com/Public/Wx/Images/gua_image.png';//图像文件的路径代入生成的Image对象中
			var pat=ctx.createPattern(imgx,"repeat"); //指定背景图案及平铺方法
			ctx.fillStyle = pat;
			ctx.fillRect(0, 0, w, h);
		}

//		function layer(ctx){
//			ctx.fillStyle = 'gray';
//			ctx.fillRect(0, 0, w, h);
//		}
		function eventDown(e){
			e.preventDefault();
			mousedown=true;
		}
		function eventUp(e){
			e.preventDefault();
			mousedown=false;
		}
		function eventMove(e){
			e.preventDefault();
			if(mousedown){
				if(e.changedTouches){
					e=e.changedTouches[e.changedTouches.length-1];
				}
				var x = (e.clientX + document.body.scrollLeft || e.pageX) - offsetX || 0,
						y = (e.clientY + document.body.scrollTop || e.pageY) - offsetY || 0;
				with(ctx){
					beginPath()
					arc(x, y, 15, 0, Math.PI * 2);
					fill();
				}
			}
		}
		canvas.width=w;
		canvas.height=h;

		canvas.style.backgroundImage='url('+img.src+')';
		ctx=canvas.getContext('2d');
		ctx.fillStyle='b9b9b9';
		ctx.fillRect(0, 0, w, h);

		layer(ctx);
		ctx.globalCompositeOperation = 'destination-out';
		canvas.addEventListener('touchstart', eventDown);
		canvas.addEventListener('touchend', eventUp);
		canvas.addEventListener('touchmove', eventMove);
		canvas.addEventListener('mousedown', eventDown);
		canvas.addEventListener('mouseup', eventUp);
		canvas.addEventListener('mousemove', eventMove);
	});

	img.src = imgSrc;
	(document.body.style);
}



</script>

</html>