<?php
return array(
	//'配置项'=>'配置值'
            
        'MODULE_ALLOW_LIST' => array('Wx'),
        'DEFAULT_MODULE'     => 'Wx', //默认模块
        'URL_MODEL'          => '2', //URL模式
        'SESSION_AUTO_START' => true, //是否开启session


        'TMPL_PARSE_STRING'  =>array(
            '__AJS__'     => C('HOST') . '/Public/admin/Js',
            '__JS__'      => C('HOST') . '/Public/Wx/Js',
            '__CSS__'     => C('HOST') . '/Public/Wx/Css',
            '__HEAD__'    => C('HOST') . '/Public/Wx/head',
            '__IMAGES__'  => C('HOST') . '/Public/Wx/Images',
            '__IMG__'     => C('HOST') . '/Public/Wx/img',
            '__IMAGES1__' => C('HOST') . '/Public/Wx/Images1',
            '__ASSETS__'  => C('HOST') . '/Public/Wx/Assets',
            '__SWF__'     => C('HOST') . '/Public/Wx/Swf',
            '__FONTS__'   => C('HOST') . '/Public/Wx/Fonts',
            '__SCRIPT__'  => C('HOST') . '/Public/Wx/script',
            '__STYLE__'   => C('HOST') . '/Public/Wx/style',
            '__ZJDJS__'   => C('HOST') . '/Public/Wx/zajindan/js',
            '__ZJDCSS__'  => C('HOST') . '/Public/Wx/zajindan/css',
            '__GGLJS__'   => C('HOST') . '/Public/Wx/guaguale/js',
            '__GGLCSS__'  => C('HOST') . '/Public/Wx/guaguale/css',
            '__DZPJS__'   => C('HOST') . '/Public/Wx/dazhuanpan/js',
            '__DZPCSS__'  => C('HOST') . '/Public/Wx/dazhuanpan/css',
            '__HOST__'    => C('HOST'),
        ),
        #'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/error_404.tpl', // 默认错误跳转对应的模板文件
        #'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/success.tpl', // 默认成功跳转对应的模板文件
        #'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/exception_500.tpl',// 异常页面的模板文件
);
