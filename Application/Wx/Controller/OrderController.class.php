<?php
namespace Wx\Controller;
use Think\Controller;

class OrderController extends PublicController {
	public function _initialize()
    {
        parent::_initialize();
        $this->checkLogin();
//        $count = M("systemMessage")->where(array("user_id" => $this->user_id, "isdel" => 0, "islooked" => 0))->count();
//        $this->assign("count", $count);
        $this->assign("userinfo", $this->user_info);
        $this->assign("urlname", ACTION_NAME);

    }
	public function index(){
	  
		$this->display();
	}
	//购物车  mtf
	public function cart(){
        $userid = $this->wx_user_id;
        $c      = M("Cart");
        $data   = $c->where(array('user_id'=>$userid))->order('id desc')->select();
        /*根据skuid 查出相关规格*/
        $integal = '0';
        foreach($data as $k=>$val){
            if($val['type'] == '1'){
                $g      = M("Goods");
                $g_sku = M('sku_list');
                $map = array(
                    'id' => $val['goods_id'],
                    'type' => 1,
                );
            } elseif($val['type'] == '3') {
                $g      = M("goods_market");
                $g_sku = M('sku_list_market');
                $map = array(
                    'id' => $val['goods_id'],
                    'isactivity' => 1,
                );
            } elseif($val['type'] == '2') {
                $g      = M("Goods");
                $g_sku = M('sku_list');
                $map = array(
                    'id' => $val['goods_id'],
                    'type' => 2,
                );
            }
            /*查出该商品类型的库存*/
            if($val['sku_list_id']) {
                $goods_stock = $g_sku->where(array('goods_id'=>$val['goods_id'], 'attr_list'=>$val['sku_list_id']))
                    ->field('stock')
                    ->find();
            } else {
                $goods_stock = $g->where(array('id'=>$val['goods_id']))->field('stock')->find();
            }

            $data[$k]['goods_stock'] = $goods_stock['stock'];
            /*查出是否收藏该商品*/
            $cc=M('collection');
            $rrr=$cc->where(array('user_id'=>$userid, 'type'=>'1', 'goods_id'=>$val['goods_id'],'status'=>1))->find();
            $goods = $g->where($map)->field("id,price,logo_pic,goods_name, integral, oprice, goods_des, goods_ser")->find();
            $res = $this->checkCartNum($goods['id'],$val['num'],$val['sku_list_id'], $val['type']);
            if($res['status'] != 1){
                if($res['stock'] == 0){
                    $c->delete($val['id']);
                    unset($data['$k']);
                    continue;
                }
                $c->where(array("id"=>$val['id']))->setField("num", $res['num']);
                $data[$k]['num'] = $val['num'] = $res['num'];
            }
            $attr_list = ltrim(rtrim($val['sku_list_id'], '-'), '-');
            $attr_list = explode('-', $attr_list);
//            foreach($attr_list as $k=>$v) {
//                $
//            }
            $goods['stock'] = $res['stock'];
            $goods['price'] = $res['price'];
            $data[$k]['goodsinfo'] = $goods;
            $data[$k]['allprice']  = $val['num']*$data[$k]['goodsinfo']['price'];
            $data[$k]['alloprice']  = $val['num']*$data[$k]['goodsinfo']['oprice'];
            $data[$k]['integal'] = $goods['integal'] * $val['num'];
            if($rrr) {
                $data[$k]['rrr'] = '1';
            }
            $data[$k]['rrr'] = $rrr;
            $integal += $data[$k]['integal'];
            $num += $val['num'];
            $price += $data[$k]['allprice'];
            $oprice += $data[$k]['alloprice'];
            $data[$k]['alloprice'] = number_format($data[$k]['alloprice'],2);
            $data[$k]['allprice'] = number_format($data[$k]['allprice'],2);
        }
        $price = number_format($price,2);
        $oprice = number_format($oprice,2);

        $spread_price = $oprice - $price;
        $this->assign("cartInfo",json_encode($result));
        /*$this->assign("cartInfo",json_encode($result));*/
        $this->assign('user_id', $userid);
        $this->assign('data',$data);
        $this->assign('price',$price);
        $this->assign('integal',$integal);
        $this->assign('num',$num);
        $this->assign('spread_price',$spread_price);
        $this->assign('oprice',$oprice);
        $this->display();
	}

    /**
     * mtf
     * 删除购物车单个商品
     */
    public function delCart(){
        if(IS_AJAX){
            $cartid = I("post.id");
            $userid = $this->wx_user_id;
            $res = M("cart")->where(array("id"=>$cartid, "user_id"=>$userid))->delete();
            if($res){
                //$this->logs('删除购物车单个商品');
                $this->ajaxReturn(array("status"=>1 ,"info"=>"删除成功！"));
            }
            $this->ajaxReturn(array("status"=>0 ,"info"=>"删除失败！"));
        }
        $this->error("非法访问！");
    }

	//客服中心
	public function about4(){
	  
		$this->display();
	}
    /**
     *   mtf
     *   下单界面，两种情况
     *     	一、来自立即购买
     *     	二、来自购物车
     * @param  cart_ids  -1-2-3-  拼接购物车id
     * @param  goods_id  立即下单时候对应的商品id
     * @param  nums      立即下单时候对应的商品数量
     * @param  skuid     如果有sku则判断sku中的库存
     * 整合数据结构
     */
    public function buy(){
        // 接收购物车id
        $cart_ids   = I('post.cart_ids');
        $userid     = $this->wx_user_id;
        $order_list = array();
        $countprice = 0;
        $countoprice = 0;
        $express_fee= 0;
        if($cart_ids){
            // 有购物车id说明来自购物车下单
            $cart_arr = array_filter(explode("-", $cart_ids));
            $c_m = M("cart");
            $num = '';
            foreach($cart_arr as $v){
                $cart_info = $c_m->where(array("user_id"=>$userid, "id"=>$v))->find();
                $num_res = $this->checkCartNum($cart_info['goods_id'], $cart_info['num'], $cart_info['sku_list_id'], $cart_info['type']);
                if(!in_array($num_res['status'],array(0,3))){
                    if($cart_info['type'] == '1'|| $cart_info['type'] == '2') {
                        $g_m = M("goods");
                    } elseif($cart_info['type'] == '3') {
                        $g_m = M("goods_market");
                    }
                    $goods_info = $g_m->find($cart_info['goods_id']);
                    /*根据分类id 查出分类名*/
                    $cate_two = M('shop_goods_cate')
                        ->where(array('id'=>$goods_info['cate_id'], 'is_del'=>'0'))
                        ->field('id, classname')
                        ->find();
                    $cate_one = M('shop_goods_cate')
                        ->where(array('id'=>$goods_info['cate_pid'], 'is_del'=>'0'))
                        ->field('id, classname')
                        ->find();
                    $allprice   = number_format($num_res['price']*$num_res['num'], 2);
                    $sku_info = $this->getSkuDes($cart_info['sku_list_id']);
                    $order_list[] = array(
                        "goods_id"    => $cart_info['goods_id'],
                        "num"         => $num_res['num'],
                        "sku_id"      => $cart_info['sku_list_id'],
                        "goods_img"   => $goods_info['logo_pic'],
                        "goods_title" => $goods_info['goods_name'],
                        "oprice"      => $num_res['oprice'],
                        "price"       => $num_res['price'],
                        "sku_info"    => $sku_info,
                        "stock"       => $num_res['stock'],
                        "allprice"    => number_format($allprice, 2),
                        "sku_name"    => $num_res['sku_names'],
                        "type"        => $cart_info['type'],
                        "cate_one"    => $cate_one['classname'],
                        "cate_two"    => $cate_two['classname'],
                    );
                    $num += $num_res['num'];
                    $countprice  += $num_res['price']*$num_res['num'];
                    $countoprice += $num_res['oprice']*$num_res['num'];
                }
            }
            if(empty($order_list)){
                $this->error("无效的购买！");
            }
        }else{
            $goods_id = I('post.goodsid', 0, "intval");
            $nums     = I('post.nums', 0, "intval");
            $skuid    = I('post.skuid', 0, "trim");
            $isactivity = I('post.isactivity', '0' ,'intval');
            if(empty($isactivity)) {
                $isactivity = '1';
            }
            // 这里处理
            if(!$goods_id || !$nums){
                $this->error("无效的购买！");
            }
            if($skuid){
                $skuid = explode('-',$skuid);
                sort($skuid);
                $attr_list = '';
                foreach($skuid as $k=>$v) {
                    $attr_list .= $v.'-';
                }
                $attr_list = '-'.$attr_list;
            } else {
                $attr_list = '';
            }
            $return = $this->checkCartNum($goods_id, $nums, $attr_list, $isactivity);
            if($return['status']!=1){
                $this->error($return['info']);
            }
            if($isactivity == '1'|| $isactivity == '2') {
                $g_m = M("goods");
            } elseif($isactivity == '3') {
                $g_m = M("goods_market");
            }
            $goods_info = $g_m->find($goods_id);
            /*根据分类id 查出分类名*/
            $cate_two = M('shop_goods_cate')
                ->where(array('id'=>$goods_info['cate_id'], 'is_del'=>'0'))
                ->field('id, classname')
                ->find();
            $cate_one = M('shop_goods_cate')
                ->where(array('id'=>$goods_info['cate_pid'], 'is_del'=>'0'))
                ->field('id, classname')
                ->find();
            $allprice   = number_format($return['price']*$nums, 2);
            $order_list = array();
            $sku_info = $this->getSkuDes($attr_list);
            $order_list[] = array(
                "goods_id"    => $goods_id,
                "num"         => $nums,
                "sku_id"      => $skuid,
                "goods_img"   => $goods_info['logo_pic'],
                "goods_title" => $goods_info['goods_title']?$goods_info['goods_title']:$goods_info['goods_name'],
                "oprice"      => $return['oprice'],
                "price"       => $return['price'],
                "sku_info"    => $sku_info,
                "stock"       => $return['stock'],
                "allprice"    => number_format($allprice, 2),
                "sku_name"    => $return['sku_names'],
                "type"        => $isactivity,
                "cate_one"    => $cate_one['classname'],
                "cate_two"    => $cate_two['classname'],
            );
            $countprice  += $return['price']*$nums;
            $countoprice += $return['oprice']*$nums;
            $num = $nums;
        }
        $zhekou      = number_format($countoprice-$countprice, 2);
        $countprice  = number_format($countprice, 2);
        $countoprice = number_format($countoprice, 2);
        /**
         * 得到用户收货地址
         */
        $address = M("address")->where(array("userid"=>$userid))->order("`isdefault` desc")->find();
        /**
         * 得到用户发票
         */
        //$receipt = M("receipt")->where(array("user_id"=>$userid))->select();
//        $address1 = array_slice($address,0,4);
//        $address2 = array_slice($address,4);


        /*--------------------------------------------生成订单  start------------------------------------------------*/
        $order_info = $order_list;
        $message = '';
        // 收货地址
//        $address_id 	  = I("post.address_id");
//        $countprice 	  = I("post.countprice");
        // 留言
        //$message 		  = I("post.liuyan");
        // 发票信息
//		$invoice_type 	  = I("post.invoice_type");
//		$invoice_title 	  = I("post.invoice_title");
//		$receipt_id 	  = I("post.receipt_id");
//		$pay_way 	      = I("post.pay_way");
        // 登陆者id
        $userid           = $this->wx_user_id;
        M()->startTrans();
        // 购物车的is拼接
        $cart_arr         = array_filter(explode("-", $cart_ids));
        $order_data       = array();   // 订单
        $order_goods_data = array();   // 订单详情
        $express_fee      = 0; // 邮费
        $order_data['user_id']     = $userid;
//		$order_data['shop_id']     = 0;
        $order_data['order_no']    = 'DEYI'.date('YmdHis',time()).rand(1111,9999);
        $order_data['consignee']   = $address['consignee'];
        $order_data['order_status']   = '1';
        $order_data['province']    = $address['province'];
        $order_data['city']        = $address['city'];
        $order_data['district']    = $address['district'];
        $order_data['address']     = $address['place'];
        $order_data['mobile']      = $address['telephone'];
        $order_data["message"]     = $message?$message:"";
        //$order_data["express_fee"] = $express_fee;   // 现在默认包邮
        $order_data["receive_time"]= 0;
        $order_data["source"]      = 1;
        //$order_data["pay_way"]     = $pay_way;
        $order_data["order_time"]  = time();
        //$order_data["couponsid"]   = 0;
        // 整理发票信息
        //$order_data['invoice_type']= $invoice_type;
//		if($invoice_type == 2){
//			$invoice = M("receipt")->where(array("id"=>$receipt_id,"user_id"=>$userid))->find();
//			if(!$invoice){
//				$this->ajaxReturn(array('info'=>'发票信息错误','status'=>0));
//			}
//		    $order_data['invoice_title']        = $invoice['invoice_title'];
//			$order_data['invoice_company']		= $invoice['company']?$invoice['company']:"";
//			$order_data['invoice_taxpayer_id']	= $invoice['taxpayer_id']?$invoice['taxpayer_id']:"";
//			$order_data['invoice_address']		= $invoice['address']?$invoice['address']:"";
//			$order_data['invoice_phone']		= $invoice['phone']?$invoice['phone']:"";
//			$order_data['invoice_bank']			= $invoice['bank']?$invoice['bank']:"";
//			$order_data['invoice_bank_account'] = $invoice['bank_account']?$invoice['bank_account']:"";
//		}else{
//			$order_data['invoice_title']        = $invoice_title;
//		}
        // 下面是处理商品：同意购物车和立即购买的格式
        if($cart_ids){
            $cart_m = M("cart");
            $cart_arr = array_filter(explode("-", $cart_ids));
            // 检测购物车中的商品是否为传过来的商品
            $cart_res = $this->checkMyCartByWx($cart_arr);
            if($cart_res['status'] != 1){
                $this->ajaxReturn(array("status"=>0, "info"=>$cart_res['info']));
            }
        }
        // 得到total_price

        $total_price = 0;        // 商品实际价格
        $total_fee   = 0;
        $integral = 0;
        foreach($order_info as $v){
            if($v['type'] == '1' || $v['type'] == '2') {
                $goods_m = M("goods");
                $sku_l_m = M("sku_list");
                $map=array(
                    'id' => $v['goods_id'],
                    'is_sale' => '1',
                    'is_del' => '0',
                );
            }
//            if($v['type'] == '2') {
//                $goods_m = M("goods");
//                $sku_l_m = M("sku_list");
//            }
            if($v['type'] == '3') {
                $goods_m = M("goods_market");
                $sku_l_m = M("sku_list_market");
                $map=array(
                    'id' => $v['goods_id'],
                    'is_sale' => '1',
                    'is_del' => '0',
                    'isactivity' => '1',
                );
            }
            $goods = $goods_m->where($map)->find();
            if(!$goods){
                $this->ajaxReturn(array('info'=>'商品已下架','status'=>0));
            }
            if(!$cart_ids) {
                if($v['sku_id']){
                    //$v['sku_id'] = sort($v['sku_id']);
                    $v['sku_id'] = $attr_list;
                    /*根据商品id 和sku数据 查出skuid*/
                } else {
                    $v['sku_id'] = '';
                }
            }
            $sku_ids = $sku_l_m
                ->where(array('attr_list' => $v['sku_id'], 'goods_id' => $v['goods_id']))
                ->field('id')
                ->find();

            //$integral += $goods['integal'];
            // 得到商品库存
            $num_res = $this->checkCartNum($goods['id'], $v['num'], $v['sku_id'], $v['type']);
            if($num_res['status']!=1){
                $this->ajaxReturn(array("status"=>0, "info"=>$num_res['info']));
            }
            $price = $num_res['price'];
            // 记入订单详情
            $sku_infos = $this->getSkuDes($v['sku_id']);
            $order_goods_data[] = array(
                'goods_id'    => $goods['id'],
                'goods_name'  => $goods['goods_name'],
                'goods_nums'  => $v['num'],
                'goods_price' => $price,
                'goods_priceall'=>$price*$v['num'],
                'goods_pic'  => $goods['logo_pic'],
                //"sku_list_id" => $v['sku_id']?$v['sku_id']:0,
                "sku_list_id" => $sku_ids['id'],
                //'jifen'       => $integral,
                'sku_info'    => $sku_infos,
                'user_id'     => $userid,
                'type'        => $v['type'],
            );
            /*
            // 减少库存
            if($v['sku_id']){
                $res = $sku_l_m->where(array("id"=>$v['sku_id']))->setDec("stock", $v['num']);
            }else{
                $res = $goods_m->where(array("id"=>$goods['id']))->setDec("stock", $v['num']);
            }
            // 减少库存
            if(!$res){
                $this->ajaxReturn(array('info'=>'商品库存扣除失败！','status'=>0));
            }
            */
            // 得到商品的价格
            $total_price += $price*$v['num'];
        }
        ///$express_fee 邮费
        $total_fee = $total_price;
        $order_m   = M("order_info");
        $order_data['consjifen']    = 0;
        $order_data['return_score'] = 0;
        $order_data['total_fee']    = $total_fee;
        $order_data['total_price']  = $total_price;
        $order_data['is_valid'] = '1';
        $order_res 					= $order_m->add($order_data);
        if(!$order_res){
            $this->ajaxReturn(array('info'=>"下单失败",'status'=>0));
        }
        // 保存到订单详情
        $order_goods_m = M("order_goods");
        foreach($order_goods_data as $v){
            $v['order_id']   = $order_res;
            $v['order_no']   = $order_data['order_no'];
            $v['order_time'] = $order_data['order_time'];
            $o_g_res = $order_goods_m->add($v);
            // dump($v);
            if(!$o_g_res){
                M()->rollback();
                $this->ajaxReturn(array('info'=>"下单失败",'status'=>0));
            }
        }

        if($cart_ids){
            foreach($cart_arr as $v){
                $cart_res = $cart_m->where(array('id'=>$v,"user_id"=>$userid))->delete();
                if(!$cart_res){
                    M()->rollback();
                    $this->ajaxReturn(array('info'=>'购物车商品错误','status'=>0));
                }
            }
        }
        M() -> commit();
        /*查出经销商信息*/
        $dealer = M('dealer')->where(array('province' => $address['province']))->field('id')->find();
        if(!$dealer) {
            $dealer = M('dealer')->where(array('city' => $address['city']))->field('id')->find();
            if(!$dealer) {
                $dealer = M('dealer')->where(array('county' => $address['district']))->field('id')->find();
                if(!$dealer) {
                    $data_dealer = array();
                    $data_dealer = array(
                        'order_id' => $order_res,
                        'province' => $address['province'],
                        'city' => $address['city'],
                        'district' => $address['district'],
                        'add_time' => date("Y-m-d H:i:s"),
                    );
                    $res_dealer = M('dealer_log')->add($data_dealer);
                    if(!$res_dealer) {
                        $res_dealer_info = array(
                            'status'=>0,
                            'msg'=>'系统错误，请刷新后重试！',
                        );
                        exit(json_encode($res_dealer_info));
                    }
                }
            }
        }
        $data_order = array();
        $data_order = array(
            'shop_id' => $dealer,
        );
        $where_order = array();
        $where_order = array(
            'id' => $order_res,
        );
        M('order_info')->where($where_order)->data($data_order)->save();
        //$this->ajaxReturn(array("status"=>1,'order_id'=>$order_res,'order_no'=>$order_data['order_no'],"url"=>U('Order/pays',array("order_no"=>$order_data['order_no'], "order_id"=>$order_res))));
//		switch($pay_way){
//			case "1":
//				M() -> commit();
//				$this->ajaxReturn(array("status"=>1,'order_id'=>$order_res,'order_no'=>$order_data['order_no'],"url"=>U('Pay/wxpay',array("order_no"=>$order_data['order_no']))));
//				break;
//			case "2";
//				M() -> commit();
//				$this->ajaxReturn(array("status"=>1,'order_id'=>$order_res,'order_no'=>$order_data['order_no'],"url"=>U('Pay/alipay',array("order_no"=>$order_data['order_no']))));
//				break;
//			default:
//				// 至此，全部成功
//				M() -> rollback();
//				$this->ajaxReturn(array("status"=>0,'info'=>"无效的支付方式！"));
//				break;
//		}
        /*生成订单END*/

        /*查出发票信息数据*/
        $invoice = M('invoice')->where(array('user_id'=>$this->wx_user_id, 'is_del'=>'0'))
            ->order('add_time DESC')
            ->find();

        $this->assign("invoice",$invoice);
        $this->assign("num",   $num);
        //$this->assign("count",      count($order_list));
        $this->assign("address",   $address);
        //$this->assign("receipt",    $receipt);
        $this->assign("express_fee",$express_fee);
        $this->assign("zhekou",     $zhekou);
        $this->assign("countprice", $countprice);
        $this->assign("countoprice",$countoprice);
        $this->assign("order_list", $order_list);
        //$this->assign("order_info", serialize($order_list));
        $this->assign("cart_ids",   $cart_ids);

        $this->display();
    }
	//全部订单
	public function user_order(){
        $user_id = $this->wx_user_id;
        $data['user_id'] = $user_id;
        $order_list = D('OrderInfo')->myOrderList($data);
        $this->assign('order_list', $order_list);
		$this->display();
	}
	//代付款
	public function user_order1(){
        $status = '1';
        $user_id = $this->wx_user_id;
        $data['status'] = $status;
        $data['user_id'] = $user_id;
        $order_list = D('OrderInfo')->myOrderList($data);
        //var_dump($order_list);exit;
        $this->assign('order_list', $order_list);
		$this->display();
	}
	//代发货
	public function user_order2(){
        $status = '2';
        $user_id = $this->wx_user_id;
        $data['status'] = $status;
        $data['user_id'] = $user_id;
        $order_list = D('OrderInfo')->myOrderList($data);
        $this->assign('order_list', $order_list);
		$this->display();
	}
    //待收货
    public function user_order3(){
        $status = '3';
        $user_id = $this->wx_user_id;
        $data['status'] = $status;
        $data['user_id'] = $user_id;
        $order_list = D('OrderInfo')->myOrderList($data);
        $this->assign('order_list', $order_list);
        $this->display();
    }
    //待评价
    public function user_order4(){
        $status = '4';
        $user_id = $this->wx_user_id;
        $data['status'] = $status;
        $data['user_id'] = $user_id;
        $order_list = D('OrderInfo')->myOrderList($data);
        $this->assign('order_list', $order_list);
        $this->display();
    }
	//售后
	public function user_order5(){
        $status = '6';
        $user_id = $this->wx_user_id;
        $data['status'] = $status;
        $data['user_id'] = $user_id;
        $order_list = D('OrderInfo')->myOrderList($data);
        $this->assign('order_list', $order_list);
		$this->display();
	}
	//售后详情
	public function user_order5_inner(){
	  
		$this->display();
	}

    /**
     * mtf
     * 检测购物车商品数量
     */
    private function checkCartNum($goodsid, $num, $skuid, $isactivity){
        if($isactivity == '1' || $isactivity == '2') {
            $goods = M("goods")->where(array("id"=>$goodsid ,"is_del"=>0, 'is_sale' => '1'))->find();
        } elseif ($isactivity == '3') {
            $goods = M("goods_market")->where(array("id"=>$goodsid ,"is_del"=>0, 'is_sale' => '1','isactivity' => '1'))->find();
        }
//		$goods = M("goods")->where(array("id"=>$goodsid ,"is_del"=>0, 'status' => '1'))->find();
        $zhekou = 1;
        if(!$goods){
            return array("status"=>'0', "info"=>"没有该商品！","num"=>0);
        }
        if(!$goods['is_sale']){
            return array("status"=>'0', "info"=>"该商品已下架！","num"=>0);
        }
        if($skuid) {
            $sku_id = ltrim(rtrim($skuid, '-'), '-');
            $sku_id = explode('-', $sku_id);
            /*查出相关sku名*/
            $sku_name = M('sku_attr')->where(array('id' => array('in',$sku_id)))->field('id, pid, classname')->select();

            foreach($sku_name as $k_s => $v_s) {
                $pid_name = M('sku_attr')->where(array('id'=>$v_s['pid']))->field('id, classname')->find();
                $sku_name[$k_s]['pid_name'] = $pid_name['classname'];
                $sku_names .= $pid_name['classname'].':'.$v_s['classname'].' ';
            }
        }

        $stock=array();
        if($skuid){
            // 商品没开启sku
//			if(!$goods['is_sku']){
//				return array("status"=>'0', "info"=>"该商品已下架2！","num"=>0);
//			}
            if($goods['is_sku']) {
                if($isactivity == '1' || $isactivity == '2') {

                    $sku = M("sku_list")->where(array("goods_id" => $goodsid, "attr_list" => $skuid, "status" => 0,'is_del'=>0))->find();
//                    var_dump($sku);exit;
                } elseif($isactivity == '3') {
                    $sku = M("sku_list_market")->where(array("goods_id" => $goodsid, "attr_list" => $skuid, "status" => 0,'is_del'=>0))->find();
                }
                if(!$sku){
                    return array("status"=>'3' ,"info"=>"商品没有该属性！","num"=>0, "price"=>$sku['price'],"stock"=>0,"oprice"=>$sku['oprice']);
                }
            } else {
                $sku = $goods;
            }

            if($sku['stock']<$num){
                return array("status"=>'2' ,"info"=>"该商品库存不足！","num"=>$sku['stock'], "price"=>$sku['price'],"stock"=>$sku['stock'],"oprice"=>$sku['oprice']);
            }
            $stock  = $sku['stock'];
            $oprice = $sku['oprice'];
            $price  = $sku['price'];
        }else{
            if($goods['stock']<$num){
                return array("status"=>'2' ,"info"=>"该商品库存不足！","num"=>$goods['stock'], "price"=>$goods['price'],"stock"=>$goods['stock'],"oprice"=>$goods['oprice']);
            }
            $stock  = $goods['stock'];
            $oprice = $goods['oprice'];
            $price  = $goods['price'];
        }
        if(0<$zhekou && $zhekou<1){
            $price = floor($price*$zhekou);
        }
        return array("status"=>'1',"num"=>$num, "price"=>$price,"stock"=>$stock,"oprice"=>$oprice, 'sku_names' => $sku_names);
    }

    /**
     * 检测购物车合法性
     */
    private function checkMyCart($cart_arr){
        $m      = M("cart");
        $userid = $this->user_id;
        foreach($cart_arr as $v){
            $cart = $m->where(array("id"=>$v, "user_id"=>$userid))->find();
            if($cart){

            }else{
                return array("status"=>0, "info"=>"请确认购物车的商品！");
            }
        }
        return array("status"=>1, "info"=>"ok");
    }

    /**
     * 检测购物车合法性
     */
    private function checkMyCartByWx($cart_arr){
        $m      = M("cart");
        $userid = $this->wx_user_id;
        foreach($cart_arr as $v){
            $cart = $m->where(array("id"=>$v, "user_id"=>$userid))->find();
            if($cart){

            }else{
                return array("status"=>0, "info"=>"请确认购物车的商品！");
            }
        }
        return array("status"=>1, "info"=>"ok");
    }
	
}
