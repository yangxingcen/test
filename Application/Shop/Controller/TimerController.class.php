<?php
namespace Shop\Controller;
use Think\Controller;

class TimerController extends PublicController {
    public function index() {
        /*查出所有限时特惠商品*/
        $model = M('goods_market');
        $page = I('get.page', '1', 'intval');
        $map = array();
        $map['is_sale'] = '1';
        $map['is_del'] = '0';
        $map['is_preference'] = '0';
        $map['isactivity'] = '1';
        $map['limited_time_start'] = array('elt', date('Y-m-d H:i:s'));
        $map['limited_time_end'] = array('gt', date('Y-m-d H:i:s'));
        $field = array();
        $field = array('id, logo_pic, price, oprice, limited_time_end, limited_time_start, goods_name, promotion_label, is_preference, isactivity');

        list($count,$info,$show) = $this->lists($map, $model, $field);
        $preference = array();
        foreach($info as $k1=>$v1) {
            $strlen = mb_strlen($v1['goods_name'], 'utf-8');
            if($strlen>16){
                $info[$k1]['goods_name']=mb_substr($v1['goods_name'], 0,16,'utf-8')."...";
            }
        }
        $preference = $model->where(array('is_sale'=>'1', 'is_del' => '0', 'is_preference' => '1', 'limited_time_start'=>array('elt', date('Y-m-d H:i:s')), 'limited_time_end' => array('gt', date('Y-m-d H:i:s'))))->field('id, logo_pic, price, oprice, limited_time_end, limited_time_start, goods_name, promotion_label, is_preference, isactivity')->select();
        foreach($preference as $k=>$val) {
                $discount = round($info[$k]['price']/$info[$k]['oprice'], 2) * 100;
                $preference[$k]['discount'] = $discount;

        }
        /*限时列表页banner图 顶部*/
        $time_index_config = S('time_index_config');
        if(!$time_index_config){
            $time_index_config = M('ShopBanner')->where(array('id'=>'15'))->getField('pic');
            S('time_index_config',$time_index_config,array('expire'=>3600));
        }
        $this->assign('time_index_config',$time_index_config);
        $this->assign('info', $info);
        $this->assign('preference', $preference);
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('count', $count);
        $this->assign('header_bot', '1');
        $this->display();
    }

    public function lists($map, $m, $field)
    {
        $count = $m->where($map)->count();
        $Page  = getpage($count, 6);
        $show  = $Page->show();
        $info = $m->where($map)->order('id DESC')->field($field)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        if(!$info) {
            $this->error();
        }
        return array($count,$info,$show);
    }

    public function detail(){
        $this->logs('查看限时特惠商品详情');
        /*查出商品详情*/
        $cate = M('shop_goods_cate');
        $goods = M('goods_market');
        $id = I('get.id', 0, 'intval');
        $Time=time();
        $url = base64_encode("/timerDetail.html?id=".$id);
        $goodsInfo = $goods->where(array('id'=>$id, 'is_del'=>0, 'is_sale'=>1))->find();
        $goodsInfo['price'] = number_format($goodsInfo['price'], 2);
        $goodsInfo['oprice'] = number_format($goodsInfo['oprice'], 2);
        /*根据商品id查出分类*/
        $cate_two = array();
        $cate_two = $cate -> where(array('id' => $goodsInfo['cate_id']))->find();
        /*根据pid查出上级id*/
        $cate_one = array();
        if($cate_two['pid'] != '0') {
            $cate_one = $cate -> where(array('id' => $cate_two['pid']))->find();
        }

        /*获取滚动图片*/
        $goodsInfo['pic1'] = explode(',', $goodsInfo['pics']);
        /*sku*/
        //$sku_item = "";
        if ($goodsInfo['is_sku']) {
            $sku_item = json_decode($goodsInfo['goods_sku_info'], true);
            $sku_data = M('sku_list_market')->where(array('goods_id' => $id, "status" => 0,'is_del'=>0))->select();
       
            $sku_data = deal_sku_data($sku_data);
            /*根据sku pid 查出该pid下的所有子sku*/
            $sku_all ='';
        }
        $goods_param = array();
        if($goodsInfo['goods_param']) {
            $goods_param = unserialize($goodsInfo['goods_param']);
            if($goods_param){
                foreach ($goods_param as $key =>$value){
                    $goods_param[$key]=explode('-',$value);
                }
            }
        }
        /*查出是否收藏该商品*/
        $cc=M('collection');
        $rrr=$cc->where(array('user_id'=>$this->user_id, 'type'=>'3', 'goods_id'=>$id,'status'=>1))->find();
        if($rrr) $this->assign('coll',1);
        /*类似风格*/
        $cate_id = $goodsInfo['cate_id'];
        $id = $goodsInfo['id'];
        $cate_like = M('goods_market')
            ->where(array('is_del' => '0', 'isactivity'=>'1', 'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit(4)
            ->select();
        /*同等价位*/
        $price_like = M('goods_market')
            ->where(array('is_del' => '0', 'isactivity'=>'1','is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit(4)
            ->select();
        /*同类热销*/
        $cate_like_hot = M('goods_market')
            ->where(array('is_del' => '0', 'isactivity'=>'1', 'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('sales DESC')
            ->limit(4)
            ->select();
        /*用户id*/
        $user_id = $this->user_id;
        $this->assign("url",$url);
        $this->assign('header_bot', '1');
        $this->assign('user_id', $user_id);
        $this->assign('isactivity', '3');
        $this->assign('cate_like_hot', $cate_like_hot);
        $this->assign('price_like', $price_like);
        $this->assign('cate_like', $cate_like);
        $this->assign('goods_param', $goods_param);
        $this->assign("sku_data", json_encode($sku_data));
        $this->assign('goodsInfo', $goodsInfo);
        $this->assign('sku_item', $sku_item);
        $this->assign('cate_two', $cate_two);
        $this->assign('cate_one', $cate_one);
        $this->display('Goods:detail');
    }


}
?>