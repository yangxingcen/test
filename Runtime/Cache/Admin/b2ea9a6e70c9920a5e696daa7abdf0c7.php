<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="/Public/images/logo.ico"/>
    <title><?php echo ($shop_seo_config["title"]); ?>-后台管理系统</title>
    
    <link rel="stylesheet" href="/Public/Admin/Css/component-min.css">
    <link rel="stylesheet" href="/Public/Admin/Css/jbox-min.css">
    <link rel="stylesheet" href="/Public/Admin/Css/home.2015.05.22-09.32.css">
    <link rel="stylesheet" href="/Public/Admin/Css/list_homepage.css">

    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/jquery-form.js"></script>

    <link rel="stylesheet" href="/Public/Admin/Css/admincommon.css"><!--自定义css-->

    <!--弹出框 1-->
    <link rel="stylesheet" href="/Public/Admin/Css/alert.css">
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/alert.js"></script>
    <!--弹出框 2-->

    <!--编辑器 1-->
    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>
    <!--编辑器 2-->

</head>
<body class="cp-bodybox">
<div class="header">
    <div class="inner clearfix">
        <div class="fl"><a href="<?php echo U('Admin/Index/web_config');?>" class="header-logo">
            <img src="/Public/images/logo.png" height="45"> </a>
        </div>
        <div class="header-nav fl">
            <ul class="header-nav-list clearfix">
                <?php if(is_array($node_head_list)): foreach($node_head_list as $key=>$v): ?><li class="fl <?php if(($head_id) == $v[id]): ?>active<?php endif; ?>">
                        <a href="<?php echo U('/Admin/'.$v[controller].'/'.$v[action]);?>"><?php echo ($v['classname']); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
        <div class="fr">
            <ul class="header-ctrl clearfix">
                <li class="header-ctrl-item fl">
                    <a href="javascript:;" class="header-ctrl-item-parent">
                        <i class="gicon-user white"></i> <i class="gicon-user"></i> 账户<?php echo (session('admin')); ?>
                    </a>
                    <ul class="header-ctrl-item-children">
                        <li><a href="<?php echo U('/Admin/Index/updatePwd');?>">修改密码</a></li>
                        <li><a href="<?php echo U('/Admin/User/login');?>">退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <span class="account_inbox_switch fr">
            <a href="javascript:void(0)" class="header_mail"></a>
        </span>
    </div>
</div>

<link rel="stylesheet" href="/Public/Admin/Css//lists.css">

<div class="container">
<div class="inner clearfix"> <div class="content-left fl">
  <dl class="left-menu shop_3 sub_tags">
    <?php if(is_array($node_left_list)): foreach($node_left_list as $key=>$v): ?><dt><i class="icon-menu tags"></i> <span id="shop_3" data-id="3"><?php echo ($v['classname']); ?></span></dt>
      <?php if(is_array($v['nodes'])): foreach($v['nodes'] as $key=>$vv): ?><dd class="subshop_0 <?php if(($left_id) == $vv[id]): ?>active<?php endif; ?> ">
          <a href="<?php echo U('/Admin/'.$vv[controller].'/'.$vv[action]);?>"><?php echo ($vv['classname']); ?></a>
        </dd><?php endforeach; endif; endforeach; endif; ?>
  </dl>
</div>

  <!-- end content-left -->

  <div class="content-right fl">
    <h1 class="content-right-title">关于我们</h1>
	<!--<a href="<?php echo U('/Admin/'.CONTROLLER_NAME.'/addeditcontent/classid/'.$classid.'/action/'.ACTION_NAME);?>" class="btn btn-success">发布内容</a>-->
    <!-- end tabs -->

    <table class="wxtables mgt10" style="text-align:center;">
      <colgroup>

      <col width="30%">
	  <col width="30%">

	  <col width="30%">
      </colgroup>
      <thead>
        <tr class="po_list">

          <td>标题</td>
          
          <td>图片</td>
          <td>操作<span></span></td>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
            <!-- <td><input type="checkbox" class="check checkbox table-ckbs" data-id="<?php echo ($vo['id']); ?>"></td> -->
		
			<td><?php echo ($vo["title"]); ?></td>
            <td><div class="goodswrap"> 
                <a href="<?php echo ($vo['pic']); ?>" class="block" target="_blank" title="<?php echo ($vo['title']); ?>">
                <?php if($vo["pic"] != null): ?><div class="table-item-img"> <img src="<?php echo ($vo['pic']); ?>" alt="" width="50px"> </div><?php endif; ?>
                </a> </div>
            </td>           

            <td>
              <a href="<?php echo U('/Admin/'.CONTROLLER_NAME.'/addeditcontent/id/'.$vo['id'].'/action/'.ACTION_NAME.$urllink);?>" class="btn btn-primary j-editClass" title="编辑">编辑</a>

              </td>
          </tr><?php endforeach; endif; ?>
      </tbody>
    </table>
    <!-- end wxtables -->

    <!-- end content-right -->
  </div>
</div>
<!-- end container -->
<div class="footer"><?php echo ($shop_seo_config["copyright"]); ?> , Inc. All rights reserved.</div>
<div class="fixedBar" style="left: 1321px; height: 285px; top: 76px; margin-top: 0px;"></div>
<a href="#" id="j-gotop" class="gotop" title="回到顶部" style="left: 1322.5px;"></a>
<script src="/Public/Admin/Js/lib-min.js"></script>
<script src="/Public/Admin/Js/jquery.jbox-min.js"></script>
<!-- 线上环境 -->
<script src="/Public/Admin/Js/component-min.js"></script>
<script src="/Public/Admin/Js/scroll.js"></script>
<script src="/Public/Admin/Js/echarts.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/admincommon.js"></script><!--自定义的js-->
</body>
</html>
<script>

</script>


<script>
    //改变状态
    function status(obj){
       var _this= $(obj)
      var id   =_this.attr("data-id");
      var item = _this.attr("data-item");
      $.post("<?php echo U('Admin/Index/changeStatus');?>", {
        id:id,
        item:item,
        tab : 'content'
      }, function(data){
        if(data.status == 1){
          _this.css({color:"#0C0"}).html("√");
        }else if(data.status == 2){
          _this.css({color:"#c00"}).html("×");
        }else{
          alert(data.info);
        }
      }, "json")
    }


    //删除
    function btn_del(id){
        var id = id ;
       dialog.showTips("确定删除吗","firm",function (){
              if(!id){
                id = "";
             
                $('.check:checked').each(function(){
                    id = id + $(this).attr("data-id") + '-';
                });
      
              }
        
            $.ajax({
                url: "<?php echo U('/Admin/Index/delsoftAll');?>",
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                    tab: 'content',
                }
            }).done(function (res) {
                if (res.status == 1) {
                    dialog.showTips(res.info,"","<?php echo U('Admin/'.CONTROLLER_NAME.'/'.ACTION_NAME.$urllink);?>");
                } else {
                  console.dir(res.info);
                    dialog.showTips(res.info,"warn");
                }
            })
        
      });
      
    }

	//上下移
	$(".updown").click(function(){
		var id = $(this).attr("data-id");
		var num = $(this).attr("data-num");
		var title = $(this).attr("data-name");
		var pid = $(this).attr("data-pid");
		////console.dir(id);
		//console.dir(num);
		//return false;
		$.post(
			"<?php echo U('Admin/Index/updown');?>" ,
			{
				id   : id,
				num  : num,
				title: 'name',
				val  : title,
				pid  : pid,
				pname: 'cate_id',
				tab  : 'content',
				sort : 'sort',
                classid:'<?php echo ($classid); ?>'
			}, 
			function (data){

			    //console.dir(data.info);
			    if(data.status){
					 window.location.reload();
			    }else{
					alert(data.info);
				}
				
			}
		)
	})
	
	//转移分类
  function changeALL(){
    dialog.showTips("确定转移所有选中的分类？","firm",function (){
    var ids = "";
    $(".table-ckbs:checked").each(function(i){
      ids += $(this).attr("data-id")+"-"
    })
	
    var pid = $("#select_class_id").val();
	
    $.post(
      "<?php echo U('Admin/Index/change');?>" ,
      {
        ids:ids,
        pid:pid,
        tab:'content',
        pname:'cate_id',
      }, 
      function (data){
        if(data.info!='移动成功'){
          alert(data.info);
        }
          //console.dir(data.info);
          if(data.status){
			dialog.showTips(data.info,"","<?php echo U('Admin/'.CONTROLLER_NAME.'/'.ACTION_NAME.$urllink);?>");
          }
      }
    )
  });

}

</script>