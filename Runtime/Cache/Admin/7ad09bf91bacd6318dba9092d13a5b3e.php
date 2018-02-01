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
    #albums-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .3);
        z-index: 998
    }
</style>
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
            <h1 class="content-right-title">会员等级<a href="javascript:history.go(-1);" style="float:right" class="btn btn-success">返回</a></h1>
            <div class="clearfix"><a href="javascript:;" class="btn btn-success" onclick="J_Edit(this,'add_vip')">添加等级</a></div>
            <div class="tablesWrap">
                <table class="wxtables">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>等级名称</td>
                        <td>升级条件</td>
                        <td>折扣率</td>
                        <td>状态</td>
                        <td>添加时间</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["vip_name"]); ?></td>
                            <td><?php echo ($vo["num"]); ?></td>
                            <td><?php echo ($vo["discount"]); ?></td>
                            <td>
                                <?php switch($vo["status"]): case "0": ?>正常<?php break;?>
                                    <?php case "1": ?>冻结<?php break;?>
                                    <?php default: ?>
                                    未知<?php endswitch;?>
                            </td>
                            <td><?php echo ($vo["add_time"]); ?></td>
                            <td>
                                <p>
                                    <a href="javascript:;" class="btn btn-warning" data-id='<?php echo ($vo["id"]); ?>' data-name='<?php echo ($vo["vip_name"]); ?>' data-status='<?php echo ($vo["status"]); ?>' data-num='<?php echo ($vo["num"]); ?>' data-discount='<?php echo ($vo["discount"]); ?>'  onclick="J_Edit(this,'edit_vip')"><i class="gicon-edit white"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="albums-overlay" class="disshow"></div>

<div class="jbox add_vip addfenlei disshow" style="height:auto;top: 38%;">
    <div class="jbox-title">
        <div class="jbox-title-txt">修改等级</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <form id="add_vip">
        <div class="jbox-container" style="height: auto;">
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>等级名称：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="vip" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>升级条件：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="num" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>折扣率：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="discount" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>状态：&nbsp;&nbsp;&nbsp;</label>
                <div class="form-controls">
                    <div class="radio-group" style="padding-top:0px;">
                        <label><input type="radio" name="status" value="0" checked>正常</label>
                        <label><input type="radio" name="status" value="1">冻结</label>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="type" value="add_vip">
        <div class="jbox-buttons">
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this,'add_vip')">确定</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
        </div>
    </form>
</div>


<div class="jbox edit_vip addfenlei disshow" style="height:auto;top: 38%;">
    <div class="jbox-title">
        <div class="jbox-title-txt">修改等级</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <form id="edit_vip">
        <div class="jbox-container" style="height: auto;">
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>等级名称：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="edit_vip" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>升级条件：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="edit_num" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>折扣率：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="edit_discount" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>状态：&nbsp;&nbsp;&nbsp;</label>
                <div class="form-controls">
                    <div class="radio-group" style="padding-top:0px;">
                        <label><input type="radio" name="edit_status" value="0" checked>正常</label>
                        <label><input type="radio" name="edit_status" value="1">冻结</label>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="type" value="edit_vip">
        <input type="hidden" name="edit_id" value="">
        <div class="jbox-buttons">
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this,'edit_vip')">确定</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
        </div>
    </form>
</div>

<script>
    function J_Edit(obj,cla) {
        $('.'+cla).show();
        $('#albums-overlay').show();
        if('edit_vip' == cla){
            $('input[name=edit_id]').val($(obj).attr('data-id'));
            $('input[name=edit_num]').val($(obj).attr('data-num'));
            $('input[name=edit_discount]').val($(obj).attr('data-discount'));
            $(":radio[name='edit_status'][value='" + $(obj).attr('data-status') + "']").prop("checked", "checked");
            $('input[name=edit_vip]').val($(obj).attr('data-name'));
        }
    }

    function J_Confirm(obj,id) {
        var post =$("#"+id).serialize();
        $.post('/Admin/Member/do_vip', post, function (res) {
            if (res.status == 1) {
                dialog.showTips(res.info, '', 1);
                return false;
            } else {
                dialog.showTips(res.info, 'warn');
                return false;
            }
        }, "json");
    }

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