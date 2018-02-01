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
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/index1.css">
	<script src="http://www.deyishop.com/Public/Wx/Js/jquery-1.11.1.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/bootstrap.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/jquery-ui.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/easing.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/index.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/swiper-3.4.1.min.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/Js/main.js"></script>

	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/swiper-3.4.1.min.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/style.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/common.css">
	<link rel="stylesheet" type="text/css" href="http://www.deyishop.com/Public/Wx/Css/font-awesome.css">




	<link href="http://www.deyishop.com/Public/Wx/head/cropper.min.css" rel="stylesheet">
	<link href="http://www.deyishop.com/Public/Wx/head/sitelogo.css" rel="stylesheet">
	<script src="http://www.deyishop.com/Public/Wx/head/cropper.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/head/sitelogo.js"></script>
</head>

<body>

	<!--  / warpper  -->
	<div class="warpper" style=" background: #f9f9f9">

		<div class="integral">

			<a href="/wx_my_info">
				<div class="screening_btn1">
					<span></span>
				</div>
			</a>

			<div class="tegral">个人设置</div>

		</div>

		<div class="administer">
			<div class="user6" style="padding:0;">

				<div class="user_r6" style="padding:0; border-bottom:none;">
					<div class="user_1b">

						<ul>

							<a href="javascript:volid(0);">
								<li style="padding:10px; line-height:70px;">头像
									<!-- <span class="touxiang" data-toggle="modal" data-target="#avatar-modal"><img src="<?php echo ($info["person_img"]); ?>" width="50" style="border-radius:100%;"></span> -->
									<span class="touxiang" data-toggle="modal" data-target="#avatar-modal"><img id="person_img" class="user_headimg" src="<?php echo ($info["person_img"]); ?>" width="50" style="border-radius:100%;"></span>
									<input class="needsclick" style="display:none;" type="file" id="imgfile" onChange="readFile(this)" style="" accept="image/jpg,image/jpeg,image/png"/>
								</li>
							</a>

							<a href="/wx_my_name.html">
							<?php if($info['person_name']): ?><li>用户名 <span><b><?php echo ($info["person_name"]); ?></b><i class="fa fa-angle-right"></i></span></li>
							<?php else: ?>
								<li>用户名 <span><b><?php echo ($info["telephone"]); ?></b><i class="fa fa-angle-right"></i></span></li><?php endif; ?>
								
							</a>
							<a href="javascript:volid(0);">
								<li>会员等级 <span><b><?php echo ($info["vip_name"]); ?></b> </span></li>
							</a>
							<a href="javascript:volid(0);" class=" secret">
								<li>性别 <span><b><?php echo ($info["sex"]); ?></b><i class="fa fa-angle-right"></i></span></li>
							</a>
							<a href="/wx_my_password.html">
								<li>修改密码 <span><i class="fa fa-angle-right"></i></span></li>
							</a>

						</ul>
					</div>
				</div>

			</div>

		</div>

	</div>
	<input type="hidden" id="update_id" value="<?php echo ($info["id"]); ?>">
	<!--  / warpper  -->
	<div class="refunds_bg"></div>

	<div class="dification  ficatio1">

		<h5>修改性别</h5>
		<div class="sex" sex="1">
			<img src="http://www.deyishop.com/Public/Wx/Images/sex1.png" width="100%"> 男
		</div>
		<div class="sex" sex="2">
			<img src="http://www.deyishop.com/Public/Wx/Images/sex2.png" width="100%"> 女
		</div>

		<div class="sex sex1" sex="3" >
			<img src="http://www.deyishop.com/Public/Wx/Images/sex3.png" width="100%"> 保密
		</div>

	</div>


	<div class="user_pic" style="margin: 10px;">
		<!-- <img src=""> -->
	</div>

	<!-- <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form class="avatar-form">
					<div class="modal-header">
						<button class="close" data-dismiss="modal" type="button">&times;</button>
						<h4 class="modal-title" id="avatar-modal-label">上传图片</h4>
					</div>
					<div class="modal-body">
						<div class="avatar-body">
							<div class="avatar-upload">
								<input class="avatar-src" name="avatar_src" type="hidden">
								<input class="avatar-data" name="avatar_data" type="hidden">
								<label for="avatarInput" style="line-height: 35px;">图片上传</label>
								<button class="btn btn-danger" type="button" style="height: 35px;" onClick="$('input[id=avatarInput]').click();">
									请选择图片
								</button>
								<span id="avatar-name"></span>
								<input class="avatar-input hide" id="avatarInput" name="avatar_file" type="file"></div>

							<div class="avatar-wrapper"></div>

							<div class=" avatar-btns">
								<div class="btn-group">
									<button class="btn btn-danger fa fa-undo" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">
										向左旋转
									</button>
								</div>
								<div class="btn-group">
									<button class="btn  btn-danger fa fa-repeat" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">
										向右旋转
									</button>
								</div>

								<button class="btn btn-danger fa fa-arrows" data-method="setDragMode" data-option="move" type="button" title="移动">
								<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
								</span>
								</button>
								<button type="button" class="btn btn-danger fa fa-search-plus" data-method="zoom" data-option="0.1" title="放大图片">
								<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, 0.1)">
								</span>
								</button>
								<button type="button" class="btn btn-danger fa fa-search-minus" data-method="zoom" data-option="-0.1" title="缩小图片">
								<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, -0.1)">
								</span>
								</button>
								<button type="button" class="btn btn-danger fa fa-refresh" data-method="reset" title="重置图片">
									<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;reset&quot;)" aria-describedby="tooltip866214"></span>
								</button>
							</div>
							<button class="btn btn-danger btn-block avatar-save fa fa-save" type="button" data-dismiss="modal">
								保存修改
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> -->
	
	<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	<script type="text/javascript" src="http://www.deyishop.com/Public/admin/Js/alert.js"></script>
	<script src="http://www.deyishop.com/Public/Wx/head/html2canvas.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
	$( '#avatarInput' ).on( 'change', function( e )
	{
		var filemaxsize = 1024 * 5;//5M
		var target = $( e.target );
		var Size = target[ 0 ].files[ 0 ].size / 1024;
		if( Size > filemaxsize )
		{
			alert( '图片过大，请重新选择!' );
			$( ".avatar-wrapper" ).childre().remove;
			return false;
		}
		if( !this.files[ 0 ].type.match( /image.*/ ) )
		{
			alert( '请选择正确的图片!' )
		}
		else
		{
			var filename = document.querySelector( "#avatar-name" );
			var texts = document.querySelector( "#avatarInput" ).value;
			var teststr = texts; //你这里的路径写错了
			testend = teststr.match( /[^\\]+\.[^\(]+/i ); //直接完整文件名的
			filename.innerHTML = testend;
		}

	} );

	$( ".avatar-save" ).on( "click", function()
	{	
		var img_lg = document.getElementById( 'imageHead' );
		// 截图小的显示框内的内容
		html2canvas( img_lg, {
			allowTaint: true,
			taintTest: false,
			onrendered: function( canvas )
			{
				canvas.id = "mycanvas";
				//生成base64图片数据
				var dataUrl = canvas.toDataURL( "image/jpeg" );
				var newImg = document.createElement( "img" );
				newImg.src = dataUrl;
				imagesAjax( dataUrl )
			}
		} );
	} )

	function imagesAjax( src )
	{
		var data = {};
		data.img = src;
		data.jid = $( '#jid' ).val();
		$.ajax( {
			url: "upload-logo.php",
			data: data,
			type: "POST",
			dataType: 'json',
			success: function( re )
			{
				if( re.status == '1' )
				{
					$( '.user_pic img' ).attr( 'src', src );
				}
			}
		} );
	}
	</script>

</body>
<script>
$( document ).ready( function()
{

	$( ".secret " ).click( function()
	{

		$( '.refunds_bg' ).stop( true, true ).fadeIn( 300 );
		$( '.ficatio1' ).stop( true, true ).fadeIn( 300 );
	} )

	$( ".sex " ).click( function()
	{	
		var sex = $(this).attr('sex');
		$.ajax({
	        url:"<?php echo U('Wx/Ucenter/up_sex');?>",
	        type:'post',
	        data:{'id':$("#update_id").val(),sex:sex},
	        dataType:'json',
	        cache:false,
	        success:function(res){
	      		if(res.status == 1){
	      			window.location.href="/wx_my_set.html";
	      		}else{
	      			window.location.href="/wx_my_set.html";
	      		}
	        }
	    })
		$( '.refunds_bg' ).stop( true, true ).fadeOut( 300 );
		$( '.ficatio1,.ficatio2' ).stop( true, true ).fadeOut( 300 );
	} )



	$(".refunds_bg" ).click(function(){
		$(".dification ,.refunds_bg " ).fadeOut(300)
	})
} )
</script>
<script>
    var img_str,el;
    function readFile(obj){
        var file = obj.files[0];
        //判断类型是不是图片
        if(!/image\/\w+/.test(file.type)){
            dialog.showTips('请确保文件为图像类型', "warn");
            return false;
        }
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e){
            img_str=this.result;
            $.ajax({
                type: 'POST',
                url: "<?php echo U('Wx/Ucenter/upload_base64');?>",
                data: {'img_str':img_str},
                dataType: 'json',
                cache:false,
                success: function(data){
                    console.dir(data);
                    if(data.flag==1){

                        $('.user_headimg').attr('src', data.img);
                        // dialog.showTips('头像上传成功！', "warn");
                    }else{
                        dialog.showTips('头像上传失败！', "warn");
                    }
                },
                error: function(xhr, type, error){
                    // console.log(type);
                    // console.log(error);
                },
                complete: function(xhr, status){
                    // el.hide();
                }
            });
        }
    }
    $("#person_img").click(function (){
        $("#imgfile").trigger("click")
    })
</script>

</html>