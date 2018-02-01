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
            <h1 class="content-right-title">限时特惠列表<a href="javascript:history.go(-1);" style="float:right" class="btn" title="返回"><i class="gicon-chevron-left"></i></a></h1>
            <a href="javascript:;" class="btn btn-success" title="发布" onclick="J_Add(this,1)"><i class="gicon-plus white"></i></a>
            <form action="<?php echo U('/Admin/Goodsmarket/spikeGoods');?>" method="get">
                <div class="tables-searchbox newcearchbox">
                    <input type="text" placeholder="产品名称" class="input" name="name" value="<?php echo ($name); ?>">
                    <input type="text" placeholder="ID" class="input mini" name="id" value="<?php echo ($id); ?>">
                    <button class="btn btn-primary" style="line-height:26px;" title="查询"><i class="gicon-search white"></i></button>
                </div>
            </form>
            <!-- end tabs -->
            <div class="tabs clearfix mgt10">
                <a href="<?php echo U('/Admin/Goodsmarket/spikeGoods/status/10');?>?name=<?php echo ($name); ?>&id=<?php echo ($id); ?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "10"): ?>active<?php endif; ?> tabs_a fl">普通商品(<?php echo ((isset($count10) && ($count10 !== ""))?($count10):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goodsmarket/spikeGoods/status/11');?>?name=<?php echo ($name); ?>&id=<?php echo ($id); ?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "11"): ?>active<?php endif; ?> tabs_a fl">出售中(<?php echo ((isset($count11) && ($count11 !== ""))?($count11):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goodsmarket/spikeGoods/status/12');?>?name=<?php echo ($name); ?>&id=<?php echo ($id); ?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "12"): ?>active<?php endif; ?> tabs_a fl">已售罄(<?php echo ((isset($count12) && ($count12 !== ""))?($count12):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goodsmarket/spikeGoods/status/13');?>?name=<?php echo ($name); ?>&id=<?php echo ($id); ?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "13"): ?>active<?php endif; ?> tabs_a fl">仓库中(<?php echo ((isset($count13) && ($count13 !== ""))?($count13):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goodsmarket/spikeGoods/status/14');?>?name=<?php echo ($name); ?>&id=<?php echo ($id); ?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "14"): ?>active<?php endif; ?> tabs_a fl">回收站(<?php echo ((isset($count14) && ($count14 !== ""))?($count14):'0'); ?>)</a>
            </div>
            <table class="wxtables mgt10" style="text-align:center;">
                <thead>
                <tr class="po_list">
                    <td><i class="icon_check"></i></td>
                    <td>ID</td>
                    <td>商品标题</td>
                    <td>价格(元)</td>
                    <td>库存<br/>销量</td>
                    <td>开始时间<br/>结束时间</td>
                    <td>上架</td>
                    <td>回收站</td>
                    <td>排序</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
                        <td><input type="checkbox" class="checkbox table-ckbs" value="<?php echo ($vo['id']); ?>"></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td align="left"><div class="table-item-img" style="float: left"><img src="<?php echo ($vo['logo_pic']); ?>" alt=""></div><div><?php echo ($vo["goods_name"]); ?></div></td>
                        <td>￥<?php echo ($vo["price"]); ?>元</td>
                        <td><?php echo ($vo["stock"]); ?><br/><?php echo ($vo["sales"]); ?></td>
                        <td><?php echo ($vo["limited_time_start"]); ?><br/><?php echo ($vo["limited_time_end"]); ?></td>
                        <td>
                            <?php if(($vo["is_sale"] == 1)): ?><p style="color: green"  onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="下架"  data-item="is_sale" data-value="<?php echo ($vo["is_sale"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="上架"  data-item="is_sale" data-value="<?php echo ($vo["is_sale"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <?php if(($vo["is_del"] == 0)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="还原"  data-item="is_del" data-value="<?php echo ($vo["is_del"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="删除"  data-item="is_del" data-value="<?php echo ($vo["is_del"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td><?php echo ($vo["sorts"]); ?></td>
                        <td>
                            <a href="javascript:;" onclick="J_Config(this)"
                               data-limited_time ="<?php echo ($vo["limited_time_start"]); ?> To <?php echo ($vo["limited_time_end"]); ?>"
                               data-promotion_label ="<?php echo ($vo["promotion_label"]); ?>"
                               data-id="<?php echo ($vo["id"]); ?>" class='btn btn-primary' title="限时配置" ><i class="gicon-cog white"></i></a>
                            <a href="<?php echo U('/Admin/Goodsmarket/spikeGoodsAdd/tt/1');?>/id/<?php echo ($vo["id"]); ?>/page/<?php echo ($pag); ?>" class="btn btn-warning j-editClass" title="编辑"><i class="gicon-edit white"></i></a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <!-- end wxtables -->
            <div class="tables-btmctrl clearfix">
                <div style="margin:4px 0px;">
                    <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                    <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                    <a href="javascript:;" class="btn btn-success" onclick="J_ChangeStatus(this)"  data-item="is_sale" data-value="0" title="上架"><i class="gicon-arrow-up white"></i></a>
                    <a href="javascript:;" class="btn btn-warning" onclick="J_ChangeStatus(this)"  data-item="is_sale" data-value="1" title="下架"><i class="gicon-arrow-down white"></i></a>
                    <a href="javascript:;" class="btn btn-danger " onclick="J_ChangeStatus(this)"  data-item="is_del" data-value="0"  title="删除"><i class="gicon-trash white"></i></a>
                    <a href="javascript:;" class="btn btn-success" onclick="J_ChangeStatus(this)"  data-item="is_del" data-value="1"  title="恢复"><i class="gicon-retweet white"></i></a>
                </div>
                <div>
                    <div class="pages" style="width:100%;margin-left:0px;"> <?php echo ($page); ?></div>
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
<!--检索普通商品S-->
<div id="albums-overlay" style="display: none;"></div>
<div class="jbox addfenlei select-goods disshow" style="height: auto;margin-top:-280px;width: 700px;left: 40%">
    <div class="jbox-title">
        <div class="jbox-title-txt">请选择商品</div>
        <a href="javascript:void(0);" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container" style="height: auto;">
        <div class="formitems">
            <div class="formitems">
                <label class="fi-name" style="width: 100px"><span class="colorRed"></span>商品名称：</label>
                <div class="form-controls" style="margin-left:0px;float: left">
                    <input type="text" class="input xxlarge" name="keyword" placeholder="请输入搜索的商品名称">
                </div>
                <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_SelectGoods(this)">确定</a>
            </div>
            <table class="wxtables mgt10" style="text-align:center;">
                <thead>
                <tr class="po_list">
                    <td><i class="icon_check"></i></td>
                    <td>ID</td>
                    <td>商品名称</td>
                    <td>价格(元)</td>
                </tr>
                </thead>
                <tbody class="goods_list"></tbody>
            </table>
        </div>
    </div>
    <div class="jbox-buttons">
        <input type="hidden" name="isactivity" value="1">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm_Select(this)">确定添加</a>
        <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
    </div>
</div>
<!--检索普通商品E-->

<div class="jbox addfenlei config disshow" style="height: auto;margin-top:-280px;width: 700px;left: 40%">
    <div class="jbox-title">
        <div class="jbox-title-txt">限时特惠配置</div>
        <a href="javascript:void(0);" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container" style="height: auto;">
        <div class="formitems">
            <div class="formitems">
                <label class="fi-name"><span class="colorRed">*</span>抢购起止时间：</label>
                <div class="form-controls">
                    <input type="text" class="input xxlarge w1" name="limited_time"  id="limited_time" value="" onFocus="this.blur()">
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed">*</span>抢购活动标签：</label>
                <div class="form-controls">
                    <input type="text" class="input xxlarge w1" name="promotion_label" value=""
                           placeholder="" maxlength="50">
                    <span class="fi-help-text"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="jbox-buttons">
        <input type="hidden" name="isactivity" value="1">
        <input type="hidden" name="id" value="">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Submit_Config(this)">确定添加</a>
        <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
    </div>
</div>
<!--检索普通商品E-->


<script type="text/javascript" src="/Public/Admin/Js/Goodsmarket/goodsmarket_com.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/Goodsmarket/spikegoods.js"></script>
<link type="text/css" rel="stylesheet" href="/Public/Jedate/jeDate-test.css">
<link type="text/css" rel="stylesheet" href="/Public/Jedate/skin/jedate.css">
<script type="text/javascript" src="/Public/Jedate/jquery.jedate.js"></script>
<script>
    $("#limited_time").jeDate({
        format: "YYYY-MM-DD hh:mm:ss",
        range:" To "
    });
</script>