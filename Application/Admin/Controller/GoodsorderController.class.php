<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 下午 16:45
 */

namespace Admin\Controller;


class GoodsorderController extends AdminCommonController
{
    public function index()
    {

        $whe = ['is_del'=>0];
        $orderModel = M('order_info');

        $order_status = I('order_status');
        if($order_status!=null){
            $whe['order_status'] = $order_status;
        }

        $name = I('name');
        if($name){
            $whe['order_no'] = array('like',"%{$name}%");
        }

        $starttime      = I('starttime');
        if (!empty($starttime)) {
            $starttime      = strtotime($starttime);
            $whe['order_time']=array('egt',$starttime);
        }

        $endtime        = I('endtime');
        if (!empty($endtime)) {
            $endtime        = strtotime($endtime)+24*3600;
            $whe['order_time']=array('elt',$endtime);
        }

        $count = M('order_info')->where($whe)->count();
        $Page  = getpage($count,10);
        $show  = $Page->show();
        $list = M('order_info')->where($whe)->limit($Page->firstRow, $Page->listRows)->select();

        foreach($list as $k => &$v){
            $v['goods'] = M('order_goods')->where(['order_id'=>$v['id']])->select();
        }

        $count = $orderModel->where(['is_del'=>0])->count();              //已取消
        $count0 = $orderModel->where(['is_del'=>0,'order_status'=>0])->count();              //已取消
        $count1 = $orderModel->where(['is_del'=>0,'order_status'=>1])->count();              //待付款
        $count2 = $orderModel->where(['is_del'=>0,'order_status'=>2])->count();              //待发货
        $count3 = $orderModel->where(['is_del'=>0,'order_status'=>3])->count();              //已发货
        $count4 = $orderModel->where(['is_del'=>0,'order_status'=>4])->count();              //已完成
        $count5 = $orderModel->where(['is_del'=>0,'order_status'=>5])->count();              //已关闭
        $count6 = $orderModel->where(['is_del'=>0,'order_status'=>6])->count();              //退款中
        $count7 = $orderModel->where(['is_del'=>0,'order_status'=>7])->count();              //订单删除

        $this->assign('count',$count);
        $this->assign('count0',$count0);
        $this->assign('count1',$count1);
        $this->assign('count2',$count2);
        $this->assign('count3',$count3);
        $this->assign('count4',$count4);
        $this->assign('count5',$count5);
        $this->assign('count6',$count6);
        $this->assign('count7',$count7);

        $express = M("express")->select();
        $this->assign("express_list",$express);
        $this->assign('page',$show);
        $this->assign('cache',$list);
        $this->display();
    }

    //查看详情
    public function orderDetail()
    {
        $id = I('id');
        $order = [];
        if($id){
            $order = M('order_info')->where(['id'=>$id])->find();
            if($order){
                $order['goods'] = M('order_goods')->where(['order_id'=>$order['id']])->select();
                $order['user'] = M('member')->where(['id'=>$order['user_id']])->find();
            }
        }
        $this->assign('cache',$order);
        $this->display();
    }

    public function editOrderGoodsPrice()
    {   #修改订单的价格
        if(IS_POST){
            //error_log("\r\n".date('Y-m-d H:i:s').'【'.__LINE__.'】 : '.print_r(I('post.'),true),3,'E:/WWW/1.log');
            $action = I('post.action','','trim');
            switch($action){
                case 'goodslists':
                    $orderid = I('post.orderid',0,'intval');
                    if(!$orderid){
                        $this->ajaxReturn(array("status"=>0,'info'=>"订单ID丢失了"));
                    }
                    $field = 'id AS ordergoodsid,goods_name,goods_price,goods_nums,sku_info';

                    $lists = M('order_goods')->field($field)->where(array('order_id'=>$orderid))->select();
                    if($lists){
                        $this->ajaxReturn(array("status"=>1,'info'=>$lists));
                    }
                    $this->ajaxReturn(array("status"=>0,'info'=>"没有商品"));
                    break;
                case 'changegoods':
                    $orderid        = I('post.orderid',0,'intval');
                    $goods          = I('post.goods','','trim');
                    $expressfee     = I('post.expressfee','0','trim');
                    $totalfee       = I('post.totalfee','0','trim');

                    if(!$orderid){
                        $this->ajaxReturn(array("status"=>0,'info'=>"订单ID丢失了"));
                    }
                    if($expressfee < 0){
                        $this->ajaxReturn(array("status"=>0,'info'=>"快递费不能小于0"));
                    }
                    if($totalfee < 0.01){
                        $this->ajaxReturn(array("status"=>0,'info'=>"支付的金额不能小于0.01"));
                    }
                    $ORDERGOODS_DB= M('order_goods');
                    if(is_array($goods)){
                        if(is_array($goods['goods'])){
                            foreach($goods['goods'] As $k=>$v){
                                if(!$v['ordergoodsid']){
                                    $this->ajaxReturn(array("status"=>0,'info'=>"订单商品表ID丢失"));
                                }
                                if((!$v['price']) || ($v['price']<0.01)){
                                    $this->ajaxReturn(array("status"=>0,'info'=>"商品价格必须大于0"));
                                }
                                if((!$v['num']) || ($v['num']<1)){
                                    $this->ajaxReturn(array("status"=>0,'info'=>"数量必须大于0"));
                                }
                                $res = $ORDERGOODS_DB->where(array('id'=>$v['ordergoodsid']))->setField(array('goods_price'=>$v['price'],'goods_nums'=>$v['num']));
                            }
                        }else{
                            $this->ajaxReturn(array("status"=>0,'info'=>"商品参数错误"));
                        }
                    }else{
                        $this->ajaxReturn(array("status"=>0,'info'=>"商品参数错误"));
                    }
                    $data = array(
                        'express_fee'  => $expressfee,
                        'total_fee'    => $totalfee,
                        'total_price'  => $goods['totalprice'],
                    );
                    $res = M('order_info')->where(array('id'=>$orderid))->setField($data);
                    $this->ajaxReturn(array("status"=>1,'info'=>"操作完成"));
                    break;
            }
        }
        $this->ajaxReturn(array("status"=>0,'info'=>"非法访问"));
    }

    public function orderPay()
    {   #后台订单支付
        if(IS_AJAX){
            $orderid     = I('post.orderid','0','intval');
            $payprice    = I('post.payprice','0','intval');
            //error_log("\r\n".date('Y-m-d H:i:s').'【'.__LINE__.'】 : '.print_r(I('post.'),true),3,'E:/WWW/1.log');
            if($orderid && $payprice){
                $orderinfo_db=M('order_info');
                $map   = array('id'=>$orderid);
                $order = $orderinfo_db->field('order_no,order_status,total_fee')->where($map)->find();
                if($order){
                    if($order['order_status'] != 1){
                        $this->ajaxReturn(array('status'=>0,'info'=>'订单不在待付款状态下,不可支付'));
                    }
                    if(($payprice) > $order['total_fee']){
                        $this->ajaxReturn(array('status'=>0,'info'=>'支付的金额不能大于订单的支付金额'));
                    }
                    $data = array(
                        'order_status'=>3,
                        'pay_way'     =>5,
                        'pay_price'   =>$payprice,
                        'pay_time'    =>NOW_TIME,
                    );
                    $id   = $orderinfo_db->where($map)->save($data);
                    if($id){
                        $this->ajaxReturn(array('status'=>1,'info'=>'付款成功'));
                    }
                    $this->ajaxReturn(array('status'=>0,'info'=>'付款失败'));
                }else{
                    $this->ajaxReturn(array('status'=>0,'info'=>'订单不存在'));
                }
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'订单ID不存在和支付金额必填'));
            }
        }
        $this->ajaxReturn(array("status"=>0,'info'=>'访问错误'));exit;
    }

    // 未发货的订单商品列表
    public function goodslist()
    {
        if(IS_AJAX){
            $id  = I('post.orderid',0,'intval');
            $res = M('order_info')->find($id);
            if(!$res){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单不存在"));
            }

            if($res['order_status'] != 3 && $res['order_status'] != 4){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单不能发货了"));
            }

            $map['order_id'] = $id;
            $map['is_delivery'] = 0;

            $list = M('order_goods')->where($map)->select();
            if(!$list){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单已经发货了"));
            }
            foreach ($list as $k => $v) {
                $goodslist[$k]['goodsid'] = $v['id'];
                $goodslist[$k]['goodsname'] = $v['goods_name'];
                $goodslist[$k]['goodsimg'] = $v['goods_pic'];
            }
            $this->ajaxReturn(array("status"=>1,'info'=>$goodslist));
        }
    }

    public function orderCancel()
    {   #后台取消订单
        if(IS_AJAX){
            $orderid    = I('post.orderid','0','intval');
            //$this->ajaxReturn(D('OrderInfo')->orderCancel($orderid));
            $this->ajaxReturn($this->doorderCancel($orderid));
        }
        $this->ajaxReturn(array("status"=>0,'info'=>'访问错误'));exit;
    }


    private function doorderCancel($id=0,$userid=0)
    {   #取消订单
        if($id){
            $map = array('id'=>$id);
            if($userid){
                $map['userid'] = $userid;
            }
            $orderinfo_db = M('order_info');
            $order = $orderinfo_db->field('id,order_status')->where($map)->find();
            if($order['order_status'] !=1){
                return array('status'=>0,'info'=>'订单不在待付款状态下,不可取消');
            }
            $id = $orderinfo_db->where($map)->setField('order_status',0);
            if($id){
                return array('status'=>1,'info'=>'取消成功');
            }
            return array('status'=>0,'info'=>'取消失败');
        }
        return array('status'=>0,'info'=>'订单ID不存在');
    }

    public function orderRefund()
    {   #线上退款
        if(IS_AJAX){        #订单id,退款金额,退款积分
            #{orderid:orderid,rfee:rfee,rjifen:rjifen};
            $orderid    = I('post.orderid','0','intval');
            $rfee       = I('post.rfee','0','trim');
            $this->ajaxReturn($this->doorderRefund($orderid,$rfee));
        }
        $this->ajaxReturn(array("status"=>0,'info'=>'访问错误'));exit;
    }


    public function doorderRefund($orderid,$rfee)
    {   #订单退款       订单id,支付金额,支付积分
        #$status = A('Common/AliRefunds')->aliRefund('10022017100423203729210','2017100421001004320535144213','0.01','订单退款',4);
        #exit('end');
        $orderInfoModel = M('order_info');
        if(!$orderid){
            return array('status'=>0,'info'=>'没有订单ID');
        }
        if(!$rfee){
            return array('status'=>0,'info'=>'请填写退款金额');
        }
        $order = $orderInfoModel->where(array('id'=>$orderid))->find();
        if(!$order){
            return array('status'=>0,'info'=>'没有找到订单,请稍后再试');
        }
        if(!in_array($order['order_status'],array(2,3,4))){
            return array('status'=>0,'info'=>'订单不能退款');
        }
        if($rfee > $order['pay_price']){
            return array('status'=>0,'info'=>'退款金额必须小于支付金额');
        }

        switch($order['pay_way']){                                              #支付方式：1-微信支付，2-支付宝，3-银联,4-余额',
            case 2:
                $result = A('Common/AliRefunds')->aliRefund($order['order_no'],$order['out_trade_no'],$order['trade_no'],$rfee,'订单退款',$orderid);
                $status = $result['status'];
                break;
            case 4:
                $result = A('Common/Assets')->balanceRefund($order['userid'],$rfee,$orderid,'订单'.$order['order_no'].'退款');
                $status = $result['status'];
                break;
            case 5:
                $status = true;
                break;
            default:
                $status = false;
                break;
        }
        if(!$status){
            order_log($order,1);
            return array('status'=>0,'info'=>'退款失败');
        }
        return array('status'=>1,'info'=>'退款处理完成');
    }

    // 修改备注
    public function editRemark()
    {
        if(IS_AJAX){
            $id       = I('post.orderid',0,'intval');
            $remark   = trim(I("post.remark"));
            $res = M('order_info')->find($id);
            if(!$res){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单不存在"));
            }
            $reg = M('order_info')->where(array('id'=>$id))->setField('remark1',$remark);
            $this->ajaxReturn(array("status"=>1,'info'=>"修改备注成功"));
        }
    }

    // 修改收货地址
    public function editAddress()
    {
        if(IS_AJAX){
            $id          = I('post.orderid',0,'intval');
            $consignee   = trim(I("post.consignee"));
            $mobile      = trim(I("post.mobile"));
            $is_address  = I('post.is_address',0,'intval');
            $country     = trim(I("post.country"));
            $address     = trim(I("post.address"));

            $res = M('order_info')->find($id);
            if(!$res){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单不存在"));
            }
            // if($res['order_status'] >= 5){
            //     $this->ajaxReturn(array("status"=>0,'info'=>"不能修改收货地址"));
            // }

            $map['consignee'] = $consignee;
            $map['mobile'] = $mobile;
            if($is_address == 1){
                $res = explode('/', $country);
                $map['province'] = $res[0];
                $map['city'] = $res[1];
                $map['district'] = $res[2];
                $map['address'] = $address;
            }

            $reg = M('order_info')->where(array('id'=>$id))->save($map);
            $this->ajaxReturn(array("status"=>1,'info'=>"修改收货地址成功"));
        }
    }




}