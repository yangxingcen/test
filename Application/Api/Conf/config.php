<?php
return array(
	//'配置项'=>'配置值'

        'MODULE_ALLOW_LIST' => array('Api'),
        'DEFAULT_MODULE'     => 'Api', //默认模块
        'URL_MODEL'          => '2', //URL模式
        'SESSION_AUTO_START' => true, //是否开启session

        //'配置项'=>'配置值'
        'TMPL_PARSE_STRING' => array(
            '__JS__'        => C('HOST').'/Public/Shop/js',
        ),

        'URL_ROUTER_ON'         => true,
        'URL_MAP_RULES'         => array(

        ),

    //'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/error_404.tpl', // 默认错误跳转对应的模板文件
//    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/success.tpl', // 默认成功跳转对应的模板文件
//    'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/exception_500.tpl',// 异常页面的模板文件
);
