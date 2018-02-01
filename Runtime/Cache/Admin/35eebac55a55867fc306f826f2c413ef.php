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

        <!-- end content-left -->
        <div class="content-right fl">
            <h1 class="content-right-title">广告列表<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>
            <div class="alert alert-info disable-del">共有 <span style="font-size:16px;"><?php echo ($count); ?></span> 张图片。
                <a href="javascript:;" class="alert-delete" title="隐藏"><i class="gicon-remove"></i></a>
            </div>
            <div class="clearfix"><a href="javascript:;" class="btn btn-success BtnAddClass">添加广告</a></div>
            <form action="" method="get">
                <select class="select" style="width: 223px;" name="type">
                    <option value="">请选择广告位置</option>
                        <?php if(is_array($bannerType)): $i = 0; $__LIST__ = $bannerType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $type): ?>selected<?php endif; ?> ><?php echo ($vo["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <button class="btn btn-primary" id="search_m" style="vertical-align:-2px;"><i class="gicon-search white"></i>查询 </button>
            </form>
            <div class="tablesWrap">
                <table class="wxtables" style="  text-align: center;">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>分类</td>
                        <td>图片</td>
                        <td>标题</td>
                        <td>链接</td>
                        <td>排序</td>
                        <td>状态</td>
                        <td align="center">操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["classname"]); ?></td>
                            <td><img src="<?php echo ($vo["pic"]); ?>" height="40px;"/></td>
                            <td><?php echo ($vo["title"]); ?></td>
                            <td><?php echo ($vo["param"]); ?></td>
                            <td><?php echo ($vo["sorts"]); ?></td>
                            <td onclick="J_Change(this)" data-item="status" data-id="<?php echo ($vo["id"]); ?>" style="cursor: pointer">
                                <?php if(($vo["status"]) == "0"): ?><span class="green">启用中</span><?php endif; ?>
                                <?php if(($vo["status"]) == "1"): ?><span class="red">已禁用</span><?php endif; ?>
                            </td>
                            <td align="right">
                                <p style=" text-align:center">
                                    <a class="btn btn-warning"
                                       data-id="<?php echo ($vo["id"]); ?>"
                                       data-type="<?php echo ($vo["type"]); ?>"
                                       data-title='<?php echo ($vo["title"]); ?>'
                                       data-param='<?php echo ($vo["param"]); ?>'
                                       data-sorts="<?php echo ($vo["sorts"]); ?>"
                                       data-pic="<?php echo ($vo["pic"]); ?>"
                                            onclick="J_Edit(this)"><i class="gicon-edit white"></i></a>
                                    <a href="JavaScript:void(0);" class='btn btn-danger' onclick="J_Change(this)" data-item="is_del" data-id="<?php echo ($vo["id"]); ?>"><i class="gicon-trash white"></i></a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <!-- end wxtables -->
                <div class="tables-btmctrl clearfix">
                    <div class="pages">
                        <?php echo ($page); ?>
                    </div>
                </div>
            </div>
            <!-- end tablesWrap -->
        </div>
        <!-- end content-right -->
    </div>
</div>
<!-- end container -->

<div id="albums-overlay" class="disshow"></div>
<div class="jbox addfenlei disshow" style="height: auto;">
    <div class="jbox-title">
        <div class="jbox-title-txt">添加/编辑广告</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <form id="Form_one">
    <div class="jbox-container">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>广告位：</label>

            <div class="form-controls">
                <select name='type' class="select large type">
                    <option value="">--请选择--</option>
                    <?php if(is_array($bannerType)): $i = 0; $__LIST__ = $bannerType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <span class="fi-help-text"></span>
            </div>
        </div>

        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>标题：</label>
            <div class="form-controls">
                <input type="text" class="input large" name="title" maxlength="50">
                <span class="fi-help-text"></span>
            </div>
        </div>

        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>链接参数：</label>
            <div class="form-controls">
                <input type="text" class="input large" name="param" placeholder="URL">
                <span class="fi-help-text"></span>
            </div>
        </div>

        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>排序：</label>
            <div class="form-controls">
                <input type="text" value="0" class="input large" placeholder="默认0" name="sorts"
                       onKeyUp="this.value=this.value.replace(/\D/g,'')"
                       onafterpaste="this.value=this.value.replace(/\D/g,'')">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed">*</span>上传图片：</label>

            <div class="form-controls images">
                <div class="fl mgr10">
                    <img src="<?php echo ($cache['pic']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,4)">
                <input name="pic" value="<?php echo ($cache['pic']); ?>" type="hidden">
                </div>
                <span class="fi-help-text" style="left:85px; position:absolute; top:40px; width:150px; height:20px;"><!--建议大小:轮播图（宽300高150）--></span>
            </div>
        </div>
    </div>
    <div class="jbox-buttons">
        <input type="hidden" name="id" value="">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this)">确定</a>
        <a href="javascript:void (0);" class="jbox-buttons-ok btn cancle">取消</a>
    </div>
    </form>
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
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/Banner/banner.js"></script><!--页面js-->