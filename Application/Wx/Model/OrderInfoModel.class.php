<?php
/**
*  wx商城订单model
 * mtf
 */
namespace Wx\Model;
use Think\Model;
class OrderInfoModel extends Model {

    /**20171223wzz
     * 获取个人中心我的订单
     * $status 订单状态
     * */
    public function myOrderList($data = array()) {
        $status = $data['status'];
        $user_id = $data['user_id'];
        if($status) {
            $map['order_status'] = $status;
        } elseif($status === 0) {
            $map['order_status'] = $status;
        } else {
            $map['order_status'] = array('lt', '7');
        }
        $map['user_id'] = $user_id;
        $map['is_del'] = 0;
        $o_m = M('order_info');
        $o_g_m = M("order_goods");
        $order = $o_m->where($map)->order("order_time desc")->
        field("id, order_no, order_status, pay_status, total_fee, pay_price, consignee, order_time, order_status")->select();
        if($order) {
            foreach($order as $k=>$v){
                //$order[$k]['data']
                $goods= $o_g_m->where(array("user_id"=>$this->wx_user_id,"order_id"=>$v['id']))->select();
                $nums = 0;
                foreach($goods as $key=>$val) {
                    $cate = M('goods')->alias('a')
                        ->join('LEFT JOIN __SHOP_GOODS_CATE__ b ON a.cate_id = b.id')
                        ->join('LEFT JOIN __SHOP_GOODS_CATE__ c ON b.pid = c.id')
                        ->field('c.classname as cate_one, b.classname as cate_two')
                        ->where(array('a.id' => $val['goods_id']))
                        ->find();
                    $goods[$key]['cate_one'] = $cate['cate_one'];
                    $goods[$key]['cate_two'] = $cate['cate_two'];
                    $nums += $val['goods_nums'];
                }
                $order[$k]['data'] = $goods;
                $order[$k]['nums'] = $nums;
                $order[$k]['count'] = count($order[$k]['data']);
                switch ($v['order_status']){
                    case 0 : $order[$k]['status'] = '已取消';
                        break;
                    case 1 :
                        $order[$k]['status'] = '等待买家付款';
                        break;
                    case 2 : $order[$k]['status'] = '下单成功，待发货';
                        break;
                    case 3 : $order[$k]['status'] = '卖家已发货';
                        break;
                    case 4 : $order[$k]['status'] = '已完成';
                        break;
                    case 5 : $order[$k]['status'] = '已关闭';
                        break;
                    case 6 : $order[$k]['status'] = '退款中';
                        break;
                }
                $order[$k]['order_time'] = date('Y-m-d H:i:s', $v['order_time']);
            }
        }
        return $order;
    }
}