<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11 0011
 * Time: 上午 8:31
 */  //当前时间
date_default_timezone_set('PRC');
$time=date('Y-m-d H:i:s',time());
//加密
$a="dee"+$time+"server";
$b=md5($a);
print_r($b);
echo  "<br/>";
print_r(substr($b,0,8));
echo  "<br/>";
print_r(substr($b,-8));
//$c=left($b,8) +"serverdee" + right($b,8);
//$timeencrty=md5($c);