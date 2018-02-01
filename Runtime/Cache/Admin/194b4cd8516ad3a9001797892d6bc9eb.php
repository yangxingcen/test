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

        <!-- end content-left -->
        <div class="content-right fl">
            <h1 class="content-right-title">权限分配————[<?php echo ($per_name); ?>]<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>

            <div class="alert alert-info disable-del">建议将[首页]——[后台主页]——[主页]——[主页]勾选，避免出现用户无法登入后台的现象。
                <a href="javascript:;" class="alert-delete" title="隐藏"><i class="gicon-remove"></i></a>
            </div>
            <form action="" method="post">
                <div class="clearfix"><a href="javascript:;" class="btn btn-success fl check-all">全选</a>
                <input type="button" class="btn btn-primary"  style="float: right" onclick="J_Submit(this)"  data-id="<?php echo ($id); ?>" value="保存">
                </div>
            </form>

            <table class="wxtables">
                <tbody>
                <?php if(is_array($cache)): foreach($cache as $key=>$v1): ?><tr>
                        <td class="access-padding level-1" style="background-color: #58A0D3;"> [头部导航]
                            <input type="checkbox" value="<?php echo ($v1["id"]); ?>"  data-pid="<?php echo ($v1["pid"]); ?>" data-pid2="<?php echo ($v1["pid2"]); ?>" data-pid3="<?php echo ($v1["pid3"]); ?>" class="checkbox table-ckbs" data-id="<?php echo ($v1["id"]); ?>" <?php if(in_array($v1['id'],$node_arr)): ?>checked<?php endif; ?> data-name="">
                            <b><?php echo ($v1["classname"]); ?> </b>
                        </td>
                    </tr>
                    <?php if(is_array($v1['nodes'])): foreach($v1['nodes'] as $key=>$v2): ?><tr>
                            <td class="access-padding  level-2" style="background-color:#D9D9D9;">&nbsp;&nbsp;[左侧标签]
                                <input type="checkbox" value="<?php echo ($v2["id"]); ?>" data-pid="<?php echo ($v2["pid"]); ?>" data-pid2="<?php echo ($v2["pid2"]); ?>" data-pid3="<?php echo ($v2["pid3"]); ?>" class="checkbox table-ckbs" data-id="<?php echo ($v2["id"]); ?>" <?php if(in_array($v2['id'],$node_arr)): ?>checked<?php endif; ?> data-name="">
                                <?php echo ($v2["classname"]); ?>
                            </td>
                        </tr>
                        <?php if(is_array($v2['nodes'])): foreach($v2['nodes'] as $k=>$v3): ?><tr>
                                <td class="access-padding  level-3">&nbsp;&nbsp;&nbsp;&nbsp;[左侧导航]
                                    <input type="checkbox" value="<?php echo ($v3["id"]); ?>" data-pid="<?php echo ($v3["pid"]); ?>" data-pid2="<?php echo ($v3["pid2"]); ?>" data-pid3="<?php echo ($v3["pid3"]); ?>" class="checkbox table-ckbs" data-id="<?php echo ($v3["id"]); ?>" <?php if(in_array($v3['id'],$node_arr)): ?>checked<?php endif; ?> data-name="">
                                    <b><?php echo ($v3["classname"]); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td class="access-padding  level-4">
                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[内容节点]</div>
                                    <?php if(is_array($v3['nodes'])): $i = 0; $__LIST__ = $v3['nodes'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v4): $mod = ($i % 2 );++$i;?><div>
                                        <input type="checkbox" value="<?php echo ($v4['id']); ?>" data-pid="<?php echo ($v4['pid']); ?>" data-pid2="<?php echo ($v4['pid2']); ?>" data-pid3="<?php echo ($v4['pid3']); ?>" class="checkbox table-ckbs" data-id="<?php echo ($v4['id']); ?>" data-name="" <?php if(in_array($v4['id'],$node_arr)): ?>checked<?php endif; ?> >
                                        <?php echo ($v4['classname']); ?>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </td>
                            </tr><?php endforeach; endif; endforeach; endif; endforeach; endif; ?>
                </tbody>
            </table>
            <div class="panel-single panel-single-light mgt20 txtCenter">
                <a href="javascript:;" class="btn" onclick="history.back()">返回</a>
                <input type="button" class="btn btn-primary"  onclick="J_Submit(this)" data-id="<?php echo ($id); ?>" value="保存">
            </div>
        </div>
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
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/System/roleSet.js"></script><!--页面js-->