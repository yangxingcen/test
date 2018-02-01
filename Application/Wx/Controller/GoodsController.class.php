<?php
namespace Wx\Controller;
use Think\Controller;

class GoodsController extends PublicController {
	//产品分类
	public function goodsList(){
	  	$goods_type = M("shop_goods_cate")->where("status=0 and is_del=0 and pid=0")->field("id,classname,pid,pic5")->order('sorts')->select();
	  	foreach ($goods_type as &$v) {
	  		$v['son_type'] = M("shop_goods_cate")->where("status=0 and is_del=0 and pid='".$v['id']."'")->field("id,classname")->order('sorts')->select();
	  		foreach ($v['son_type'] as &$z) {
	  			$z['goods'] = M('goods')->where("cate_id='".$z['id']."' and is_groom=1 and is_del=0 and is_sale=1")->field('id,goods_name,logo_pic')->limit(3)->select();
	  		}
	  	}
	  	$this->assign('goods_type',$goods_type);
		$this->display();
	}
	// 全部产品
	public function product(){
		$cate_id=I("get.cate_id");
		$cate_pid=I("get.cate_pid");
		$where='';
		if($cate_id){
			$where .= ' and cate_id="'.$cate_id.'"';
		}
		if($cate_pid){
			$where .= ' and cate_pid="'.$cate_pid.'"';
		}
	  	//商品分类
	  	$goods_type = M("shop_goods_cate")->where("status=0 and is_del=0 and pid=0")->field("id,classname,pid,pic")->order('sorts')->select();
	  	//商品
	  	$goods = M('goods')->alias('g')->join('tb_shop_goods_cate as c on c.id=g.cate_pid')->where("g.is_groom=1 and g.is_del=0 and g.is_sale=1".$where)->field('g.id,g.goods_name,g.logo_pic,g.goods_des,g.comment_num,g.price,c.classname')->select();
	  	if(!$cate_pid){
			$cate_pid = $goods[0]['cate_pid'];
	  	}
	  	$this->assign('cate_pid',$cate_pid);
	  	$this->assign('goods',$goods);
	  	$this->assign('goods_type',$goods_type);
		$this->display();
	}
	// 餐品详情
	public function detail(){
	  	$id = I("get.id");
	  	if(!$id){
	  		$this->error();
	  	}
	  	//添加浏览记录
	  	$query = $info = M('browse')->where("user_id='".$this->wx_user_id."' and is_del=0 and goods_id='".$id."'")->find();
	  	if($query['id']){
	  		$up_browse = array(
		  		'add_time' => date("Y-m-d h:i:s")
	  		);
	  		M('browse')->where('id="'.$query['id'].'"')->save($up_browse);
	  	}else{
	  		$add_browse = array(
		  		'goods_id' => $id,
		  		'type' => 1,
		  		'user_id' => $this->wx_user_id,
		  		'add_time' => date("Y-m-d h:i:s")
	  		);
	  		M('browse')->add($add_browse);
	  	}
	  	
	  	//商品
	  	$goods = M('goods')->where("is_del=0 and is_sale=1 and id='".$id."'")->find();
	  	$sc = M('collection')->where('goods_id = "'.$goods['id'].'" and type = "'.$goods['type'].'" and status=1')->count();
		if(!$goods){
			$this->error();
		}
		//sku
		if ($goods['is_sku']) {
            $sku_item = json_decode($goods['goods_sku_info'], true);
            $sku_data = M('sku_list')->where(array('goods_id' => $id, "status" => 0,'is_del'=>0))->select();
            $sku_data = deal_sku_data($sku_data);
        }
        //  echo "<pre>";
        // print_r($goods['is_sku']);
        // exit;
	  	// 商品参数
	  	$goods_param = unserialize($goods['goods_param']);
	  	if($goods_param){
            foreach ($goods_param as $key =>$value){
                $goods_param[$key]=explode('-',$value);
            }
        }
        //地址
        $address = M("address")->where("userid='".$this->wx_user_id."' and isdefault = 1")->find();
        // echo "<pre>";
        // print_r($address);
        //商品轮播图
        $goods['pics'] = explode(",",$goods['pics']);
        // 相似商品
        $xs_goods = M('goods')->where("is_groom=1 and is_del=0 and is_sale=1 and cate_id='".$goods['cate_id']."' and is_groom=1 and id<>'".$id."'")->field('price,sales,goods_name,logo_pic')->order('add_time desc')->limit(3)->select();
        $this->assign('sc',$sc);
	  	$this->assign('xs_goods',$xs_goods);
	  	$this->assign('goodsinfo',$goods);
	  	$this->assign('address',$address);
	  	$this->assign('sku_item', $sku_item);
	  	$this->assign("sku_data", json_encode($sku_data));
	  	$this->assign("user_id", $this->wx_user_id);
		$this->display();
	}

	/*查出商品相关信息*/
	public function detailById() {
        if(IS_AJAX){
            $id = I('post.id', '0', 'intval');
            if(!$id){
                $this->error();
            }
            //商品
            $goods = M('goods')->where("is_del=0 and is_sale=1 and id='".$id."'")->find();
            $sc = M('collection')->where('goods_id = "'.$goods['id'].'" and type = "'.$goods['type'].'" and status=1')->count();
            if(!$goods){
                $this->error();
            }
            //sku
            if ($goods['is_sku']) {
                $sku_item = json_decode($goods['goods_sku_info'], true);
                $sku_data = M('sku_list')->where(array('goods_id' => $id, "status" => 0, 'is_del' => 0))->select();
                $sku_data = deal_sku_data($sku_data);
            }
            // 商品参数
            $goods_param = unserialize($goods['goods_param']);
            if($goods_param){
                foreach ($goods_param as $key =>$value){
                    $goods_param[$key]=explode('-',$value);
                }
            }
            //地址
            $address = M("address")->where("userid='".$this->wx_user_id."' and isdefault = 1")->find();
            //echo array("status"=>'1',"address"=>$address, "goodsInfo"=>$goods,"sku_item"=>$sku_item);
            //var_dump($sku_item);exit;
            $this->ajaxReturn(array("status"=>1 ,"address"=>$address,"goodsInfo"=>$goods,"sku_item"=>$sku_item));

        }
    }

	//限时促销
	public function sale(){
		$this->display();
	}
	// 添加购物车
	public function addcar(){
		if(IS_AJAX){
           if(IS_AJAX){
			$goodsid = I('post.goodsid', 0, "intval");
			$skuid   = I('post.skuid', 0, "trim");
			$userid  = $this->wx_user_id;
			$nums    = I("post.nums", 0, "intval");
			$isactivity    = M("goods")->where('id="'.$goodsid.'"')->getField('type');
			if(!$isactivity){
				$isactivity    = M("goods_market")->where('id="'.$goodsid.'" and isactivity=1 and is_sale=1 and id_del=0')->getField('type');
			}
            $skuid = explode('-',$skuid);
            asort($skuid);
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
			// echo "<pre>";
			// print_r($cart);
			// exit;
			if($cart){
				$res = $m->where($map)->setInc("num", $nums);

			}else{
				$res = $m->add($data);
			}
			$count = $m->where(array('user_id'=>$userid))->count();
			if($res){
                // $this->logs('添加商品到购物车');
				$this->ajaxReturn(array("status"=>1 ,"info"=>"添加购物车成功！"));
			}else{
				$this->ajaxReturn(array("status"=>0 ,"info"=>"添加购物车失败！"));
			}
		}
		$this->error("非法访问！");
	}
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
	 /**
     * 收藏
     */
    public function addcollect()
    {
        if(IS_AJAX) {
            $data['user_id']=$this->wx_user_id;
            $data['goods_id'] = I("post.goodsid");
            $data['create_at'] = time();
            $data['collect_time'] = time();
            $data['status'] = 1;
            $isactivity  = M("goods")->where('id="'.$data['goods_id'].'" and is_sale=1 and is_del=0')->getField('type');
			if(!$isactivity){
				$isactivity    = M("goods_market")->where('id="'.$data['goods_id'].'" and isactivity=1 and is_sale=1 and is_del=0')->getField('type');
			}

            if($isactivity == '1') {
                $data['type'] = '1';
                $g=M('goods');

                $where = array(
                    "user_id" => $data['user_id'],
                    "goods_id" => $data['goods_id'],
                    'type'     => '1',
                 
                );
                $goods_where = array(
                    "id" => $data['goods_id'],
                    'type'     => '1',
                    'is_del'    => '0',
                    'is_sale'   => '1',
                );
            } elseif($isactivity == '2'){
                $data['type'] = '2';
                $g=M('goods');

                $where = array(
                    "user_id" => $data['user_id'],
                    "goods_id" => $data['goods_id'],
                    'type'     => '2',
                
                );
                $goods_where = array(
                    "id" => $data['goods_id'],
                    'type'     => '2',
                    'is_del'    => '0',
                    'is_sale'   => '1',
                );
            } elseif($isactivity == '3') {
                $data['type'] = '3';
                $g=M('goods_market');

                $where = array(
                    "user_id" => $data['user_id'],
                    "goods_id" => $data['goods_id'],
                    'type'     => '3',
            
                );
                $goods_where = array(
                    "id" => $data['goods_id'],
                    'isactivity'     => '1',
                    'is_del'    => '0',
                    'is_sale'   => '1',
                );
            }
            $m = M('collection');

            $res = $m->where($where)->find();//先查用户和商品关联的数据是否存在

            if ($res)//商品存在
            {
                $status = $res['status'];//收藏状态
                if ($status==1) {//如果为1 表示已收藏 ->修改收藏状态  改为取消收藏

                    $dat['status'] = 0;
                    $dat['collect_time'] = 0;
                    $m->where($where)->save($dat);//更新收藏表

                    //获取此时收藏数量
                    $g->where($goods_where)->setDec('collection_num',1);//更新goods表        减1
                    $this->ajaxReturn(array("status"=>0, "info"=>"已取消收藏！"));
                } elseif($status==0) {//没有收藏->修改收藏状态    加1
                    $dat['status'] = 1;
                    $dat['collect_time'] = time();
                    $m->where($where)->save($dat);//更新收藏表
                    $g->where($goods_where)->setInc('collection_num',1);;//更新goods表          加1
                    $this->ajaxReturn(array("status"=>1, "info"=>"收藏成功！"));
                }
            } else {
                $m->data($data)->add();//更新收藏表
                $g->where($goods_where)->setInc('collection_num',1);;//更新goods表   加1
                $this->ajaxReturn(array("status"=>1, "info"=>"收藏成功！"));
            }
        }
    }
}
