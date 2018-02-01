<?php
namespace Common\Controller;
use Think\Controller;
class KuaiDiController extends Controller
{   #快递接口
    private     $AppKey;
    protected   $typeCom;
    protected   $typeNu;
    public function _initialize()
    {
        //$this->AppKey = 'hyUYUyGb6378';
        $this->AppKey = '40D2A2F3EF4D374B2D053ED1C566A782';
    }
    public function index()
    {
        exit("end");
    }
    public function Inquire($typeCom='',$typeNu='')
    {   #查询  快递公司,快递单号
        if($typeCom && $typeNu){
            $url  = 'http://api.kuaidi100.com/api?id=';
            $url .= $this->AppKey.'&com='.$typeCom.'&nu='.$typeNu.'&show=0&muti=1&order=desc';
            if (function_exists('curl_init') == 1){
                
                $curl = curl_init();
                curl_setopt ($curl, CURLOPT_URL, $url);
                curl_setopt ($curl, CURLOPT_HEADER,0);
                curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
                curl_setopt ($curl, CURLOPT_TIMEOUT,5);
                $get_content = curl_exec($curl);
                curl_close ($curl);
                $reponse = json_decode($get_content,true);
                if($reponse['status'] == 0){
                    return array('result'=>$reponse['status'],'info'=>$reponse['message']);
                }else{
                    
                }
                return $reponse;
            }
        }
        return array('result'=>0,'info'=>'没有快递信息');
    }
}

