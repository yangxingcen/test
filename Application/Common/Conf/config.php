<?php
//return array(
    //'配置项'=>'配置值'
//);
return array(
    'MODULE_ALLOW_LIST' => array('Admin','Shop','Wx','Api'),
    'DEFAULT_MODULE'     => 'Admin',                                            //默认模块
    'URL_MODEL'          => '2',                                                //URL模式
    'SESSION_AUTO_START' => true,                                               //是否开启session
    //更多配置参数
    //'URL_HTML_SUFFIX' => 'html|shtml|xml',                                    // 多个伪静态后缀设置 用|分割
    /* 数据库设置 */
    'DB_TYPE'               => 'mysql',                                         // 数据库类型
    'DB_HOST'               => '127.0.0.1',                                     // 服务器地址
    'DB_NAME'               => 'deyilao',                                          // 数据库名
    'DB_USER'               => 'root',                                          // 用户名
    'DB_PWD'                => 'root',                                          // 密码
    'DB_PORT'               => '3306',                                          // 端口
    'DB_PREFIX'             => 'tb_',                                          // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    => false,                                           // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       => false,                                           // 启用字段缓存
    'DB_CHARSET'            => 'utf8',                                          // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        => 0,                                               // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        => false,                                           // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         => 1,                                               // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           => '',                                              // 指定从服务器序号
    'DB_SQL_BUILD_CACHE'    => false,                                           // 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    => 'file',                                          // SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   => 20000,                                           // SQL缓存的队列长度
    'DB_SQL_LOG'            => false,                                           // SQL执行日志记录
    /* 数据库设置 */
    "over_time"             => 120,                                             // 验证码过期时间
    "PASS_KEY"              => 'unohachahangzhou',
    'ALIOSS_CONFIG'         => array(
        'KEY_ID'            => '',                                              // 阿里云oss key_id
        'KEY_SECRET'        => '',                                              // 阿里云oss key_secret
        'END_POINT'         => '',                                              // 阿里云oss endpoint
        'BUCKET'            => ''  	                                            // bucken 名称
    ),
    "OSSURL"                => '',                                              //阿里图片域名
    'HOST'                  => 'http://www.deyishoplao.com',                         //本机域名

    'URL_ROUTER_ON'   => true,
    'URL_MAP_RULES'=> array(
        'wx_register'       => 'Wx/User/reg',                       /*注册*/
        'wx_login'          => 'Wx/User/login',                     /*登录*/
'wx_forget_password'   => 'Wx/User/forget',                 /*忘记密码*/
            'wx_forget_password1'   => 'Wx/User/forget1',                 /*忘记密码*/
            'wx_use'   => 'Wx/User/h5view',                 /*忘记密码*/
        'wx_ucenter'        => 'Wx/Ucenter/index',                  //个人中心
        'wx_index'          => 'Wx/Index/index',                    //首页
        'wx_cart'           => 'Wx/Order/cart',                     //购物车
        'wx_goodslist'      => 'Wx/Goods/goodsList',                //商品分类
        'wx_search'         => 'Wx/Index/search',                   //导航搜索
        'wx_activity'       => 'Wx/Activity/index',                 //活动
        'wx_meal'           => 'Wx/Meal/meal',                     //热卖组合
        'wx_integral'       => 'Wx/Integral/index',                 //积分商城
        'wx_product'        => 'Wx/Goods/product',                  //全部产品
        'wx_detail'         => 'Wx/Goods/detail',                   //全部产品
        'wx_buy'            => 'Wx/Order/buy',                      //立即购买
        'wx_address'        => 'Wx/Ucenter/address',                //地址管理
        'wx_add_address'    => 'Wx/Ucenter/add_address',            //添加地址
        'wx_update_address' => 'Wx/Ucenter/update_address',         //修改地址
        'wx_my_info'        => 'Wx/Ucenter/myInfo',                 /*个人中心设置*/
        'wx_my_set'         => 'Wx/Ucenter/mySet',                  /*个人设置*/
        'wx_my_name'        => 'Wx/Ucenter/myName',                 /*修改用户名页面*/
        'wx_my_password'    => 'Wx/Ucenter/myPassword',             /*修改用密码页面*/
        'wx_integral_add'   => 'Wx/Ucenter/getIntegral',            /*赚取积分*/
        'wx_integral_info'  => 'Wx/Ucenter/integralInfo',           /*积分明细*/
'wx_integral_detail'           => 'Wx/Integral/integralDetail',       /*积分商品详情*/
            'wx_sale_inner'           => 'Wx/Index/sale_inner',       /*积分商品详情*/
            'wx_product_pj'           => 'Wx/Index/product_pj',       /*商品评价*/

        ),

    
);