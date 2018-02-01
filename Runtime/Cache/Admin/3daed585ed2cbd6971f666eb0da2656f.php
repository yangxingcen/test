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


<style type="text/css">  
    .bar {  
        margin-top:10px;  
        height:10px;  
        max-width: 300px;  
        background: green;  
    }  
     p {
        font-size: 20px;
        text-align: center;
        cursor: pointer;
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

    <div class="content-right fl">

      <h1 class="content-right-title">积分分类列表</h1>
      <input type="hidden" id="update_id">
      <div class="alert alert-info disable-del"> 目前拥有 <span style="font-size:16px;"><?php echo ($num); ?></span>个分类。 <a href="javascript:;" class="alert-delete" title="隐藏"><i class="gicon-remove"></i></a> </div>
      <form action="" method="get">
              

                <input type="text" style="width:120px;" name="title" class="input" placeholder="分类/内容" value="<?php echo ($title); ?>">
                <input type="text" name="id" class="input xmini" placeholder="ID" value="<?php echo ($id); ?>">
                <!-- <input type="text" style="width:120px;" placeholder="发布时间开始" style="background-color:#FFFFFF;" class="input" name="release_time" value="<?php echo ($release_time); ?>" maxlength="19" readonly>-
                <input type="text" style="width:120px;" placeholder="发布时间结束" style="background-color:#FFFFFF;" class="input" name="release_time_end" value="<?php echo ($release_time_end); ?>" maxlength="19" readonly>
                &nbsp;&nbsp;&nbsp; -->
                <b style="font-size: 15px;">状态：</b>  
                <input type="radio" name="e_status" value="0" <?php if($e_status == 0): ?>checked<?php endif; ?>><span style="font-size: 13px;">全部</span>&nbsp;&nbsp;
                <input type="radio" name="e_status" value="1" <?php if($e_status == 1): ?>checked<?php endif; ?>><span style="color:green;font-size: 20px;">√</span>&nbsp;&nbsp;
                <input type="radio" name="e_status" value="2" <?php if($e_status == 2): ?>checked<?php endif; ?>><span style="color:red;font-size: 20px;">x</span>
                &nbsp;&nbsp;&nbsp;
         
          
                <button class="btn btn-primary" id="search_m" style="vertical-align:-2px;"><i class="gicon-search white"></i>查询</button>
            </form>
      <div class="tablesWrap">
        <!-- <div class="tables-searchbox">
          <div class="fl">
          <a href="javascript:;" class="btn btn-success fl BtnAddClass">添加分类</a>
          </div>
        </div> -->
        <!-- end tables-searchbox -->
        <table class="wxtables" style="text-align:center;">
          <colgroup>
          <col width="6%">
          <col width="10%">
          <col width="30%">
          <col width="10%">
          <col width="5%">
          <col width="6%">
          <col width="15%">
          <col width="15%">
          </colgroup>
          <thead>
            <tr>
              <td>id</td>
              <td>分类</td>
              <td>内容</td>
              <td>积分</td>
              <td>状态</td>
              <td>排序</td>
              <td>修改时间</td>
              <td>操作</td>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["integral_type"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td><?php echo ($vo["integral"]); ?></td>
                <td>
                    <?php if(($vo["status"] == 0)): ?><p style="color: green" class="change_status"  data-id="<?php echo ($vo["id"]); ?>" title="停用" data-data="1">√</p>
                        <?php else: ?>
                        <p style="color: red" class="change_status"   data-id="<?php echo ($vo["id"]); ?>" title="启用" data-data="0">×</p><?php endif; ?>
                </td>
                <td><?php echo ($vo["sorts"]); ?></td>
                <td><?php echo ($vo["update_time"]); ?></td>
                <td>
                    <a href="JavaScript:void(0);" onclick="update_type(id);" id="<?php echo ($vo["id"]); ?>" class='btn btn-warning' title="修改"><i class="gicon-edit white"></i></a>
                    <a href="JavaScript:void(0);" onclick="del_type(id);" id="<?php echo ($vo["id"]); ?>" class='btn btn-danger' title="删除"><i class="gicon-trash white"></i></a>
                </td>
              </tr><?php endforeach; endif; ?>
          </tbody>
        </table>
        <!-- end wxtables -->
        <div class="tables-btmctrl clearfix">
          <div class="fl">
            <div class="pages" style="width:100%;margin-left:0px;"> <?php echo ($page); ?> </div>
            <!-- end paginate -->
          </div>
        </div>
        <!-- end tables-btmctrl -->
      </div>
      <!-- end tablesWrap -->
    </div>
    <!-- end content-right -->
  </div>
</div>
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
<div class="jbox addfenlei disshow" style="height:auto;top: 38%;">
  <div class="jbox-title">
    <div class="jbox-title-txt">修改分类</div>
    <a href="javascript:;" class="jbox-close cancle"></a></div>
  <div class="jbox-container" style="height: auto;">
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>分类：</label>
      <div class="form-controls">
        <label>
          <input type="text" name="integral_type" class="input">
          <span class="red">*必填</span> </label>
        <span class="fi-help-text"></span></div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>内容：</label>
      <div class="form-controls">
        <label>
          <textarea name="titles" id="" cols="27" rows="5"></textarea>
          <span class="red">*必填</span> </label>
        <span class="fi-help-text"></span></div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>积分：</label>
      <div class="form-controls">
        <label>
          <input type="text" name="integral" class="input">
          <span class="red">*必填</span> </label>
        <span class="fi-help-text"></span></div>
    </div>
    <div class="formitems">
        <label class="fi-name"><span class="colorRed"></span>启用：</label>
        <div class="form-controls">
            <div class="radio-group" style="padding-top:0px;">
                <label><input id="status1" type="radio" name="status" value="0" checked>启用</label>
                <label><input id="status2" type="radio" name="status" value="1">禁用</label>
            </div>
        </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed"></span>排序：</label>
      <div class="form-controls">
        <label>
          <input type="text" name="sorts" value="0" class="input" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
          <span class="red">*必填</span> </label>
        <span class="fi-help-text"></span></div>
    </div>
  </div>
  <div class="jbox-buttons">
  <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" id="add_vedio">确定</a>
  <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a></div>
</div>
<script type="text/javascript" src="/Public/Admin/Js/jquery-form.js"></script>
<script type="text/javascript">
$(".cancle").click(function(){
    $(this).parent().parent('.jbox').hide();
    $('#albums-overlay').hide();
    window.location.reload();
})
</script>
<script>
    $(".BtnAddClass").click(function(){
        $('.addfenlei').show();
        $('#albums-overlay').show();
    })
    //获取修改信息
    function update_type(id){
      $.post("<?php echo U('Admin/integralcate/integral_type_info');?>", {id:id}, function (data) {
          $('input[name="integral_type"]').val(data.integral_type);
          $('textarea[name="titles"]').text(data.title);
          $('input[name="sorts"]').val(data.sorts);
          $('input[name="integral"]').val(data.integral);
          $('#update_id').val(data.id);
          if(data.status == 0){
            $("#status1").attr("clecked","clecked");
          }else{
            $("#status2").attr("checked","checked");
          }
          $('.addfenlei').show();
          $('#albums-overlay').show();
      })
    }
    //添加或修改
    $("#add_vedio").click(function(){
      var array =$("[name='type_price']");
      var type_price = '';
      for(var i=0;i<array.length;i++){
        type_price += $(array[i]).val()+',';
      }
      var array = {
        'sorts': $('input[name="sorts"]').val(),
        'integral_type':  $('input[name="integral_type"]').val(),
        'status': $('input[name="status"]:checked').val(),
        'title' :$('textarea[name="titles"]').val(),
        'integral' :$('input[name="integral"]').val(),
      }
      var id=$("#update_id").val();
      $.post("<?php echo U('Admin/integralcate/integral_type_addOrUpdate');?>", {array:array,id:id}, function (data) {
          if (data.status == 1) {
              dialog.showTips(data.info, "", 1);
              return false;
          } else {
              dialog.showTips(data.info, "warn");
              return false;
          }
      })
    })
    //删除问题
    function del_type(id){
      dialog.showTips("确定要进行删除的操作吗?", "firm", function () {
            $.ajax({
                url: "<?php echo U('Admin/integralcate/integral_type_del');?>",
                type: "post",
                dataType: "json",
                data: {
                    id:id,
                }
            }).done(function (res) {
                if (res.status == 1) {
                    dialog.showTips(res.info,"",1); return false;
                } else {
                    dialog.showTips(res.info,"warn"); return false;
                }
            })//
        })
    }
    //修改状态
    $(".change_status").click(function () {
        var id = $(this).attr("data-id");
        var data = $(this).attr("data-data");
        var title = $(this).attr("title");
        dialog.showTips("确定要进行"+title+"的操作吗?", "firm", function () {
            $.post("<?php echo U('Admin/integralcate/integral_type_status');?>", {id:id,data:data}, function (data) {
                if (data.status == 1) {
                    dialog.showTips(data.info, "", 1);
                    return false;
                } else {
                    dialog.showTips(data.info, "warn");
                    return false;
                }
            })
        })
    });
    
</script>