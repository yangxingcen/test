<?php
namespace Common\Controller;
use Think\Controller;
class AliRefundsController extends Controller
{   //支付宝退款接口
    public function _initialize()
    {   //初始化类
        
    }
    public function index()
    {   //文件初始化类库
        exit("end");
    }
    public function aliRefund($orderno,$out_trade_no,$trade_no,$money,$refund_reason,$orderid)
    {   //"partner"=>"2088721350721657",  //商户订单号,支付号,支付宝交易号,金额,退款理由,订单ID
        if(!($orderno && $out_trade_no && $money && $refund_reason && $orderid)){    //判断参数
            return false;
        }
        $out_trade_no= $out_trade_no ? $out_trade_no : $orderno;
        $setbizstring=array(
            'out_trade_no'  => $out_trade_no,              //订单支付时传入的商户订单号,不能和 trade_no同时为空。
            'trade_no'      => $trade_no,             //支付宝交易号，和商户订单号不能同时为空
            'refund_amount' => $money,                //退款金额
            'refund_reason' => $refund_reason,        //退款原因
            'out_request_no'=> 'SD02RF'.substr($out_trade_no,0,4).$orderid,   //标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
        );
        Vendor('Ali.aop.AopClient');
        Vendor('Ali.aop.request.AlipayTradeRefundRequest');
        $aop                = new \AopClient();
        $aop->gatewayUrl    = 'https://openapi.alipay.com/gateway.do';
        $aop->appId         = '2017093009009407';
        $aop->rsaPrivateKey = 'MIIEogIBAAKCAQEA12NpX9PKJS9X61mMg9owbG/WopMNV/xZqmG/QZJfzKQGtJdh+6/TqwZyfVlkWtT30mkoXVAV+B3pEx5Sooczsdq/8o9+RwcAseKrJ1uELQsVj9HIaI2r3c8HJ7Nw+tzxXSPBGeApLdUGIQj2pmJ6YUKkTN2yJY6CUULHTXt+Pr0FIeIGnwQAonsD6UdgNKNZlhia0YBU5vensfc6ywHoy0JkxGv2ghpZHei/mtBIDfSG7/lnBscpEWD7hjeXQmVOKdS7dVNaPYm7N2G3aV/xqUKmOWDOr/cH+eEo+1ts94Uty9rtlaKoZleR+gBhH145c1CyQxxwtmndiDBv+IqCDQIDAQABAoIBAC85U6Q4Ck0m2S73vlA2aYGM79FLTpSo9nvd3JIi5rA2kmXL/yawwUbxLe7/x3oG0aMnfTsgUQDKhgy0DEgoPpRTMtyay4QFLAjUetQxQ4SgtoSG6VrLHRCP0LDKrg3CnYTfTvo+ZKjw2NwrW/DVDKIAe4eC4AlN+pKYgpwhZGeaoKomEILoNidGZmkRBhmVxEnlZUJTasFzjg2XgF0YhlRVpxzBp4nEkUjXWd3QCCKZECQgbHYaqa46G0Xm+tEmh3XNBnLQAlUY/QqAnhvEUfSdNPUZ/T9U4k1br5lO0ceRSgQOKFptW/yNJzVElyGc79IqEB6h/mUr95kYraCbgUECgYEA+8hxHHLplMrWNfjCtjE3qZbCl331iXhfxAc+9JSGnmYUYaO93MZINjBzg5XeFbBwKf7QSoMz5L01e8To9g97eCMAnTLfMbGnWPqOJ9mRARnBteDcThfnQhzzeavSL/NIfKheJ2n7z6ViSD+lfvu2rb7/HMjqlWIraFfopbqIfTECgYEA2v7sEN6ShMtJjkq/yvrsu2NO1JBfSUUKYnYwH8pko4OXmbhaXAUdUc/1/zEvcxSAxNMTr5g0Qd9DphhjTShp3qTQOtbs3C9ApXwY+rgMIA8+EJHVQbKEJ4bXU4o3CHzZ34+zEgVsZwRjxSaOVEiamn1t43/k1k1OmnDlBbUWq50CgYBvNL7Qw+hrMZOfTvohImflXZMg+h9C0onpuRGTUS6MM6X44itvoZwvYwMCMWVfywgfZE53Oq/m7bL7saL7Wyc7jqosxFVUS5UQdcnny+6Bv/CQ9noXe/NGficDrGIvj5KKjIrZebQgqHlaU9Iy3dZ3sw5Wll8WD8AAXCODX3n9YQKBgByLKX2xZOuGC5pOR91PA1gRQ48VGjZUl1vqB6+9E4z0c+gHTU+9Iuss7eVLJeIcBASjdmdmsTj8vraBaz/9Sn9IgBOLO+gfCJAJMsBLCNmM4wwJ1f/wIqV8P8iVtUKX81XeRvrMViq/ObnSoq59oBkOzCng25TLErmyiUdLKR9JAoGAUhoPhmaUHPW6HxzbN8raeFp4Q8GWiY9jxhN6Xx5kIwbmoXpzB/1mX7TwBxGS5a64fL1yXpXnwoVayMz1c1hbiJ6lEeLdllxGma+IKe/pf46Yt4IilSdcb0f57al7bPL4/LqLkwnesc9rjM8OrbyF4AG1T4475kyCbmjoK8P17v8=';
        $aop->alipayrsaPublicKey='MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnNDDAaeUjJqBothQPZ+/+8pPm2NK5NKRsge0nLd2G/E0VxhQHVvFRi6htwEaaWuyjYXPfAdJbL5QKLMnTKnMfwJchWfMigMo6TLsqSCIJv7Eg+tGIdkaITffRqCkZdsQo6RK+cgaOQ4X29gDUkldH911kYjRAJDzeNLuG4mzBmD2Z+Wnd/NpebAFdGnm7rJ6UHAcR1zcScUolOiXewPuzmIcMhqLJQaA35uE/SdgoaRCshHGxLNn5JPZOgFIEIVsgKATL4/sQROJoFahOLw4KQwZXPKkVww5tu+g33qSKeTiaPEvlS27VwXoOZQFEgYbBEHpUVDXhMP2uvEHt7yh1QIDAQAB';
        $aop->apiVersion    = '1.0';
        $aop->signType      = 'RSA2';
        $aop->postCharset   = 'UTF-8';
        $aop->format        ='json';
        $request            = new \AlipayTradeRefundRequest ();
        $request->setBizContent(json_encode($setbizstring));
        $result             = $aop->execute($request);
        $responseNode       = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode         = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){   //退款成功
            return array('status'=>1,'into'=>'退款成功');
        }
        file_put_contents("./log/Alipay/refund/{$orderno}.txt",print_r(array($result,date('Y-m-d H:i:s',time())),true).PHP_EOL,FILE_APPEND);
        return array('status'=>0,'into'=>'退款失败');
    }
}

