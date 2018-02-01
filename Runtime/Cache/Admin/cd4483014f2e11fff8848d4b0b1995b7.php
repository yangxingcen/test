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

<script type="text/javascript" src="/Public/Admin/Js/jquery.js"></script>
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
            <h1 class="content-right-title">用户列表<a href="javascript:history.go(-1);" style="float:right" class="btn btn-success">返回</a></h1>
            <div class="alert alert-info disable-del">
                目前拥有 <span style="font-size:16px;"><?php echo ($count); ?></span>名用户。
                <a href="javascript:;" class="alert-delete" title="隐藏"><i class="gicon-remove"></i></a>
            </div>
            <form action="" method="get">
                <div class="tables-searchbox newcearchbox">
                    <input type="text" placeholder="用户昵称|手机号码" class="input" name="keyword" value="<?php echo I('get.keyword');?>">
                    <input type="text" placeholder="ID" class="input mini" name="id" value="<?php echo I('get.id');?>">
                    <button class="btn btn-primary" style="line-height:28px;"><i class="gicon-search white"></i>查询</button>
                </div>
            </form>
            <div class="tablesWrap">
                <table class="wxtables">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>头像</td>
                        <td>用户昵称/手机</td>
                        <td>性别</td>
                        <td>状态</td>
                        <td>注册时间<br/>上次登录时间</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><img src="<?php echo ($vo["person_img"]); ?>" width="50"></td>
                            <td><?php echo ($vo["person_name"]); ?><br/><?php echo ($vo["telephone"]); ?></td>

                            <td>
                                <?php switch($vo["sex"]): case "0": ?>保密<?php break;?>
                                    <?php case "1": ?>男<?php break;?>
                                    <?php case "2": ?>女<?php break;?>
                                    <?php default: ?>
                                    未知<?php endswitch;?>
                            </td>

                            <td class="status">
                                <?php switch($vo["status"]): case "0": ?><p class="green">正常</p><?php break;?>
                                    <?php case "1": ?><p class="red">冻结</p><?php break; endswitch;?>
                            </td>
                            <td><?php echo ($vo["add_time"]); ?><br/><?php echo ($vo["last_login_time"]); ?></td>
                            <td>
                                <p>
                                    <a href="<?php echo U('/Admin/Member/detail/id');?>/<?php echo ($vo["id"]); ?>" class="btn btn-warning" title="编辑"><i class="gicon-edit white"></i></a>
                                </p>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <!-- end wxtables -->
                <div class="tables-btmctrl clearfix">
                    <div class="fl">
                        <div class="pages" style="width:100%;margin-left:0px;">
                            <?php echo ($page); ?>
                        </div>
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