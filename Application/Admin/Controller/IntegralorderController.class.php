<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class IntegralorderController extends AdminCommonController
{

    private $storeid;    //商家id  平台1
    public function _initialize()
    {
        parent::_initialize();
        $this->storeid  = 1;
        $this->assign('storeid',$this->storeid);
    }
    
    //商品
    public function index(){
        $name=I("get.name");
        $goodsname = I("get.goodsname");
        $order_status = I("get.order_status");
        $where='';
        $where1='';
        if($order_status){
            $where1 .= ' and a.status = "'.$order_status.'"'; 
            $this->assign('order_status', $order_status);

        }
        if($name){
            $where .= ' and (a.order_id like "%'.$name.'%" or m.person_name like "%'.$name.'%" or m.telephone like "%'.$name.'%")';
        }
        if($goodsname){
            $where .= ' and b.goods_name like "%'.$goodsname.'%"';
        }
        //查询状态的条数
        $count0 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count0', $count0);

        $count1 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id and a.status=1')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count1', $count1);
  
        $count2 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id and a.status=2')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count2', $count2);
  
        $count3 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id and a.status=3')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count3', $count3);
 
        $count4 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id and a.status=4')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count4', $count4);
  
        $count5 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id and a.status=5')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count5', $count5);

        $count6 = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id and a.status=6')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0')->count();
        $this->assign('count6', $count6); 
        ///////////////
        $count = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0'.$where.$where1)->count();

        $Page  = getpage($count, 10);
        $show  = $Page->show();

        $lists = M("integral_order")->alias("a")->join('tb_integral_order_info as b on b.order_id = a.id')->join('tb_member as m on m.id = a.user_id')->where('a.is_del=0 and b.is_del=0 and m.status=0 and m.isdel=0'.$where.$where1)->field("a.id as aid,b.id as bid,a.order_id as order_num,m.person_name,m.telephone,a.price as allprice,b.goods_name,b.goods_logo,b.price,b.num,a.status,b.goods_id,b.sku_info,a.consignee,a.address,a.telephone as atelephone")->limit($Page->firstRow . ',' . $Page->listRows)->order('a.id DESC')->select();

        foreach ($lists as &$v) {
            switch ($v['status']) {
                case '1':
                    $v['status_name'] = '已支付/待发货';
                break;
                case '2':
                    $v['status_name'] = '已发货/待收货';
                break;
                case '3':
                    $v['status_name'] = '已收货/待评价';
                break;
                case '4':
                    $v['status_name'] = '已完成';
                break;
                case '5':
                    $v['status_name'] = '申请退积分';
                break;
                default:
                    $v['status_name'] = '退积分完成';
                break;
            }

        }
        $express = M("express")->select();
        // echo "<pre>";
        // print_r($lists);
        // exit;
        $this->assign("express_list",$express);
        $this->assign('count', $count);
        $this->assign('lists', $lists);
        if($count > 10){
            $this->assign('pages', $show);// 赋值分页输出
        }
        $page = I('get.p',1,'intval');
        $this->assign('page',$page);
        $this->display();
    }
    //退款
    public function orderRefund(){
        $orderid = I("post.orderid");
        $integral = I("post.rjifen");
        $user_id = M("integral_order")->where('order_id="'.$orderid.'"')->getField('user_id');
        $o_id = M("integral_order")->where('order_id="'.$orderid.'"')->getField('id');
        // $price = M("integral_order_info")->where('order_id="'.$o_id.'"')->getField('price');
        $num = M("integral_order_info")->where('order_id="'.$o_id.'"')->getField('num');
        $sku_list = M("integral_order_info")->where('order_id="'.$o_id.'"')->getField('sku_list');
        $goods_id = M("integral_order_info")->where('order_id="'.$o_id.'"')->getField('goods_id');
        $goods_name = M("integral_order_info")->where('order_id="'.$o_id.'"')->getField('goods_name');
        $goods_img = M("integral_order_info")->where('order_id="'.$o_id.'"')->getField('goods_logo');
        if($sku_list){
            //获取sku库存和id
            $sku_arr = M("integral_sku_list")->where("goods_id='".$goods_id."' and attr_list='".$sku_list."'")->field('id,stock')->find();
            $sku_id = $sku_arr['id'];
            $sku_num = $sku_arr['stock'];
            // 获取商品库存
            $goods_num = M("integral_goods")->where('id="'.$goods_id.'"')->getField('stock');
            //修改库存
            $up_stock = array(
                'stock' => $sku_num+$num
            );
            $up_goods_stock = array(
                'stock' => $goods_num+$num
            );
        }else{
            // 获取商品库存
            $goods_num = M("integral_goods")->where('id="'.$goods_id.'"')->getField('stock');
            //修改库存
            $up_goods_stock = array(
                'stock' => $goods_num+$num,
            );
        }
        $my_integral = M("member")->where('id="'.$user_id.'"')->getField('integral');
        //开启事务
        M('integral_order')->startTrans();
        //修改订单状态
        $up_order = array(
            'status' => 6,
            'update_time_t' => date("Y-m-d h:i:s")
        );
        //修改积分
        $up_member = array(
            'integral' => $my_integral+$integral
        );
        //修改积分流水
        $ls = array(
            'action' => 8,
            'user_id' => $user_id,
            'integral' => $integral,
            'integral_befor' => $my_integral,
            'integral_after' => $my_integral+$integral,
            's_type' => 1,
            'goods_id' => $goods_id,
            'goods_name' => $goods_name,
            'goods_img' => $goods_img,
            'order_id' => $o_id

        );
        
        //执行sql
        $order_res = M("integral_order")->where('order_id="'.$orderid.'"')->save($up_order);
        $member_res = M("member")->where('id="'.$user_id.'"')->save($up_member);
        $ls_res = M("integral_status")->add($ls);
        if($sku_list){
            $stock_res = M("integral_sku_list")->where("id='".$sku_id."'")->save($up_stock);
            $goods_res = M("integral_goods")->where("id='".$goods_id."'")->save($up_goods_stock);
        }else{
            $goods_res = M("integral_goods")->where("id='".$goods_id."'")->save($up_goods_stock);
        }
        if($order_res && $member_res && $ls_res && $goods_res){
            //提交事务
            M('integral_order')->commit();
            $this->ajaxReturn(array('status'=>1,'info'=>'退积分成功!'));
        }else{
            // 回滚事务
            M('integral_order')->rollback();
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
    }
    //选择快递公司
    public function express(){
        if(IS_AJAX){
            $express_name = I("post.express_name",'','trim');                   //名称
            $express_ma   = I("post.express_ma",'','trim');                     //编码
            $express_no   = I("post.express_no",'','trim');
            $id           = I('post.orderid',0,'intval');
    
            if(!$express_no){
                $this->ajaxReturn(array("status"=>0,'info'=>"请填写快递单号"));
            }
            if(!($express_ma && $express_name)){
                $this->ajaxReturn(array("status"=>0,'info'=>"请选择快递公司"));
            }
            $orderinfo_db  = M('integral_order');
           
            $res = $orderinfo_db->find($id);
            if(!$res){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单不存在"));
            }
            if($res['status'] !=1){
                $this->ajaxReturn(array("status"=>0,'info'=>"订单不能发货了"));
            }
            $up_order = array(
                'express_name' => $express_name,
                'express_ma' => $express_ma,
                'express_no' => $express_no,
                'status' => 2,
                'update_time_f' => date("Y-m-d h:i:s")
            );
            $res = $orderinfo_db->where('id="'.$id.'"')->save($up_order);
            if($res){
                $this->ajaxReturn(array("status"=>1,'info'=>"发货成功"));
            }else{
                $this->ajaxReturn(array("status"=>0,'info'=>"系统繁忙,请稍后再试!"));
            }
            
            
        }
        $this->ajaxReturn(array("status"=>0,'info'=>"系统繁忙,请稍后再试!"));
    }
    //查看详情
    public function orderDetail()
    {
        $id = I('get.id');
        $res=array();
        $order = M('integral_order')->find($id);
        if(!$order){
            goback("没有此订单！");
        }
        $order['user']  = M('member')->find($order['user_id']);
        $address = M('address')->where("userid='".$order['user_id']."'")->find();

        $province_id = M('region')->where('region_name=""')->getField('id');
        // echo $province_id;
        // echo M('address')->_sql();
        $order_goods    = M("integral_order_info")->where(array('order_id'=>$order['id']))->select();
        $express        = M("express")->order("id asc")->select();
        $order['goods'] = $order_goods;
        $res['order']   = $order;
        $res['express'] = $express;
        
        // echo "<pre>";
        // print_r($address);
        $this->assign("cache", $res['order']);
        if($res['order']['status'] > 1 && $res['order']['status'] <5){
            $express = get_express_message($res['order']['express_ma'],$res['order']['express_no']);  //第三方物流查询api
            $this->assign("express",$express[1]);
        }
        // $this->assign("express", $res['exp']);
        $this->assign("express_list",$res['express']);
        $this->display();
    }
}