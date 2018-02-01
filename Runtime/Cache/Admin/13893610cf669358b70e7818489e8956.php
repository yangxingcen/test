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


<link rel="stylesheet" href="/Public/Admin/Css/Goods/addGoods.css"/><!--当前页面自定义-->
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
            <h1 class="content-right-title">
                <?php if(empty($info["id"])): ?>签到配置<?php else: ?>修改签到配置<?php endif; ?>
                <a href="javascript:history.back(-1)" class="btn" style="float: right">返回</a>
            </h1>

            <div>
                <!--商品参数 1-->
                <div class="panel-single panel-single-light mgt20" id="tab3" style="display: block">
                    <h3 class="cst_h3 mgb20">签到参数</h3>
                    <form id="Form_3">
                        <input name="id" value="1" hidden>
                        <div class="formitems">
                            <table id="goodsparamtable">
                                <tr>
                                    <th>开始天数</th>
                                    <th>结束天数</th>
                                    <th>赠送积分</th>
                                </tr>
                                <tr id='param_list'>
                                    <td><input type="text" class="input" name="start_day[]" value="<?php echo ($sign_config["0"]["start_day"]); ?>"/></td>
                                    <td><input type="text" class="input large" name="end_day[]" value="<?php echo ($sign_config["0"]["end_day"]); ?>"/></td>
                                    <td><input type="text" class="input large" name="give_integral[]" value="<?php echo ($sign_config["0"]["give_integral"]); ?>"/></td>
                                </tr>

                                <?php if(is_array($sign_config)): $i = 0; $__LIST__ = array_slice($sign_config,1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                                        <td><input type="text" class="input" name="start_day[]" value="<?php echo ($info["start_day"]); ?>"/></td>
                                        <td><input type="text" class="input large" name="end_day[]" value="<?php echo ($info["end_day"]); ?>"/></td>
                                        <td><input type="text" class="input large" name="give_integral[]" value="<?php echo ($info["give_integral"]); ?>"/></td>
                                        <td><span class="thisparam gicon-remove" onclick="J_del_param(this)" title='删除' style="padding-top:2px;cursor:pointer;"></span></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </table>
                            <div>
                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" onclick="J_add_param(this)" title="添加"><i class="gicon-plus white"></i></a>
                            </div>
                        </div>

                        <div class="panel-single panel-single-light mgt20 txtCenter ">
                            <a href="javascript:;" onclick="baocun()" class="btn">保存</a>

                        </div>
                    </form>
                </div>
                <!--商品参数 2-->


            </div>
        </div>
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

</div>

<script>
    /*添加商品参数 1*/
    function J_add_param(obj) {
        var html = "<tr>" +
            "<td> <input type=\"text\" class=\"input\" name=\"start_day[]\" /></td>" +
            "<td> <input type=\"text\" class=\"input large\" name=\"end_day[]\"/> </td>" +
            "<td> <input type=\"text\" class=\"input large\" name=\"give_integral[]\"/> </td>" +
            "<td style='width:30px'>" +
            "<span class=\"thisparam gicon-remove\" onclick='J_del_param(this)' title='删除' style=\"padding-top:2px;cursor:pointer;\"></span>" +
            "</td>" +
            "</tr>";
        $(obj).parent().parent().find("#goodsparamtable").append(html);
        J_del_param();
    }
    /*添加商品参数 2*/
    /*删除参数 1*/
    function J_del_param(obj){
        $(obj).parent().parent().remove();
    }
    /*删除参数 2*/
</script>

<script>
    function  baocun() {

        $.ajax({
            type:"POST",
            url:"/Admin/Sign/sign_config",
            data:$("#Form_3").serialize(),
            cache:false,
            async:false,
            dataType:"json",
            beforeSend:function(){
            },
            success:function(data){
                if(data.status==1){
                    dialog.showTips(data.info, "",1);
                }

            },
            error: function(){

            }
        })

    }

</script>