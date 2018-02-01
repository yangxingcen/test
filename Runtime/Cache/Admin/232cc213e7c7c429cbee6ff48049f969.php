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
            <h1 class="content-right-title">配置详情</h1>
            <form id="web_config_form">
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">基本信息</h3>
                    <div class="formitems">
                        <label class="fi-name">网站LOGO：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="fl mgr10">
                                <img src="<?php echo ($cache['logo']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="logo" value="<?php echo ($cache['logo']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl"></span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>商城名称：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["web_name"]); ?>" name="web_name">
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>商城简介：</label>
                        <div class="form-controls">
                            <textarea name="brief" style="padding: 10px;width: 400px;height: 100px;"> <?php echo ($cache["brief"]); ?></textarea>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>SEO标题：</label>
                        <div class="form-controls">
                            <textarea name="seo_title" style="padding: 10px;width: 400px;height: 50px;"><?php echo ($cache["seo_title"]); ?></textarea>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>SEO关键字：</label>
                        <div class="form-controls">
                            <textarea name="seo_keywords" style="padding: 10px;width: 400px;height: 50px;"><?php echo ($cache["seo_keywords"]); ?></textarea>

                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>SEO描述：</label>
                        <div class="form-controls">
                            <textarea name="seo_description" style="padding: 10px;width: 400px;height: 50px;"><?php echo ($cache["seo_description"]); ?></textarea>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>版权设置：</label>
                        <div class="form-controls">
                            <textarea  name="copyright" style="padding: 10px;width:400px;height:50px;"><?php echo ($cache["copyright"]); ?></textarea>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>客服电话：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["servise_phone"]); ?>" name="servise_phone" placeholder="">
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>客服QQ：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["servise_qq"]); ?>" name="servise_qq" placeholder="">
                        </div>
                    </div>

                    <!--<div class="formitems">
                        <label class="fi-name">售罄图标：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['sell_out_pic']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="sell_out_pic" value="<?php echo ($cache['sell_out_pic']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽?高?）</span>
                        </div>
                    </div>-->


                    <!--<div class="formitems">
                        <label class="fi-name">加载图标：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['load_pic']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="load_pic" value="<?php echo ($cache['load_pic']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl lh30 mgl10">建议大小（宽?高?）</span>
                        </div>
                    </div>-->

                    <div class="formitems">
                        <label class="fi-name">微信商城：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['wx_shop']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="wx_shop" value="<?php echo ($cache['wx_shop']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl lh30 mgl10">建议大小（宽?高?）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name">微博：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['weibo']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="weibo" value="<?php echo ($cache['weibo']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl lh30 mgl10">建议大小（宽?高?）</span>
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>上次更新时间：</label>
                        <div class="form-controls"><?php echo ($cache["update_time"]); ?></div>
                    </div>
                    <div class="panel-single panel-single-light mgt20 txtCenter">
                        <button type="button" class="btn btn-primary" onclick="J_Confirm(this)">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/Index/web_config.js"></script><!--页面js-->
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