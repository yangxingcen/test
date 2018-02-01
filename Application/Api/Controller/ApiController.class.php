<?php
namespace Api\Controller;
use Think\Controller;

class ApiController extends PublicController {

        /*
         * 关于服务接口
         */
    public function service(){
//        $id=I('id');
          $id=29;
         $yuye=M('make_yuyue')
            ->field('realname,telphone,add_time ,fid ,user_id ,id ,province,city,area,address,pid')
            ->where('id='.$id)->find();

        $yuye_goods=M('make_goods')->where('id='.$yuye['pid'])->find();
        //当前时间
        $time=date('Y-m-d H:i:s',time());
        //加密
        //        a="dee"+timesign+"server"
        //	b=md5(a)
        //	取左边8位和右边8位，中间插入"serverdee"组成新的字符串
        //	c=left(b,8) +"serverdee" + right(b,8)
        //	timeencrty=md5(c)

        $a="dee".$time."server";
        $b=md5($a);
        $b= strtoupper($b);//转大写
        $left=substr($b,0,8);
        $right= substr($b,-8);
        $c=$left."serverdee".$right;

	    $timeencrty=md5($c);
        $timeencrty= strtoupper($timeencrty);//转大写


        $yuye_li['timesign']=$time;//请求时间
        $yuye_li['datasource']=5;//数据来源, 5 表示官方商城
        $yuye_li['timeencrty']=$timeencrty;//请求时间加密内容
        $yuye_li['tel']= $yuye['telphone'];//电话
        $yuye_li['name']= $yuye['realname'];//姓名
        $yuye_li['addr']=$yuye['province'].$yuye['city'].$yuye['area'].$yuye['address'];//地址
        $yuye_li['pre']= $yuye['add_time'];//预约时间
        $yuye_li['remark']= '测试';//备注
        $yuye_li['sq_type']= $yuye['fid'];//服务类型
        $yuye_li['customer_id']=  strtoupper('dydqgfsc'). $yuye['user_id'];//客户id
        $yuye_li['total']= 1;//总数
        $yuye_li['products'][]=array('product_name'=>$yuye_goods['xinghao']);//型号
        $yuye_li['wx_primary_id']= strtoupper('dydqgfsc'). $yuye['id'];//预约id
        $url='http://115.238.70.85:8013/server_install.ashx';//接口url

        $post_data=json_encode($yuye_li);
        $res=httpClient($url,array('data'=>$post_data));

        print_r($res);
    }

    /*
     * 订单接口
     */
    public function order(){
//        $order=I('order');
        $order='DEYI201712282249431613';
        //订单表
        $order_list=M('order_info')->where('order_no='."'$order'")->find();

        //购买商品表start
        $goods_order=M('order_goods')->where('order_id='.$order_list['id'])->field('id,goods_id,goods_nums,goods_price,goods_name')->select();

        foreach ($goods_order as $k=>$v){
            $goods_order[$k]['t']=M('goods')->where('id='.$v['goods_id'])->field('goods_code')->find();
            $goods_order[$k]['goods_code']=  $goods_order[$k]['t']['goods_code'];
        }
        $zhu='';
        foreach ($goods_order as $k=>$v){
                $zhu[$k]['goods_code']=$v['goods_code'];//产品条形码
                $zhu[$k]['goods_name']=$v['goods_name'];//产品名称
                $zhu[$k]['quantity']=$v['goods_nums'];//数量
                $zhu[$k]['price']=$v['goods_price'];//单价
        }
        //购买商品表end

        //经销商start

       $dealer= M('dealer')->where('id='.$order_list['distributor_id'])->find();

        //经销商end

        $data['plan_id']=$order_list['id'];//商城订单
        $data['plan_sts']=$order_list['order_status'];//订单状态（0：已取消，1：待付款,2：待发货，3：已发货，4：已完成，5：已关闭，6：退款中， 7：订单删除）
        $data['shop_nbr']=$order_list['shop_id'];//商城编号

        if($order_list['shop_id']=1){
                $shang_name='商城';
        }
        if($order_list['shop_id']=2){
            $shang_name='微商城';
        }
        $data['shop_name']=$shang_name;//商城名称
        $data['tel']=$order_list['mobile'];//电话
        $data['name']=$order_list['consignee'];//顾客姓名
        $data['addr']=$order_list['province'].$order_list['city'].$order_list['district'].$order_list['address'];//地址
        $data['buy_date']=$order_list['pay_time'];//购买日期
        $data['pre_date']=$order_list['pre_date'];//预约送货日期
        $data['addr_id']=$dealer['card'];//终端编号(指经销商内码，与分销系统对应)
        $data['addr_name']=$dealer['name'];//终端名称 (指经销商)
        $data['staff_name']=null;//制单人
        $data['invo_name']=$order_list['invoice_type'];//发票类别（增值普通发票、增值专用发票、电子发票、其它）
        $data['remark']=$order_list['remark1'].$order_list['remark2'];//备注要求
        $data['amount']=$order_list['total_fee'];//总金额
        $data['code']=$order_list['order_no'];//订单号
        $data['dj']=0;//定金
        $data['wk']=0;//尾款
        $data['detail']=$zhu;//产品型号明细
        echo  json_encode($data);
    }

    /*
     * 发货接口
     */
    public  function  deliver_goods(){

        //        $order=I('order');
        $order='DEYI201712282249431613';

        $data['order_status']=3;//订单状态（0：已取消，1：待付款,2：待发货，3：已发货，4：已完成，5：已关闭，6：退款中， 7：订单删除）',
        $data['is_send']=1;//0 未发货 1 已发货
        $data['shipping_time']=time();//发货时间
        $order_list=M('order_info')->where('order_no='."'$order'")->setField($data);
        if($order_list){
            $sta['status']=1;
            $sta['info']="发货成功";
            echo  json_encode($sta);
        }
    }

    /*
   * 发货接口
   */
    public  function  goods_receipt(){

        //        $order=I('order');
        $order='DEYI201712282249431613';

        $data['order_status']=4;//订单状态（0：已取消，1：待付款,2：待发货，3：已发货，4：已完成，5：已关闭，6：退款中， 7：订单删除）',
        $data['is_confirm']=1;//是否确认
        $data['receive_time']=time();//收货时间
        $order_list=M('order_info')->where('order_no='."'$order'")->setField($data);
        if($order_list){
            $sta['status']=1;
            $sta['info']="确认收货成功";
            echo  json_encode($sta);
        }
    }

    /*
     * 返回微信的报单的处理状态 接口
     */
    public  function  return_state(){

        $time=date('Y-m-d H:i:s',time());
        //加密
        //        a="dee"+timesign+"server"
        //	b=md5(a)
        //	取左边8位和右边8位，中间插入"serverdee"组成新的字符串
        //	c=left(b,8) +"serverdee" + right(b,8)
        //	timeencrty=md5(c)
        $a="dee".$time."server";
        $b=md5($a);
        $b= strtoupper($b);//转大写
        $left=substr($b,0,8);
        $right= substr($b,-8);
        $c=$left."serverdee".$right;

        $timeencrty=md5($c);
        $timeencrty= strtoupper($timeencrty);//转大写


        $yuye_li['timesign']=$time;//请求时间
        $yuye_li['timeencrty']=$timeencrty;//请求时间加密内容
        $yuye_li['customer_id']=strtoupper('dydqgfsc'). 29;//预约id

        $url='http://115.238.70.86:8013/return_sts.ashx';//接口url

        $post_data=json_encode($yuye_li);
        $res=httpClient($url,array('data'=>$post_data));
        print_r($res);
        print_r($post_data);

    }



}
