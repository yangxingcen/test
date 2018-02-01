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
            <h1 class="content-right-title">[<?php echo ($cache["title"]); ?>]--活动配置详情<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>
            <div class="tabs clearfix mgt10">
                <a href="javascript:void(0);" class="tabs_a fl tab1 " onclick="tab_show(this,1)">活动基本信息</a>
                <a href="javascript:void(0);" class="tabs_a fl tab2 active" onclick="tab_show(this,2)">奖品配置</a>
            </div>

            <div>
                <div class="panel-single panel-single-light mgt20" id="tab1" style="display: none">
                    <h3 class="cst_h3 mgb20">活动基本信息</h3>
                    <form id="Form_one">
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>活动起止时间：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge w1" name="time"  id="time" <?php if(!empty($cache["start_time"])): ?>value="<?php echo ($cache["start_time"]); ?> To <?php echo ($cache["end_time"]); ?>"<?php endif; ?> onFocus="this.blur()">
                            <span class="fi-help-text"></span>
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>活动名称：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["title"]); ?>" name="title">
                        </div>
                    </div>
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>优惠券有效天数：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge" value="<?php echo ($cache["add_days"]); ?>" name="add_days" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="11">
                            </div>
                        </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>每次消耗积分：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["integral"]); ?>" name="integral" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="11">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>每天可参与次数/人：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" value="<?php echo ($cache["num"]); ?>" name="num" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="11">
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name">头部背景图：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['pic1']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,6)">
                                <input name="pic1" value="<?php echo ($cache['pic1']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl">建议图片大小:(640*400)</span>
                        </div>
                    </div>


                        <div class="formitems">
                            <label class="fi-name">主体背景图：</label>
                            <div class="form-controls pdt5 j-imglistPanel">
                                <div class="showimage fl mgr10">
                                    <img src="<?php echo ($cache['pic2']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,6)">
                                    <input name="pic2" value="<?php echo ($cache['pic2']); ?>" type="hidden">
                                </div>
                                <span class="fi-help-text fl lh30 mgl10">建议图片大小:(640*1130)</span>
                            </div>
                        </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>活动规则：</label>
                        <div class="form-controls">
                            <textarea name="describe" style="padding: 10px;width: 400px;height: 50px;"> <?php echo ($cache["describe"]); ?></textarea>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>分享标题：</label>
                        <div class="form-controls">
                            <textarea name="share_title" style="padding: 10px;width: 400px;height: 50px;"> <?php echo ($cache["share_title"]); ?></textarea>
                        </div>
                    </div>


                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>分享描述：</label>
                        <div class="form-controls">
                            <textarea name="share_desc" style="padding: 10px;width: 400px;height: 50px;"> <?php echo ($cache["share_desc"]); ?></textarea>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name">分享图片：</label>
                        <div class="form-controls pdt5 j-imglistPanel">
                            <div class="showimage fl mgr10">
                                <img src="<?php echo ($cache['share_logo']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,6)">
                                <input name="share_logo" value="<?php echo ($cache['share_logo']); ?>" type="hidden">
                            </div>
                            <span class="fi-help-text fl lh30 mgl10">建议图片大小:（）</span>
                        </div>
                    </div>

                        <div class="formitems">
                            <label class="fi-name">列表图片：</label>
                            <div class="form-controls pdt5 j-imglistPanel">
                                <div class="showimage fl mgr10">
                                    <img src="<?php echo ($cache['list_pic']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,6)">
                                    <input name="list_pic" value="<?php echo ($cache['list_pic']); ?>" type="hidden">
                                </div>
                                <span class="fi-help-text fl lh30 mgl10">建议图片大小:(604*289)</span>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>列表标题：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge" value="<?php echo ($cache["list_title"]); ?>" name="list_title">
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>列表介绍：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge" value="<?php echo ($cache["list_desc"]); ?>" name="list_desc">
                            </div>
                        </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>上次更新时间：</label>
                        <div class="form-controls"><?php echo ($cache["update_time"]); ?></div>
                    </div>
                    <div class="panel-single panel-single-light mgt20 txtCenter">
                        <input type="hidden" name="id" value="<?php echo ($cache["id"]); ?>">
                        <button type="button" class="btn btn-primary" onclick="J_Confirm(this)">保存</button>
                    </div>
                    </form>
                </div>

                <div class="panel-single panel-single-light mgt20" id="tab2">
                <h3 class="cst_h3 mgb20">奖品配置</h3>
                <form id="Form_two">
                    <div>
                        <a href="javascript:void(0)" class="btn btn-primary btn-mini" onclick="J_add_param(this)" title="添加"><i class="gicon-plus white"></i></a>
                    </div>
                    <div class="jiangxiang">
                        <?php if(empty($jiang_list)): ?><input type="hidden" name="jiang_id[]"value="0">
                            <div class="panel-single jiang">
                                <div class="formitems">
                                    <label class="fi-name"><span class="colorRed">*</span>奖项一：</label>
                                    <div class="form-controls">
                                        <input type="text" class="input mini" name="percent[]" value="<?php echo ($cache["percent"]); ?>" placeholder="中奖百分比">%
                                    </div>
                                </div>
                                <div class="formitems">
                                    <label class="fi-name"><span class="colorRed">*</span>奖品：</label>
                                    <div class="form-controls">
                                        <div class="radio-group">
                                            <label ><input type="radio" name="type[0]"value="1" <?php if(($info["type"]) == "1"): ?>checked<?php endif; ?>>优惠券</label>
                                            <label><input type="radio" name="type[0]"value="2" <?php if(($info["type"]) == "2"): ?>checked<?php endif; ?>>积分</label>
                                            <label ><input type="radio" name="type[0]"value="3" <?php if(($info["type"]) == "3"): ?>checked<?php endif; ?>>积分商品</label>
                                            <label ><input type="radio" name="type[0]"value="4" <?php if(($info["type"]) == "4"): ?>checked<?php endif; ?>>未中奖</label>


                                        </div>


                                    </div>
                                </div>
                                <div class="formitems">
                                    <label class="fi-name"><span class="colorRed">*</span>参数：</label>
                                    <div class="form-controls">
                                        <input type="text" class="input mini fl" name="param[]" value="<?php echo ($cache["percent"]); ?>" >
                                        <span class="fi-help-text">请填写：优惠券面额/积分值/积分商品ID</span>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <?php if(is_array($jiang_list)): foreach($jiang_list as $k=>$v): ?><input type="hidden" name="jiang_id[]"value="<?php echo ($v["jiang_id"]); ?>">

                            <div class="panel-single jiang">
                                <a href="javascript:;" class="btn btn-danger btn-mini" style="float: right" onclick="J_del_del(<?php echo ($id); ?>)" title="删除"><i class="gicon-minus white"></i></a>
                                <div class="formitems">
                                    <label class="fi-name"><span class="colorRed">*</span>奖项<?php if($k == 0): ?>一<?php endif; if($k == 1): ?>二<?php endif; if($k == 2): ?>三<?php endif; if($k == 3): ?>四<?php endif; if($k == 4): ?>五<?php endif; if($k == 5): ?>六<?php endif; if($k == 6): ?>七<?php endif; if($k == 7): ?>八<?php endif; ?>：</label>
                                    <div class="form-controls">
                                        <input type="text" class="input mini" name="percent[]" value="<?php echo ($v["percent"]); ?>" placeholder="中奖百分比">%
                                    </div>
                                </div>
                                <input name="ben_id[]" value="<?php echo ($v["id"]); ?>" type="hidden">
                                <div class="formitems">
                                    <label class="fi-name"><span class="colorRed">*</span>奖品：</label>
                                    <div class="form-controls">
                                        <div class="radio-group">

                                            <label ><input type="radio" name="type[<?php echo ($k); ?>]"value="1" <?php if(($v["type"]) == "1"): ?>checked<?php endif; ?>>优惠券</label>
                                            <label><input type="radio" name="type[<?php echo ($k); ?>]"value="2" <?php if(($v["type"]) == "2"): ?>checked<?php endif; ?>>积分</label>
                                            <label ><input type="radio" name="type[<?php echo ($k); ?>]"value="3" <?php if(($v["type"]) == "3"): ?>checked<?php endif; ?>>积分商品</label>
                                            <label ><input type="radio" name="type[<?php echo ($k); ?>]"value="4" <?php if(($v["type"]) == "4"): ?>checked<?php endif; ?>>未中奖</label>


                                        </div>


                                    </div>
                                </div>
                                <div class="formitems">
                                    <label class="fi-name"><span class="colorRed">*</span>参数：</label>
                                    <div class="form-controls">
                                        <input type="text" class="input mini fl" name="param[]" value="<?php echo ($v["param"]); ?>" >
                                        <span class="fi-help-text">请填写：优惠券面额/积分值/积分商品ID</span>
                                    </div>
                                </div>
                            </div><?php endforeach; endif; endif; ?>



                    </div>




                    <div class="panel-single panel-single-light mgt20 txtCenter">
                        <input type="hidden" name="id" value="<?php echo ($cache["id"]); ?>">
                        <button type="button" class="btn btn-primary" onclick="J_Confirm_prize(this)">保存</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/Activity/activityConfigInfo.js"></script><!--页面js-->
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
<link type="text/css" rel="stylesheet" href="/Public/Jedate/jeDate-test.css">
<link type="text/css" rel="stylesheet" href="/Public/Jedate/skin/jedate.css">
<script type="text/javascript" src="/Public/Jedate/jquery.jedate.js"></script>
<script>
    $("#time").jeDate({
        format: "YYYY-MM-DD hh:mm:ss",
        range:" To "
    });

</script>