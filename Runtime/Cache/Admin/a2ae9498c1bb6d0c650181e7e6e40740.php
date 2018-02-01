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
                        <label class="fi-name"><span class="colorRed">*</span>首页头部公告：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="fl mgr10">
                                <img src="<?php echo ($cache['pic1']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic1" value="<?php echo ($cache['pic1']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽1600高160）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>首页搜索栏右侧广告位：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="fl mgr10">
                                <img src="<?php echo ($cache['pic2']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic2" value="<?php echo ($cache['pic2']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽150高60）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title1"]); ?>" name="title1">
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题1—1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title1_1"]); ?>" name="title1_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片3：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic3']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic3" value="<?php echo ($cache['pic3']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽340高220）</span>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片3-1：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic3_1']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic3_1" value="<?php echo ($cache['pic3_1']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽200高200）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题3-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title3_1"]); ?>" name="title3_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题3-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title3_2"]); ?>" name="title3_2">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片4：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic4']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic4" value="<?php echo ($cache['pic4']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽340高220）</span>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片4-1：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic4_1']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic4_1" value="<?php echo ($cache['pic4_1']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽200高200）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题4-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title4_1"]); ?>" name="title4_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题4-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title4_2"]); ?>" name="title4_2">
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片5：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic5']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic5" value="<?php echo ($cache['pic5']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽340高220）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片5-1：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic5_1']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic5_1" value="<?php echo ($cache['pic5_1']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽200高200）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题5-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title5_1"]); ?>" name="title5_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题5-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title5_2"]); ?>" name="title5_2">
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片6：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic6']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic6" value="<?php echo ($cache['pic6']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽340高220）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片6-1：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic6_1']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic6_1" value="<?php echo ($cache['pic6_1']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽200高200）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题6-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title6_1"]); ?>" name="title6_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题6-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title6_2"]); ?>" name="title6_2">
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片7：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic7']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic7" value="<?php echo ($cache['pic7']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽350高780）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题7-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title7_1"]); ?>" name="title7_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题7-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title7_2"]); ?>" name="title7_2">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题8-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title8_1"]); ?>" name="title8_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题8-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title8_2"]); ?>" name="title8_2">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片9：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic9']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic9" value="<?php echo ($cache['pic9']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽350高780）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题9-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title9_1"]); ?>" name="title9_1">
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片10：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic10']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic10" value="<?php echo ($cache['pic10']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽350高780）</span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题10-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title10_1"]); ?>" name="title10_1">
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题11-1：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title11_1"]); ?>" name="title11_1">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>标题11-2：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title11_2"]); ?>" name="title11_2">
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片11：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic11']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic11" value="<?php echo ($cache['pic11']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽800高500）</span>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片12：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic12']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic12" value="<?php echo ($cache['pic12']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽800高500）</span>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>图片13：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic13']); ?>" width="100px" onerror="this.src='http://www.deyishoplao.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,1)">
                                <input name="pic13" value="<?php echo ($cache['pic13']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议大小（宽800高500）</span>
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>上次更新时间：</label>
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

<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/Index/shopindexConfig.js"></script><!--页面js-->
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