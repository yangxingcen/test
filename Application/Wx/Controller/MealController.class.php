<?php
namespace Wx\Controller;
use Think\Controller;
class MealController extends PublicController {

	public function meal(){
		#获取分类
		$goods_cate = S('goods_cate');
		if(!$goods_cate){
			$goods_cate = M('ShopGoodsCate')->field('id,pic,classname,pid,price_arr')->where(array('is_del'=>'0','status'=>'0'))->select();
			foreach($goods_cate as $k=>$v){
				if($v['price_arr']){
					$goods_cate[$k]['price_arr']=unserialize($v['price_arr']);
				}
			}
			S('goods_cate',$goods_cate,array('expire'=>60*60));
		}
		$goods_cate =array_group($goods_cate,'pid');
		$J_goods_cate = json_encode($goods_cate);
		$this->assign('goods_cate',$goods_cate[0]);
		$this->assign('J_goods_cate',$J_goods_cate);

		#获取商品
		list($count,$lists,$page)=D('Goods')->get_list(2);
		$this->assign('is_groom',I('get.is_groom'));
		if(in_array(I('get.is_rq'),array('0','1'))){
			$this->assign('is_rq',1-I('get.is_rq'));
		}
		if(in_array(I('get.jg'),array('0','1'))){
			$this->assign('jg',1-I('get.jg'));
		}
		$this->assign('cache',$lists);
		$this->assign('page',$page);
		$this->display();
	}

}
