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

    .access-padding {
        padding: 3px;
    }

    .access-padding div {
        float: left;
        margin-right: 5px;
    }

    .access-padding a:hover {
        color: red;
    }
</style>
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
            <h1 class="content-right-title">权限配置<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>

            <form action="" method="post">
                <div class="clearfix"><a href="javascript:;" class="btn btn-success fl " onclick="J_Add(this)">添加顶部导航</a></div>
            </form>
            <table class="wxtables">
                <colgroup>
                    <col width="100%">
                </colgroup>
                <tbody>
                <?php if(is_array($cache)): foreach($cache as $key=>$v1): ?><tr>
                        <td class="access-padding level-1" style="background-color: #58A0D3;">
                            <span style="font-size: 80%;color:#FFF">[头部导航]</span> <b><?php echo ($v1["classname"]); ?> </b>
                            [<a onclick="J_Add(this)" href="javascript:;" data-id="<?php echo ($v1["id"]); ?>" data-classname="<?php echo ($v1["classname"]); ?>" data-pid="<?php echo ($v1["pid"]); ?>" data-level="<?php echo ($v1["level"]); ?>">创建子节点</a>
                            <a onclick="J_Edit(this)"  href="javascript:;" data-id="<?php echo ($v1["id"]); ?>" data-controller="<?php echo ($v1["controller"]); ?>" data-action="<?php echo ($v1["action"]); ?>" data-classname="<?php echo ($v1["classname"]); ?>" data-pid="<?php echo ($v1["pid"]); ?>" data-level="<?php echo ($v1["level"]); ?>" data-sorts="<?php echo ($v1["sorts"]); ?>">修改</a>
                            <?php if($v1['id'] > 1): ?><a href="javascript:;" onclick="J_Change(this)" data-id="<?php echo ($v1['id']); ?>" data-item="is_del">删除</a><?php endif; ?>]
                        </td>
                    </tr>
                    <?php if(is_array($v1['nodes'])): foreach($v1['nodes'] as $key=>$v2): ?><tr>
                            <td class="access-padding  level-2" style="background-color:#D9D9D9;">
                                &nbsp;&nbsp;
                                <span style="font-size: 80%;color:#999">[左侧标签]</span> <?php echo ($v2["classname"]); ?>
                                [<a onclick="J_Add(this)" href="javascript:;" data-id="<?php echo ($v2["id"]); ?>" data-classname="<?php echo ($v2["classname"]); ?>" data-pid="<?php echo ($v2["pid"]); ?>" data-level="<?php echo ($v2["level"]); ?>">创建子节点</a>
                                <a onclick="J_Edit(this)" href="javascript:;" data-id="<?php echo ($v2["id"]); ?>" data-controller="<?php echo ($v2["controller"]); ?>" data-action="<?php echo ($v2["action"]); ?>" data-classname="<?php echo ($v2["classname"]); ?>" data-pid="<?php echo ($v2["pid"]); ?>" data-level="<?php echo ($v2["level"]); ?>" data-sorts="<?php echo ($v2["sorts"]); ?>">修改</a>
                                <?php if($v2['pid'] > 1): ?><a href="javascript:;" onclick="J_Change(this)" data-id="<?php echo ($v2['id']); ?>" data-item="is_del">删除</a><?php endif; ?>]
                            </td>
                        </tr>
                        <?php if(is_array($v2['nodes'])): foreach($v2['nodes'] as $k=>$v3): ?><tr>
                                <td class="access-padding  level-3">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-size: 80%;color:#999">[左侧导航]</span> <b><?php echo ($v3["classname"]); ?></b>
                                    [<a onclick="J_Add(this)" href="javascript:;" data-id="<?php echo ($v3["id"]); ?>" data-classname="<?php echo ($v3["classname"]); ?>" data-pid="<?php echo ($v3["pid"]); ?>" data-level="<?php echo ($v3["level"]); ?>">创建子节点</a>
                                    <a onclick="J_Edit(this)" href="javascript:;" data-id="<?php echo ($v3["id"]); ?>" data-controller="<?php echo ($v3["controller"]); ?>" data-action="<?php echo ($v3["action"]); ?>" data-classname="<?php echo ($v3["classname"]); ?>" data-pid="<?php echo ($v3["pid"]); ?>" data-level="<?php echo ($v3["level"]); ?>" data-sorts="<?php echo ($v3["sorts"]); ?>">修改</a>
                                    <?php if($v3['pid2'] > 1): ?><a href="javascript:;" onclick="J_Change(this)" data-id="<?php echo ($v3['id']); ?>" data-item="is_del">删除</a><?php endif; ?> ]
                                </td>
                            </tr>
                            <tr>
                                <td class="access-padding  level-4">
                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span style="font-size: 80%;color:#999">[内容节点]</span>
                                    </div>
                                    <?php if(is_array($v3['nodes'])): $i = 0; $__LIST__ = $v3['nodes'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v4): $mod = ($i % 2 );++$i;?><div> <i class="green"><?php echo ($v4['classname']); ?></i>
                                        [<a onclick="J_Edit(this)" href="javascript:;" data-id="<?php echo ($v4['id']); ?>" data-controller="<?php echo ($v4['controller']); ?>" data-action="<?php echo ($v4['action']); ?>" data-classname="<?php echo ($v4['classname']); ?>" data-pid="<?php echo ($v4['pid']); ?>" data-level="<?php echo ($v4['level']); ?>" data-sorts="<?php echo ($v4['sorts']); ?>">修改</a>
                                        <?php if($v4['pid3'] > 1): ?><a href="javascript:;" onclick="J_Change(this)" data-id="<?php echo ($v4['id']); ?>" data-item="is_del">删除</a><?php endif; ?>]
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </td>
                            </tr><?php endforeach; endif; endforeach; endif; endforeach; endif; ?>
                </tbody>
            </table>
            <div class="tables-btmctrl clearfix"></div>
        </div>
    </div>
</div>
<!-- end container -->
<!--=======================添加节点 1===============================-->
<div id="albums-overlay" class="disshow"></div>
<div class="jbox addfenlei disshow" style="height:auto;">
    <div class="jbox-title">
        <div class="jbox-title-txt">添加节点</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container" style="height: auto;">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>节点名称</label>

            <div class="form-controls">
                <input type="text" class="input" name="classname">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>控制器名</label>

            <div class="form-controls">
                <input type="text" class="input" name="controller">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>方法名</label>

            <div class="form-controls">
                <input type="text" class="input" name="action">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>排序</label>

            <div class="form-controls">
                <input type="text" class="input" name="sorts" value="0">
                <span class="fi-help-text"></span>
            </div>
        </div>
    </div>
    <div class="jbox-buttons">
        <input type="hidden" class="input" name="pid">
        <input type="hidden" class="input" name="id">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this)">确定</a>
        <a href="javascript:void (0);" class="jbox-buttons-ok btn cancle">取消</a></div>
</div>
<!--=======================添加节点 2===============================-->

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
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/System/nodeList.js"></script><!--页面js-->