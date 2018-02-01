<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/7
 * Time: 15:31
 */
namespace Shop\Controller;
use Think\Controller;
class IntegralController extends PublicController {
    public function _initialize()
    {
        parent::_initialize();
        $this->checkLogin(1);
        $this->assign("userinfo", $this->user_info);
    }
    public function index(){
        $cate = I("get.cate");
       
        if($cate){
            $this->assign("s_cate_id",$cate);
        }
        $user_id = $this->user_id;

        $integral = M("member")->where("isdel=0 and status=0 and id='".$user_id."'")->field("integral,person_name,person_img")->select();
     
        $type_list=M("integral_shop_type")->where('is_del=0 and status=0')->field("id,name,sort,status,add_time")->order('sort')->select();
        $integral_stream = M("integral_status")->alias('i')->join('tb_member as m ON m.id=i.user_id')->where('i.is_del=0 and i.s_type=2')->field('i.goods_name,i.goods_img,m.telephone,i.add_time,i.integral')->select();

        $this->assign('type_list',$type_list);
        $this->assign('integral',$integral[0]['integral']);
        $this->assign('person_name',$integral[0]['person_name']);
        $this->assign('person_img',$integral[0]['person_img']);
        $this->assign('integral_stream',$integral_stream);
        $this->assign('header_bot', '1');
        $this->display();
    }
    //如何获取积分页面
    public function addIntegral(){
    	$user_id = $this->user_id;
        // var_dump($user_id) ;
        // exit;
        $integral = M("member")->where("isdel=0 and status=0 and id='".$user_id."'")->field("integral")->select();
        $integral = $integral[0]['integral'];
        // echo "<pre>";
        // print_r($integral);
    	$date_befor = date('Y-m-d H:i:s',strtotime(date('Y-m-d')));
    	$date_after = date('Y-m-d H:i:s',strtotime("$date_befor +1 day"));
    	
    	$Integral_list = D("Integral")->alias('i')->where('i.is_del=0 and status=0')->field('i.id,i.title,i.integral,i.integral_type')->order('i.id')->select();
    	foreach ($Integral_list as &$v) {
    		$Integral_status = D("Integral_status")->where('add_time >="'.$date_befor.'" and add_time <="'.$date_after.'" and user_id="'.$user_id.'" and is_del=0')->field('action')->select();
    		if(!$Integral_status){
    			if($v['id'] == 1 || $v['id'] == 2 || $v['id'] == 7){
    				$v['status'] = 1;
	    		}else{
	    			$v['status'] = 2;
	    		}
    		}else{
    			$v['status'] = 2;
    			foreach ($Integral_status as &$z) {
	    			if($v['id'] == $z['action'] || $v['id'] == 1 || $v['id'] == 2 || $v['id'] == 7){
	    				$v['status'] = 1;
	    			}
	    		}
    		}
    		
    		
    	}
        $this->assign('integral', $integral);
    	$this->assign('Integral_list', $Integral_list);
        $this->assign('header_bot', '1');
        $this->display();
    }
    //获取积分
    public function Integral_status(){
    	$id = I("post.id");
    	$integral = I("post.title");
    	$user_id = $this->user_id;
    	$integral_befor = M("member")->where("isdel=0 and status=0 and id='".$user_id."'")->field("integral")->select();
        $integral_befor = $integral_befor[0]['integral'];
 
    	$arr = array(
    		'action' => $id,
    		'user_id' => $user_id,
    		'integral' => $integral,
    		'integral_befor' => $integral_befor,
    		'integral_after' => $integral_befor+$integral,
            's_type' => 1
    	);
        $u_integral = M("member")->where("isdel=0 and status=0 and id='".$user_id."'")->field("integral")->select();
        $u_integral = $u_integral[0]['integral'];
        $u_arr = array(
            'integral' => $u_integral+$integral,
        );
        M('integral_status')->startTrans();
        $u_res = M("member")->where("id='".$user_id."'")->save($u_arr);
    	$res = M('integral_status')->add($arr);
    	if($u_res && $res){
            M('integral_status')->commit();
    		$this->ajaxReturn(array('status'=>1,'info'=>'成功！'));
    	}else{
            M('integral_status')->rollback();
    		$this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
    	}
    }
    public function all_price(){
        $id=I("post.id");
        $list = M("integral_type_price")->where("type_id='".$id."'")->field("id,price")->order('id')->select();

        $this->ajaxreturn($list);
    }
    //获取商品
    public function goods_list(){
        $data = I("post.post");
        $cate = I("post.cate");
        $where = '';
        $sort = '';
        if($cate){
            $where .= ' and cate_id = "'.$cate.'"';
        }
        if($data['typeid']){
            $where .= ' and cate_id = "'.$data['typeid'].'"';
        }
        if($data['data']){
            if(strpos($data['price'],'以上') !== false){
                $where .= ' and price > "'.$data['price'].'"';
            }else{
                if($data['data'] == 'price'){
                    $price_arr = explode("-",$data['price']);
                    $where .= ' and price between "'.$price_arr[0].'" and "'.$price_arr[1].'"';
                }
            }
            
        }
        if($data['sorts']){
            switch ($data['sorts']) {
                case '按积分':
                    $sort = 'price';
                break;
                case '按积分1':
                    $sort = 'price desc';
                break;
                case '按时间':
                    $sort = 'edit_at';
                break;
               default:
                    $sort = 'edit_at desc';
                break;
           }
        }else{
            $sort = 'sort desc,create_at desc';
        }
        $count = M("integral_goods")->where("is_del=0 and is_sale=1".$where)->field("id")->count();
        $pageSize=8;
        $Page  = ceil($count/$pageSize);
        if($data['page']){
            $PageNum = $data['page']-1;

        }else{
            $PageNum = 0;
        }
        $pageNow = $PageNum*$pageSize;
        $list = M("integral_goods")->where("is_del=0 and is_sale=1".$where)->field("id,logo_pic,goods_name,price,volume")->order($sort)->limit($pageNow.','.$pageSize)->select(); 
        $arr_list = array(
            'num' => $Page,
            'res' => $list,
            'page' => $data['page'],
            'sorts' => $data['sorts']
        );
       
        
        $this->ajaxreturn($arr_list);
        
    }
    public function detail(){
        $this->assign('header_bot', '1');
        $cate = M('integral_shop_type');
        $goods = M('integral_goods');
        $id = I('get.id', 0, 'intval');
        $Time=time();
        // $url = base64_encode(U("Goods/detail",array("id"=>$id)));
        $this->assign("url",$url);
        $goodsInfo = $goods->where(array('id'=>$id, 'is_del'=>0, 'is_sale'=>1))->find();
        $goodsInfo['price'] = number_format($goodsInfo['price'], 2);
        $goodsInfo['oprice'] = number_format($goodsInfo['oprice'], 2);
        /*根据商品id查出分类*/
        $cate_two = array();
        $cate_two = $cate -> where(array('id' => $goodsInfo['cate_id'], 'status' => '0'))->find();
        // echo "<pre>";;
        // print_r($cate_two);
        // exit;
        /*获取滚动图片*/
        $picAll = explode(',', $goodsInfo['pic1']);
        /*sku*/
        //$sku_item = "";
        if ($goodsInfo['is_sku']) {
            $sku_item = json_decode($goodsInfo['goods_sku_info'], true);
            $sku_data = M('integral_sku_list')->where(array('goods_id' => $id, "status" => 0,'is_del'=>0))->select();
            $sku_data = deal_sku_data($sku_data);
        }
        // echo "<pre>";
        // print_r($sku_item);
        $goods_param = array();
        if($goodsInfo['goods_param']) {
            $goods_param = unserialize($goodsInfo['goods_param']);
            if($goods_param){
                foreach ($goods_param as $key =>$value){
                    $goods_param[$key]=explode('-',$value);
                }
            }
        }
        /*类似风格*/
        $cate_id = $goodsInfo['cate_id'];
        $cate_like = M('integral_goods')
            ->where(array('cate_id' => $cate_id, 'is_del' => '0', 'status' => '1', 'is_sale' => '1'))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit('1, 4')
            ->select();
        /*同等价位*/
        $price_like = M('integral_goods')
            ->where(array('cate_id' => $goodsInfo['price'], 'is_del' => '0', 'status' => '1', 'is_sale' => '1'))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit('1, 4')
            ->select();
        /*同类热销*/
        $cate_like_hot = M('integral_goods')
            ->where(array('cate_id' => $cate_id, 'is_del' => '0', 'status' => '1', 'is_sale' => '1'))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('volume DESC')
            ->limit('1, 4')
            ->select();
        /*用户id*/
        $user_id = $this->user_id;
        // dump($user_id);
        // exit;
        // dump($sku_item);
        $goodsInfo['pic1']=explode(",", $goodsInfo['pic1']);
        // echo "<pre>";
        // print_r($goodsInfo);
        // exit;

        $this->assign('user_id', $user_id);
        $this->assign('cate_like_hot', $cate_like_hot);
        $this->assign('price_like', $price_like);
        $this->assign('cate_like', $cate_like);
        $this->assign('goods_param', $goods_param);
        $this->assign("sku_data", json_encode($sku_data));
        $this->assign('picAll', $picAll);
        $this->assign('goodsInfo', $goodsInfo);
        $this->assign('sku_item', $sku_item);
        $this->assign('cate_two', $cate_two);
        $this->display();
    }
    private function checkCartNum($goodsid, $num, $skuid){
        $goods = M("integral_goods")->where(array("id"=>$goodsid ,"is_del"=>0))->find();
        // echo M("integral_goods")->_sql();
        // exit;
        $zhekou = 1;
        if(!$goods){
            return array("status"=>'0', "info"=>"没有该商品！","num"=>0);
        }
        if(!$goods['is_sale']){
            return array("status"=>'0', "info"=>"该商品已下架！","num"=>0);
        }
        if($skuid){
            // echo $skuid;
            // exit;
            // 商品没开启sku
            if(!$goods['is_sku']){
                return array("status"=>'0', "info"=>"该商品已下架！","num"=>0);
            }
            $sku = M("integral_sku_list")->where(array("goods_id"=>$goodsid, "attr_list"=>$skuid, "status"=>0,'is_del'=>0))->find();
            
            if(!$sku){
                return array("status"=>'3' ,"info"=>"商品没有该属性！","num"=>0, "price"=>$sku['price'],"stock"=>0,"oprice"=>$sku['oprice']);
            }
            if($sku['stock']<$num){
                return array("status"=>'2' ,"info"=>"该商品库存不足！","num"=>$sku['stock'], "price"=>$sku['price'],"stock"=>$sku['stock'],"oprice"=>$sku['oprice']);
            }
            $store  = $sku['stock'];
            $oprice = $sku['oprice'];
            $price  = $sku['price'];
        }else{
            if($goods['stock']<$num){
                return array("status"=>'2' ,"info"=>"该商品库存不足！","num"=>$goods['stock'], "price"=>$goods['price'],"stock"=>$goods['stock'],"oprice"=>$goods['oprice']);
            }
            $store  = $goods['stock'];
            $oprice = $goods['oprice'];
            $price  = $goods['price'];
        }
        if(0<$zhekou && $zhekou<1){
            $price = floor($price*$zhekou);
        }
        return array("status"=>'1',"num"=>$num, "price"=>$price,"stock"=>$store,"oprice"=>$oprice);
    }
    //立即兑换、订单
    public function order(){
        $nums = I("post.nums");
        $goodsid = I("post.goodsid");
        $skuid_old = I("post.skuid");

        $user_id = $this->user_id;
        // echo $user_id;
        // exit;
        $skuid = explode(',',$skuid_old);
        sort($skuid);
        $attr_list = '';
        foreach($skuid as $k=>$v) {
            if($v){
                $attr_list .= $v.'-';
            }  
        }
        if($attr_list){
            $attr_list = '-'.$attr_list;
        }
        $price = $this->checkCartNum($goodsid, $nums, $attr_list)['price'];
        // echo $price;
        // exit;
        $goods = M('integral_goods')->where('id="'.$goodsid.'"')->field("logo_pic,goods_name")->select();
        $good_name = $goods[0]['goods_name'];
        $good_logo_pic = $goods[0]['logo_pic'];
        // echo $good_logo_pic;
        // exit;
        $integral_sku_attr= M("integral_sku_attr");
        $sku_name = $integral_sku_attr->where('id in('.$skuid_old.')')->field('id,pid,classname')->select();
        $sku_str = '';
        foreach ($sku_name as &$v) {
            $res =  M('integral_sku_attr')->where('id in('.$v['pid'].')')->field('id,pid,classname')->select();
            foreach ($res as &$z) {
                $sku_str .= $z['classname'].":".$v['classname']."&nbsp;&nbsp;&nbsp;";
            }
            
        }
        
        //收货地址
        $address = M("address")->where("userid='".$user_id."'")->order("`isdefault` desc")->select();
        $address1 = array_slice($address,0,4);
        $address2 = array_slice($address,4);
        $this->assign('address1', $address1);
        $this->assign('address2', $address2);
        $this->assign('sku_name', $sku_name);
        $this->assign('nums', $nums);
        $this->assign('good_name', $good_name);
        $this->assign('good_logo_pic', $good_logo_pic);
        $this->assign('price', $price);
        $this->assign('all_price', ($price*$nums));
        $this->assign('sku_str', $sku_str);
        $this->assign('goods_id', $goodsid);
        $this->assign('skuid', $skuid_old);
        //
        // $info1 = M("address")->where(array('id' => $id, 'user_id' => $this->user_id))->find();
        // echo "<pre>";
        // print_r($info1);
        // exit;
        $this->assign('info1', $info1);
        $this->display();
    }
    public function ok_order(){
        $user_id = $this->user_id;
        $data = I("post.post");
        //获取地址
        if($data['address_id']){
            $address_info = M("address")->where("id='".$data['address_id']."'")->field("consignee,telephone,province,city,district,place")->select();
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'请选择地址!'));
            exit;
        }
        //获取购买的会员的积分
        $my_integral = M("member")->where("id='".$user_id."'")->field("integral")->select();
        $my_integral = $my_integral[0]['integral'];
        //获取库存
        $skuid = explode(',',$data['skuid']);
        sort($skuid);
        $attr_list = '';
        foreach($skuid as $k=>$v) {
            if($v){
                $attr_list .= $v.'-';
            }  
        }
        // 判断是sku库存还是本身库存
        if($attr_list){
            $attr_list = '-'.$attr_list;
            $my_store = M("integral_sku_list")->where("goods_id='".$data['goods_id']."' and attr_list='".$attr_list."'")->field('id,stock')->select();
            $my_store = $my_store[0]['stock'];
        }else{
            $my_store = M("integral_goods")->where("id='".$data['goods_id']."'")->field('stock')->select();
            $my_store = $my_store[0]['stock'];
        }
        //获取销量
        $my_volume = M("integral_goods")->where("id='".$data['goods_id']."'")->field('volume')->select();
        $my_volume = $my_volume[0]['volume'];
        //判断库存
        if($my_store < $data['nums']){
            $this->ajaxReturn(array('status'=>0,'info'=>'库存不足!'));
            exit;
        }
        //判断积分
        if($my_integral < $data['all_price']){
            $this->ajaxReturn(array('status'=>0,'info'=>'积分不足!'));
            exit;
        }
        //修改积分的数据
        $up_integral = array(
            'integral' => $my_integral-$data['all_price'],
        );
        //修改库存的数据
        $up_store = array(
            'stock' => $my_store-$data['nums'],
        );
        //增加销量的数据
        $up_volume = array(
            'volume' => $my_volume+$data['nums'],
        );
        
        //生成订单的数据
        $order = array(
            'order_id' => date('Ymdhis') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT).$user_id,
            'price' => $data['all_price'],
            'user_id'=> $user_id,
            'address' => $data['address'],
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
            'user_id' => $user_id,
            'integral' => $data['all_price'],
            'integral_befor' => $my_integral,
            'integral_after' => $my_integral-$data['all_price'],
            's_type' => 2,
            'goods_id' => $data['goods_id'],
            'goods_name' => $data['good_name'],
            'goods_img' => $data['pic_logo'],
            'order_id' => $order_id
        );
        //生成订单详情数据
        $order_info = array(
            'order_id' => $order_id,
            'goods_id' => $data['goods_id'],
            'price' => $data['price'],
            'num' => $data['nums'],
            'sku_info' => $data['sku_str'],
            'goods_name' => $data['good_name'],
            'goods_logo' => $data['pic_logo'],
            'price_num' => $data['all_price']
        );
        //生成订单详情
        $o_res = M('integral_order_info')->add($order_info);
        // 修改积分
        $m_res = M("member")->where("id='".$user_id."'")->field("integral")->save($up_integral);
        // 修改库存
        if($attr_list){
            /*修改str表中的库存*/
            $r_store = M("integral_sku_list")->where("goods_id='".$data['goods_id']."' and attr_list='".$attr_list."'")->save($up_store);

            /*修改str表中的销量*/
            $r_volume = M("integral_sku_list")->where("goods_id='".$data['goods_id']."' and attr_list='".$attr_list."'")->setInc("sales", $data['nums']);
            $r_store = M("integral_goods")->where("id='".$data['goods_id']."'")->setDec("stock", $data['nums']);
            $r_volume = M("integral_goods")->where("id='".$data['goods_id']."'")->setInc("volume", $data['nums']);
        }else{
            $r_store = M("integral_goods")->where("id='".$data['goods_id']."'")->setDec("stock", $data['nums']);
            //增加销量
            $r_volume = M("integral_goods")->where("id='".$data['goods_id']."'")->setInc("volume", $data['nums']);
        }
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