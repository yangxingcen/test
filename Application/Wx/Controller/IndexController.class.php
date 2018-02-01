<?php
namespace Wx\Controller;
use Think\Controller;

class IndexController extends PublicController {

	public function index(){

//	    echo C('PASS_KEY');
//	    echo C('DATA_AUTH_KEY');
		//轮播图
		$banner = M("shop_banner")->where('type=1 and status=0 and is_del=0')->order("sorts")->select();
		//热卖组合底下的图片
		$banner2 = M("shop_banner")->where('type=2 and status=0 and is_del=0')->order("sorts")->limit(1)->find();
	  	//新品商品
	  	$isnew = M("goods")->where('is_sale=1 and is_new=1 and is_del=0 and type=1')->select();
	  	//限时促销
	  	$express = M("goods_market")->alias('g')->join('tb_shop_goods_cate as c on c.id=g.cate_id')->where('g.is_sale=1 and g.isactivity=1 and g.is_del=0')->field('g.id,g.goods_name,g.goods_des,g.logo_pic,g.price,g.oprice,c.classname,g.limited_time_end')->order('g.add_time desc')->limit(1)->find();
	  	$strlen = mb_strlen($express['goods_des'], 'utf-8');
	  	if($strlen>7){
	  		$express['goods_des']=mb_substr($express['goods_des'], 0,7,'utf-8')."...";
	  	}
	  	$begin_time=time();
	  	$end_time = strtotime($express['limited_time_end']);
	  	$res = $this->timediff($begin_time,$end_time);
	  	$express['sec'] = $res['day']*24*3600+$res['hour']*3600+$res['min']*60+$res['sec'];
	  	//热卖组合
	  	$r_shop = M("goods")->where('is_sale=1 and is_groom=1 and is_del=0 and type=2')->order('sorts,add_time desc')->limit(1)->find();
	  	// echo M("goods")->_sql();
	  	// exit;
	  	$r_shop2 = M("goods")->where('is_sale=1 and is_groom=1 and is_del=0 and type=2')->order('sorts,add_time desc')->limit(1,2)->select();
	  	//积分活动
	  	$integral = M('integral_goods')->alias('i')->join('tb_integral_shop_type as t on t.id=i.cate_id')->where('i.is_sale=1 and i.is_del=0 and t.is_del=0 and t.status=0')->field('i.id,t.name as tname,i.goods_name,i.goods_name,i.price,i.logo_pic')->order('i.create_at desc')->select();
	  	foreach ($integral as &$v){
	  		$strlen = mb_strlen($v['goods_name'], 'utf-8');
	  		if($strlen>7){
	  			$v['goods_name']=mb_substr($v['goods_name'], 0,7,'utf-8')."...";
	  		}	
	  	}
	  	//一级分类、商品
	  	$cate_info = M('shop_goods_cate')->where('is_del=0 and status=0 and pid=0 and is_tui=1')->field('id,classname')->order('sorts desc,id asc')->select();
	  	foreach ($cate_info as &$v) {
	  		$goods_info=M('goods')->where('is_sale=1 and is_del=0 and cate_pid="'.$v['id'].'" and type=1')->field('id,goods_name,logo_pic,goods_des,price')->order("add_time desc")->limit(4)->select();
	  		if($goods_info){
	  			$v['goods'] = $goods_info;
	  		}else{
	  			$v['goods'] = '';
	  		}
	  	}
	  	//滚动公告
	  	$gundong_gonggao = S('gundong_gonggao');
        if(!$gundong_gonggao){
            $gundong_gonggao = M('Announ')->where(array('cate_id'=>4))->order('id desc')->find();
            S('gundong_gonggao',$gundong_gonggao,array('expire'=>3600));
        }
        
	  	// echo "<pre>";
	  	// print_r($r_shop2);
	  	// exit;
	  	$this->assign('gundong_gonggao',$gundong_gonggao['title']);
	  	$this->assign("r_shop",$r_shop);
	  	$this->assign("r_shop2",$r_shop2);
	  	$this->assign("banner2",$banner2);
	  	$this->assign("banner",$banner);
	  	$this->assign("cate_info",$cate_info);
	  	$this->assign("integral",$integral);
	  	$this->assign("express",$express);
	  	$this->assign("isnew",$isnew);
		$this->display();
	}
	//计算倒计时
	function timediff($begin_time,$end_time){
		if($begin_time < $end_time){
			$starttime = $begin_time;
			$endtime = $end_time;
		}else{
			$starttime = $end_time;
			$endtime = $begin_time;
		}
		//计算天数
		$timediff = $endtime-$starttime;
		$days = intval($timediff/86400);
		//计算小时数
		$remain = $timediff%86400;
		$hours = intval($remain/3600);
		//计算分钟数
		$remain = $remain%3600;
		$mins = intval($remain/60);
		//计算秒数
		$secs = $remain%60;
		$res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
		return $res;
	}
	//导航搜索
	public function search(){
		$this->display();
	}
	//限时促销详情
	public function sale_inner(){
		$this->display();
	}
	//评价
	public function product_pj(){
		$this->display();
	}


	/**20171227wzz
	 * 抽奖游戏
	 * */
	public function games(){

	    $list_info=M('activity_config')->field('id,list_pic,list_title,list_desc')->select();

        $this->assign("list_info",$list_info);

		$this->display();
	}


}
