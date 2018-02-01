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
            <h1 class="content-right-title">商品列表<a href="javascript:history.go(-1);" style="float:right" class="btn">返回</a></h1>
            <a href="<?php echo U('/Admin/Goods/addgoods');?>" class="btn btn-success">发布商品</a>
            <form action="<?php echo U('/Admin/Goods/index');?>" method="get">
                <div class="tables-searchbox newcearchbox">
                    <input type="text" placeholder="产品名称" class="input" name="keyword" value="<?php echo I('get.keyword');?>">
                    <input type="text" placeholder="ID" class="input mini" name="id" value="<?php echo I('get.id');?>">
                    <select name="cate" class="select large" onchange="J_Select_Cate(this)">
                        <option value=""> 请选择商品一级分类</option>
                        <?php if(is_array($goods_cate_new)): $i = 0; $__LIST__ = $goods_cate_new;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["classname"]); ?></option>
                            <?php if(is_array($vo['son'])): $i = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($voo["id"]); ?>">&nbsp;&nbsp; |--<?php echo ($voo["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <button class="btn btn-primary" style="line-height:26px;"><i class="gicon-search white"></i>查询
                    </button>
                </div>
            </form>

            <div class="tabs clearfix mgt10">
                <a href="<?php echo U('/Admin/Goods/index/status/10');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "10"): ?>active<?php endif; ?> tabs_a fl">普通商品(<?php echo ((isset($count10) && ($count10 !== ""))?($count10):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/11');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "11"): ?>active<?php endif; ?> tabs_a fl">出售中(<?php echo ((isset($count11) && ($count11 !== ""))?($count11):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/12');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "12"): ?>active<?php endif; ?> tabs_a fl">已售罄(<?php echo ((isset($count12) && ($count12 !== ""))?($count12):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/13');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "13"): ?>active<?php endif; ?> tabs_a fl">仓库中(<?php echo ((isset($count13) && ($count13 !== ""))?($count13):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/14');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "14"): ?>active<?php endif; ?> tabs_a fl">回收站(<?php echo ((isset($count14) && ($count14 !== ""))?($count14):'0'); ?>)</a>
            </div>
            <div class="tabs clearfix mgt10">
                <a href="<?php echo U('/Admin/Goods/index/status/20');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "20"): ?>active<?php endif; ?> tabs_a fl">套餐商品(<?php echo ((isset($count20) && ($count20 !== ""))?($count20):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/21');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "21"): ?>active<?php endif; ?> tabs_a fl">出售中(<?php echo ((isset($count21) && ($count21 !== ""))?($count21):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/22');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "22"): ?>active<?php endif; ?> tabs_a fl">已售罄(<?php echo ((isset($count22) && ($count22 !== ""))?($count22):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/23');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "23"): ?>active<?php endif; ?> tabs_a fl">仓库中(<?php echo ((isset($count23) && ($count23 !== ""))?($count23):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/Goods/index/status/24');?>?keyword=<?php echo I('get.keyword');?>&id=<?php echo I('get.id');?>&time=<?php echo ($time); ?>"
                   class="<?php if(($status) == "24"): ?>active<?php endif; ?> tabs_a fl">回收站(<?php echo ((isset($count24) && ($count24 !== ""))?($count24):'0'); ?>)</a>
            </div>
            <table class="wxtables mgt10" style="text-align:center;">
                <colgroup>
                    <col width="2%">
                    <col width="5%">
                    <col width="10%">
                    <col width="18%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr class="po_list">
                    <td><i class="icon_check"></i></td>
                    <td>ID</td>
                    <td>商品图片</td>
                    <td>商品名称</td>
                    <td>价格(元)</td>
                    <td>库存(件)</td>
                    <td>排序</td>
                    <td>上架</td>
                    <td>新品</td>
                    <td>促销</td>
                    <td>回收站</td>
                    <td>推荐</td>
                    <td>推荐官网</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
                        <td><input type="checkbox" class="checkbox table-ckbs" value="<?php echo ($vo['id']); ?>"></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td align="left"><div class="table-item-img" style="float: left"><img src="<?php echo ($vo['logo_pic']); ?>" onerror="this.src='http://dyshop.unohacha.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'" alt=""></div></td>
                        <td><?php echo ($vo["goods_name"]); ?></td>
                        <td>￥<?php echo ($vo["price"]); ?>元</td>
                        <td><?php echo ($vo["stock"]); ?></td>
                        <td><?php echo ($vo["sorts"]); ?></td>
                        <td>
                            <?php if(($vo["is_sale"] == 1)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="已上架"  data-item="is_sale" data-value="<?php echo ($vo["is_sale"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="已下架"  data-item="is_sale" data-value="<?php echo ($vo["is_sale"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <?php if(($vo["is_new"] == 1)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="新品"  data-item="is_new" data-value="<?php echo ($vo["is_new"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="非新品"  data-item="is_new" data-value="<?php echo ($vo["is_new"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <?php if(($vo["is_cuxiao"] == 1)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="促销"  data-item="is_cuxiao" data-value="<?php echo ($vo["is_cuxiao"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="非促销"  data-item="is_cuxiao" data-value="<?php echo ($vo["is_cuxiao"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <?php if(($vo["is_del"] == 1)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="已删除"  data-item="is_del" data-value="<?php echo ($vo["is_del"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="未删除"  data-item="is_del" data-value="<?php echo ($vo["is_del"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <?php if(($vo["is_groom"] == 1)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="推荐"  data-item="is_groom" data-value="<?php echo ($vo["is_groom"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="非推荐"  data-item="is_groom" data-value="<?php echo ($vo["is_groom"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <?php if(($vo["is_pc"] == 1)): ?><p style="color: green" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="推荐"  data-item="is_pc" data-value="<?php echo ($vo["is_pc"]); ?>">√</p>
                                <?php else: ?>
                                <p style="color: red" onclick="J_ChangeStatus(this)" data-id="<?php echo ($vo["id"]); ?>" title="非推荐"  data-item="is_pc" data-value="<?php echo ($vo["is_pc"]); ?>">×</p><?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo U('/Admin/goods/addgoods/id');?>/<?php echo ($vo["id"]); ?>/page/<?php echo I('get.page');?>" class="btn btn-warning j-editClass" title="编辑"><i class="gicon-edit white"></i></a>
                            <a href="<?php echo U('/Admin/goods/match',['id'=>$vo['id']]);?>" class="btn btn-primary j-editClass" title="商品搭配">商品搭配</a>
                            <?php if(($vo['is_pc']) == "1"): ?><a href="<?php echo U('/Admin/goods/goods_pc/id');?>/<?php echo ($vo["id"]); ?>/page/<?php echo I('get.page');?>" class="btn btn-success j-editClass" title="官网配置"><i class="gicon-cog white"></i></a><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <!-- end wxtables -->
            <div class="tables-btmctrl clearfix">
                <div style="margin:4px 0px;">
                    <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                    <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                    <a href="javascript:;" class="btn btn-success" onclick="J_ChangeStatus(this)" data-item="is_sale" data-value="0" title="上架"><i class="gicon-arrow-up white"></i></a>
                    <a href="javascript:;" class="btn btn-warning" onclick="J_ChangeStatus(this)" data-item="is_sale" data-value="1" title="下架"><i class="gicon-arrow-down white"></i></a>
                    <a href="javascript:;" class="btn btn-danger" onclick="J_ChangeStatus(this)" data-item="is_del" data-value="0" title="删除"><i class="gicon-trash white"></i></a>
                    <a href="javascript:;" class="btn btn-success" onclick="J_ChangeStatus(this)" data-item="is_del" data-value="1" title="恢复"><i class="gicon-retweet white"></i></a>
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

<script src="/Public/Admin/Js/Goods/index.js"></script>