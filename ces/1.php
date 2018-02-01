<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 22:57
 */
//手机号替换为****
//$newMobile2 = substr_replace(15857176461, '****', 5, 4);
//echo $newMobile2.'<br/>';



//当前时间加+天数
date_default_timezone_set('PRC');
//$t=time();
//$day=1;
//$dainq=date('Y-m-d H:i:s',strtotime("+".$day."day",time()));
//
//echo  date('Y-m-d H:i:s',$dainq);
//前一天时间
echo "昨天:",date("Ymd",strtotime("-1 day")), "<br>";
//1000.00
//echo sprintf("%.10f", 1000);

//根据时间判断是星期几

//function get_week($time){
//    $arr = array("周一","周二","周三","周四","周五","周六","周日");
//    $num =  date("N",$time);
//    return $arr[$num-1];
//}

//格式化时间，并且判断2月是否是29天；
//function run_year($year){
//    $time = mktime(20,20,20,2,1,$year);//取得一个日期的 Unix 时间戳;
//    if (date("t",$time)==29){ //格式化时间，并且判断2月是否是29天；
//        return $year."-02-29";//是29天就输出时闰年；
//    }else{
//        return $year."-02-28";
//    }
//}