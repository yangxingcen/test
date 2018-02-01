<?php
namespace Shop\Controller;
use Think\Controller;

class OrderController extends PublicController {

	/*
	订单状态（0：已取消，1：待付款,2：待发货，3：已发货，4：已完成，5：已关闭，6：退款中， 7：订单删除）
	*/

	public function index(){
		$this->display();
	}

	/**
	 * 订单查询
	 */
	public function lst(){

	    $this->logs('查看订单');
		if(IS_POST){
			$data["starttime"]	= I('post.starttime');
			$data["endtime"]	= I('post.endtime');
			$starttime			= strtotime($data["starttime"]);
			$endtime			= strtotime($data["endtime"]);
			// if($starttime>$endtime){
			// 	$this->error("输入的时间不对");die;
			// }
			$order_no	= I('post.order_no');
			$userid = $this->user_id;
			$m = M("order_info");
			if($starttime==null){
				$sql = "SELECT * from (select a.id,a.user_id,a.order_no,a.order_time,a.order_status,a.total_fee,b.goods_name,b.goods_nums,b.goods_price from app_order_info a left join app_order_goods b on a.id=b.order_id) as c where c.user_id={$userid} and c.order_no like '%$order_no%'";
			}else{
				$sql = "SELECT * from (select a.id,a.user_id,a.order_no,a.order_time,a.order_status,a.total_fee,b.goods_name,b.goods_nums,b.goods_price from app_order_info a left join app_order_goods b on a.id=b.order_id) as c where c.user_id={$userid} and c.order_no like '%$order_no%' or c.order_time BETWEEN $starttime and $endtime";
			}

			$res = $m->query($sql);
			if(!$res){
				$this->error("未查询到结果");
			}
			$this->assign("res",$res);
		}
		$this->display();
	}

	/**
	 * 购物车页面
	 */
	public function cart(){
        $this->logs('查看购物车页面');
		$userid = $this->user_id;
		$c      = M("Cart");
		$data   = $c->where(array('user_id'=>$userid))->order('id desc')->select();
		/*根据skuid 查出相关规格*/
        $integal = '0';
		foreach($data as $k=>$val){
		    if($val['type'] == '1'){
                $g      = M("Goods");
                $map = array(
                    'id' => $val['goods_id'],
                    'type' => 1,
                );
            } elseif($val['type'] == '3') {
                $g      = M("goods_market");
                $map = array(
                    'id' => $val['goods_id'],
                    'isactivity' => 1,
                );
            } elseif($val['type'] == '2') {
                $g      = M("Goods");
                $map = array(
                    'id' => $val['goods_id'],
                    'type' => 2,
                );
            }
			$goods = $g->where($map)->field("id,price,logo_pic,goods_name, integral, oprice")->find();
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
		//dump($data);exit;
		$this->assign('data',$data);
		$this->assign('price',$price);
		$this->assign('integal',$integal);
		$this->assign('num',$num);
		$this->assign('spread_price',$spread_price);
		$this->assign('oprice',$oprice);
		$this->display();
	}

	/**
	 * 清空购物车
	 */
	public function clearCart(){
	    $user_id = $this->user_id;
		$res = M("cart")->where(array("user_id"=>$user_id))->delete();
		if($res){
            $this->logs('清空购物车');
			$this->ajaxReturn(array("status"=>1 ,"info"=>"ok"));
		}else{
			$this->ajaxReturn(array("status"=>0 ,"info"=>"清空购物车失败！"));
		}
	}


	/**
	 * zyf
	 * 删除购物车单个商品
	 */
	public function delCart(){
		if(IS_AJAX){
			$cartid = I("post.id");
			$userid = $this->user_id;
			$res = M("cart")->where(array("id"=>$cartid, "user_id"=>$userid))->delete();
			if($res){
                $this->logs('删除购物车单个商品');
				$this->ajaxReturn(array("status"=>1 ,"info"=>"删除成功！"));
			}
			$this->ajaxReturn(array("status"=>0 ,"info"=>"删除失败！"));
		}
		$this->error("非法访问！");
	}

	/**
	 * zyf
	 * 改变购物车商品
	 * 业务逻辑：
	 *     判断商品库存是否足够
	 */
	public function changeCartNum(){
		if(IS_AJAX){
			$post   = I("post.");
			// 改变后的商品数量
			$userid = $this->user_id;
			$m 		= M("cart");
			foreach($post as $cartid=>$nums){
				$cart 	= $m->where(array("user_id"=>$userid, "id"=>$cartid))->find();
				if(!$cart){
					$this->ajaxReturn(array("status"=>0, "info"=>"修改失败！"));
				}
				$return = $this->checkCartNum($cart['goods_id'], $nums, $cart['sku_list_id']);
				if($return['status'] != "1" ){
					$this->ajaxReturn(array("status"=>2, "info"=>$return['info'], "num"=>$return['num']));
				}
				$res = $m->where(array('id'=>$cartid))->setField("num",$nums);
				if($res===false){
					$this->ajaxReturn(array("status"=>0, "info"=>"修改失败！"));
				}
			}
            $this->logs('修改购物车商品');
			$this->ajaxReturn(array("status"=>1, "info"=>"修改成功！"));
		}
		$this->error("非法访问！");
	}

	/**
	 * zyf
	 * 加入购物车
	 * 带sku ,在购物车列表中判断库存是否足够
	 * @param goodsid 商品id
	 * @param skuid
	 * @param nums
	 */
	public function addToCart(){
		if(IS_AJAX){
			$goodsid = I('post.goodsid', 0, "intval");
			$skuid   = I('post.skuid', 0, "trim");
			$userid  = $this->user_id;
			$nums    = I("post.nums", 0, "intval");
			$isactivity    = I("post.isactivity", 0, "intval");
            $skuid = explode(',',$skuid);
            sort($skuid);
            $attr_list = '';
            foreach($skuid as $k=>$v) {
                $attr_list .= $v.'-';
            }
            $attr_list = '-'.$attr_list;
            if(!$goodsid || !$nums){
				$this->ajaxReturn(array("status"=>0 ,"info"=>"加入购物车失败！"));
			}
			// 判断商品
			$return = $this->checkCartNum($goodsid, $nums, $attr_list, $isactivity);
			if($return['status']!=1){
				$this->ajaxReturn(array("status"=>0, "info"=>$return['info']));
			}
			$data = array(
					"user_id"       => $userid,
					"goods_id"      => $goodsid,
					"sku_list_id"   => $attr_list,
					"num"			=> $nums,
					"create_at"		=> time(),
                    "type"          => $isactivity,
				);
			$map = array(
					"user_id"       => $userid,
					"goods_id"      => $goodsid,
					"sku_list_id"   => $attr_list,
                    "type"          => $isactivity,
				);
			$m = M("cart");
			$cart = $m->where($map)->find();
			if($cart){
				$res = $m->where($map)->setInc("num", $nums);
			}else{
				$res = $m->add($data);
			}
			$count = $m->where(array('user_id'=>$userid))->count();
			if($res){
                $this->logs('添加商品到购物车');
				$this->ajaxReturn(array("status"=>1 ,"info"=>"添加购物车成功！","nums"=>$count));
			}else{
				$this->ajaxReturn(array("status"=>0 ,"info"=>"添加购物车失败！"));
			}
		}
		$this->error("非法访问！");
	}

	/**
	 *   zyf
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
		$userid     = $this->user_id;
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
					$allprice   = number_format($num_res['price']*$num_res['num'], 2);
					$order_list[] = array(
							"goods_id"    => $cart_info['goods_id'],
							"num"         => $num_res['num'],
							"sku_id"      => $cart_info['sku_list_id'],
							"goods_img"   => $goods_info['logo_pic'],
							"goods_title" => $goods_info['goods_name'],
							"oprice"      => $num_res['oprice'],
							"price"       => $num_res['price'],
							"sku_info"    => $this->getSkuDes($cart_info['sku_list_id']),
							"stock"       => $num_res['stock'],
							"allprice"    => number_format($allprice, 2),
                            "sku_name"    => $num_res['sku_names'],
                            "type"        => $cart_info['type'],
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
			// 这里处理
			if(!$goods_id || !$nums){
				$this->error("无效的购买！");
			}
			if($skuid){
                $skuid = explode(',',$skuid);
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
			$allprice   = number_format($return['price']*$nums, 2);
			$order_list = array();
			$order_list[] = array(
					"goods_id"    => $goods_id,
					"num"         => $nums,
					"sku_id"      => $skuid,
					"goods_img"   => $goods_info['logo_pic'],
					"goods_title" => $goods_info['goods_title']?$goods_info['goods_title']:$goods_info['goods_name'],
					"oprice"      => $return['oprice'],
					"price"       => $return['price'],
					"sku_info"    => $this->getSkuDes($skuid),
					"stock"       => $return['stock'],
					"allprice"    => number_format($allprice, 2),
                    "sku_name"    => $return['sku_names'],
                    "type"        => $isactivity,
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
		$address = M("address")->where(array("userid"=>$userid))->order("`isdefault` desc")->select();
		/**
		 * 得到用户发票
		 */
		//$receipt = M("receipt")->where(array("user_id"=>$userid))->select();
		$address1 = array_slice($address,0,4);
		$address2 = array_slice($address,4);
        $this->assign("num",   $num);
		//$this->assign("count",      count($order_list));
		$this->assign("address1",   $address1);
		$this->assign("address2",   $address2);
		//$this->assign("receipt",    $receipt);
		$this->assign("express_fee",$express_fee);
		$this->assign("zhekou",     $zhekou);
		$this->assign("countprice", $countprice);
		$this->assign("countoprice",$countoprice);
		$this->assign("order_list", $order_list);
		$this->assign("order_info", serialize($order_list));
		$this->assign("cart_ids",   $cart_ids);
	//	 dump($order_list);exit;
		// dump(serialize($order_list));
		$this->display();
	}

	/*生成订单*/
	public function makeOrder(){
        //$this->logs('查看订单中商品详情');
		// 订单中的商品详情
		$order_info      = I("post.order_info", "","trim");
		$order_info  = unserialize($order_info);

		// 收货地址
		$address_id 	  = I("post.address_id");
		$countprice 	  = I("post.countprice");
		// 留言
		$message 		  = I("post.liuyan");
		// 发票信息
//		$invoice_type 	  = I("post.invoice_type");
//		$invoice_title 	  = I("post.invoice_title");
//		$receipt_id 	  = I("post.receipt_id");
//		$pay_way 	      = I("post.pay_way");
		// 登陆者id
		$userid           = $this->user_id;
		M()->startTrans();
		// 购物车的is拼接
		$cart_ids 	      = I("post.cart_ids");
		$cart_arr         = array_filter(explode("-", $cart_ids));
		$order_data       = array();   // 订单
		$order_goods_data = array();   // 订单详情
		$express_fee      = 0; // 邮费
		// 判断订单商品是否有效
		if(!$order_info || empty($order_info) || count($order_info)==0){
			$this->ajaxReturn(array('info'=>'请确认下单内容', 'status'=>0));
		}
		// 判断登录用户
		if(!($userid>0)){
			$this->ajaxReturn(array('info'=>'无效的用户',    'status'=>0));
		}
		if(count($cart_arr)<=0 && $cart_ids){
			$this->ajaxReturn(array('info'=>'商品数量无效',  'status'=>0));
		}
		// 判断收货地址id
		if(!(intval($address_id)>0)){
			$this->ajaxReturn(array('info'=>'无效的收获地址','status'=>0));
		}
		// 整理地址
		$address = M("address")->where(array("id"=>$address_id,"user_id"=>$userid))->find();
		if(!$address){
			$this->ajaxReturn(array('info'=>'地址信息错误','status'=>0));
		}
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
			// 检测购物车中的商品是否为传过来的商品
			$cart_res = $this->checkMyCart($cart_arr);
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
                    foreach($v['sku_id'] as $k_sku=>$v_sku) {
                        $attr_list .= $v_sku.'-';
                    }

                    $v['sku_id'] = '-'.$attr_list;
                    /*根据商品id 和sku数据 查出skuid*/
                    $sku_id = $sku_l_m
                        ->where(array('attr_list' => $v['sku_id'], 'goods_id' => $v['goods_id']))
                        ->field('id')
                        ->find();
                } else {
                    $v['sku_id'] = '';
                }
            }
			//$integral += $goods['integal'];
			// 得到商品库存
			$num_res = $this->checkCartNum($goods['id'], $v['num'], $v['sku_id'], $v['type']);
			if($num_res['status']!=1){
				$this->ajaxReturn(array("status"=>0, "info"=>$num_res['info']));
			}
			$price = $num_res['price'];
			// 记入订单详情
			$order_goods_data[] = array(
						'goods_id'    => $goods['id'],
						'goods_name'  => $goods['goods_name'],
						'goods_nums'  => $v['num'],
						'goods_price' => $price,
						'goods_priceall'=>$price*$v['num'],
						'goods_pic'  => $goods['logo_pic'],
						//"sku_list_id" => $v['sku_id']?$v['sku_id']:0,
						"sku_list_id" => $sku_id['id'],
						//'jifen'       => $integral,
						'sku_info'    => $this->getSkuDes($v['sku_id']),
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
        $this->ajaxReturn(array("status"=>1,'order_id'=>$order_res,'order_no'=>$order_data['order_no'],"url"=>U('Order/pays',array("order_no"=>$order_data['order_no'], "order_id"=>$order_res))));
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
	}

	/*付款页面*/
	public function pays() {
        $order_id = '';
        $order_id = I('get.order_id');
        /*根据订单id查出相关信息*/
        if($order_id){
            $order_info = M('order_info')
                ->where(array('id'=>$order_id))
                ->field('id, total_fee, consignee, province, city, district, address, mobile')
                ->find();
            $this->assign('order_info', $order_info);
        }
	    $this->display();
    }

    /*付款成功页面*/
    public function paySuccess() {
        $order_id = I('get.id', '0', 'intval');
        $order_info = M('order_info')
            ->where(array('id'=>$order_id))
            ->field('order_time, total_fee, total_price, consignee, province, city, district, address, mobile')
            ->find();
        $order_info['order_time'] = date('Y-m-d H:i:s', $order_info['order_time']);
        $this->assign('info', $order_info);
        $this->display();
    }

    /*付钱*/
    public function balancePuy() {
        if(IS_AJAX){
            $order_id = I('post.order_id', '0', 'intval');
            $price = I('post.price');
            /*查出当前用户的余额*/
            $balance_user = M('member')
                ->where(array('id' => $this->user_id))
                ->field('wallet')
                ->find();
            if(!$balance_user) {
                $this->ajaxreturn(array("status"=>0, 'info'=>"操作失败，请稍后重试！"));
            }

            if($balance_user['wallet'] < $price) {
                $this->ajaxreturn(array("status"=>0, 'info'=>"钱包余额不足，请充值后重试！"));
            }
            M()->startTrans();
            $balance = $balance_user['wallet'] - $price;/*算出钱包扣款后的余额*/
            $m = M('member');
            $where = array(
                'id' => $this->user_id,
            );
            $dat = array(
                'wallet' => $balance,
            );
            $res = $m->where($where)->save($dat);

            if(!$res) {
                //return array("status"=>0, "info"=>"操作失败，请稍后重试！");
                M()->rollback();
                $this->ajaxreturn(array("status"=>0, 'info'=>"操作失败，请稍后重试！"));
            }
            /*修改订单状态*/
            $data = array(
                "pay_status"    => 1,
                "order_status"  => 2,
                "pay_price"		=> $price,
                "pay_way"		=> 2,
                "pay_time"		=> time(),
            );
            $res2 = M('order_info')->where(array('id'=>$order_id))->save($data);
            if(!$res2){
                M()->rollback();
                // 这里记入错误日志
                $msg = "用户支付成功，订单改变状态失败！";
                $this->addToOrderErrorLog($this->user_id,$order_id,$msg);

            }

            $res3 = $this->delStore($order_id);
            if(!$res3) {
                M()->rollback();
                $this->ajaxreturn(array("status"=>0, 'info'=>"操作失败，请稍后重试！"));
            } else {
                M()->commit();
                $this->ajaxreturn(array("status"=>1, 'order_id'=>$order_id));
            }
        }

    }

    /**
     * 减少订单对应商品的库存的方法
     */
    private function delStore($orderid){
        $order_goods = M("order_goods")->where(array('order_id'=>$orderid))->select();
        if(!$order_goods){
            return false;
        }
        $return = true;
        foreach ($order_goods as $k){
            if($k['type'] == '1' || $k['type'] == '2') {
                $g_m   = M("goods");
                $sku_m = M("sku_list");
            } elseif($k['type'] == '3') {
                $g_m   = M("goods_market");
                $sku_m = M("sku_list_market");
            }
            $nums = $k['goods_nums'];
            if($k['sku_list_id']){
                $store = $sku_m->where(array("id"=>$k['sku_list_id']))->getField("stock");
                if($store < $nums){
                    // 记入错误日志
                    $msg = "商品库存不足，用户需要{$nums}件，商城只有{$store}";
                    $this->addToOrderErrorLog($k['user_id'],$k['order_id'],$msg,$k['goods_id'],$k['goods_nums'],$k['sku_list_id'],$k['sku_info']);
                    $return = fasle;
                    // $res  = $sku_m->where(array("id"=>$k['sku_list_id']))->setField("stock", 0);
                    // $res2 = $sku_m->where(array("id"=>$k['sku_list_id']))->setInc("sell_nums", $store);
                }else{
                    $res  = $sku_m->where(array("id"=>$k['sku_list_id']))->setDec("stock", $nums);
                    $res2 = $sku_m->where(array("id"=>$k['sku_list_id']))->setInc("sales", $nums);
                    $res3 = $g_m->where(array("id"=>$k['goods_id']))->setDec("stock", $nums);
                    $res4 = $g_m->where(array("id"=>$k['goods_id']))->setInc("sales", $nums);
                    /*根据商品id查出赠送积分*/
                    $integral = $g_m->where(array('id' =>$k['goods_id']))->field('integral')->find();
                    $res5 = M('member')->where(array("id"=>$this->user_id))->setInc("integral", ($integral['integral']*$k['goods_nums']));

                    if(!$res){
                        // 记入错误日志
                        $msg = "减少商品库存失败，需减少{$nums}";
                        $this->addToOrderErrorLog($k['user_id'],$k['order_id'],$msg,$k['goods_id'],$k['goods_nums'],$k['sku_list_id'],$k['sku_info']);
                        $return = fasle;
                    }
                    if(!$res2){
                        // 记入错误日志
                        $msg = "商品增加销量失败，需增加{$nums}";
                        $this->addToOrderErrorLog($k['user_id'],$k['order_id'],$msg,$k['goods_id'],$k['goods_nums'],$k['sku_list_id'],$k['sku_info']);
                        $return = fasle;
                    }
                }
            }else{
                $store = $g_m->where(array("id"=>$k['goods_id']))->getField("stock");
                if($store < $nums){
                    // 记入错误日志
                    $msg = "商品[{$k['sku_info']}]库存不足，用户需要{$nums}件，商城只有{$store}";
                    $this->addToOrderErrorLog($k['user_id'],$k['order_id'],$msg,$k['goods_id'],$k['goods_nums'],$k['sku_list_id'],$k['sku_info']);
                    $return = fasle;
                    // $res  = $g_m->where(array("id"=>$k['goods_id']))->setField("stock", 0);
                    // $res2 = $g_m->where(array("id"=>$k['goods_id']))->setInc("sell_nums", $store);
                }else{
                    $res  = $g_m->where(array("id"=>$k['goods_id']))->setDec("stock", $nums);
                    $res2 = $g_m->where(array("id"=>$k['goods_id']))->setInc("sales", $nums);
                    $integral = $g_m->where(array('id' =>$k['goods_id']))->field('integral')->find();
                    $res5 = M('member')->where(array("id"=>$k['user_id']))->setInc("integral", $integral['integral']);
                    if(!$res){
                        // 记入错误日志
                        $msg = "减少商品库存失败，需减少{$nums}";
                        $this->addToOrderErrorLog($k['user_id'],$k['order_id'],$msg,$k['goods_id'],$k['goods_nums'],$k['sku_list_id'],$k['sku_info']);
                        $return = fasle;
                    }
                    if(!$res2){
                        // 记入错误日志
                        $msg = "商品增加销量失败，需增加{$nums}";
                        $this->addToOrderErrorLog($k['user_id'],$k['order_id'],$msg,$k['goods_id'],$k['goods_nums'],$k['sku_list_id'],$k['sku_info']);
                        $return = fasle;
                    }
                }
            }
        }
        return $return;
    }

    /*错误日志*/
    public function addToOrderErrorLog($userid=null,$orderid=null,$msg=null,$goodsid=null,$nums=null,$skuid=null,$skuinfo=null){
        $data = array(
            "user_id"   => $userid,
            "order_id"  => $orderid,
            "msg"		=> $msg,
            "goods_id"	=> $goodsid,
            "nums"		=> $nums,
            "sku_id"	=> $skuid,
            "sku_info"	=> $skuinfo,
            "create_at" => time(),
            "status"	=> 0,
        );
        M("order_error_log")->add($data);
    }

    /**
     * mtf
     * 取消订单
     * 判断订单状态是否处于可取消状态
     * 可取消状态：1
     */
    public function cancelOrder(){
        if(IS_AJAX){
            $id = I("post.id");
            $m = M("orderInfo");
            $map = array("user_id"=>$this->user_id,"id"=>$id,"order_status"=>1);
            $order_res = $m->where($map)->find();
            if(!$order_res){
                $this->ajaxReturn(array("status"=>0, "info"=>"无效的订单！"));
            }
            $res = $m->where($map)->save(array("order_status"=>0, "is_valid"=>0));
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"取消订单成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"取消订单失败！"));
            }
        }
        $this->error("非法访问！");
    }

    /**
     * mtf
     * 确认收货，判断是否可以反佣金
     * 判断订单状态是否处于可确认收货状态  => 4
     * is_confirm => 1
     * 可触发状态：3
     */
    public function confirmOrder(){
        if(IS_AJAX){
            $id = I("post.id");
            $m = M("orderInfo");
            $map = array("user_id"=>$this->user_id,"id"=>$id,"order_status"=>3);
            $order_res = $m->where($map)->find();
            if(!$order_res){
                $this->ajaxReturn(array("status"=>0, "info"=>"无效的订单！"));
            }
            $res = $m->where($map)->save(array("order_status"=>4, "is_confirm"=>1));
            if($order_res['onelevel']){
                $price = floatval($order_res['onelevel']);
                M("member")->where(array('id'=>$this->user_id))->setInc("wallet",$price);
            }
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"确认收货成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"确认收货失败！"));
            }
        }
        $this->error("非法访问！");
    }

    /**
     * mtf
     * 申请退款
     * 判断订单状态是否处于可申请退款状态  => 6
     * 可触发状态：2 ， 3
     * 确认退款后 is_refund => 1;并记录瑞款时间
     */
    public function refundOrder(){
        if(IS_AJAX){
            $id = I("post.id");
            $m = M("orderInfo");
            $map = array("user_id"=>$this->user_id,"id"=>$id);
            $order_res = $m->where($map)->find();
            if(!$order_res){
                $this->ajaxReturn(array("status"=>0, "info"=>"无效的订单！"));
            }
            if(!in_array($order_res['order_status'],array(2,3))){
                $this->ajaxReturn(array("status"=>0, "info"=>"订单不可退款！"));
            }
            $res = $m->where($map)->save(array("order_status"=>6));
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"申请退款成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"申请退款失败！"));
            }
        }
        $this->error("非法访问！");
    }

    /**
     * mtf
     * 删除订单
     * 判断订单状态是否处于可删除状态
     * 可取消状态：0 ， 4 ， 5
     */
    public function delOrder(){
        if(IS_AJAX){
            $id = I("post.id");
            $m = M("orderInfo");
            $map = array("user_id"=>$this->user_id,"id"=>$id);
            $order_res = $m->where($map)->find();
            if(!$order_res){
                $this->ajaxReturn(array("status"=>0, "info"=>"无效的订单！"));
            }
            if(!in_array($order_res['order_status'],array(0,4,5))){
                $this->ajaxReturn(array("status"=>0, "info"=>"订单不可删除！"));
            }
            $res = $m->where($map)->setField("order_status", 7);
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"删除成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"删除失败！"));
            }
        }
        $this->error("非法访问！");
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
	 * zyf
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





}