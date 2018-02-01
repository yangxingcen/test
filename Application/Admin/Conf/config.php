<?php
return array(
    'MODULE_ALLOW_LIST' => array('Admin'),
    'DEFAULT_MODULE'    => 'Admin', //默认模块
    'URL_MODEL'         => '2',     //URL模式
    'SESSION_AUTO_START'=> true,    //是否开启session
    'SHOW_PAGE_TRACE'   => false,   //调试模式
    'TMPL_PARSE_STRING' =>array(
        '__ICO__'       => '/Public/images',
        '__JS__'        => '/Public/Admin/Js',
        '__CSS__'       => '/Public/Admin/Css',
        '__IMAGES__'    => '/Public/Admin/Images',
        '__LHG__'       => '/Public/Admin/lhgcalendar',
        '__SWF__'       => '/Public/Admin/Swf',
        '__JqColor__'   => '/Public/Admin/JqColor',
        '__UEDITOR__'   => '/Public/Ueditor',
        '__JEDATE__'    => '/Public/Jedate',
        '__HOST__'      =>  C('HOST'), 
        "__OSSURL__"    => '',                #阿里图片域名
        "__UPLOADIMG__" => '/Public/UploadImg',
        '__PROVINCE__'  =>  '/Public/ProvinceCity',     #省市区三级联动
    ),


    'URL_HTML_SUFFIX'=>'',//去掉后缀

//    'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/error_404.tpl', // 默认错误跳转对应的模板文件
//    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/success.tpl', // 默认成功跳转对应的模板文件
    #'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/exception_500.tpl',// 异常页面的模板文件
);