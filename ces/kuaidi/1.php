<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11 0011
 * Time: 上午 10:56
 */


/**
 * 得到物流信息
 * @param express_ma   物流公司标志
 * @param express_no   物流单号
 */
function get_express_message($express_ma, $express_no)
{
    if($express_ma && $express_no){
        //参数设置
        $post_data = array();
        $post_data["customer"]  = '40D2A2F3EF4D374B2D053ED1C566A782';
        $key                    = 'hyUYUyGb6378' ;
        $post_data["param"]     = '{"com":"'.$express_ma.'","num":"'.$express_no.'"}';

        $url='http://poll.kuaidi100.com/poll/query.do';
            $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
            $post_data["sign"] = strtoupper($post_data["sign"]);
        $o="";
        foreach ($post_data as $k=>$v){
            $o.= "$k=".urlencode($v)."&";       //默认UTF-8编码格式
        }
        $post_data=substr($o,0,-1);
        $curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, $url);
        curl_setopt ($curl, CURLOPT_HEADER,0);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
        curl_setopt ($curl, CURLOPT_TIMEOUT,5);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $post_data);

        $result = curl_exec($curl);
        $data = str_replace("\"",'"',$result );
        $data = json_decode($data,true);
        if($data['message'] =='ok'){
            return array(1,$data['data']);
        }
        return array(0,'没有物流信息');
    }
    return array(0,'物流参数错误');
}

echo  get_express_message('zhongtong','474157561148');