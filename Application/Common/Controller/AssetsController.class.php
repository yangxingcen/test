<?php
# 资产操作  余额,积分,佣金,种子  加减
# Cyonger iwanjiao@qq.com 201710141515
namespace Common\Controller;
use Think\Controller;
class AssetsController extends Controller
{   #余额退款接口
    public function index()
    {   
        exit("end");
    }
    public function balanceRefund($userid,$money,$orderid,$remark='')
    {   #减少
        if($userid && $money && $orderid){
            $remark = $remark ? $remark : '减少';
            return $this->assetsAddEdit('wallet',$userid,0,$money,$orderid,2,$remark);
        }
        return array('status'=>0,'into'=>'参数错误');
    }
    public function balancePay($userid,$money,$orderid,$remark='')
    {   #增加
        if($userid && $money && $orderid){
            $remark = $remark ? $remark : '减少';
            return $this->assetsAddEdit('wallet',$userid,1,$money,$orderid,2,$remark);
        }
        return array('status'=>0,'into'=>'参数错误');
    }
    private function assetsAddEdit($field,$userid,$type,$money,$fromid=0,$genre=0,$remark='')
    {   #加减余额
        switch($field){
            case 'integral':
                $moneytype = 1;
            break;
            case 'wallet':
                $moneytype = 0;
            break;
            case 'seed':
                $moneytype = 3;
            break;
            case 'commission':
                $moneytype = 2;
            break;
            default:
                return array('status'=>0,'into'=>'错误的请求');
            break;
        }
        if($money > 0.01){
            $before= M('member')->where(array('id'=>$userid))->order('id DESC')->getField($field);
            if($type){      #减少
                if($before >= $money){
                    $type=1;
                    $now = (float)$before - (float)$money;
                }else{
                    return array('status'=>0,'into'=>'余额不足');
                }
            }else{          #增加
                $type= 0;
                $now = (float)$before + (float)$money;
            }
            M()->startTrans();
            $id = M('member')->where(array('id'=>$userid))->order('id DESC')->setField($field,$now);
            if($id){
                $data  = array(
                    'userid'   => $userid,
                    'addtime'  => date('Y-m-d H:i:s',NOW_TIME),
                    'before'   => $before,
                    'money'    => $money,
                    'now'      => $now,
                    'type'     => $type,
                    'fromid'   => $fromid,
                    'genre'    => $genre,
                    'remark'   => $remark,
                    'moneytype'=> $moneytype,
                );
                $id = M('money_record')->add($data);
                if($id){
                    M()->commit();
                    return array('status'=>1,'into'=>'支付成功');
                }
            }
            M()->rollback();
            return array('status'=>0,'into'=>'支付失败');
        }
        return array('status'=>0,'into'=>'支付金额必须大于0');
    }
}

