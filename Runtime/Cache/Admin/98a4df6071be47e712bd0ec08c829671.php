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

<!--上传图片 1-->
<link rel="stylesheet" href="/Public/UploadImg/uploadImg.css" /><!--自定义-->
<link rel="stylesheet" href="/Public/UploadImg/themes/default/default.css" />
<link rel="stylesheet" href="/Public/UploadImg/plugins/code/prettify.css" />
<script charset="utf-8" src="/Public/UploadImg/kindeditor-all.js"></script>
<script charset="utf-8" src="/Public/UploadImg/lang/zh-CN.js"></script>
<script charset="utf-8" src="/Public/UploadImg/plugins/code/prettify.js"></script>
<!--上传图片 2-->
<div class="container">
    <div class="inner clearfix">
        <div class="content-left fl">
  <dl class="left-menu shop_3 sub_tags">
    <?php if(is_array($node_left_list)): foreach($node_left_list as $key=>$v): ?><dt><i class="icon-menu tags"></i> <span id="shop_3" data-id="3"><?php echo ($v['classname']); ?></span></dt>
      <?php if(is_array($v['nodes'])): foreach($v['nodes'] as $key=>$vv): ?><dd class="subshop_0 <?php if(($left_id) == $vv[id]): ?>active<?php endif; ?> ">
          <a href="<?php echo U('/Admin/'.$vv[controller].'/'.$vv[action]);?>"><?php echo ($vv['classname']); ?></a>
        </dd><?php endforeach; endif; endforeach; endif; ?>
  </dl>
</div>

        <div class="content-right fl">
            <h1 class="content-right-title">门店列表<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>
            <div class="alert alert-info disable-del"> 目前拥有 <span style="font-size:16px;"><?php echo ($count); ?></span> 个门店。
                <a href="javascript:;" class="alert-delete" title="隐藏"><i class="gicon-remove"></i></a>
            </div>
            <div class="clearfix">
                <a href="<?php echo U('admin/Store/addStore');?>" class="btn btn-success fl BtnAddClass">添加门店</a>
            </div>
            <form action="" method="get">
                <div class="tables-searchbox newcearchbox">
                    <input type="text" placeholder="门店名称" class="input" name="store_name" value="<?php echo I('get.store_name');?>">
                    <button class="btn btn-primary" style="line-height:28px;"><i class="gicon-search white"></i>查询</button>
                </div>
            </form>
            <div class="tablesWrap">
                <!-- end tables-searchbox -->
                <table class="wxtables" style="text-align:center;">
                    <colgroup>
                        <col width="1%">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <td><i class="icon_check"></i></td>
                        <td>门店名称</td>
                        <td>省份</td>
                        <td>地级市</td>
                        <td>区、县级市</td>
                        <td>地址</td>
                        <td>电话</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr >
                            <td><input type="checkbox" class="checkbox table-ckbs check" data-id="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>" data-name=""></td>
                            <td><?php echo ($vo["storename"]); ?></td>
                            <td align="left"><?php echo ($vo["province"]); ?></td>
                            <td><?php echo ($vo["city"]); ?></td>
                            <td><?php echo ($vo["district"]); ?></td>
                            <td><?php echo ($vo["address"]); ?></td>
                            <td><?php echo ($vo["telephone"]); ?></td>
                            <td>
                                <a href="<?php echo U('admin/store/editstore',array('id'=>$vo[id],'name'=>$vo[storename]));?>" class='btn btn-warning'  title="编辑"><i class="gicon-edit white"></i></a>
                                    <a href="<?php echo U('admin/store/delStore',array('id'=>$vo[id],'name'=>$vo[storename]));?>" onclick="return confirm('确定要删除吗？')" class='btn btn-danger' title="删除"><i class="gicon-trash white"></i></a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div class="tables-btmctrl clearfix">
                    <div class="fl">
                        <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                        <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                        <a href="javascript:;"  style="background-color:#f0ad4e;border-color:#eea236;"  class="btn btn-primary del">删除</a>
                    </div>
                    <div class="fr">
                        <div class="pages">
                            <?php echo ($page); ?>
                        </div>
                        <!-- end paginate -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.del').click(function(){
            var Id ='';
            if($('.check:checked').length ==0){
                alert('请选择要删除的门店');return false;
            }
            if(confirm('确定删除多个门店吗！')){
                $('.check:checked').each(function(){
                    Id = Id + $(this).val() + ',';
                });

                $.post("<?php echo U('Admin/Store/delStore');?>",{'id':Id,'type':'some'},function(data){
                    if(data.status==1){
                        alert(data.info);
                        location.reload();
                    }
                },'json');
            }
        })
    })
</script>
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