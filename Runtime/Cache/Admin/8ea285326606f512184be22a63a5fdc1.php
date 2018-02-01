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

<style>
.btn-success {
    margin-top: 12px;
}
</style>
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
    <h1 class="content-right-title">sku列表</h1>
    <div class="alert alert-info disable-del">
      <h4>提示</h4>
      删除sku属性会删除sku下面所有的sku属性值 <a href="javascript:;" class="alert-delete" title="隐藏"> <i class="gicon-remove"></i></a></div>
    <form action="" method="post">
      <div class="clearfix"> 
      <a href="javascript:;" class="btn btn-success fl BtnAddClass">添加sku</a> 
      </div>
    </form>
    <table class="wxtables mgt15">
      <colgroup>
      <col width="20%">
      <col width="15%">
      <col width="20%">
      <col width="38%">
      </colgroup>
      <thead>
        <tr>
          <td>分类名称</td>
          <td>排序</td>
          <td >创建时间</td>
          <td class="center">操作</td>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
            <?php if(!empty($vo["data"])): ?><td class="cate" data-id="<?php echo ($vo["id"]); ?>" data-open="0"><span class="colorBlue bold">+</span>&nbsp;<?php echo ($vo["classname"]); ?></td>
            <?php else: ?>
                <td><?php echo ($vo["classname"]); ?></td><?php endif; ?>
            <td><?php echo ($vo["sort"]); ?></td>
            <td><?php echo ($vo["add_time"]); ?></td>
            <td class="center">
                <a href="javascript:void(0);" class="btn btn-warning j-editClass" title="编辑" data-id="<?php echo ($vo["id"]); ?>" data-pic="<?php echo ($vo["pic"]); ?>" data-title="<?php echo ($vo["classname"]); ?>" data-renk="<?php echo ($vo["sort"]); ?>"><i class="gicon-edit white"></i></a>
                <a href="javascript:;" class="btn btn-danger j-delClass" title="删除" data-id="<?php echo ($vo["id"]); ?>"><i class="gicon-trash white"></i></a> 
            </td>
          </tr>
          <?php if(is_array($vo["data"])): foreach($vo["data"] as $key=>$vo1): ?><tr class="subcate_<?php echo ($vo["id"]); ?>_<?php echo ($vo1["id"]); ?>" style="display:none;">
            <td>|---<?php echo ($vo1["classname"]); ?></td>
            <td><?php echo ($vo1["sort"]); ?></td>
            <td><?php echo ($vo1["add_time"]); ?></td>
            <td class="center">
                <a href="javascript:void(0);" class="btn btn-warning j-editClass" title="编辑" data-id="<?php echo ($vo1["id"]); ?>" data-pic="<?php echo ($vo1["pic"]); ?>" data-fid="<?php echo ($vo1["pid"]); ?>" data-title="<?php echo ($vo1["classname"]); ?>" data-renk="<?php echo ($vo1["sort"]); ?>"><i class="gicon-edit white"></i></a> 
                <a href="javascript:;" class="btn btn-danger j-delClass" data-id="<?php echo ($vo1["id"]); ?>" title="删除" ><i class="gicon-trash white"></i></a> 
            </td>
          </tr><?php endforeach; endif; endforeach; endif; ?>
      </tbody>
    </table>
    <!-- end wxtables -->
    <div class="tables-btmctrl clearfix">
       
      <div class="pages"> 
        <?php echo ($page); ?> 
      </div>
      <!-- end tables-btmctrl --> 
    </div>
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
<div id="albums-overlay" class="disshow"></div>
<div class="jbox addfenlei disshow" style="height:auto;">
  <div class="jbox-title">
    <div class="jbox-title-txt">添加sku</div>
    <a href="javascript:;" class="jbox-close cancle"></a></div>
  <div class="jbox-container">
    <div class="formitems">
      <label class="fi-name"><span class="colorRed">*</span>sku名称：</label>
      <div class="form-controls">
        <input type="text" class="input classname" name="classname" >
        <span class="fi-help-text"></span> </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>上级sku：</label>
      <div class="form-controls">
      <select name='fid' style='padding:5px;border: 1px solid #ccc;width:182px' id='fid'>
      <option value="0">--顶级sku--</option>
          <?php if(is_array($cate)): foreach($cate as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["classname"]); ?></option><?php endforeach; endif; ?>
      </select>
        <span class="fi-help-text"></span> </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>分类排序：</label>
      <div class="form-controls">
        <input type="text" value="0" class="input" id="addsort" name="serial" >
        <span class="fi-help-text"></span> </div>
    </div>
  </div>
  <div class="jbox-buttons">
  <a href="javascript:void(0);"  class="jbox-buttons-ok btn btn-primary" id="addcategory">确定</a>
  <a href="javascript:void (0);" class="jbox-buttons-ok btn cancle">取消</a></div>
</div>
<div class="jbox editfenlei disshow" style="height:auto;">
  <div class="jbox-title">
    <div class="jbox-title-txt">修改sku</div>
    <a href="javascript:;" class="jbox-close cancle"></a></div>
  <div class="jbox-container">
    
    <div class="formitems">
      <label class="fi-name"><span class="colorRed">*</span>sku名称：</label>
      <div class="form-controls">
        <input type="text" class="input classname" name="classname" id="editclassname">
        <span class="fi-help-text"></span> </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>上级sku：</label>
      <div class="form-controls">
      <select name='fid' style='padding:5px;border: 1px solid #ccc;width:182px' id='editfid'>
      <option value="0">--顶级sku--</option>
      <?php if(is_array($cate)): foreach($cate as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["classname"]); ?></option><?php endforeach; endif; ?>
      </select>
        <span class="fi-help-text"></span> </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>分类排序：</label>
      <div class="form-controls">
        <input type="text" class="input sort" name="serial" id="editsort" >
        <input type="hidden" class="input sort" name="serial" id="categoryid" >
        <span class="fi-help-text"></span> </div>
    </div>
    
  </div>
  <div class="jbox-buttons">
  <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" id="editcategory">确定</a>
  <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a></div>
</div>

<script type="text/javascript" src="/Public/Admin/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/util.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.j-delClass').click(function(){
        var id = parseInt($(this).attr('data-id'));
        if (id > 0) {
            dialog.showTips("确定删除吗?", "firm",function(){

                $.post("<?php echo U('Admin/Ingetralsku/delSku');?>" ,{action:'upIssale',id:id}, function (data){
                  if (data.status == 1) {
                      dialog.showTips(data.info,"",1); return false;
                  } else {
                      dialog.showTips(data.info,"warn"); return false;
                  }
                })
            })
        } else {
            dialog.showTips('错误的请求', 'warn');
            return false;
        }
    });
});
</script>
<script type="text/javascript">
    $(".cancle").click(function(){
        $(this).parent().parent('.jbox').hide();
        $('#albums-overlay').hide();
    })

    $(".BtnAddClass").click(function(){
        $('.addfenlei').show();
        $('#albums-overlay').show();
    })

    $("#addcategory").click(function(){
        var classname = $('.classname').val();  //分类名称
        var fid       = $('#fid').val();
        var sort      = $('#addsort').val();           //排序
        var img       = $("#addpic").val();
        if (classname == '') {
            alert("sku名称必填！");
            return false;
        }
        if(!sort.match(/^[0-9]*$/)){
            alert("请填写正确的排序！");
            return false;
        }
        $.ajax({
            url: "<?php echo U('/Admin/Ingetralsku/addSku');?>",
            type: "post",
            dataType: "json",
            data: {
                classname: classname,
                fid:       fid,
                sort:      sort,
            }
        }).done(function (g) {
            if (g.status == 1) {
                dialog.showTips(g.info,"",1); return false;
            } else {
                dialog.showTips(g.info,"warn"); return false;
            }
        })
    })
</script> 
<!--添加分类end--> 

<!--修改分类--> 
<script type="text/javascript">
    var categoryid;
    $(".j-editClass").click(function(){
        $('.editfenlei').show();
        $('#albums-overlay').show();
        var categoryname=$(this).attr('data-title');
        var categoryid=$(this).attr('data-id');
        var fid=$(this).attr('data-fid');
        var sort=$(this).attr('data-renk');
        $('#editclassname').val(categoryname);
        $('#editfid').val(fid);
        $('#editsort').val(sort);
        $('#categoryid').val(categoryid);
    })
    $("#editcategory").click(function(){
        var classname   = $('#editclassname').val();  //分类名称
        var fid         = $('#editfid').val();  //分类名称
        var sort        = $('#editsort').val();           //排序
        var categoryid  = $('#categoryid').val();           //排序
        if (classname == '') {
            alert("分类名称必填！");
            return false;
        }
        $.ajax({
            url: "<?php echo U('/Admin/Ingetralsku/editSku');?>",
            type: "post",
            dataType: "json",
            data: {
                classname: classname,
                fid: fid,
                sort: sort,
                categoryid:categoryid,
            }
        }).done(function (g) {
            if (g.status == 1) {
                dialog.showTips(g.info,"",1); return false;
            } else {
                dialog.showTips(g.info,"warn"); return false;
            }
        })
    })
</script> 
<!--修改分类end-->