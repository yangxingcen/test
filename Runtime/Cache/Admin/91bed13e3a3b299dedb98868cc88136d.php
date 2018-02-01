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
<link rel="stylesheet" href="/Public/UploadImg/uploadImg.css"/><!--自定义-->
<link rel="stylesheet" href="/Public/UploadImg/themes/default/default.css"/>
<link rel="stylesheet" href="/Public/UploadImg/plugins/code/prettify.css"/>
<script charset="utf-8" src="/Public/UploadImg/kindeditor-all.js"></script>
<script charset="utf-8" src="/Public/UploadImg/lang/zh-CN.js"></script>
<script charset="utf-8" src="/Public/UploadImg/plugins/code/prettify.js"></script>
<!--上传图片 2-->


<!--三级联动-->
<script src="/Public/ProvinceCity/GlobalProvinces_main.js"></script>
<script src="/Public/ProvinceCity/GlobalProvinces_extend.js"></script>
<script src="/Public/ProvinceCity/initLocation.js"></script>
<script>
    /*省市区联动 编辑 1*/
    var option = jQuery.extend({
        sheng:"s_province",		//省的网页ID
        shi:"s_city",			//市的网页ID
        xian:"s_county",		//县的网页ID
        xiang:"xiang",		//乡的网页ID
        sheng_val:"<?php echo ($info["ship_province"]); ?>",		//默认省份
        shi_val:"<?php echo ($info["ship_city"]); ?>",			//默认地区
        xian_val:"<?php echo ($info["ship_county"]); ?>",		//默认县
        xiang_val:""		//默认乡镇
    });
    $(function(){initLocation(option);})
    /*省市区联动 编辑 2*/
</script>
<!--三级联动-->


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
                <?php if(empty($info["id"])): ?>发布商品<?php else: ?>修改商品<?php endif; ?>
                <a href="javascript:history.back(-1)" class="btn" style="float: right">返回</a>
            </h1>
            <div class="tabs clearfix mgt10">
                <a href="javascript:void(0);" class="tabs_a fl tab1 active" onclick="tab_show(this,1)">基本信息</a>
                <a href="javascript:void(0);" class="tabs_a fl tab2 " onclick="tab_show(this,2)">价格设置</a>
                <a href="javascript:void(0);" class="tabs_a fl tab3 " onclick="tab_show(this,3)">商品参数</a>
                <a href="javascript:void(0);" class="tabs_a fl tab4 " onclick="tab_show(this,4)">商品详情</a>
                <a href="javascript:void(0);" class="tabs_a fl tab5 " onclick="tab_show(this,5)">分享参数</a>
            </div>


            <div>
                <!--基本信息 1-->
                <div class="panel-single panel-single-light mgt20 " id="tab1" >
                    <h3 class="cst_h3 mgb20">基本信息</h3>
                    <form id="Form_1">
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">添加时间</span>：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge" name="" value="<?php echo ($info["add_time"]); ?>" onFocus="this.blur()">
                            </div>
                            <label class="fi-name"><span class="colorRed">更新时间</span>：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge" name="" value="<?php echo ($info["update_time"]); ?>" onFocus="this.blur()">
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>排序：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge w1" name="sorts" value="<?php echo ((isset($info["sorts"]) && ($info["sorts"] !== ""))?($info["sorts"]):0); ?>"
                                       maxlength="6" onKeyUp="this.value=this.value.replace(/\D/g,'')"
                                       onafterpaste="this.value=this.value.replace(/\D/g,'')">
                                <span class="fi-help-text">数字越大，排名越靠前,如果为0，默认排序方式为创建时间</span>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>商品名称：</label>

                            <div class="form-controls">
                                <input type="text" class="input xxlarge w1" name="goods_name" value="<?php echo ($info["goods_name"]); ?>"
                                       placeholder="输入商品名称" maxlength="50">
                                <span class="fi-help-text">最长50个字符</span>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>商品简介：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge w1" name="goods_des" value="<?php echo ($info["goods_des"]); ?>"
                                       placeholder="输入商品简介" maxlength="50">
                                <span class="fi-help-text">最长50个字符</span>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>商品服务：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge w1" name="goods_ser" value="<?php echo ($info["goods_ser"]); ?>"
                                       placeholder="输入商品服务" maxlength="50">
                                <span class="fi-help-text">最长50个字符</span>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>商品分类：</label>
                            <div class="radio-group">
                                <select name="cate_pid" class="select large" onchange="J_Select_Cate(this)">
                                    <option value=""> 请选择商品一级分类</option>
                                    <?php if(is_array($goods_cate_new["0"])): $i = 0; $__LIST__ = $goods_cate_new["0"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <select name="cate_id" class="select large">
                                    <option value=""> 请选择商品二级分类</option>
                                </select>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>发货地：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <select name="ship_province" id="s_province" class="select large"></select>
                                    <select name="ship_city" id="s_city" class="select large"></select>
                                    <select name="ship_county" id="s_county" class="select large"></select>
                                </div>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>上架：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <label><input type="radio" name="is_sale" value="0" <?php if(($info["is_sale"]) == "0"): ?>checked<?php endif; ?>>否</label>
                                    <label><input type="radio" name="is_sale" value="1" <?php if(($info["is_sale"]) == "1"): ?>checked<?php endif; ?>>是</label>
                                </div>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>新品：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <label><input type="radio" name="is_new" value="0" <?php if(($info["is_new"]) == "0"): ?>checked<?php endif; ?> >否</label>
                                    <label><input type="radio" name="is_new" value="1" <?php if(($info["is_new"]) == "1"): ?>checked<?php endif; ?> >是</label>
                                </div>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>促销：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <label><input type="radio" name="is_cuxiao" value="0" <?php if(($info["is_cuxiao"]) == "0"): ?>checked<?php endif; ?> >否</label>
                                    <label><input type="radio" name="is_cuxiao" value="1" <?php if(($info["is_cuxiao"]) == "1"): ?>checked<?php endif; ?> >是</label>
                                </div>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>推荐首页：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <label><input type="radio" name="is_groom" value="0" <?php if(($info["is_groom"]) == "0"): ?>checked<?php endif; ?> >否</label>
                                    <label><input type="radio" name="is_groom" value="1" <?php if(($info["is_groom"]) == "1"): ?>checked<?php endif; ?> >是</label>
                                </div>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>产品类型：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <label><input type="radio" name="type" value="1" <?php if(($info["type"]) == "1"): ?>checked<?php endif; ?> >普通商品</label>
                                    <label><input type="radio" name="type" value="2" <?php if(($info["type"]) == "2"): ?>checked<?php endif; ?> >套餐产品</label>
                                </div>
                            </div>
                        </div>

                        <div class="panel-single panel-single-light mgt20 txtCenter ">
                            <a href="javascript:;" onclick="J_tab_show(this,2)" class="btn">下一步</a>
                        </div>
                    </form>
                </div>
                <!--基本信息 1-->

                <!--价格设置 1-->
                <div class="panel-single panel-single-light mgt20 " id="tab2" style="display: none">
                    <h3 class="cst_h3 mgb20">价格设置</h3>
                    <form id="Form_2">
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>编码：</label>
                            <div class="form-controls">
                                <span class="input-group-addon">商品编码</span>
                                <input type="text" class="input mini" name="goods_code" value="<?php echo ($info["goods_code"]); ?>" onblur="J_set_pval(this)">
                                <span class="input-group-addon">重量</span>
                                <input type="text" class="input mini" name="weight" value="<?php echo ($info["weight"]); ?>" placeholder="克(g)" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                                <span class="input-group-addon">虚拟销量</span>
                                <input type="text" class="input mini" name="virtual_sales" value="<?php echo ($info["virtual_sales"]); ?>" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                                <span class="input-group-addon">赠送积分</span>
                                <input type="text" class="input mini" name="integral" value="<?php echo ($info["integral"]); ?>" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                            </div>
                        </div>


                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>价格设置：</label>
                            <div class="form-controls">
                                <span class="input-group-addon">原价</span>
                                <input type="text" class="input mini" name="oprice" value="<?php echo ($info["oprice"]); ?>" onblur="J_set_pval(this)">
                                <span class="input-group-addon">元；</span>
                                <span class="input-group-addon">现价</span>
                                <input type="text" class="input mini" name="price" value="<?php echo ($info["price"]); ?>" onblur="J_set_pval(this)">
                                <span class="input-group-addon">元；</span>
                                <span class="input-group-addon">成本价</span>
                                <input type="text" class="input mini" name="cost_price" value="<?php echo ($info["cost_price"]); ?>" onblur="J_set_pval(this)">
                                <span class="input-group-addon">元</span>
                                <span class="input-group-addon">库存</span>
                                <input type="text" class="input mini" name="stock" value="<?php echo ($info["stock"]); ?>" onblur="J_set_pval(this)">
                                <span class="input-group-addon">单位</span>
                                <input type="text" class="input mini" name="goods_unit" value="<?php echo ($info["goods_unit"]); ?>" placeholder="个/件">
                            </div>
                        </div>


                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>启用多规格：</label>
                            <div class="form-controls">
                                <div class="radio-group">
                                    <label><input type="radio" name="is_sku" value="0" onclick="$('.set_sku').hide()" <?php if(($info["is_sku"]) != "1"): ?>checked<?php endif; ?>  >否</label>
                                    <label><input type="radio" name="is_sku" value="1" onclick="$('.set_sku').show()" <?php if(($info["is_sku"]) == "1"): ?>checked<?php endif; ?>>是</label>
                                </div>
                            </div>
                        </div>

                        <!--设置SKU属性  1-->
                        <div class="panel-single panel-single-light mgt20 set_sku" <?php if(($info["is_sku"]) != "1"): ?>style="display:none"<?php endif; ?>>
                        <h3 class="cst_h3 mgb20" style="float: left">选择sku属性：</h3>
                        <div style="float: right">
                            <input type="button" class="btn btn-primary" onclick="J_add_guige_tankuang()" value="选择规格">
                        </div>
                        <div>
                            <div style="padding: 5px 8px;" class="div_content">
                                <input type="hidden" name="guigeshuxing" value=''>
                                <input type="hidden" class="xxlarge input" name="goods_sku_info" value=''>

                                <div class="div_contentlist">
                                    <?php if(is_array($info["guigeshuxing"])): foreach($info["guigeshuxing"] as $k=>$vo): ?><ul class="Father_Title Father_Title<?php echo ($vo['skuid']); ?>" style='clear: both;padding-top: 20px;border-top: 1px solid #ccc;'>
                                            <li data-skuid="<?php echo ($vo['skuid']); ?>" style="float: left;font-weight: bold;font-size: 16px;line-height:22px;margin-top: 4px;"><?php echo ($vo['classname']); ?></li>
                                            <li style="float: left">
                                                <label>
                                                    <button type="button" class="btn btn-mini btn-primary"  onclick="J_add_shuxing_tankuang(this)" data-skuid="<?php echo ($vo['skuid']); ?>"  value="选择属性值"><i class="gicon-edit white"></i></button>
                                                    <span class="li_empty"> </span>
                                                </label>
                                                <label>
                                                    <button type="button" class="btn btn-mini btn-danger" onclick="J_del_guige(this)" data-skuid="<?php echo ($vo['skuid']); ?>"  value="删除"><i class="gicon-trash white"></i></button>
                                                    <span class="li_empty"></span>
                                                </label>
                                            </li>
                                            <div style="clear: both"></div>
                                        </ul>
                                        <ul class="Father_Item<?php echo ($vo['skuid']); ?> Father_Item">
                                            <?php if(is_array($vo["subset"])): $i = 0; $__LIST__ = $vo["subset"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li data-skuid="<?php echo ($v['skuid']); ?>" class="li_width Father_son Father_son<?php echo ($v["skuid"]); ?>" style="line-height:22px;margin-right:4px;float: left;">
                                                    <label><?php echo ($v["classname"]); ?></label>
                                                    <label>
                                                        <button type="button" class="btn btn-mini btn-danger"  data-skuid="<?php echo ($v['skuid']); ?>" onclick="J_del_shuxing(this)" value="删除"><i class="gicon-trash white"></i></button>
                                                    </label>
                                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul><?php endforeach; endif; ?>
                                </div>
                                <div class="div_contentlist2" style='clear: both;;padding-top: 20px;border-top: 1px solid #ccc;'>
                                    <ul>
                                        <li style="margin-bottom: 20px">
                                            <div class="batch-update-area" style="">
                                                <div class="">
                                                    <span class="input-group-addon">原价</span>
                                                    <input type="text" class="input mini" name="P_oprice" value="<?php echo ($info["oprice"]); ?>" onblur="J_set_pval(this)" onkeyup="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                    <span class="input-group-addon">元；</span>
                                                    <span class="input-group-addon">现价</span>
                                                    <input type="text" class="input mini" name="P_price" value="<?php echo ($info["price"]); ?>" onblur="J_set_pval(this)" onkeyup="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                    <span class="input-group-addon">元；</span>
                                                    <span class="input-group-addon">成本价</span>
                                                    <input type="text" class="input mini" name="P_cost_price" value="<?php echo ($info["cost_price"]); ?>" onblur="J_set_pval(this)" onkeyup="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                    <span class="input-group-addon">元</span>
                                                    <span class="input-group-addon">库存</span>
                                                    <input type="text" class="input mini" name="P_stock" value="<?php echo ($info["stock"]); ?>" onblur="J_set_pval(this)" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')">
                                                    <span class="input-group-addon">商品编码</span>
                                                    <input type="text" class="input mini" name="P_goods_code" value="<?php echo ($info["goods_code"]); ?>" onblur="J_set_pval(this)" >
                                                    <input type="button" class="btn btn-primary" value="批量填充" id="piliang" style="margin-left: 20px;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div id="createTable"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--设置SKU属性 2-->

                        <div class="panel-single panel-single-light mgt20 txtCenter ">
                            <a href="javascript:;" onclick="J_tab_show(this,1)" class="btn">上一步</a>
                            <a href="javascript:;" onclick="J_tab_show(this,3)" class="btn">下一步</a>
                        </div>
                    </form>
                </div>
                <!--价格设置 2-->

                <!--商品参数 1-->
                <div class="panel-single panel-single-light mgt20" id="tab3" style="display: none">
                    <h3 class="cst_h3 mgb20">商品参数</h3>
                    <form id="Form_3">
                        <div class="formitems">
                            <table id="goodsparamtable">
                                <tr>
                                    <th>名称</th>
                                    <th>值</th>
                                </tr>
                                <tr id='param_list'>
                                    <td><input type="text" class="input" name="param_name[]" value="<?php echo ($info["goods_param"]["0"]["0"]); ?>"/></td>
                                    <td><input type="text" class="input large" name="param_val[]" value="<?php echo ($info["goods_param"]["0"]["1"]); ?>"/></td>
                                </tr>
                                <?php if(is_array($info["goods_param"])): $i = 0; $__LIST__ = array_slice($info["goods_param"],1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td><input type="text" class="input" name="param_name[]" value="<?php echo ($vo["0"]); ?>"/></td>
                                        <td><input type="text" class="input large" name="param_val[]" value="<?php echo ($vo["1"]); ?>"/></td>
                                        <td><span class="thisparam gicon-remove" onclick="J_del_param(this)" title='删除' style="padding-top:2px;cursor:pointer;"></span></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </table>
                            <div>
                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" onclick="J_add_param(this)" title="添加"><i class="gicon-plus white"></i></a>
                            </div>
                        </div>

                        <div class="panel-single panel-single-light mgt20 txtCenter ">
                            <a href="javascript:;" onclick="J_tab_show(this,2)" class="btn">上一步</a>
                            <a href="javascript:;" onclick="J_tab_show(this,4)" class="btn">下一步</a>
                        </div>
                    </form>
                </div>
                <!--商品参数 2-->

                <!--商品详情 1-->
                <div class="panel-single panel-single-light mgt20" id="tab4" style="display: none">
                    <h3 class="cst_h3 mgb20">商品详情</h3>
                    <form id="Form_4">
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>LOGO图片：</label>
                            <div class="form-controls pdt5">
                                <div class=" fl mgr10">
                                    <img src="<?php echo ($info['logo_pic']); ?>" width="100px"
                                         onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"
                                         onclick="J_uploadImg(this,3)">
                                    <input name="logo_pic" value="<?php echo ($info['logo_pic']); ?>" type="text" class="input xxlarge" onFocus="this.blur()">
                                </div>
                            </div>
                        </div>

                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>轮播展示图(多选)：</label>
                            <div class="form-controls pdt5">
                                <div class=" fl mgr10">
                                    <img src="<?php echo ($info['pic_s']); ?>" width="100px"
                                         onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"
                                         onclick="J_uploadImg_more(this,3)" data-name="pics[]" data-view="J_imageView_1">
                                </div>
                            </div>
                        </div>
                        <!--图片区-->
                        <div style="margin-left:148px;" class="input-group multi-img-details ui-sortable dad-active dad-container" id="J_imageView_1">
                            <?php if(!empty($info['pics'])): if(is_array($info['pics'])): $i = 0; $__LIST__ = $info['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods_imgs">
                                        <img src="<?php echo ($vo); ?>"
                                             onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.jpg'; this.title='图片未找到.'"
                                             class="img-responsive img-thumbnail">
                                        <input type="hidden" name="pics[]" value="<?php echo ($vo); ?>">
                                        <em class="close" title="删除这张图片" onclick="deleteMultiImage(this)">×</em>
                                    </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </div>
                        <!--图片区-->

                        <div class="formitems">
                            <div class="form-controls pdt3 goods_xiangqing">
                                <script id="editor" type="text/plain" name="detail" class="edui-container"><?php echo (stripslashes(htmlspecialchars_decode($info["detail"]))); ?></script>
                            </div>
                        </div>

                        <div class="panel-single panel-single-light mgt20 txtCenter ">
                            <a href="javascript:;" onclick="J_tab_show(this,3)" class="btn">上一步</a>
                            <a href="javascript:;" onclick="J_tab_show(this,5)" class="btn">下一步</a>
                        </div>
                    </form>
                </div>
                <!--商品详情 2-->

                <!--分享参数 1-->
                <div class="panel-single panel-single-light mgt20 neirong" id="tab5" style="display: none">
                    <h3 class="cst_h3 mgb20">分享参数</h3>
                    <form id="Form_5">
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>分享标题：</label>
                            <div class="form-controls">
                                <input type="text" class="input xxlarge" name="share_title" value="<?php echo ($info["share_title"]); ?>">
                                <span class="fi-help-text">如果不填写，默认为商品名称</span>
                            </div>
                        </div>
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed">*</span>分享描述：</label>
                            <div class="form-controls">
                                <textarea name='share_desc' cols='70' rows='6' style='padding:5px'><?php echo ($info["share_desc"]); ?></textarea>
                                <span class="fi-help-text">如果不填写，则使用商品副标题，如商品副标题为空则使用商品名称</span>
                            </div>
                        </div>
                        <div class="formitems">
                            <label class="fi-name"><span class="colorRed"></span>分享图片：</label>
                            <div class="form-controls pdt5">
                                <div class=" fl mgr10">
                                    <img src="<?php echo ($info['share_logo']); ?>" width="100px"
                                         onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"
                                         onclick="J_uploadImg(this,3)">
                                    <input name="share_logo" value="<?php echo ($info['share_logo']); ?>" type="text"  class="input xxlarge" onFocus="this.blur()">
                                </div>
                            </div>
                        </div>

                        <div class="panel-single panel-single-light mgt20 txtCenter">
                            <input type="hidden" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):0); ?>" name="goodsid">
                            <input type="hidden" value="<?php echo ($info["isactivity"]); ?>" name="isactivity"><!--这个字段区分活动商品和普通商品活动商品goos_market表-->
                            <a href="javascript:;" onclick="J_tab_show(this,4)" class="btn">上一步</a>
                            <input type="button" class="btn btn-primary" onclick="J_Submit(this)" value="保存">
                        </div>
                    </form>
                </div>
                <!--分享参数 2-->
            </div>
        </div>
    </div>
</div>


<!-- end container -->
<input type="hidden" name="page" value="<?php echo ((isset($page) && ($page !== ""))?($page):1); ?>">
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
<div id="albums-overlay" style="display: none;"></div>

<!--新增规格1-->
<div class="jbox disshow addfenlei addguige" style="height:auto;left:40%;width: 50%">
    <div class="jbox-title">
        <div class="jbox-title-txt">选择规格</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <form id="Form_one">
        <div class="jbox-container">
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>名称：</label>
                <div class="form-controls guige_content"></div>
            </div>
            <div class="formitems">
                <label class="fi-name"><span class="colorRed"></span>新增名：</label>
                <div class="form-controls">
                    <input type="text" class="input" name="new_guige" placeholder="不填则不新增">
                    <span class="fi-help-text"></span>
                </div>
            </div>
            <div class="jbox-buttons" style="text-align:center;">
                <input type="hidden" class="sku_id_checked_old" value="">
                <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a>
                <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_add_guige(this)">确定</a>
            </div>
        </div>
    </form>
</div>
<!--新增规格2-->

<!--新增规格属性1-->
<div class="jbox disshow addfenlei addguigeshuxing" style="height:auto;left:40%;width: 50%"">
<div class="jbox-title">
    <div class="jbox-title-txt">选择属性值</div>
    <a href="javascript:;" class="jbox-close cancle"></a>
</div>
<form id="Form_two">
    <div class="jbox-container">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>名称：</label>
            <div class="form-controls shuxing_content"></div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>新增值：</label>

            <div class="form-controls">
                <input type="text" class="input" name="new_shuxing" placeholder="不填则不新增">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="jbox-buttons" style="text-align:center;">
            <input type="hidden" name="sku_pid" value="">
            <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a>
            <a href="javascript:void(0);" class="btn btn-primary" onclick="J_add_shuxing(this)">确定</a>
        </div>
    </div>
</form>
</div>
<!--validate 1-->
<!--<script src="/Public/Admin/Js/jquery.js"></script>-->
<script type="text/javascript" src="/Public/Admin/Js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/jquery.validate.messages_cn.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/jquery.validate.additional-methods.js"></script>
<!--validate 2-->

<script type="text/javascript">
    var j_goods_cate =jQuery.parseJSON('<?php echo ($j_goods_cate); ?>');
</script>
<script type="text/javascript" src="/Public/Admin/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/Goods/set-sku.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/Goods/addgoods.js"></script>
<?php if(!empty($skulist)): ?><script>
        window.onload = function () {
            var arr = JSON.parse('<?php echo ($skulist); ?>');
            $.each(arr, function (n, v) {
                $('#sku_table tbody tr .Txt_OPrice').eq(n).val(v.oprice);
                $('#sku_table tbody tr .Txt_Price').eq(n).val(v.price);
                $('#sku_table tbody tr .Txt_Cost_Price').eq(n).val(v.cost_price);
                $('#sku_table tbody tr .Txt_Stock').eq(n).val(v.stock);
                $('#sku_table tbody tr .Txt_Goods_Code').eq(n).val(v.goods_code);
                $('#sku_table tbody tr .Txt_Pic').eq(n).val(v.pic);
                $('#sku_table tbody tr img').eq(n).attr('src', v.pic);
                $('#sku_table tbody tr ').find("input[name='sku_id[]']").eq(n).val(v.id);
            });
        }

    </script><?php endif; ?>

<!--拖拽图片排序-->
<link rel="stylesheet" href="/Public/UploadImg/jquery.dad.css"/>
<script src="/Public/UploadImg/jquery.dad.min.js"></script>
<script language="javascript">
    $('#J_imageView_1').dad({
        draggable: 'img'//拖拽区域
    });
</script>
<!--拖拽图片排序-->


<!--编辑商品时商品分类 1-->
<?php if(!empty($info)): ?><script>
        $(document).ready(function(e) {
            var cate_pid =<?php echo ($info['cate_pid']); ?>;
            var cate_id =<?php echo ($info['cate_id']); ?>;
            set_category('0',cate_pid,'cate_pid','一');
            set_category(cate_pid,cate_id,'cate_id','二');
        });
    </script><?php endif; ?>
<!--编辑商品时商品分类 2-->