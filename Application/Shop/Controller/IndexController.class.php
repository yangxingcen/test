<?php
namespace Shop\Controller;
use Think\Controller;

class IndexController extends PublicController {

    public function zhuce(){
        $telephone = I('post.telephone');
        $password  = I('post.password');
        if($telephone && $password){
            $count = M('member')->where(array('telephone'=>$telephone))->count();
            if(!$count){
                $s_data=array(
                    'telephone'=>$telephone,
                    'person_img'=>'http://dyshop.unohacha.com/Public/Shop/Images/user.jpg',
                    'password'=>encrypt_pass($password),
                    'add_time'=>date("Y-m-d H:i:s"),
                );
                M('member')->add($s_data);
            }
        }
    }



    public function index(){
    #首页banner
		$index_banner = S('index_banner');
		if(!$index_banner) {
			$index_banner = M('shop_banner')->where(array('type' => 18, 'status' =>'0', 'is_del' => '0'))->find();
			S('index_banner',$index_banner,array('expire'=>3600));
		}
		$this->assign('index_banner',$index_banner);

        /*查出显示特惠商品*/
        $market_model = M('goods_market');
        $market_list = S('market_list');
        if(!$market_list) {
            $market_list = $market_model
                ->where(array('is_sale' => '1', 'is_del' => '0', 'isactivity' => '1', 'is_groom' => '1', 'limited_time_start' => array('elt', date('Y-m-d H:i:s')), 'limited_time_end' => array('gt', date('Y-m-d H:i:s'))))
                ->field('id, goods_name, promotion_label, price, oprice, limited_time_start, limited_time_end, logo_pic, pics')
                ->order('id DESC')
                ->limit(4)
                ->select();
            foreach ($market_list as $key_m => $val_m) {
                $market_list[$key_m]['pic1'] = explode(',', $val_m['pics']);
                $strlen = mb_strlen($val_m['goods_name'], 'utf-8');
                if ($strlen > 11) {
                    $market_list[$key_m]['goods_name'] = mb_substr($val_m['goods_name'], 0, 11, 'utf-8') . "...";
                }
            }
        }
        $this->assign('market_list', $market_list);

        /*推荐分类*/
        $shop_cate = S('shop_cate');
        if(!$shop_cate) {
            $shop_cate = M('shop_goods_cate')
                ->where(array('is_tui' => '1', 'status' => '0', 'is_del' => '0', 'pid'=>'0'))
                ->field('classname, id')
                ->order('sorts desc,id asc')
                ->limit(8)
                ->select();
            S('shop_cate',$shop_cate,array('expire'=>3600));
        }
        $this->assign('shop_cate', $shop_cate);
        /*查出主推产品的销量倒序数据*/
        $goods_model = M('goods');
        $integral_model = M('integral_goods');
        $product_sales_desc = S('product_sales_desc');
        if(!$product_sales_desc) {
            $product_sales_desc = $goods_model
                ->where(array('is_sale'=> '1', 'is_del' => '0', 'type'=>'1'))
                ->order('sorts DESC, id DESC')
                ->field('id, goods_name, cate_id, cate_pid, goods_des, logo_pic, price')
                ->limit(6)
                ->select();
            foreach($product_sales_desc as $key => $val) {
                $cate_model = M('shop_goods_cate');
                $cate = $cate_model
                    ->where(array('id' => $val['cate_id'], 'is_del' => '0'))
                    ->getField('classname');
                $product_sales_desc[$key]['cate_name'] = $cate;
                $pid_cate = $cate_model
                    ->where(array('pid' => $val['cate_pid'], 'is_del' => '0'))
                    ->getField('classname');
                $product_sales_desc[$key]['pid_cate_name'] = $pid_cate;
            }
            S('product_sales_desc',$product_sales_desc,array('expire'=>3600));
        }

        $this->assign('product_sales_desc', $product_sales_desc);
        /*根据兑换量查出积分商品排序*/
        $integral_sales_desc = S('integral_sales_desc');
        if(!$integral_sales_desc) {
            $integral_sales_desc =$integral_model
                ->where(array('is_sale'=> '1', 'is_del' => '0'))
                ->order('volume DESC, id DESC')
                ->limit(6)
                ->field('id, goods_name, cate_id, goods_des, logo_pic, price, goods_des')
                ->select();
            foreach($integral_sales_desc as $key_i => $val_i){
                $integral_cate = M('integral_shop_type')
                    ->where(array('id' => $val['cate_id'], 'is_del' => '0'))
                    ->getField('name');
                $integral_sales_desc[$key_i]['cate_name'] = $integral_cate;
            }
            S('integral_sales_desc',$integral_sales_desc,array('expire'=>3600));
        }
        $this->assign('integral_sales_desc', $integral_sales_desc);
        /*查出推荐套餐商品*/
        $set_meal_goods = S('set_meal_goods');
        if(!$set_meal_goods) {
            $set_meal_goods = $goods_model
                ->where(array('is_del' => '0', 'is_sale' => '1', 'type' => '2', 'is_groom' => '1'))
                ->limit(4)
                ->order('id DESC')
                ->field('id, logo_pic, goods_name, goods_des, price, oprice')
                ->select();
            S('set_meal_goods',$set_meal_goods,array('expire'=>3600));
        }
        /*查出是否收藏该商品*/
        foreach($set_meal_goods as $key_set => $val_set) {
            $cc=M('collection');
            $rrr=$cc->where(array('user_id'=>$this->user_id, 'type'=>'2', 'goods_id'=>$val_set['id'],'status'=>1))->find();
            if($rrr){
                $set_meal_goods[$key_set]['coll'] = '1';
            }
        }
        /*查出主推商品*/
        $goods_list = S('goods_list');
        if(!$goods_list) {
            $goods_list = $goods_model
                ->where(array('is_sale' => '1', 'is_del' => '0', 'is_show' => '1', 'type' => '1'))
                ->order('sorts desc,id DESC')
                ->limit(6)
                ->field('id, goods_name, cate_id, cate_pid, goods_des, logo_pic, price, oprice')
                ->select();
            foreach ($goods_list as $key_g => $val_g) {
                $cate_model = M('shop_goods_cate');
                $goods_cate = $cate_model
                    ->where(array('id' => $val_g['cate_id'], 'is_del' => '0'))
                    ->getField('classname');
                $goods_list[$key_g]['cate_name'] = $goods_cate;
                $pid_cate = $cate_model
                    ->where(array('pid' => $val_g['cate_pid'], 'is_del' => '0'))
                    ->getField('classname');
                $goods_list[$key_g]['pid_cate_name'] = $pid_cate;
            }
            S('goods_list',$goods_list,array('expire'=>3600));
        }
        /*推荐分类*/
        $int_shop_cate = S('int_shop_cate');
        if(!$int_shop_cate) {
            $int_shop_cate = M('integral_shop_type')
                ->where(array('is_tuijian' => '1', 'status' => '0', 'is_del' => '0'))
                ->field('name, id')
                ->limit(8)
                ->select();
            S('int_shop_cate',$int_shop_cate,array('expire'=>3600));
        }
        $this->assign('int_shop_cate', $int_shop_cate);
        /*积分商品页面*/
        $integral_list = S('integral_list');
        if(!$integral_list) {
            list($cate_array) = $this->int_cate();
            $integral_list = $integral_model
                ->where(array('is_del' => '0', 'is_sale' => '1', 'cate_id'=>array('in', $cate_array)))
                ->limit(6)
                ->field('id, goods_name, cate_id, goods_des, logo_pic, price')
                ->order('sort desc,id desc')
                ->select();
            S('integral_list',$integral_list,array('expire'=>3600));
        }

        $this->assign('integral_list', $integral_list);
        $this->assign('goods_list', $goods_list);
        $this->assign('set_meal_goods', $set_meal_goods);
        $this->assign('user_id', $this->user_id);
        $this->assign('header_bot', '1');
        $this->assign('category', '1');
		
		//商城资讯
		$zjwx = M('Announ')->where(array('is_display'=>1,'status'=>1,'cate_id'=>1))->order('addtime desc')->limit(0,3)->select();
		
		$dyxbs = M('Announ')->where(array('is_display'=>1,'status'=>1,'cate_id'=>2))->order('addtime desc')->limit(0,5)->select();
		
	$scgg = M('Announ')->where(array('is_display'=>1,'status'=>1,'cate_id'=>3))->order('addtime desc')->limit(0,5)->select();

        $this->assign('zjwx', $zjwx);
        $this->assign('dyxbs', $dyxbs);
        $this->assign('scgg', $scgg);		
        $this->display();
    }

    /*查出积分商品推荐分类*/
    public function int_cate() {
        $int_cate = M('integral_shop_type')
            ->where(array('is_del' => '0', 'is_tuijian' => '1', 'status'=>'0'))
            ->field('id')
            ->select();
        /*重组数组*/
        if($int_cate) {
            $cate_array = array();
            foreach($int_cate as $k_c=>$v_c) {
                $cate_array[] = $int_cate[$k_c]['id'];
            }
        }
        return array($cate_array);
    }

    /*查出积分商品*/
    public function getIntGoods() {
        $integral_model = M('integral_goods');
        $id = '0';
        $id = I('post.id', '', 'intval');
        $map = array();
        $map['is_del'] = '0';
        $map['is_sale'] = '1';
        if($id) {
            $map['cate_id'] = $id;
        }
        $integral_list = $integral_model
            ->where($map)
            ->limit(1,6)
            ->field('id, goods_name, cate_id, goods_des, logo_pic, price')
            ->select();
        $this->ajaxreturn($integral_list);
    }

    /*查出普通商品*/
    public function getGoods() {
        $goods_model = M('goods');
        $id = '0';
        $id = I('post.id', '', 'intval');
        $map = array();
        $map['is_del'] = '0';
        $map['is_sale'] = '1';
        $map['type'] = '1';
        if($id) {
            $map['cate_pid'] = $id;
        }
        $goods_list = $goods_model
            ->where($map)
            ->order('id DESC')
            ->limit(1,6)
            ->field('id, goods_name, cate_id, cate_pid, goods_des, logo_pic, price, oprice')
            ->select();
        foreach($goods_list as $key_g => $val_g){
            $cate_model = M('shop_goods_cate');
            $goods_cate = $cate_model
                ->where(array('id' => $val_g['cate_id'], 'is_del' => '0'))
                ->getField('classname');
            $goods_list[$key_g]['cate_name'] = $goods_cate;
            $pid_cate = $cate_model
                ->where(array('id' => $val_g['cate_pid'], 'is_del' => '0'))
                ->getField('classname');
            $goods_list[$key_g]['pid_cate_name'] = $pid_cate;
        }
        $this->ajaxreturn($goods_list);
    }


    private function getCateList(){

    }



    /**
     * 首页尾部服务列表
     */
    public function Service(){
        $type=I("get.cc");
        $sort=I("get.ss");


        $m=M('Service');
        $service=$m->select();
        $this->assign('service',$service);
        $serviceInfo=$m->where(array('type'=>$type,'sort'=>$sort))->find();
        $this->setSeo($serviceInfo['title']);
        $this->assign('serviceInfo',$serviceInfo);
        $this->display();
    }

    /**
     * 联系我们
     */
    public function contactUs(){

        $this->display();
    }

    /**
     * 友情链接
     */
    public function friendlyLink(){

        $this->display();
    }

    /**
     * 招聘中心
     */
    public function recruitCenter(){

        $this->display();
    }

    /**
     * 查看详情
     */
    public function recruitDetail(){

        $this->display();
    }

    /**
     * 最新活动
     */
    public function activity(){

        $this->display();
    }

    /**
     * 售后服务
     */
    public function service1(){

        $this->display();
    }

    /**
     * 自助服务
     */
    public function autoService(){

        $this->display();
    }

    /**
     * 会员注册
     */
    public function userReg(){

        $this->display();
    }

    /**
     * 购物指南
     */
    public function shoppingDirectory(){

        $this->display();
    }

    /**
     * 新闻公告
     */
    public function news(){

        $this->display();
    }

    /**
     * 新闻详情
     */
    public function newsDetail(){

        $this->display();
    }

    /**
     * 预约
     */
    public function reserve(){
        $this->display();
    }


    public function store_inner(){
        $this->display();
    }


    public function store_net(){
        $this->display();
    }
}
