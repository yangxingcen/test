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
.ftnormal {line-height: 25px!important;}
.btn{vertical-align: baseline;}
.newinput{ width:250px;}
.select.mini{width: 110px;}
.vtal-2{vertical-align: -2px;}
.shady{ background:#000; opacity:0.5; width:100%; height:100%; position:fixed; top:0; left:0; z-index:111111; display:none; }
.achtpay{position: fixed;width: 400px;height: auto;left: 46%;top: 46%;margin-left: -200px;margin-top: -190px;z-index: 999998;}
.acfahuo{position: fixed;width: 400px;height: auto;left: 46%;top: 46%;margin-left: -200px;margin-top: -190px;z-index: 999998;}
.achtchangeprice{position:fixed;width:750px;height:auto;left:46%;top:46%;margin-left:-250px;margin-top:-190px;z-index:999998;}
.wxtables thead>td{font-weight: 700;background: #eee;color: #555;border-left: 0;border-right: 0;}
.wxtables tr>td{text-align:center; /*设置水平居中*/vertical-align:middle;/*设置垂直居中*/padding: 8px 10px;word-break:normal;}
.wxtables tr>td .table-item{padding: 10px 0px 10px 10px;}
.wxtables tr>td .topp{text-align:left;}
.wxtables tr>td .noteb{font-size: 14px;line-height: 14px;color: #428bca;}
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
<div class="shady" id="heemu"></div>
<img src="" id="em" style="position:fixed;width:34%;margin:auto;left:0;right:0;display:none;z-index:999;cursor:pointer;" onclick="this.style.display='none',document.getElementById('heemu').style.display='none'"/>
<div class="content-right fl">
    <h1 class="content-right-title">所有订单
        <a href="javascript:history.go(-1);" style="float:right" class="btn" title="返回"><i class="gicon-chevron-left"></i></a>
    </h1>
    <form id="search-form" action="<?php echo U('Admin/Integralorder/index/order_status');?>/<?php echo ($order_status); ?>" method="get">
        <div class="tables-searchbox">
            <input type="text" placeholder="订单编号|用户|电话" class="input newinput" name="name" value="<?php echo ($name); ?>">
            <input type="text" placeholder="商品名称" class="input mini" name="goodsname" value="<?php echo I('goodsname');?>">
       <!--      <input type="text"  name="starttime" id="starttime" value="<?php echo ($starttime); ?>" placeholder="订单起始时间" class="input Wdate" >
            <span class="mgr5">至</span>
            <input type="text"  name="endtime" id="endtime" value="<?php echo ($endtime); ?>" placeholder="订单结束时间" class="input Wdate" > -->
            <button class="btn btn-primary vtal-2"><i class="gicon-search white"></i>查询</button>
            <!-- <a href="javascript:void(0);" class="btn  btn-warning vtal-2">订单金额:<?php echo ((isset($money) && ($money !== ""))?($money):0.00); ?></a> -->
            <a href="javascript:;" id="orderexport" style="cursor:pointer" class="btn btn-primary fr" title="导出"><i class="gicon-download-alt white"></i></a>
        </div>
    </form>
    <div class="tabs clearfix mgt15">
        <div class="tabs clearfix mgt15">
            <a href="<?php echo U('Admin/Integralorder/index');?>" class="<?php if(($_GET['order_status']) == ""): ?>active<?php endif; ?> tabs_a fl">所有订单(<?php echo ($count0); ?>)</a>
            <a href="<?php echo U('Admin/Integralorder/index/order_status/1');?>" class="<?php if(($_GET['order_status']) == "1"): ?>active<?php endif; ?> tabs_a fl">待发货(<?php echo ($count1); ?>)</a>
            <a href="<?php echo U('Admin/Integralorder/index/order_status/2');?>" class="<?php if(($_GET['order_status']) == "2"): ?>active<?php endif; ?> tabs_a fl">待收货(<?php echo ($count2); ?>)</a>
            <a href="<?php echo U('Admin/Integralorder/index/order_status/3');?>" class="<?php if(($_GET['order_status']) == "3"): ?>active<?php endif; ?> tabs_a fl">待评价(<?php echo ($count3); ?>)</a>
            <a href="<?php echo U('Admin/Integralorder/index/order_status/4');?>" class="<?php if(($_GET['order_status']) == "4"): ?>active<?php endif; ?> tabs_a fl">已完成(<?php echo ($count4); ?>)</a>
            <a href="<?php echo U('Admin/Integralorder/index/order_status/5');?>" class="<?php if(($_GET['order_status']) == "5"): ?>active<?php endif; ?> tabs_a fl">退积分(<?php echo ($count5); ?>)</a>
            <a href="<?php echo U('Admin/Integralorder/index/order_status/6');?>" class="<?php if(($_GET['order_status']) == "6"): ?>active<?php endif; ?> tabs_a fl">退积分完成(<?php echo ($count6); ?>)</a>
    </div>
         <table class="wxtables table-order mgt20">
            <colgroup>
                <col width="50%">
                <col width="16%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <td align="center"><b>商品信息</b></td>
                    <td align="center"><b>订单金额</b></td>
                    <td align="center"><b>支付信息</b></td>
                    <td align="center"><b>订单状态</b></td>
                    <td align="center"><b>操作</b></td>
                </tr>
            </thead>
        </table>
      <table class="wxtables table-order mgt20">
            <colgroup>
                <col width="50%">
                <col width="16%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><thead>
                    <tr>
                        <td colspan="6" class="ftnormal" style="background-color:#F2F8FC;text-align: -webkit-left;">
                            <!-- <input type="checkbox" class="checkbox table-ckbs" data-id="2137327" name="id" value="<?php echo ($vo["id"]); ?>"> -->
                            <span>
                                <?php switch($vo["order_status"]): case "0": ?>取消时间:<?php echo ($vo["cancel_time"]); break;?>
                                    <?php case "1": ?>下单时间:<?php echo (date("Y-m-d H:i:s",$vo["order_time"])); break;?>
                                    <?php case "2": ?>下单时间:<?php echo (date("Y-m-d H:i:s",$vo["order_time"])); break;?>
                                    <?php case "3": ?>付款时间:<?php echo (date("Y-m-d H:i:s",$vo["pay_time"])); break;?>
                                    <?php case "4": ?>发货时间:<?php echo (date("Y-m-d H:i:s",$vo["shipping_time"])); break;?>
                                    <?php case "5": ?>发货时间:<?php echo (date("Y-m-d H:i:s",$vo["shipping_time"])); break;?>
                                    <?php case "6": ?>收货时间:<?php echo (date("Y-m-d H:i:s",$vo["receive_time"])); break;?>
                                    <?php case "7": ?>评价时间:<?php echo (date("Y-m-d H:i:s",$vo["receive_time"])); break;?>
                                    <?php case "8": ?>退款申请时间:<?php echo (date("Y-m-d H:i:s",$vo["tuihuo_time"])); ?>
                                        退款时间:<?php echo (date("Y-m-d H:i:s",$vo["refund_time"])); break;?>
                                    <?php case "9": ?>退款申请时间:<?php echo (date("Y-m-d H:i:s",$vo["com_tuihuo_time"])); break; endswitch;?>
                            </span>
                            <span class="mgl10">ID：<b class="noteb"><?php echo ($vo["aid"]); ?></b></span>
                            <span class="mgl15">编号：<b class="noteb"><?php echo ($vo["order_num"]); ?></b></span>
                            <span class="mgl20">买家：<b class="noteb"><?php echo ($vo["person_name"]); ?></b></span>
                            <span class="mgl15">电话：<b class="noteb"><?php echo ($vo["telephone"]); ?></b></span>
                            <span style="margin-right:4px;float:right;">订单总金额：<b class="noteb">¥<?php echo ($vo["allprice"]); ?></b></span>
                         </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pd0">
                                <div class="table-item">
                                        <a href="<?php echo U('/Admin/integralgoods/addgoods/id');?>/<?php echo ($vo["goods_id"]); ?>" class="block" target="_blank" title="<?php echo ($vod["goods_name"]); ?>">
                                        <div class="table-item-img fl">
                                            <img src="<?php echo ($vo["goods_logo"]); ?>">
                                        </div>
                                    </a>
                                    <div class="table-item-info" style="text-align:initial; width:85%">
                                        <p style="height:auto;"><?php echo ($vo["goods_name"]); ?></p>
                                        <p style="height:auto;"><?php echo ($vo["sku_info"]); ?></p>
                                        <span class="price">单价：¥ <?php echo ($vo["price"]); ?> 积分</span>&nbsp;&nbsp;&nbsp;
                                        <span class="price">数量：<?php echo ($vo["num"]); ?></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                        </td>
                        <td valign="top" style="padding-top:15px;vertical-align: inherit;">
                            <p class="topp mgl15"><b>总&nbsp;&nbsp;金&nbsp;&nbsp;额：¥ <?php echo ($vo["allprice"]); ?></b></p>
                            <p class="topp mgl15"><b>商品金额：¥ <?php if($vo['price']): echo ($vo["price"]); else: ?>0.00<?php endif; ?></b></p>
                        </td>
                        <td valign="middle" align="center" class="txtCenter">
                            <p><b>
                            <?php if($vo['order_status'] !=1 && $vo['order_status'] !=0){ ?>
                               <?php switch($vo["pay_way"]): case "1": ?>微信支付<?php break;?>
                                <?php case "2": ?>支付宝<?php break;?>
                                <?php case "3": ?>银联支付<?php break;?>
                                <?php case "4": ?>余额支付<?php break;?>
                                <?php case "5": ?>后台人工付款<?php break; endswitch;?>
                            <?php }?>
                            </b></p>
                            <p><b>¥ <?php if($vo['pay_price']): echo ($vo["pay_price"]); else: echo ($vo["allprice"]); endif; ?></b></p>
                            <?php if(!empty($vo['pay_time'])): ?><!--p><b><?php echo (date("Y-m-d H:i:s",$vo["pay_time"])); ?></b></p--><?php endif; ?>
                        </td>
                        <td valign="middle" align="center"  class="txtCenter">
                            <p>
                            
                               
                              <span class="colorRed"><?php echo ($vo["status_name"]); ?></span>
                         
                            </p>
                        </td>
                        <td valign="top" style="vertical-align: inherit;">
                            <p>
                                <a href="<?php echo U('Admin/Integralorder/orderDetail');?>/id/<?php echo ($vo["aid"]); ?>" class="btn btn-mini btn-primary">查看详情</a>
                                <!-- 2是已支付需要发货 -->
                                <?php if($vo['order_status']==2){ ?>
                                    <p><a href="javascript:;" class="J_shipping_order btn btn-mini btn-primary" data-id="<?php echo ($vo["id"]); ?>" data-no="<?php echo ($vo["order_no"]); ?>">标记发货</a></p>
                                <?php }?>
                                <!--后台取消,去支付订单-->
                                <?php if(($vo['order_status']) == "1"): ?><a href="javascript:;" 
                                        data-id         ="<?php echo ($vo["id"]); ?>" 
                                        data-totalfee   ="<?php echo ($vo["total_fee"]); ?>" 
                                        data-expressfee ="<?php echo ($vo["express_fee"]); ?>" 
                                        data-useintegral="<?php echo ($vo["use_integral"]); ?>" 
                                        class="btn btn-mini btn-success a-hteditprice">修改价格</a>
                                    <a href="javascript:;"
                                        data-no="<?php echo ($vo["order_no"]); ?>"
                                        data-id="<?php echo ((isset($vo["id"]) && ($vo["id"] !== ""))?($vo["id"]):0); ?>"
                                        data-totalfee="<?php echo ((isset($vo["total_fee"]) && ($vo["total_fee"] !== ""))?($vo["total_fee"]):0); ?>"
                                        data-totalprice="<?php echo ((isset($vo["total_price"]) && ($vo["total_price"] !== ""))?($vo["total_price"]):0); ?>"
                                        data-expressfee="<?php echo ((isset($vo["express_fee"]) && ($vo["express_fee"] !== ""))?($vo["express_fee"]):0); ?>"
                                        data-useintegral="<?php echo ((isset($vo["use_integral"]) && ($vo["use_integral"] !== ""))?($vo["use_integral"]):0); ?>"
                                        class="btn btn-mini btn-warning a-htpay">去&nbsp;&nbsp;付&nbsp;&nbsp;款
                                    </a>
                                    <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="btn btn-mini btn-danger a-htcancel">取消订单</a><?php endif; ?>
                                <!--后台取消,去支付订单-->
                                <!--代发货start-->
                                <?php if(in_array(($vo['status']), explode(',',"1"))): ?><a href="javascript:;" 
                                        data-no="<?php echo ($vo["order_num"]); ?>" 
                                        data-id="<?php echo ((isset($vo["aid"]) && ($vo["aid"] !== ""))?($vo["aid"]):0); ?>" 
                                        data-consignee="<?php echo ($vo["consignee"]); ?>" 
                                        data-mobile="<?php echo ($vo["atelephone"]); ?>" 
                                        data-address="<?php echo ($vo["address"]); ?>"
                                        data-issubbag="<?php echo ((isset($vo["issubbag"]) && ($vo["issubbag"] !== ""))?($vo["issubbag"]):0); ?>"
                                        class="btn btn-mini btn-success a-htship">发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;货
                                    </a>
                                    <a href="javascript:;" 
                                        data-no="<?php echo ($vo["order_num"]); ?>" 
                                        data-id="<?php echo ((isset($vo["id"]) && ($vo["id"] !== ""))?($vo["id"]):0); ?>" 
                                        data-zs="<?php echo ((isset($vo["allprice"]) && ($vo["allprice"] !== ""))?($vo["allprice"]):0); ?>"
                                        class="btn btn-mini btn-success a-xstk">线上退分</a><?php endif; ?>
                                <!--代发货end-->
                                <!--申请退款部分-->
                                <?php if(($vo['order_status']) == "8"): ?><a href="javascript:;" data-no="<?php echo ($vo["order_no"]); ?>" data-id="<?php echo ((isset($vo["id"]) && ($vo["id"] !== ""))?($vo["id"]):0); ?>" data-zs="<?php echo ((isset($vo["pay_price"]) && ($vo["pay_price"] !== ""))?($vo["pay_price"]):0); ?>" data-zj="<?php echo ((isset($vo["use_integral"]) && ($vo["use_integral"] !== ""))?($vo["use_integral"]):0); ?>" class="btn btn-mini btn-success a-xstk">线上退款</a>
                                    <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="btn btn-mini btn-warning a-xxtk">线下退款</a>
                                    <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="btn btn-mini btn-danger  a-jjtk">拒绝退款</a><?php endif; ?>
                                <!--申请退款部分-->

                            </p>
                        </td>
                    </tr>
                </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="tables-btmctrl clearfix mgt10">
            <!--div class="fl" style="float:none;">
                <!-- <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a> -->
                <!-- <a href="javascript:void(0)" onclick="del()" class="btn btn-danger J_batch_del">删除订单</a> -->
            <!--/div-->
            <div class="pages" style="float:none;width:100%;text-align:center;padding-top:10px;margin-left:0px;">
             <?php echo ($pages); ?>
            </div>
                <!-- end paginate -->
        </div>        <!-- end tables-btmctrl -->
    <form action="" method="post" id="ids">
        <input type="hidden" name="ids" value="">
    </form>
</div>
<!-- end content-right -->
</div>
</div>
<!-- end container -->
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
<div id="albums-overlay" class="disshow"></div>
<!--发货部分-->
<div class="jbox acfahuo disshow quxiao" style="min-height:300px;width:500px" id="updatewuliu">
  <div class="jbox-title">
    <div class="jbox-title-txt">订单发货</div>
    <a href="javascript:;" class="jbox-close cancle"></a></div>
  <div class="jbox-container">
    <div class="formitems">
        <label class="fi-name"><span class="colorRed"></span>订单号：</label>
        <div class="form-controls" id="a-fhorderno"></div>
    </div>
    <div class="formitems">
        <label class="fi-name"><span class="colorRed"></span>收货人：</label>
        <div class="form-controls" id="a-fhconsignee"></div>
    </div>
    <div class="formitems">
        <label class="fi-name"><span class="colorRed"></span>联系电话：</label>
        <div class="form-controls" id="a-fhmobile"></div>
    </div>
    <div class="formitems">
        <label class="fi-name"><span class="colorRed"></span>收货地址：</label>
        <div class="form-controls" id="a-fhaddress"></div>
    </div>
    <div class="formitems">
        <label class="fi-name"><span class="colorRed"></span>快递公司：</label>
        <div class="form-controls">
            <input type="text" class="input" name="search_company" value="" placeholder="请输入公司名字">
            <button class="btn btn-primary search_company" title="搜索"><i class="gicon-search white"></i></button>
        </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed">*</span>快递公司：</label>
      <div class="form-controls">
        <select name="express_name" class="select">
            <option value="">请选择快递公司</option>
            <?php if(is_array($express_list)): foreach($express_list as $key=>$vo): ?><option value="<?php echo ($vo["express_ma"]); ?>"><?php echo ($vo["express_company"]); ?></option><?php endforeach; endif; ?>
        </select>
        <span class="fi-help-text"></span> </div>
    </div>
    <div class="formitems">
      <label class="fi-name"><span class="colorRed">*</span>快递单号：</label>
      <div class="form-controls">
        <input type="text" class="input describe1" name="express_no" value="<?php echo ($cache["express_no"]); ?>">
        <input type="hidden" name="order_id" value="<?php echo ($cache["id"]); ?>">
        <span class="fi-help-text"></span> </div>
    </div>
    <div class="formitems" id="thisgoods" style="display:none;">
      <label class="fi-name"><span class="colorRed">*</span>发货商品：</label>
      <div class="form-controls" id="goodslist">
         <br/><input type="checkbox" name="goodsid" value="0" /> <img src="/Public/Public/images/logo.png" width='30' height='30'> 按订单发货
      </div>
    </div>

    <div class="jbox-buttons" style="text-align:center;"> 
      <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a> 
      <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" id="fahuo">发货</a> 
    </div>
  </div>
</div>
<!-- //退款 -->
<div class="jbox tuikuan disshow quxiao" style="height:auto;">
    <div class="jbox-title">
        <div class="jbox-title-txt">退积分信息</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>订单编号：</label>
            <div class="form-controls"><span class="fi-help-text" id="oorderno"></span> </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>支付积分：</label>
            <div class="form-controls"><span class="fi-help-text" id="ojine"></span> </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>退款积分：</label>
            <div class="form-controls">
                <input type="text" value=""  class="input" name="refund_fee" style="border:none;">
                <span class="fi-help-text"></span> </div>
        </div>
        <div class="jbox-buttons" style="text-align:center;">
            <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" id="ac-tuikuan">退款</a>
        </div>
    </div>
</div>

<script type="text/javascript" src="/Public/Admin/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Admin/lhgcalendar/lhgcalendar.min.js"></script>
<script type="text/javascript">
$(function(){
    $('#starttime').calendar({ disDate:['^19'],maxDate:'#endtime',format:'yyyy-MM-dd 00:00:00'});
    $('#endtime').calendar({ disDate:['^19'],minDate:'#starttime',format:'yyyy-MM-dd 23:59:59' });
});
</script>
<!--gonggao-->
<script>
$("#search-form input[name=telephone]").change(function(){
    var tele = $("#search-form input[name=telephone]").val();
    if(tele){
        var newhref = "/Admin/Order/orderExport/telephone/".tele;
        $("#dynamichref").attr('href',newhref);
    }
})
$(".daochu").click(function(){
    $.ajax({
        url:"<?php echo U('Admin/Order/orderExport');?>",
        type:'post',
        datatype : 'json',
        success:function(data){
            if(data.status==1){
                alert(data.info);
                location.href="<?php echo U('Admin/Order/index');?>";
            }else{
                alert(data.info);
            }
        }
    });
})
</script>
<script>
function ordertotal(useintegral,expressfee,totalfee){
    $(".achtchangeprice #useintegral").val(useintegral);
    $(".achtchangeprice #expressfee").val(expressfee);
    $(".achtchangeprice #totalfee").val(totalfee);
}
var goodslistsdata = new Array();
function makePriceChange(){
    var i=totalprice=totalintegral=pricestatus=integralstatus=numstatus=0;
    var goodslists  = new Array();
    $("#goodslists tr").each(function(){
        var _tdpoint     = $(this).children("td");
        var ordergoodsid = parseInt(_tdpoint.eq(0).attr("data-ordergoodsid"));
        var price        = parseFloat($("#goodslists #price_"+ordergoodsid).val());
        var integral     = parseFloat($("#goodslists #integral_"+ordergoodsid).val());
        var num          = parseFloat($("#goodslists #num_"+ordergoodsid).val());
        if(price>0){
            if(integral < 0){
                integralstatus=1;
                return false;
            }else{
                var total        = integral * num;
                totalintegral    = totalintegral+total;
            }
            if(num>0){
                var total        = price * num;
                totalprice       = totalprice + total;
                $("#goodslists #total_"+ordergoodsid).text(total);
                goodslists[i] = {ordergoodsid:ordergoodsid,price:price,num:num};
            }else{
                numstatus=1;
                return false;
            }
        }else{
            pricestatus=1;
            return false;
        }
        i++;
    });
    if(pricestatus){
        dialog.showTips('请填写商品价格',"warn");return false;
    }
    if(integralstatus){
        dialog.showTips('积分必须是0(包含0)以上的数',"warn");return false;
    }
    if(numstatus){
        dialog.showTips('请填写商品数量',"warn");return false;
    }
    var expressfee  = parseFloat($(".achtchangeprice #expressfee").val());
    totalprice      = totalprice+expressfee;
    ordertotal(totalintegral.toFixed(2),expressfee,totalprice.toFixed(2));
    goodslistsdata  = {goods:goodslists,totalprice:totalprice.toFixed(2),totalintegral:totalintegral.toFixed(2)};
    return goodslistsdata;
}
$(document).ready(function(){
    var orderid = totalfee = expressfee = useintegral =0;
    $(".a-hteditprice").click(function(){
        orderid     = parseInt($(this).attr("data-id"));
        totalfee    = parseFloat($(this).attr('data-totalfee'));                    //待支付金额
        expressfee  = parseFloat($(this).attr('data-expressfee'));                  //总的运费
        useintegral = parseFloat($(this).attr('data-useintegral'));                 //商品总抵扣积分
        if(!orderid){
            dialog.showTips('订单ID找不到了',"warn");return false;
        }
        $.post("<?php echo U('Admin/Goodsorder/editOrderGoodsPrice');?>",{action:'goodslists',orderid:orderid},function(g){
            if(g.status !=1){
                dialog.showTips(g.info,"warn");return false;
            }
            var html  = '';
            var lists = g.info;
            $.each(lists,function(k,val){
                html +='<tr>'
                html +='<td data-ordergoodsid='+parseInt(val.ordergoodsid)+'>'+val.goods_name+'<br/>'+val.sku_info+'</td>';
                html +='<td><input type="number" class="epchange input mini" id="price_'+parseInt(val.ordergoodsid)+'" value="'+parseFloat(val.goods_price)+'"></td>';
                html +='<td><input type="number" class="epchange input mini" id="integral_'+parseInt(val.ordergoodsid)+'" value="'+parseFloat(val.goods_integral)+'"></td>';
                html +='<td><input type="number" class="epchange input mini" id="num_'+parseInt(val.ordergoodsid)+'" value="'+val.goods_nums+'"></td>';
                html +='<td id="total_'+parseInt(val.ordergoodsid)+'">'+parseFloat(val.goods_price) * parseInt(val.goods_nums)+'</td>';
                html +='</tr>';
            });
            $("#goodslists").html(html);
            ordertotal(useintegral,expressfee,totalfee);
            $('#albums-overlay').show();
            $('.achtchangeprice').show();
            $(".achtchangeprice #goodslists .epchange").bind("input propertychange", function(){
                makePriceChange();
            });
        },'json');
    });
    $(".achtchangeprice #ac-htchangeprice").click(function(){
        var goodslists  = makePriceChange();
        var useintegral = parseFloat($(".achtchangeprice #useintegral").val());
        var expressfee  = parseFloat($(".achtchangeprice #expressfee").val());
        var totalfee    = parseFloat($(".achtchangeprice #totalfee").val());
        if(!goodslists){
            return false;
        }
        if(useintegral<0){
            dialog.showTips('抵扣积分不能为负数',"warn");return false;
        }
        if(expressfee<0){
            dialog.showTips('快递费不能为负数',"warn");return false;
        }
        if(totalfee<0){
            dialog.showTips('因收款不能为负数',"warn");return false;
        }
        var data={action:'changegoods',orderid:orderid,goods:goodslists,useintegral:useintegral,expressfee:expressfee,totalfee:totalfee};
        $.post("<?php echo U('Admin/Goodsorder/editOrderGoodsPrice');?>",data,function(g){
            if(g.status ==1){
                dialog.showTips(g.info,"",1);return false;
            }else{
                dialog.showTips(g.info,"warn");return false;
            }
        },'json');
    });
    $(".achtchangeprice #expressfee").change(function(){
        var expressfee = parseFloat($(this).val());
        if(expressfee < 0){
            dialog.showTips('运费不能为负数', "warn"); return false;
        }
        var useintegral = parseFloat($(".achtchangeprice #useintegral").val());
        makePriceChange();
    });
    $(".achtchangeprice #goodslists .epchange").bind("input propertychange", function(){
        makePriceChange();
    });
    $(".achtchangeprice #totalfee").change(function(){
        var val = $(this).val();
        if(val <0.01){
            dialog.showTips('应付款必须大于0', "warn"); return false;
        }
    });
});
</script>
<!--修改分类-->
<script type="text/javascript">
$(".cancle").click(function(){
    $(this).parent().parent('.jbox').hide();
    $('#albums-overlay').hide();
    $(".quxiao").hide();
})
var id ='';
$(".j-editClass").click(function(){
    id = $(this).attr("data-id");
    $('.editfenlei').show();
    $('#albums-overlay').show();
});
var  orderno = orderid = totalfee = totalprice = expressfee = useintegral = 0;
$(".a-htpay").click(function(){
    orderno     = $.trim($(this).attr('data-no'));                              //订单号
    orderid     = parseInt($(this).attr('data-id'));                            //订单id
    totalfee    = parseFloat($(this).attr('data-totalfee'));                    //待支付金额
    totalprice  = parseFloat($(this).attr('data-totalprice'));                  //商品总金额
    expressfee  = parseFloat($(this).attr('data-expressfee'));                  //总的运费
    useintegral = parseFloat($(this).attr('data-useintegral'));                 //商品总抵扣积分

    $('.achtpay #porderno').text(orderno);
    $('.achtpay #ptotalprice').text(totalprice);
    $('.achtpay #pexpressfee').text(expressfee);
    $('.achtpay #ptotalfee').text(totalfee);
    $('.achtpay #pouseintegral').text(useintegral);
    $(".achtpay input[name=ppayprice]").val(totalfee)
    $(".achtpay input[name=puseintegral]").val(useintegral)
    /*if(!useintegral){
        $("#pouseintegralid").hide();
        $("#puseintegralid").hide();
    }*/
    $('#albums-overlay').show();
    $('.achtpay').show();
});
function xiugaiFhType(obj){
    if(obj == 0){
        $('#thisgoods').hide();
    }else{
        $('#thisgoods').show();
    }
}
var orderid = issubbag = 0;
$(".a-htship").click(function(){
    var orderno     = $.trim($(this).attr('data-no'));                          //订单号
    orderid         = parseInt($(this).attr('data-id'));                        //订单id
    var consignee   = $.trim($(this).attr('data-consignee'));                   //待支付金额
    var mobile      = parseInt($(this).attr('data-mobile'));                    //商品总金额
    var address     = $.trim($(this).attr('data-address'));                     //总的运费
    issubbag        = parseInt($(this).attr('data-issubbag'));                  //商品总抵扣积分
    $(".acfahuo #a-fhorderno").text(orderno);
    $(".acfahuo #a-fhconsignee").text(consignee);
    $(".acfahuo #a-fhmobile").text(mobile);
    $(".acfahuo #a-fhaddress").text(address);
  
    var data = {orderid: orderid};
    $("#albums-overlay").show();
    $("#updatewuliu").show();

})
/***快递公司搜索S***/
$(".acfahuo .search_company").click(function(){
    var category = $.trim($(".acfahuo input[name='search_company']").val());
    if(category){
        var stat = true;
        $(".acfahuo select[name=express_name] option").each(function(){
            var txt = $.trim($(this).text());
            if(txt.indexOf(category) !=-1){
                $(this).attr("selected","selected");
                stat=false;
                return false;
            }
        });
        if(stat){
            dialog.showTips('没有找到相关快递公司','warn');
        }
    }else{
        dialog.showTips('请输入快递公司名称','warn');
    }
});
/***快递公司搜索S***/
$("#fahuo").click(function(){
    var express_name = $.trim($("#updatewuliu select[name=express_name]").find("option:selected").text());
    var express_ma   = $.trim($("#updatewuliu select[name=express_name]").val());
    var express_no   = $.trim($("#updatewuliu input[name=express_no]").val());
    var fh_type      = $("input[name='fh_type']:checked").val();
    if(!express_ma){
        alert("请选择快递公司");return false;
    }
    if(!express_no){
        alert("请填写快递单号！");return false;
    }
    if(fh_type == 1){
        var goodslist = '';
        $("input[name='goodsid']:checked").each(function(){
            goodslist += $(this).val() + ',';
        })
        goodslist = goodslist.substring(0,goodslist.length-1);
        if(!goodslist){
            alert("请选择发货商品！");return false;
        }
    }
    var data = {orderid: orderid,express_ma:express_ma,express_name:express_name,express_no:express_no,fh_type:fh_type,goodslist:goodslist};
    $.ajax({
        url: "<?php echo U('Admin/Integralorder/express');?>",
        type: "post",
        dataType: "json",
        data: data,
    }).done(function (g) {
        if (g.status == 1) {
            dialog.showTips(g.info, "",1);
        } else {
            alert(g.info);
        }
    })
})
$(".a-htcancel").click(function(){
    //后台取消订单
    var id = parseInt($(this).attr('data-id'));
    if(confirm('确认取消订单吗,此操作不可逆哦?')){
        var data = {orderid:id};
        $.ajax({
            url:"<?php echo U('/Admin/Goodsorder/orderCancel');?>",
            type:'post',
            data :data,
            datatype : 'json',
            success:function(g){
                if(g.status ==1){
                    dialog.showTips(g.info,"",1);
                }else{
                    dialog.showTips(g.info,"warn");
                }
            }
        });
    }
});
$(".a-xxtk").click(function(){
    //线下退款
    var id = parseInt($(this).attr('data-id'));
    if(confirm('确认线下退款吗')){
        var data = {action:'offlinerefund',orderid:id};
        $.ajax({
            url:"<?php echo U('/Admin/Goodsorder/offlineRefund');?>",
            type:'post',
            data :data,
            datatype : 'json',
            success:function(g){
                if(g.status ==1){
                   dialog.showTips(g.info,"",1);
                }else{
                    dialog.showTips(g.info,"warn");
                }
            }
        });
    }
});
$(".a-jjtk").click(function(){
    //拒绝退款
    var id = parseInt($(this).attr('data-id'));
    if(confirm('确认拒绝退款吗')){
        var data = {action:'refuse',orderid:id};
        $.ajax({
            url:"<?php echo U('/Admin/Goodsorder/dereturn');?>",
            type:'post',
            data :data,
            datatype : 'json',
            success:function(g){
                if(g.status ==1){
                    dialog.showTips(g.info,"",1);
                }else{
                    dialog.showTips(g.info,"warn");
                }
            }
        });
    }
});
//订单号,订单id,支付的金额,支付的积分,支付的方式
var orderno = orderid = paym = payj = 0;
$(".a-xstk").click(function(){
 //data-no="<?php echo ($vo["order_no"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-zs="<?php echo ($vo["pay_price"]); ?>" data-zj="<?php echo ($vo["use_integral"]); ?>" data-zf="<?php echo ($vo["pay_way"]); ?>"
    orderno = $.trim($(this).attr('data-no'));
    orderid = parseInt($(this).attr('data-id'));
    paym    = parseFloat($(this).attr('data-zs'));
    payj    = parseFloat($(this).attr('data-zj'));
    
    $('#oorderno').text(orderno);
    $('#ojine').text(paym);
    $('#ojifen').text(payj);
    $(".tuikuan input[name=refund_fee]").val(paym)
    $(".tuikuan input[name=refund_fee]").attr("readonly","readonly")
    $(".tuikuan input[name=refund_jifen]").val(payj)
    if(!payj){
        //$(".tuikuan input[name=refund_jifen]").attr("readonly","readonly")
        $("#oojifen").hide();
    }
    $('#albums-overlay').show();
    $('.tuikuan').show();
});
$("#ac-tuikuan").click(function(){
    var rfee    = parseFloat($(".tuikuan input[name=refund_fee]").val());
    var orderid = $("#oorderno").text();
    //订单id,退款金额,退款积分
    var data ={orderid:orderid,rjifen:rfee};

    $.ajax({
        url:"<?php echo U('/Admin/Integralorder/orderRefund');?>",
        type:'post',
        data :data,
        datatype : 'json',
        success:function(g){
            if(g.status ==1){
                dialog.showTips(g.info,"",1);
            }else{
                dialog.showTips(g.info,"warn");
            }
        }
    });
});
//订单导出
$(function(){
    $("#orderexport").click(function(){
        var order_status = "<?php echo ($order_status); ?>" ? "<?php echo ($order_status); ?>" : 'all';
        var url       = "<?php echo U('Admin/Goodsorder/Export');?>";
        //组装表单信息
        var title     = $.trim($("#search-form .newinput").val());
        var starttime = $.trim($('#starttime').val());
        var endtime   = $.trim($('#endtime').val());
        url = url+'?status='+order_status;
        if(title){
            url = url+'&title='+title;
        }
        if(starttime){
            if(endtime){
                url = url+'&starttime='+starttime+'&endtime='+endtime;
            }else{
                dialog.showTips('请选择结束时间',"warn");
            }
        }
        window.open(url);
    });
});
</script>