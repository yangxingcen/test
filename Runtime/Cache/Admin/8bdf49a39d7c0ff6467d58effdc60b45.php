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
    p{
        font-size:20px;
        text-align:center;
        cursor:pointer;
    }
    .tabs .tabs_a{
        padding: 12px 45px;
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
            <h1 class="content-right-title">抽奖列表</h1>

            <form action="<?php echo U('/Admin/activityrecord/activitylist');?>" method="get">
                <div class="tables-searchbox newcearchbox">
                    <input type="text" placeholder="用户账号|收件人|填写手机号" class="input" name="name" value="<?php echo ($name); ?>">
                    <select name="cate" class="select" style="width: 150px" >
                        <option value=""> 请选择-活动类型</option>
                        <option value="" > -全部-</option>
                        <option value="1"> 挂挂乐</option>
                        <option value="2"> 砸金蛋</option>
                        <option value="3"> 大转盘</option>

                    </select>
                    <input type="hidden" class="input mini" name="status" value="<?php echo ($status); ?>">
                    <button class="btn btn-primary" style="line-height:26px;"><i class="gicon-search white"></i>查询
                    </button>
                </div>
            </form>
            <!-- end tabs -->
            <div class="tabs clearfix mgt10">

                <a href="<?php echo U('Admin/activityrecord/activitylist',array('name'=>$name,'cate'=>$cate));?>"
                   class="<?php if(($status) == "0"): ?>active<?php endif; ?> tabs_a fl">全部(<?php echo ((isset($count12) && ($count12 !== ""))?($count12):'0'); ?>)</a>
                <a href="<?php echo U('Admin/activityrecord/activitylist',array('name'=>$name,'cate'=>$cate,'status'=>1));?>"
                   class="<?php if(($status) == "1"): ?>active<?php endif; ?> tabs_a fl">优惠券(<?php echo ((isset($arr_Array2[1][sum]) && ($arr_Array2[1][sum] !== ""))?($arr_Array2[1][sum]):'0'); ?>)</a>
                <a href="<?php echo U('Admin/activityrecord/activitylist',array('name'=>$name,'cate'=>$cate,'status'=>2));?>"
                   class="<?php if(($status) == "2"): ?>active<?php endif; ?> tabs_a fl">积分(<?php echo ((isset($arr_Array2[2][sum]) && ($arr_Array2[2][sum] !== ""))?($arr_Array2[2][sum]):'0'); ?>)</a>
                <a href="<?php echo U('Admin/activityrecord/activitylist',array('name'=>$name,'cate'=>$cate,'status'=>3));?>"
                   class="<?php if(($status) == "3"): ?>active<?php endif; ?> tabs_a fl">积分商品(<?php echo ((isset($arr_Array2[3][sum]) && ($arr_Array2[3][sum] !== ""))?($arr_Array2[3][sum]):'0'); ?>)</a>
                <a href="<?php echo U('Admin/activityrecord/activitylist',array('name'=>$name,'cate'=>$cate,'status'=>4));?>"
                   class="<?php if(($status) == "4"): ?>active<?php endif; ?> tabs_a fl">未中奖(<?php echo ((isset($arr_Array2[4][sum]) && ($arr_Array2[4][sum] !== ""))?($arr_Array2[4][sum]):'0'); ?>)</a>

            </div>
            <table class="wxtables mgt10" style="text-align:center;">
                <colgroup>
                    <col width="2%">
                    <col width="5%">
                    <col width="9%">
                    <col width="15%">
                    <col width="9%">
                    <col width="8%">
                    <col width="6%">
                    <col width="9%">
                    <col width="8%">
                    <col width="8%">
                    <col width="5%">

                </colgroup>
                <thead>
                <tr class="po_list">
                    <td><i class="icon_check"></i></td>
                    <td>ID</td>
                    <td>用户账号</td>
                    <td>中奖名称</td>
                    <td>所在地区</td>
                    <td>详细地址</td>
                    <td>收件人</td>
                    <td>手机号</td>
                    <td>中奖时间</td>
                    <td>领取状态</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($lists)): foreach($lists as $key=>$v): ?><tr>
                    <td><input type="checkbox" class="checkbox table-ckbs" data-id="<?php echo ($v["id"]); ?>"></td>
                    <td><?php echo ($v["id"]); ?></td>
                    <td><?php echo ($v["telephone"]); ?></td>
                    <td align="left"><?php echo ($v["goods_name"]); ?></td>
                    <td align="left"><?php echo ($v["address"]); ?></td>
                    <td align="left"><?php echo ($v["del_add"]); ?></td>
                    <td><?php echo ($v["realname"]); ?></td>
                    <td><?php echo ($v["tel"]); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$v["addtime"])); ?></td>
                    <td>
                        <?php if($v['status'] == 0): ?><p style="color: red" class="change_status" data-id="<?php echo ($v["id"]); ?>" title="已领取" data-item="update" data-value="1">×</p>

                            <?php else: ?>
                            <p style="color: green" class="change_status" data-id="<?php echo ($v["id"]); ?>" title="未领取" data-item="update" data-value="0">√</p><?php endif; ?>
                    </td>

                    <td>
                        <a href="javascript:;" class="btn btn-danger dange" onclick="del(<?php echo ($v["id"]); ?>)"  data-item="del" data-value="<?php echo ($v["id"]); ?>" title="删除"><i class="gicon-trash white"></i></a>
                    </td>
                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <!-- end wxtables -->
            <div class="tables-btmctrl clearfix">
                <div style="margin:4px 0px;">
                    <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                    <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                    <a href="javascript:;" class="btn btn-danger change_status"  data-item="del" data-value="1" title="删除"><i class="gicon-trash white"></i></a>

                </div>
                <div>
                    <div class="pages" style="width:100%;margin-left:0px;"> <?php echo ($show); ?></div>
                </div>
                <!-- end tables-btmctrl -->
            </div>

            <!-- end content-right -->
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
<!--上架 下架 删除 1-->
<script>
    $(".change_status").click(function () {
        var item  = $(this).attr("data-item");
        var value = $(this).attr("data-value");
        var title = $(this).attr("title");
        var ids   = "";
        $(".table-ckbs:checked").each(function (i) {
            ids += $(this).attr("data-id") + "-"
        })
        if(!ids){
            var ids = $(this).attr("data-id");
        }
        if (!ids) {
            alert("请选中需要删除的！"); return false;
        }
        dialog.showTips("确定要进行"+title+"的操作吗?", "firm", function () {
            var data = {item: item,data:value, ids: ids};
            // console.log(data);
            $.post("<?php echo U('/Admin/activityrecord/activitylist');?>", data , function (g) {
                if (g.status == 1) {
                        dialog.showTips(g.info, "", 1);return false;
                } else {
                    dialog.showTips(g.info, "warn");return false;
                }
            },"json")
        })
    });

    //单个删除
    function  del(id) {
        var item  = $(".dange").attr("data-item");
        var value = $(".dange").attr("data-value");
        var title = "删除";
        var ids   = id;

        dialog.showTips("确定要进行"+title+"的操作吗?", "firm", function () {
            var data = {item: item,data:value, ids: ids};
            // console.log(data);
            $.post("<?php echo U('/Admin/activityrecord/activitylist');?>", data , function (g) {
                if (g.status == 1) {
                    dialog.showTips(g.info, "", 1);return false;
                } else {
                    dialog.showTips(g.info, "warn");return false;
                }
            },"json")
        })
    }


</script>
<!--上架 下架 删除 2-->