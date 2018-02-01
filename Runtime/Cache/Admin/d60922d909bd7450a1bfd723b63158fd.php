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
    .radio-group select{
        height: 30px;
        margin-top: 7px;
    }
</style>
<script>
    /*省市区联动 编辑 1*/
    var options = jQuery.extend({
        sheng:"s_province",		//省的网页ID
        shi:"s_city",			//市的网页ID
        xian:"s_county",		//县的网页ID
        xiang:"xiang",		//乡的网页ID
        sheng_val:"<?php echo I('s_province');?>",		//默认省份
        shi_val:"<?php echo I('s_city');?>",			//默认地区
        xian_val:"<?php echo I('s_county');?>",		//默认县
        xiang_val:""		//默认乡镇
    });
    $(function(){initLocation(options);})
    /*省市区联动 编辑 2*/
</script>
<!--三级联动-->
<script src="/Public/ProvinceCity/GlobalProvinces_main.js"></script>
<script src="/Public/ProvinceCity/GlobalProvinces_extend.js"></script>
<script src="/Public/ProvinceCity/initLocation.js"></script>
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
            <h1 class="content-right-title">经销商列表<a href="javascript:;" style="float: right" class="btn"  onclick="history.back()">返回</a></h1>
            <div class="alert alert-info disable-del"> 目前拥有 <span style="font-size:16px;"><?php echo ($count); ?></span> 个经销商。
                <a href="javascript:;" class="alert-delete" title="隐藏"><i class="gicon-remove"></i></a>
            </div>
            <div class="clearfix"><a href="javascript:;" class="btn btn-success" onclick="J_Edit(this,'add_dealer')">添加经销商</a></div>
            <form action="" method="get">
                <div class="tables-searchbox newcearchbox">
                    <input type="text" placeholder="编号/姓名/手机号" class="input" name="dealer_search" value="<?php echo I('get.dealer_search');?>" style="width: 130px;">
                    <div class="formitems" style="display: inline;">
                        <div class="form-controls"  style="display: inline;margin-left: 0">
                            <div class="radio-group" style="display: inline;">
                                <select name="s_province" id="s_province" class="select large" style="width: 130px;"></select>
                                <select name="s_city" id="s_city" class="select large" style="width: 130px;"></select>
                                <select name="s_county" id="s_county" class="select large" style="width: 130px;"></select>
                            </div>
                        </div>
                        <button class="btn btn-primary" style="position: relative;top:1px"><i class="gicon-search white"></i>查询</button>
                    </div>

                </div>
            </form>
            <div class="tablesWrap">
                <table class="wxtables" style="text-align:center;">
                    <colgroup>
                        <col width="1%">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <td><i class="icon_check"></i></td>
                        <td>经销商编号</td>
                        <td>姓名</td>
                        <td>手机号</td>
                        <td>省</td>
                        <td>市</td>
                        <td>区</td>
                        <td>添加时间</td>
                        <td>更新时间</td>
                        <td>状态</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr >
                            <td><input type="checkbox" class="checkbox table-ckbs check" data-id="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>" data-name=""></td>
                            <td><?php echo ($vo["card"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td align="left"><?php echo ($vo["telephone"]); ?></td>
                            <td><?php echo ($vo["province"]); ?></td>
                            <td><?php echo ($vo["city"]); ?></td>
                            <td><?php echo ($vo["county"]); ?></td>
                            <td><?php echo ($vo["add_time"]); ?></td>
                            <td><?php echo ($vo["update_time"]); ?></td>
                            <td><?php echo ($vo["status"]); ?></td>
                            <td>
                                <a href="javascript:;" class="btn btn-success" data-id='<?php echo ($vo["id"]); ?>' data-card='<?php echo ($vo["card"]); ?>' data-name='<?php echo ($vo["name"]); ?>' data-telephone='<?php echo ($vo["telephone"]); ?>' data-province='<?php echo ($vo["province"]); ?>' data-city='<?php echo ($vo["city"]); ?>' data-county='<?php echo ($vo["county"]); ?>' data-status='<?php echo ($vo["status"]); ?>'  onclick="J_Edit(this,'edit_dealer')"><i class="gicon-edit white"></i></a>
                                <a href="JavaScript:void(0);" class='btn btn-danger'
                                   onclick="J_Change(this)" data-type="0" data-id="<?php echo ($vo["id"]); ?>" title="删除"><i class="gicon-trash white"></i></a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div class="tables-btmctrl clearfix">
                    <div class="fl">
                        <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                        <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                        <a href="javascript:;"  style="background-color:#f0ad4e;border-color:#eea236;"  class="btn btn-primary del">删除</a>
                    </div>
                    <div class="fr">
                        <div class="pages">
                            <?php echo ($page); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="albums-overlay" class="disshow"></div>

<div class="jbox add_dealer addfenlei disshow" style="height:auto;top: 38%;">
    <div class="jbox-title">
        <div class="jbox-title-txt">添加经销商</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <form id="add_dealer">
        <div class="jbox-container" style="height: auto;">
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>经销商唯一编号：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="card" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>经销商姓名：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="name" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>经销商手机：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="telephone" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>地区：</label>
                <div class="form-controls">
                    <div class="radio-group" style="width: 170px;">
                        <select name="province" id="province" class="select large" style="width: 185px;"></select>
                        <select name="city" id="city" class="select large" style="width: 185px;"></select>
                        <select name="county" id="county" class="select large" style="width: 185px;"></select>
                    </div>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>状态：&nbsp;&nbsp;&nbsp;</label>
                <div class="form-controls">
                    <div class="radio-group" style="padding-top:0px;">
                        <label><input type="radio" name="status" value="0" checked>正常</label>
                        <label><input type="radio" name="status" value="1">禁用</label>
                    </div>
                </div>
            </div>

        </div>
        <input type="hidden" name="type" value="0">
        <div class="jbox-buttons">
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this,'add_dealer')">确定</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
        </div>
    </form>
</div>


<div class="jbox edit_dealer addfenlei disshow" style="height:auto;top: 38%;">
    <div class="jbox-title">
        <div class="jbox-title-txt">编辑经销商</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <form id="edit_dealer">
        <div class="jbox-container" style="height: auto;">
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>经销商唯一编号：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="edit_card" value="" readonly>
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>经销商姓名：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="edit_name" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"> * </span>经销商手机：</label>
                <div class="form-controls">
                    <label>
                        <input type="text" class="input" name="edit_telephone" value="">
                        <span class="red"></span>
                    </label>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>地区：</label>
                <div class="form-controls">
                    <div class="radio-group" style="width: 170px;">
                        <select name="edit_province" id="edit_province" class="select large" style="width: 185px;"></select>
                        <select name="edit_city" id="edit_city" class="select large" style="width: 185px;"></select>
                        <select name="edit_county" id="edit_county" class="select large" style="width: 185px;"></select>
                    </div>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>状态：&nbsp;&nbsp;&nbsp;</label>
                <div class="form-controls">
                    <div class="radio-group" style="padding-top:0px;">
                        <label><input type="radio" name="edit_status" value="0" checked>正常</label>
                        <label><input type="radio" name="edit_status" value="1">禁用</label>
                    </div>
                </div>
            </div>

        </div>
        <input type="hidden" name="type" value="1">
        <input type="hidden" name="edit_id" value="">
        <div class="jbox-buttons">
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm(this,'edit_dealer')">确定</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
        </div>
    </form>
</div>
<script>
    function J_Edit(obj,cla) {
        $('.'+cla).show();
        $('#albums-overlay').show();
        if('edit_dealer' == cla){
            $('input[name=edit_id]').val($(obj).attr('data-id'));
            $('input[name=edit_card]').val($(obj).attr('data-card'));
            $('input[name=edit_name]').val($(obj).attr('data-name'));
            $('input[name=edit_telephone]').val($(obj).attr('data-telephone'));
            $(":radio[name='edit_status'][value='" + $(obj).attr('data-status') + "']").prop("checked", "checked");

            var option = jQuery.extend({
                sheng:"edit_province",		//省的网页ID
                shi:"edit_city",			//市的网页ID
                xian:"edit_county",		//县的网页ID
                xiang:"xiang",		//乡的网页ID
                sheng_val:$(obj).attr('data-province'),		//默认省份
                shi_val:$(obj).attr('data-city'),			//默认地区
                xian_val:$(obj).attr('data-county'),		//默认县
                xiang_val:""		//默认乡镇
            });
            $(function(){initLocation(option);})
        }
        if('add_dealer' == cla){
            /*省市区联动 编辑 1*/
            const option = jQuery.extend({
                sheng:"province",		//省的网页ID
                shi:"city",			//市的网页ID
                xian:"county",		//县的网页ID
                xiang:"xiang",		//乡的网页ID
                sheng_val:"",		//默认省份
                shi_val:"",			//默认地区
                xian_val:"",		//默认县
                xiang_val:""		//默认乡镇
            });
            initLocation(option);
        }
    }

    function J_Confirm(obj,id) {
        var post =$("#"+id).serialize();
        $.post('/Admin/Dealer/do_dealer', post, function (res) {
            if (res.status == 1) {
                dialog.showTips(res.info, '', 1);
                return false;
            } else {
                dialog.showTips(res.info, 'warn');
                return false;
            }
        }, "json");
    }

    /*更新状态 删除 1*/
    function J_Change(obj) {
        var post  = {};
        post.id   = $(obj).attr("data-id");
        post.type = $(obj).attr("data-type");
        dialog.showTips("确定要进行操作吗?", "firm", function () {
            $.ajax({
                url: '/Admin/Dealer/del_dealer',
                type: "post",
                dataType: "json",
                data: post
            }).done(function (res) {
                if (res.status == 1) {
                    dialog.showTips(res.info, "", 1);
                    return false;
                } else {
                    dialog.showTips(res.info, "warn");
                    return false;
                }
            })
        })
    }

    $(function(){
        $('.del').click(function(){
            var Id ='';
            if($('.check:checked').length ==0){
                alert('请选择要删除的经销商');return false;
            }
            if(confirm('确定删除多个经销商吗！')){
                $('.check:checked').each(function(){
                    Id = Id + $(this).val() + ',';
                });
                $.ajax({
                    url: '/Admin/Dealer/del_dealer',
                    type: "post",
                    dataType: "json",
                    data: {'id':Id,'type':1}
                }).done(function (res) {
                    if (res.status == 1) {
                        dialog.showTips(res.info, "", 1);
                        return false;
                    } else {
                        dialog.showTips(res.info, "warn");
                        return false;
                    }
                })
            }
        })
    })
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