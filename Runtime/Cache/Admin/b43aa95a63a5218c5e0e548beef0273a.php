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

        <!-- end content-left -->
        <div class="content-right fl">
            <h1 class="content-right-title">广告位管理<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>
            <div class="clearfix"><a href="javascript:;" class="btn btn-success fl BtnAddClass">添加广告位</a></div>
            <table class="wxtables mgt15">
                <thead>
                <tr>
                    <td>序号</td>
                    <td>广告位名称</td>
                    <td>状态</td>
                    <td>排序</td>
                    <td>添加/编辑时间</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["classname"]); ?></td>
                        <td onclick="J_Change(this)" data-item="status" data-id="<?php echo ($vo["id"]); ?>" style="cursor: pointer">
                            <?php if(($vo["status"]) == "0"): ?><span class="green">启用中</span><?php endif; ?>
                            <?php if(($vo["status"]) == "1"): ?><span class="red">已禁用</span><?php endif; ?>
                        </td>
                        <td><?php echo ($vo["sorts"]); ?></td>
                        <td><?php echo ($vo["add_time"]); ?><br/><?php echo ($vo["edit_time"]); ?></td>
                        <td>
                            <a href="javascript:;" class="btn btn-warning" onclick="J_Edit(this)" title="编辑" data-id="<?php echo ($vo["id"]); ?>"
                               data-classname="<?php echo ($vo["classname"]); ?>" data-sorts="<?php echo ($vo["sorts"]); ?>"><i class="gicon-edit white"></i></a>
                            <a href="javascript:;" class="btn btn-danger"  onclick="J_Change(this)" data-item="is_del" data-id="<?php echo ($vo["id"]); ?>" title="删除"><i class="gicon-trash white"></i></a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div class="tables-btmctrl clearfix">
                <div class="fl">
                    <div class="pages" style="width:100%;">
                        <?php echo ($page); ?>
                    </div>
                    <!-- end paginate -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end container -->
<div id="albums-overlay" class="disshow"></div>
<div class="jbox addfenlei disshow" style="height:auto;">
    <div class="jbox-title">
        <div class="jbox-title-txt">添加/编辑广告位</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container" style="height: auto;">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>广告位名称：</label>

            <div class="form-controls">
                <input type="text" class="input" name="classname">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>排序：</label>

            <div class="form-controls">
                <input type="text" class="input" name="sorts" value="0" maxlength="4" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                <span class="fi-help-text"></span>
            </div>
        </div>
    </div>
    <div class="jbox-buttons">
        <input type="hidden" name="id">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this)">确定</a>
        <a href="javascript:void (0);" class="jbox-buttons-ok btn cancle">取消</a>
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
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/banner/bannerType.js"></script><!--页面js-->