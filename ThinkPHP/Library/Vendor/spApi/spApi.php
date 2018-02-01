<?php

/**
 * Created by PhpStorm.
 * User: hc
 * Date: 2016/5/31
 * Time: 13:51
 */
class spApi
{
    //Define
    private $spCode = '';   //APPID
    private $userName = '';  //APPKey

    //GET
    private $key = '';

    //Make
    private $_sign;

    //API
    private $apiUrl = '';

  //构造方法
    function __construct($spCode,$userName,$key,$apiUrl){
        $this->spCode = $spCode;
        $this->userName = $userName;
        $this->key = $key;
        $this->apiUrl = $apiUrl;
    }

    //测试
    public function v6test($url,$arr){
        $arr['spCode'] = $this->spCode;
        $arr['userName'] = $this->userName;
        $key = $this->key;
        $url = $this->apiUrl.$url;
        $serialNumber = $arr['serialNumber'];

        foreach($arr as $k=> $v ){
            if($v =='' || $k = 'serialNumber'){
                unset($arr[$k]);
            }
        }
        $sign = $this->sign($arr,$this->key);
        $arr['sign'] =$sign;
        $arr['serialNumber'] = $serialNumber;
        $str = http_build_query($arr);
        $result_code = $this->post1($url,$str);
        dump($result_code);die;
        $return = $this->result($result_code);


        return $return;
    }

    //返回数组

    private function result($data){
        $data = json_decode($data,true);
        $result['info'] = $data['returnMsg'];
        $result['status'] = $data['returnCode'];
        return $result;

    }
    //签名构成
    private function sign($param,$key)
    {
        $param['userName'] = $param['userName'].$key;
        ksort($param);
        $open = array();
        foreach ($param as $key => $val) {
            array_push($open, $key . '=' . $val);
        }
        $open = implode('&', $open);
        $sign = md5($open);
        return $sign;

    }

    //调用接口
    private function post1($url,$data){
        $ch = curl_init();
        $header[] = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $aStatus = curl_getinfo($ch);
        curl_close($ch);
        return $output;

    }

}

class test{

    function testcms(){
         $methodUrl = "/cmc/sms/send";
		$data =array('text'=>'超限额是','textTemplateId'=>"",'scheduleTime'=>"",'sendObject'=>"13391180201,13396352365",'serialNumber'=>'20160309100352000003');
		$api = new spApiV6('260003','ep_001','11WxiYzqf1icJ5kr0GywNj/Isc/9kqYG','http://10.0.0.111:9071/sp-api');
        $api->v6test($methodUrl,$data);

    }
}