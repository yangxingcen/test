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
            <h1 class="content-right-title">商品搭配<a href="javascript:history.go(-1);" style="float:right" class="btn" title="返回"><i class="gicon-chevron-left"></i></a></h1>
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
                <a href="<?php echo U('/Admin/goods/match/',array('class'=>1,'id'=>$goods_id));?>"
                   class="<?php if(($status) == "1"): ?>active<?php endif; ?> tabs_a fl">类似风格(<?php echo ((isset($count1) && ($count1 !== ""))?($count1):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/goods/match/',array('class'=>2,'id'=>$goods_id));?>"
                   class="<?php if(($status) == "2"): ?>active<?php endif; ?> tabs_a fl">推荐同等价位(<?php echo ((isset($count2) && ($count2 !== ""))?($count2):'0'); ?>)</a>
                <a href="<?php echo U('/Admin/goods/match/',array('class'=>3,'id'=>$goods_id));?>"
                   class="<?php if(($status) == "3"): ?>active<?php endif; ?> tabs_a fl">推荐同类热销品(<?php echo ((isset($count3) && ($count3 !== ""))?($count3):'0'); ?>)</a>
            </div>
            <table class="wxtables mgt10" style="text-align:center;">
                <thead>
                <tr class="po_list">
                    <td><i class="icon_check"></i></td>
                    <td>ID</td>
                    <td>商品标题</td>
                    <td>价格(元)</td>
                    <td>库存<br/>销量</td>
                    <!--<td>开始时间<br/>结束时间</td>-->
                    <!--<td>上架</td>-->
                    <!--<td>回收站</td>-->
                    <td>排序</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($cache)): foreach($cache as $key=>$vo): ?><tr>
                        <td><input type="checkbox" class="checkbox table-ckbs" value="<?php echo ($vo['mh_id']); ?>"></td>
                        <td><?php echo ($vo["mh_id"]); ?></td>
                        <td align="left"><div class="table-item-img" style="float: left"><img src="<?php echo ($vo['logo_pic']); ?>" alt=""></div><div><?php echo ($vo["goods_name"]); ?></div></td>
                        <td>￥<?php echo ($vo["price"]); ?>元</td>
                        <td><?php echo ($vo["stock"]); ?><br/><?php echo ($vo["sales"]); ?></td>


                        <td width="100px">

                            <input  type="text" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onblur="changeTableVal('goods_match','mh_id',<?php echo ($vo['mh_id']); ?>,'sorts',this)" size="4" value="<?php echo ($vo["sorts"]); ?>"  style="width: 45px;border-radius: 4px;">

                        <td>
                            <a href="javascript:;" class="btn btn-danger " onclick="Y_del_match(this)"  data-item="is_del" data-id="<?php echo ($vo["mh_id"]); ?>"  data-dan="dan" title="删除"><i class="gicon-trash white"></i></a>

                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <!-- end wxtables -->
            <div class="tables-btmctrl clearfix">
                <div style="margin:4px 0px;">
                    <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                    <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                    <a href="javascript:;" class="btn btn-danger " onclick="Y_del_match(this)"  data-item="is_del" data-value="0"  title="删除"><i class="gicon-trash white"></i></a>
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
                <label class="fi-name" style="width: 100px"><span class="colorRed"></span>搭配类型：</label>
                <div class="form-controls" style="margin-left:0px;float: left">
                    <select name='status' class="select" id="select_status">
                        <option value="">请选择</option>
                        <option value="1">推荐类似风格</option>
                        <option value="2">推荐同等价位</option>
                        <option value="3">推荐同类热销</option>
                    </select>
                    <span class="fi-help-text"></span>
                </div>

                <label class="fi-name" style="width: 80px"><span class="colorRed"></span>商品类型：</label>
                <div class="form-controls" style="margin-left:0px;float: left;display: inline" >
                    <select name='goods_type' class="select" id="select_goods_type">
                        <option value="">普通商品</option>
                        <option value="1">活动商品</option>
                    </select>
                    <span class="fi-help-text"></span>
                </div>
            </div>

            <div class="formitems">
                <label class="fi-name" style="width: 100px"><span class="colorRed"></span>商品名称：</label>
                <div class="form-controls" style="margin-left:0px;float: left">
                    <input type="text" class="input xxlarge" name="keyword" placeholder="请输入搜索的商品名称" style="width: 425px">
                </div>
                <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_SelectGood(this)">确定</a>
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
        <input type="hidden" name="type" id="type" value="">
        <a href="javascript:void(0);" class="jbox-buttons-ok btn btn-primary" onclick="J_Confirm_Select(this)">确定添加</a>
        <a href="javascript:void(0);" class="jbox-buttons-ok btn cancle">取消</a>
    </div>
</div>


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

    function J_Add(obj,num){
        $('input[name=isactivity]').val(num);
        $('#albums-overlay').show();
        $('.select-goods').show();
    }


    /*营销活动搜索商品 确定选择 1*/

    $("#select_goods_type").change(function(){
        var goods_type=$("#select_goods_type  option:selected").val();
        $("#type").val(goods_type);
    });
    function J_Confirm_Select(obj){
        console.log(11);

        var status = $('#select_status').val();
        if(!status){
            dialog.showTips('请选择搭配类型','warn');return false;
        }
        var post     = {};
        post.goods_id = "<?php echo ($goods_id); ?>";
        post.status = status;
        post.type =  $("#type").val();

        var goods_ids= '';
        $("input[type=checkbox]:checked").each(function(){
            var id =$(this).val()?$(this).val():"";
            goods_ids +=','+id;
        });
        if(!goods_ids){
            dialog.showTips('请选择操作对象1','warn');return false;
        }
        post.goods_ids  = goods_ids;
        $(".loader" ).fadeIn("fast");
        console.log(post);
        $.post("/Admin/Goods/do_match", post, function (res) {
            $(".loader" ).fadeOut("fast");
            if (res.status == 1) {
                dialog.showTips(res.info,'',1);
                return false;
            }
            dialog.showTips(res.info,'warn');
            return false;
        }, "json")

    }

    function J_SelectGood(obj){
        var post ={};
        post.keyword = $(obj).prev().find('input').val();
        post.goods_type =  $('#select_goods_type').val();

        if(!post.keyword){
            dialog.showTips('请输入搜索的商品标题');
        }

        $(".loader" ).fadeIn("fast");
        $.post("/Admin/Goods/goods_match_select", post, function (result) {

            $(".loader" ).fadeOut("fast");
            if (result.status == 1) {
                $(".goods_list").empty().append(result.data);
                return false;
            }
            dialog.showTips(result.info,'warn');
            return false;
        }, "json")
    }
/*
删除商品搭配  单个
 */
    function Y_del_match(obj){
        var dan=$(obj).attr("data-dan");
        if(dan=='dan'){
        var id=$(obj).attr("data-id");
        }else{
        var id='';
            $("input[type=checkbox]:checked").each(function(){
                var goods_ids =$(this).val()?$(this).val():"";
                id +=','+goods_ids;
            });
        }


        dialog.showTips("确定要进行操作吗?", "firm", function () {


                $.ajax({
                    url: "<?php echo U('/Admin/Goods/del_match');?>",
                    type:'post',
                    data : 'id='+id ,
                    success : function(data){
                        if(data.status==1){
                            dialog.showTips(data.info, "",1);
                        }else{
                            dialog.showTips(data.info, "warn");
                        }
                    }
                });

        })


    }

    /*
     删除商品搭配  全选
     */
    function Y_del_match_all(obj){

        var id=$(obj).attr("data-id");


        dialog.showTips("确定要进行操作吗?", "firm", function () {


            $.ajax({
                url: "<?php echo U('/Admin/Goods/del_match');?>",
                type:'post',
                data : 'id='+id ,
                success : function(data){
                    if(data.status==1){
                        dialog.showTips(data.info, "",1);
                    }else{
                        dialog.showTips(data.info, "warn");
                    }
                }
            });

        })


    }


    /*更新排序 */

    function changeTableVal(table,id_name,id_value,field,obj)
    {

            var value = $(obj).val();


        $.ajax({
            url:"/index.php?m=Admin&c=Goods&a=match_order&table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,
            success: function(data){
                if(!$(obj).hasClass('no') && !$(obj).hasClass('yes'))


                dialog.showTips("更新成功", "",1);
            }
        });
    }
</script>