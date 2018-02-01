<?php
return array(
	//'配置项'=>'配置值'

        'MODULE_ALLOW_LIST' => array('Shop'),
        'DEFAULT_MODULE'     => 'Shop', //默认模块
        'URL_MODEL'          => '2', //URL模式
        'SESSION_AUTO_START' => true, //是否开启session

        //'配置项'=>'配置值'
        'TMPL_PARSE_STRING' => array(
            '__JS__'        => C('HOST').'/Public/Shop/js',
            '__CSS__'       => C('HOST').'/Public/Shop/css',
            '__IMAGES__'    => C('HOST').'/Public/Shop/images',
	        '__HOST__'	    => C('HOST'),

        ),

        'URL_ROUTER_ON'         => true,
        'URL_MAP_RULES'         => array(
            'register'          => 'Shop/User/reg',                   /*注册*/
            'login'             => 'Shop/User/login',                 /*登录*/
            'doLogin'           => 'Shop/User/doLogin',               /*执行登录*/
            'forgetPass'        => 'Shop/User/forgetPass',            /*忘记密码*/
            'goodslist'         => 'Shop/Goods/goodsList',            /*产品中心*/
            'timer'             => 'Shop/Timer/index',                /*限时特惠*/
            'timerDetail'       => 'Shop/Timer/detail',                /*限时特惠详情*/
            'detail'            => 'Shop/Goods/detail',               /*产品详情*/
            'buy'               => 'Shop/Order/buy',                  /*立即购买*/
            'addtocart'         => 'Shop/Order/addToCart',            /*加入购物车*/
            'mealDetail'        => 'Shop/Meal/detail',                /*套餐详情*/
            'mealList'          => 'Shop/Meal/index',                 /*套餐列表页*/
            'activity'          => 'Shop/Activity/index',             /*活动促销*/
            'activity'          => 'Shop/Activity/index',             /*活动促销*/
            'order'             => 'Shop/Order/order',                /*下单*/
            'paysuccess'        => 'Shop/Order/paySuccess',       /*付款成功*/
            'pays'              => 'Shop/Order/pays',       /*付款页面*/
            'company'           => 'Shop/User/company',
            'companyRegister'   => 'Shop/User/companyRegister',
            'loginOut'          => 'Shop/User/LoginOut',
            'protocol'          => 'Shop/User/protocol',
            'forget'            => 'Shop/User/forget',
            'login_find'        => 'Shop/User/login_find',
            'about'             => 'Shop/About/index',
            'qualification'     => 'Shop/About/qualification',
            'general'           => 'Shop/About/general',
            'connectUs'         => 'Shop/About/connectUs',
            'operating'         => 'Shop/About/operating',
            'riskControl'       => 'Shop/About/riskControl',
            'law'               => 'Shop/About/law',
            'fund'              => 'Shop/About/fund',
            'needLoan'          => 'Shop/Loan/needLoan',
            'prodot'            => 'Shop/Product/prodot',
            'gopay'             => 'Shop/Product/gopay',
            'main'              => 'Shop/Index/index',
            'dream'             => 'Shop/Index/Dream',
            'DreamInfo'         => 'Shop/Index/DreamInfo',
            'goods_cart'        => 'Shop/Order/cart',
            'my_index'          => 'Shop/Ucenter/index',       /*个人中心首页*/
            'my_info'           => 'Shop/Ucenter/myInfo',       /*个人中心我的资料*/
            'my_editinfo'       => 'Shop/Ucenter/editInfo',       /*修改我的资料*/
            'my_bankcard'       => 'Shop/Ucenter/myBankCard',       /*银行卡*/
            'my_address'        => 'Shop/Ucenter/address',       /*收货地址*/
            'my_addaddress'     => 'Shop/Ucenter/addAddress',       /*添加收货地址*/
	    'my_collections'     => 'Shop/Ucenter/collections',       /*我的收藏夹*/
	    'my_orderList'      => 'Shop/Ucenter/myOrderList',       /*我的订单*/
	    'my_orderdetail'      => 'Shop/Ucenter/orderDetail',       /*我的订单详情页*/
            //王煦航
            'integral'          => 'Shop/Integral/index',           //积分中心首页
            'integral_del'      => 'Shop/Integral/detail',          //积分中心详情页
            'integral_add'      => 'Shop/Integral/addIntegral',          //如何获取积分
            'my_integral'       => 'Shop/Ucenter/credits',          //如何获取积分
            'my_order'          => 'Shop/Integral/order',          //订单页面
            'myOrderList'       => 'Shop/Ucenter/conversionRecord',          //订单列表
            'myOrderInfo'       => 'Shop/Ucenter/user_inner',            //订单详情
	     'saveComment'      => 'Shop/Ucenter/saveComment',            //评价
            'conversionRecord'      => 'Shop/Ucenter/conversionRecord',            //积分兑换记录		
			
			
			//商城资讯
			'announ'            => 'Shop/Announ/announ',
			'announ2'           => 'Shop/Announ/announ2', 
			'announ3'           => 'Shop/Announ/announ3',
			'announ_inner'      => 'Shop/Announ/announ_inner',			
			'announ_inner2'     => 'Shop/Announ/announ_inner2',	
			'integ1'            => 'Shop/Integral/integ1',			
			'integ2'            => 'Shop/Integral/integ2',			
        ),

    //'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/error_404.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/success.tpl', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/exception_500.tpl',// 异常页面的模板文件
);
