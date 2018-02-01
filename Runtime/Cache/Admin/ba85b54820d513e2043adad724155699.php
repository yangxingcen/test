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
<style>
.checkbox-group, .radio-group{padding-top:0px;}
.imgnav {max-height: 30px;overflow: hidden;cursor: pointer;}
.imgwrapper {display: block;width: 78px;height: 78px;overflow: hidden;}
.imgwrapper img {display: block;width: 100%;padding: 0;margin: 0;border: 0;}
.spanpd10 {margin: 10px;}
.wxtables.wxtables-sku.newtable {width: 40%;margin: 0;}
.wxtables td {padding: 7px 0px;}
.sku-table .mini {width: 40px;}
.img-list li {width: 60px;height: 60px;}
.cst_h3 span {font-weight: normal;}
#imgdiv img {max-width: 190px;max-height: 190px;display: none;margin: 5px;}
.btnimage {width: 80px;height: 30px;background: white;border: 1px solid #d9d9d9;cursor: pointer;position: relative;text-align: center;line-height: 31px;}
.skuFile {position: absolute;top: 0px;left: 0;width: 80px;height: 30px;background: white;border: 1px solid #d9d9d9;cursor: pointer;opacity: 0}
.file {position: absolute;top: 0px;left: 0;width: 80px;height: 30px;background: white;border: 1px solid #d9d9d9;cursor: pointer;opacity: 0}
#imgdiv2 img {max-width: 88px;max-height: 88px;display: none;margin: 5px;}
#xuanze2 {width: 60px;height: 30px;background: white;border: 1px solid #d9d9d9;}
#xuanze2:hover {background: #E6E6E6;}
.huase {display: none;width: 86px;height: 30px;margin: 5px;text-indent: 5px;}
.w1 {float: left;}
#process{width:100%;padding:5px;}
.tbcenter{text-align:center;}
.width50{width:50px;}
.width70{width:70px;}
#albums-overlay{z-index:1000;}
.li{cursor: pointer;}
</style>
<!--sku-->
<style>
.Father_Item li {float: left;}
table#process {font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;}
table#process th {border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;}
table#process td {border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #ffffff;}
</style>
<!--sku-->
<!--分销佣金设置 1-->
<style>
table#set_fenxiaoyongjin{border: solid 1px;text-align: center;width: 100%;}
table#set_fenxiaoyongjin tr{border: solid 1px;}
table#set_fenxiaoyongjin td{border: solid 1px;}
table#set_fenxiaoyongjin td input{width: 50px;margin: 6px;}
.up_load_pic{width:80px;height:80px;}
.up_load_pic img{width: 70px;height: 70px;overflow:hidden;z-index:1;display:block;/*border:none;outline:none;*/}
.up_load_pic img[src='']{opacity:0;}
.upload_pic_form{width: 70px;height: 70px;overflow:hidden;position: relative;top: -70px;z-index:2;}
.upload_sku_pic{width: inherit;height: inherit;cursor: pointer;opacity: 0;}
</style>
<!--分销佣金设置 2-->
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
            <h1 class="content-right-title"> <?php if(empty($info["id"])): ?>发布-积分商品<?php else: ?>修改-积分商品<?php endif; ?>
            <a href="javascript:history.back(-1)" class="btn" style="float: right">返回</a></h1>
            <form aciton="javascript:;" enctype="multipart/form-data" method="post" >
                <input type="hidden" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):0); ?>" name="goodsid" >
                <input type="hidden" value="<?php echo ($storeid); ?>" name="storeid">
                <input type="hidden" value="0" name="isactivity" >
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">时间</h3>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>添加时间：</label>
                        <div class="form-controls">
                            <input type="text" class="input" name="" value="<?php echo ($info["create_at"]); ?>"  onFocus="this.blur()">
                        </div>
                    </div>
                    <div class="formitems">
                    <label class="fi-name"><span class="colorRed"></span>上次更新时间：</label>
                    <div class="form-controls">
                        <input type="text" class="input" name="" value="<?php echo ($info["edit_at"]); ?>"  onFocus="this.blur()">
                    </div>
                </div>
                </div>
                <!--  基本信息 1-->
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">商品信息</h3>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>排序：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge w1" name="sorts" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>" maxlength="4" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                            <span class="fi-help-text">数字越大，排名越靠前,如果为0，默认排序方式为创建时间</span>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>名称：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge w1" name="title" value="<?php echo ($info["goods_name"]); ?>"  placeholder="输入商品名称" maxlength="50">
                            <span class="fi-help-text">最长50个字符</span></div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>商品简介：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge w1" name="subtitle"  value="<?php echo ($info["goods_des"]); ?>" placeholder="输入商品简介" maxlength="50">
                            <span class="fi-help-text">最长50个字符</span></div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>商品服务：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge w1" name="goods_ser"  value="<?php echo ($info["goods_ser"]); ?>" placeholder="输入商品简介" maxlength="50">
                            <span class="fi-help-text">最长50个字符</span></div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>分类：</label>
                        <div class="form-controls">
                            <select class="select xxxlarge" name="cateid" id="cateid">
                                <option value="">--请选择--</option>
                                <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $info['cate_id']): ?><option value="<?php echo ($vo['id']); ?>" selected="selected"><?php echo ($vo['name']); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <span class="fi-help-text error"></span>
                        </div>
                    </div>

                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>LOGO图片：</label>
                        <div class="form-controls pdt5">
                            <div class=" fl mgr10">
                                <img src="<?php echo ($info['logo_pic']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,2)">
                                <input name="logo" value="<?php echo ($info['logo_pic']); ?>" type="hidden">
                            </div>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>轮播展示图(多选)：</label>
                        <div class="form-controls pdt5">
                            <div class=" fl mgr10">
                                <img src="<?php echo ($info['pic1']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg_more(this,2)" data-name="pic1[]" data-view="J_imageView_1">
                          
                            </div>
                        </div>
                    </div>
                    <!--图片区-->
                    <div style="margin-left:148px;" class="input-group multi-img-details ui-sortable dad-active dad-container" id="J_imageView_1">
                        <?php if(!empty($info['pic1'])): if(is_array($info['pic1'])): $i = 0; $__LIST__ = $info['pic1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods_imgs">
                                    <img src="<?php echo ($vo); ?>" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail">
                                    <input type="hidden" name="pic1[]" value="<?php echo ($vo); ?>">
                                    <em class="close" title="删除这张图片" onclick="deleteMultiImage(this)">×</em>
                                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                    <!--图片区-->
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>上架：</label>
                        <div class="form-controls">
                            <div class="radio-group">
                                <?php if(empty($info["id"])): ?><label><input type="radio" name="issale" value="0" checked>否</label>
                                    <label><input type="radio" name="issale" value="1">是</label>
                                    <?php else: ?>
                                    <label><input type="radio" name="issale" value="0"
                                        <?php if(($info["is_sale"]) == "0"): ?>checked<?php endif; ?>
                                        >否</label>
                                    <label><input type="radio" name="issale" value="1"
                                        <?php if(($info["is_sale"]) == "1"): ?>checked<?php endif; ?>
                                        >是</label><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--库存 1-->
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">库存</h3>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>编码：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" name="goodscode" value="<?php echo ($info["spu"]); ?>" placeholder="商品的编码">
                            <span class="fi-help-text"></span> </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>库存：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" id="store" name="stock" value="<?php echo ($info["stock"]); ?>" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                            <span class="fi-help-text"></span>
                        </div>
                    </div>
                    <div class="formitems goods_price" <?php if(($info["type"]) == "3"): ?>style="display: none"<?php endif; ?>>
                        <label class="fi-name"><span class="colorRed"></span>现积分：</label>
                        <div class="form-controls">
                            <input type="text" class="input mini " name="price" value="<?php echo ((isset($info["price"]) && ($info["price"] !== ""))?($info["price"]):0.00); ?>" onblur="if( ! /^(0|[1-9]\d{0,}?)(\.\d{1,2})?$/.test(this.value)){alert('格式不对！');this.value='0.00';}">分，原积分
                            <input type="text" class="input mini " name="oprice"  value="<?php echo ((isset($info["oprice"]) && ($info["oprice"] !== ""))?($info["oprice"]):0.00); ?>" onblur="if( ! /^(0|[1-9]\d{0,}?)(\.\d{1,2})?$/.test(this.value)){alert('格式不对！');this.value='0.00';}">分
                          
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!--库存 2-->
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">属性规格</h3>
                    <div class="formitems" style="margin-top: 20px;">
                        <label class="fi-name"><span class="colorRed"></span>启用：</label>
                        <div class="form-controls">
                            <div class="radio-group">
                                <label><input type="radio" name="is_sku" value="0" <?php if(($info["is_sku"]) != "1"): ?>checked<?php endif; ?> >否</label>
                                <label><input type="radio" name="is_sku" value="1" <?php if(($info["is_sku"]) == "1"): ?>checked<?php endif; ?> >是</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--设置SKU属性 1-->
                <?php if($skulist == '' ): ?><div class="panel-single panel-single-light mgt20 j-showinhyd" style="display:none" >
                        <h3 class="cst_h3 mgb20" style="float: left">设置SKU属性：</h3>
                        <div style="float: right">
                            <input type="button" class="btn btn-primary" onclick="add_guige_tankuang()" value="选择规格">
                        </div>
                        <div style="clear: both"></div>
                        <div style="width: 100%;">
                            <div style="padding: 5px 8px;" class="div_content">
                                <input type="hidden" name="guigeshuxing" value="" >
                                <input type="hidden" name="guige" value="" >
                                <div class="div_contentlist"></div>
                                <div class="div_contentlist2" style='clear: both;padding-top: 20px;border-top: 1px solid #ccc;'>
                                    <ul>
                                        <li style="margin-bottom: 20px">
                                            <div class="batch-update-area" style="">
                                                <label for="batch-price">批量填充:</label>
                                                <input type="text"  id="batch-price" class="input mini pi_oprice" placeholder="原价" 
                                                    style="margin-left:20px;" 
                                                    onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')" 
                                                    onblur="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                <input type="text"  class="input mini pi_price" placeholder="售价" 
                                                    style="margin-left: 20px;" 
                                                    onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')" 
                                                    onblur="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                <input type="text"  class="input mini pi_store" id="pi_store" placeholder="库存"
                                                    style="margin-left: 20px;" 
                                                    onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" 
                                                    onblur="this.value=this.value.replace(/(\.\d)\d*$/,'\$1')">
                                                <input type="text"  class="input pi_number" placeholder="商家编码" style="margin-left: 20px;">
                                                <input type="button" value="确定" class="btn btn-primary" id="piliang" style="margin-left: 20px;">
                                            </div>
                                        </li>
                                        <li><div id="createTable"><form class="createTable"></form></div></li>
                                        <li style="margin-top: 20px;">
                                            <div class="batch-update-area" style="">
                                                <label for="batch-price">价格及总库存:</label>
                                                最低原价：<input type="text" class="input mini Small_Txt_OPrice" placeholder="最低原价" style="margin-left: 20px;">
                                                最低售价：<input type="text" class="input mini Small_Txt_Price" placeholder="最低售价" style="margin-left: 20px;">
                                                总库存：<input type="text" class="input mini Count_Txt_Store" placeholder="总库存" style="margin-left: 20px;">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="panel-single panel-single-light mgt20 j-showinhyd"  >
                        <h3 class="cst_h3 mgb20" style="float: left">选择sku属性：</h3>
                        <div style="float: right">
                            <input type="button" class="btn btn-primary" onclick="add_guige_tankuang()" value="选择规格">
                        </div>
                        <div style="clear: both"></div>
                        <div  style="width: 100%;">
                            <div style="padding: 5px 8px;" class="div_content">
                                <input type="hidden" name="guigeshuxing" value='0'>
                                <input type="hidden" name="guige" value='0'>
                                <div class="div_contentlist">
                                    <?php if(is_array($guigeshuxing)): foreach($guigeshuxing as $k=>$vo): ?><ul class="Father_Title" style='clear: both;padding-top: 20px;border-top: 1px solid #ccc;'>
                                            <li style="float: left;font-weight: bold;font-size: 16px;line-height22px;margin-top: 4px;"><?php echo ($vo['classname']); ?></li>
                                            <li style="float: left">
                                                <label>
                                                    <input type="button" class="btn btn-mini btn-primary color_add" value="选择属性值" data-skuid="<?php echo ($vo['skuid']); ?>">
                                                    <span class="li_empty"> </span>
                                                </label>
                                                <label>
                                                    <input type="button" class="btn btn-mini btn-danger delguige" value="删除">
                                                    <span class="li_empty"></span>
                                                </label>
                                            </li>
                                            <div style="clear: both"></div>
                                        </ul>
                                        <ul class="Father_Item<?php echo ($k); ?> Father_Item">
                                            <?php if(is_array($vo["subset"])): foreach($vo["subset"] as $ks=>$v): ?><li class="li_width" style="line-height:22px;margin-right:4px;">
                                                    <label class="addsku">
                                                        <input type="checkbox" class="checkbox chcBox_Width" value="<?php echo ($v["classname"]); ?>" data-cskuid="<?php echo ($v["skuid"]); ?>" checked>
                                                        <?php echo ($v["classname"]); ?>&nbsp;
                                                    </label>
                                                    <label>
                                                        <input type="button" class="btn btn-mini btn-danger delguigeshuxing" value="删除">
                                                    </label>
                                                </li><?php endforeach; endif; ?>
                                        </ul><?php endforeach; endif; ?>
                                </div>
                                <div class="div_contentlist2" style='clear: both;;padding-top: 20px;border-top: 1px solid #ccc;'>
                                    <ul>
                                        <li style="margin-bottom: 20px">
                                            <div class="batch-update-area" style="">
                                                <label for="batch-price">批量填充:</label>
                                                <input type="text"  class="input mini pi_oprice" placeholder="原价" 
                                                    style="margin-left: 20px;" 
                                                    onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')" 
                                                    onblur="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                <input type="text"  class="input mini pi_price" placeholder="售价" 
                                                    style="margin-left: 20px;" 
                                                    onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')" 
                                                    onblur="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
                                                <input type="text"  class="input mini pi_store" placeholder="库存" 
                                                    style="margin-left: 20px;" 
                                                    onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" 
                                                    onblur="this.value=this.value.replace(/(\.\d)\d*$/,'\$1')">
                                                <input type="text"  class="input pi_number" placeholder="商家编码" style="margin-left: 20px;">
                                                <input type="button" class="btn btn-primary" value="确定" id="piliang" style="margin-left: 20px;">
                                            </div>
                                        </li>
                                        <li><div id="createTable"></div></li>
                                        <li style="margin-top: 20px;">
                                            <div class="batch-update-area" style="">
                                                <label for="batch-price">价格及总库存:</label>
                                                最低原价：<input type="text" class="input mini Small_Txt_OPrice" placeholder="最低原价" style="margin-left: 20px;" disabled="disabled">
                                                最低售价：<input type="text" class="input mini Small_Txt_Price" placeholder="最低售价" style="margin-left: 20px;" disabled="disabled">
                                                最低出厂价：<input type="text" class="input mini Small_Txt_FPrice" placeholder="最低出厂价" style="margin-left: 20px;" disabled="disabled">
                                                总库存：<input type="text" class="input mini Count_Txt_Store" placeholder="总库存" style="margin-left: 20px;" disabled="disabled">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><?php endif; ?>
                <!--设置SKU属性 2-->
                <!--商品参数 2-->
                <!--商品详情 1-->
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">商品详情</h3>
                    <div class="formitems" style="width:100%;">
                        <div class="form-controls pdt3 goods_xiangqing">
                            <script id="editor" type="text/plain" name="detail" class="edui-container" ><?php echo (stripslashes(htmlspecialchars_decode($info["detail"]))); ?></script>
                        </div>
                    </div>
                </div>

                <!--会员折扣 1-->
                <div class="panel-single panel-single-light mgt20 huiyuan_zhekou" <?php if(($info["is_part_zhekou"]) < "1"): ?>style="display:none"<?php endif; ?> >
                    <h3 class="cst_h3 mgb20">会员折扣</h3>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>会员等级折扣：</label>
                        <div class="form-controls">
                            <br>
                            <?php if(is_array($member_grade_zhekou)): $i = 0; $__LIST__ = $member_grade_zhekou;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" class="input mini " name="member_grade" value="<?php echo ($vo["id"]); ?>" >
                                <?php echo ($vo["vip_name"]); ?> &nbsp;&nbsp;&nbsp;
                                <input type="text" class="input mini " name="buy_grade_zhekou" value="<?php echo ($vo["zhe"]["0"]); ?>" >折
                                &nbsp;&nbsp;&nbsp;或者
                                <input type="text" class="input mini " name="buy_grade_money" value="<?php echo ($vo["zhe"]["1"]); ?>" >元<br/><?php endforeach; endif; else: echo "" ;endif; ?>
                            <span class="fi-help-text">只有当折扣大于0，小于10的情况下才生效，否则按自身会员等级折扣计算；如果折扣为空或者0，则不设置折扣；折扣和固定金额都有,则优先使用折扣</span>
                        </div>
                    </div>
                </div>
                <div class="panel-single panel-single-light mgt20">
                    <h3 class="cst_h3 mgb20">分享参数</h3>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>分享标题：</label>
                        <div class="form-controls">
                            <input type="text" class="input xxlarge" name="share_title" value="<?php echo ($info["share_title"]); ?>">
                            <span class="fi-help-text">如果不填写，默认为商品名称</span></div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed">*</span>分享描述：</label>
                        <div class="form-controls">
                            <textarea name='share_desc' cols='70' rows='6' style='padding:5px'><?php echo ($info["share_desc"]); ?></textarea>
                            <span class="fi-help-text">如果不填写，则使用商品副标题，如商品副标题为空则使用商品名称</span>
                        </div>
                    </div>
                    <div class="formitems">
                        <label class="fi-name"><span class="colorRed"></span>LOGO图片：</label>
                        <div class="form-controls pdt5">
                            <div class=" fl mgr10">
                                <img src="<?php echo ($info['share_logo']); ?>" width="100px" onerror="this.src='http://www.deyishop.com/Public/UploadImg/img/nopic.png'; this.title='图片未找到.'"  onclick="J_uploadImg(this,2)">
                                <input name="share_logo" value="<?php echo ($info['share_logo']); ?>" type="hidden">
                            </div>
                        </div>

                </div>
                <!--分享参数 2-->
                <div class="panel-single panel-single-light mgt20 txtCenter">
                    <a href="javascript:;" onclick="javascript:history.back(-1);" class="btn">返回</a>
                    <input type="button" class="btn btn-primary" id="saveGoods" value="保存">
                </div>
            </form>
        </div>
        <!-- end content-right -->
    </div>
</div>
<!-- end container -->
<input type="hidden" name="page" value="<?php echo ((isset($page) && ($page !== ""))?($page):1); ?>">

<div id="albums-overlay" style="display: none;"></div>
<!--商品分类1-->
<div class="jbox fenlei select-fenlei disshow" style="height: auto;margin-top: -100px;">
    <div class="jbox-title">
        <div class="jbox-title-txt">请选择商品分类</div>
        <a href="javascript:void(0);" class="jbox-close cancle"></a></div>
    <div class="jbox-container" style="height: auto;">
        <div class="formitems">
            <label class="fi-name" style="width:135px;">分类标题：</label>
            <div class="form-controls">
                <input type="text" class="input mini" name="search_category" value="" placeholder="请输入标题">
                <button class="btn btn-primary search_category" title="搜索"><i class="gicon-search white"></i></button>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name" style="width:135px;"><span class="colorRed"></span>选择分类：</label>
            <div class="form-controls">
                <select name="select_class_id" id="select_class_id" class="select">
                    <?php if(is_array($catelists)): foreach($catelists as $key=>$vo): ?><option disabled value="<?php echo ($vo["id"]); ?>" name='【<?php echo ($vo["id"]); ?>】<?php echo ($vo["classname"]); ?>'><?php echo ($vo["classname"]); ?></option>
                        <?php if(is_array($vo["cate"])): $i = 0; $__LIST__ = $vo["cate"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["id"]); ?>" name='【<?php echo ($vv["id"]); ?>】<?php echo ($vv["classname"]); ?>'> &nbsp;&nbsp; |--<?php echo ($vv["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; ?>
                </select>
                <button class="btn btn-primary search_booking_bathgoods_ok">ok</button>
                <span class="fi-help-text booking_bathgoods_names">
                    <ul class="booking_ul">
                        <?php if(is_array($catelist)): $i = 0; $__LIST__ = $catelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="li" onclick="booking_delli(this);" data-id="<?php echo ($vo["id"]); ?>">【<?php echo ($vo["id"]); ?>】<?php echo ($vo["classname"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <input type="hidden" class="input" id="booking_bathgoods_ids" value="<?php echo ($info["cateid"]); ?>">
                </span>
            </div>
        </div>
    </div>
    <div class="jbox-buttons">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" id="select_class">确定</a>
        <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
    </div>
</div>
<!--商品分类2-->
<!--请选择商品标签1 -->
<div class="jbox fenlei select-tag disshow" style="height: auto;margin-top: -100px;width: 650px;left:40%;top:40%">
    <div class="jbox-title">
        <div class="jbox-title-txt">请选择商品标签</div>
        <a href="javascript:void(0);" class="jbox-close cancle"></a></div>
    <div class="jbox-container" style="height: auto;max-height:400px">
        <div class="formitems">
            <?php if(is_array($taglist)): $i = 0; $__LIST__ = $taglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="height: 30px;"><span style="border: 1px solid #eee;padding: 5px;cursor: pointer;" class='tag' data-id="<?php echo ($vo["id"]); ?>" data-type="0"><?php echo ($vo["classname"]); ?></span>
                </div>
                <ul>
                    <?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li style="height: 30px;margin: 10px 20px;display: inline-block;" data-id="<?php echo ($vv["id"]); ?>" data-type="1"><span style="border: 1px solid #eee;padding: 5px;"><?php echo ($vv["classname"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(empty($taglist)): ?><div style="height: 30px;">暂无标签，请先去新增标签!</div><?php endif; ?>
        </div>
    </div>
    <div class="jbox-buttons">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
    </div>
</div>
<!--请选择商品标签2 -->
<!-- sku1 -->
<!--新增规格1-->
<div class="jbox disshow editfenlei addguige" style="height:auto;">
    <div class="jbox-title">
        <div class="jbox-title-txt">选择规格名</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>名称：</label>
            <div class="form-controls">
                <input type="text" class="input" id="guige_title">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>新增名：</label>
            <div class="form-controls">
                <input type="text" class="input" name="newclass" placeholder="不填则不新增">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="jbox-buttons" style="text-align:center;">
            <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="add_guige('addguige')">确定</a>
        </div>
    </div>
</div>
<!--新增规格2-->
<!--新增规格属性1-->
<div class="jbox disshow editfenlei addguigeshuxing" style="height:auto;">
    <div class="jbox-title">
        <div class="jbox-title-txt">选择规格值</div>
        <a href="javascript:;" class="jbox-close cancle"></a>
    </div>
    <div class="jbox-container">
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>名称：</label>
            <div class="form-controls">
                <input type="text" class="input describe1" id="guigeshu_title">
                <input type="hidden" id="guigename" value="">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <div class="formitems">
            <label class="fi-name"><span class="colorRed"></span>新增值：</label>
            <div class="form-controls">
                <input type="text" class="input" name="newclass" placeholder="不填则不新增">
                <span class="fi-help-text"></span>
            </div>
        </div>
        <input type="hidden" name="pid" value="0">
        <input type="hidden" name="guigename" value="">
        <div class="jbox-buttons" style="text-align:center;">
            <a href="javascript:;" class="jbox-buttons-ok btn cancle">取消</a>
            <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="add_guige_shuxing('addguigeshuxing')">确定</a>
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
<script type="text/javascript" src="/Public/Admin/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/integral_goods/Integralliandong.js?v=2.0"></script>
<script type="text/javascript" src="/Public/Admin/Js/integral_goods/addgoods.js?v=3.2"></script>
<script charset="utf-8" src="/Public/Admin/Js/admincommon.js"></script>
<?php if(!empty($skulist)): ?><script>
window.onload=function(){
    var arr = JSON.parse('<?php echo ($skulist); ?>');
    $.each(arr,function(n,v){
        $('#createTable tbody tr .Txt_OPrice').eq(n).val(v.oprice);
        $('#createTable tbody tr .Txt_Price').eq(n).val(v.price);
        $('#createTable tbody tr .Txt_FPrice').eq(n).val(v.fprice);
        $('#createTable tbody tr .Txt_Store').eq(n).val(v.store);
        $('#createTable tbody tr .Txt_Number').eq(n).val(v.bar_code);
        $('#createTable tbody tr .Txt_Pic').eq(n).val(v.pic);
        $('#createTable tbody tr td').find("input[name='skulist[]']").eq(n).attr('data-attrskuid',v.id);
        $('#createTable tbody tr img').eq(n).attr('src',v.pic);
    });
    jisuanyuanjia();
    jisuanshoujia();
    jisuanchuchangjia();
    jisuanzongkucun();
}

</script><?php endif; ?>
<!--拖拽图片排序-->
<link rel="stylesheet" href="/Public/UploadImg/jquery.dad.css" />
<script src="/Public/UploadImg/jquery.dad.min.js"></script>
<script language="javascript">
    $('#J_imageView_1').dad({
        draggable: 'img'//拖拽区域
    });
</script>
<!--拖拽图片排序-->