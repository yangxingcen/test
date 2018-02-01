<?php
namespace Wx\Controller;
use Think\Controller;

class IntegralController extends PublicController {
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
		$id = I("get.id");
		$sort = I("get.sort");
		$this->assign("sorts", $sort);
		$where = '';
		if($id){
			$where .= " and cate_id ='".$id."'";
		}
		if($sort){
			if($sort == 1){
				$sort = 'price';
			}else{
				$sort = 'price desc'; 
			}
			
		}else{
			$sort = 'sort desc';
		}
	  	$user_id = $this->wx_user_id;
	  	$member = M("member")->where("id='".$user_id."' and isdel=0 and status=0")->find();
	  	//积分分类,分类价格区间
	  	$in_type = M("integral_shop_type")->where('is_del=0 and status=0')->field("id,name,sort,status,add_time,pic_logo")->order('sort')->select();
	  	if($id){
	  		$type_price =  M("integral_type_price")->where("type_id='".$id."'")->field("id,price")->order('id')->select();
	  	}else{
	  		$type_price1 = ['0-20000','20000-50000','50000-100000','100000-200000','大于200000'];
	  	}
	  	//积分banner
	  	$banner = M("shop_banner")->where('type=28 and status=0 and is_del=0')->order("sorts")->select();
	  	//积分商品
	  	$pageSize = 4;
	  	$count = M("integral_goods")->where("is_del=0 and is_sale=1".$where)->field("id,logo_pic,goods_name,price,volume")->count();
	  	$P = getpage($count,$pageSize);
	  	$shop = M("integral_goods")->where("is_del=0 and is_sale=1".$where)->field("id,logo_pic,goods_name,price,volume")->limit($P->firstRow, $P->listRows)->order($sort)->select();
	  	$page  = $P->show();
	  	// echo"<pre>";
	  	// print_r($type_price1);
	  	// exit;
	  	$this->assign("page", $page);
        $this->assign("banner", $banner);
        $this->assign("type_price1", $type_price1);
	  	$this->assign("type_price", $type_price);
	  	$this->assign("shop", $shop);
	  	$this->assign("in_type", $in_type);
	  	$this->assign("integral", $member['integral']);
		$this->display();
	}
	public function integralDetail(){
		$id = I("get.id");
		$goodsInfo = M('integral_goods')->alias('i')->join('tb_integral_shop_type as t on t.id=i.cate_id')->where("i.is_del=0 and i.is_sale=1 and i.id='".$id."'")->find();
		$goodsInfo['pic1']=explode(",",$goodsInfo['pic1']);
		
		//sku
		if ($goodsInfo['is_sku']) {
            $sku_item = json_decode($goodsInfo['goods_sku_info'], true);
            $sku_data = M('integral_sku_list')->where(array('goods_id' => $id, "status" => 0,'is_del'=>0))->select();
            $sku_data = deal_sku_data($sku_data);
        }
        //地址
        $address = M("address")->where("userid='".$this->wx_user_id."' and isdefault = 1")->find();
		$this->assign("id", $id);
		$this->assign("goodsInfo", $goodsInfo);
		$this->assign('address',$address);
	  	$this->assign('sku_item', $sku_item);
	  	$this->assign("sku_data", json_encode($sku_data));
	  	$this->assign("user_id", $this->wx_user_id);
		$this->display();
	}
	//马上兑换
	public function ok_order(){
		$goodsid = I('post.goodsid', 0, "intval");
		$skuid   = I('post.skuid', 0, "trim");
		$userid  = $this->wx_user_id;
		$nums    = I("post.nums", 0, "intval");
		$address_id    = I("post.address_id", 0, "intval");
		$price    = I("post.price", 0, "intval");
		$sku_info    = I("post.sku_info");
		//获取商品
		$info = M("integral_goods")->where("id='".$goodsid."'")->find();
		//获取地址
        if($address_id){
            $address_info = M("address")->where("id='".$address_id."'")->field("consignee,telephone,province,city,district,place")->select();
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'请选择地址!'));
            exit;
        }
        //获取购买的会员的积分
        $my_integral = M("member")->where("id='".$this->wx_user_id."'")->field("integral")->select();
        $my_integral = $my_integral[0]['integral'];
        //获取库存
        $skuid = explode('-',$skuid);
        asort($skuid);
        $attr_list = '';
        foreach($skuid as $k=>$v) {
            if($v){
                $attr_list .= $v.'-';
            }  
        }
        // 判断是sku库存还是本身库存
        if($attr_list){
            $attr_list = '-'.$attr_list;
            $my_store = M("integral_sku_list")->where("goods_id='".$goodsid."' and attr_list='".$attr_list."'")->field('id,stock')->select();
            $my_store = $my_store[0]['stock'];
        }else{
            $my_store = M("integral_goods")->where("id='".$goodsid."'")->field('stock')->select();
            $my_store = $my_store[0]['stock'];
        }
        //获取销量
        $my_volume = M("integral_goods")->where("id='".$goodsid."'")->field('volume')->select();
        $my_volume = $my_volume[0]['volume'];
        //判断库存
        if($my_store < $nums){
            $this->ajaxReturn(array('status'=>0,'info'=>'库存不足!'));
            exit;
        }
        //判断积分
        if($my_integral < $price){
            $this->ajaxReturn(array('status'=>0,'info'=>'积分不足!'));
            exit;
        }
        //修改积分的数据
        $up_integral = array(
            'integral' => $my_integral-$price,
        );
        //修改库存的数据
        $up_store = array(
            'stock' => $my_store-$nums,
        );
        //增加销量的数据
        $up_volume = array(
            'volume' => $my_volume+$nums,
        );
        
        //生成订单的数据
        $order = array(
            'order_id' => date('Ymdhis') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT).$user_id,
            'price' => $price*$nums,
            'user_id'=> $this->wx_user_id,
            'address' => $address_info[0]['province'].$address_info[0]['city'].$address_info[0]['district'].$address_info[0]['place'],
            'consignee' => $address_info[0]['consignee'],
            'telephone' => $address_info[0]['telephone']
        );
       

        //开启回滚事务
        M('integral_order')->startTrans();
        //生成订单
        $order_id=M('integral_order')->add($order);
        //添加积分流水的数据
        $is_arr = array(
            'action' => 7,
            'user_id' => $this->wx_user_id,
            'integral' => $price*$nums,
            'integral_befor' => $my_integral,
            'integral_after' => $my_integral-$price*$nums,
            's_type' => 2,
            'goods_id' => $goodsid,
            'goods_name' => $info['goods_name'],
            'goods_img' => $info['logo_pic'],
            'order_id' => $order_id,

        );
        
        //生成订单详情数据
        $order_info = array(
            'order_id' => $order_id,
            'goods_id' => $goodsid,
            'price' => $price,
            'num' => $nums,
            'sku_info' => $sku_info,
            'goods_name' => $info['goods_name'],
            'goods_logo' => $info['logo_pic'],
            'price_num' => $price*$nums,
            'sku_list' => $attr_list
        );
        //生成订单详情
        $o_res = M('integral_order_info')->add($order_info);
        // 修改积分
        $m_res = M("member")->where("id='".$this->wx_user_id."'")->field("integral")->save($up_integral);
        // 修改库存
        if($attr_list){
            $r_store = M("integral_sku_list")->where("goods_id='".$goodsid."' and attr_list='".$attr_list."'")->save($up_store);
            $r_store = M("integral_goods")->where("id='".$goodsid."'")->save($up_store);
        }else{
            $r_store = M("integral_goods")->where("id='".$goodsid."'")->save($up_store);
        }
        //增加销量
        $r_volume = M("integral_goods")->where("id='".$goodsid."'")->save($up_volume);
        //添加积分流水
        $is_res = M("integral_status")->add($is_arr);
        if($o_res && $m_res && $r_volume && $r_store && $order_id && $is_res){
            //提交事务
            M('integral_order')->commit();
            $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
        }else{
            // 回滚事务
            M('integral_order')->rollback();
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
	}
}
