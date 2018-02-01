<?php
namespace Shop\Controller;
use Think\Controller;

/*套餐活动*/

class MealController extends PublicController {
    /*套餐列表页*/
    public function index(){
        /*套餐列表页banner图 左上角*/
        $meal_index_config_left = S('meal_index_config_left');
        if(!$meal_index_config_left){
            $meal_index_config_left = M('ShopBanner')->where(array('id'=>'19'))->getField('pic');
            S('meal_index_config_left',$meal_index_config_left,array('expire'=>3600));
        }
        $this->assign('meal_index_config_left',$meal_index_config_left);

        /*套餐列表页banner图 右下角*/
        $meal_index_config_right = S('meal_index_config_right');
        if(!$meal_index_config_right){
            $meal_index_config_right = M('ShopBanner')->where(array('id'=>'20'))->getField('pic');
            S('meal_index_config_right',$meal_index_config_right,array('expire'=>3600));
        }
        $this->assign('meal_index_config_right',$meal_index_config_right);

        /*套餐列表页banner图 顶部*/
        $meal_index_config = S('meal_index_config');
        if(!$meal_index_config){
            $meal_index_config = M('ShopBanner')->where(array('id'=>'17'))->getField('pic');
            S('meal_index_config',$meal_index_config,array('expire'=>3600));
        }
        $this->assign('meal_index_config',$meal_index_config);
        $map = array();
        $map['is_del'] = '0';
        $map['is_sale'] = '1';
        $map['type'] = '2';
        $count = M('goods')->where($map)->count();
        $Page  = getpage($count, 12);
        $show  = $Page->show();
        $list = M('goods')
            ->where($map)
            ->order('id DESC')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->field('id, logo_pic, goods_name, price')
            ->select();
        $num = count($list);
        $this->assign('list', $list);
        $this->assign('num', $num);
        $this->assign('page', $show);
        $this->assign('header_bot', '1');
        $this->display();
    }

    /*套餐详情页可购买*/
    public function detail(){
        $this->logs('查看套餐详情页');
        $cate = M('shop_goods_cate');
        $goods = M('goods');
        $id = I('get.id', 0, 'intval');
        $Time=time();
        $url = base64_encode("/mealDetail.html?id=".$id);
        $goodsInfo = $goods->where(array('id'=>$id, 'is_del'=>0, 'is_sale'=>1, 'type'=>'2'))->find();
        if(!$goodsInfo) {
            $this->error();
        }
        $goodsInfo['price'] = number_format($goodsInfo['price'], 2);
        $goodsInfo['oprice'] = number_format($goodsInfo['oprice'], 2);
        /*根据商品id查出分类*/
        $cate_two = array();
        $cate_two = $cate -> where(array('id' => $goodsInfo['cate_id']))->field('id, classname')->find();
        /*根据pid查出上级id*/
        $cate_one = array();
        if($cate_two['pid'] != '0') {
            $cate_one = $cate -> where(array('id' => $goodsInfo['cate_pid']))->field('id, classname')->find();
        }

        /*获取滚动图片*/
        $goodsInfo['pic1'] = explode(',', $goodsInfo['pics']);
        /*sku*/
        //$sku_item = "";
        if ($goodsInfo['is_sku']) {
            $sku_item = json_decode($goodsInfo['goods_sku_info'], true);
            $sku_data = M('sku_list')->where(array('goods_id' => $id, "status" => 0,'is_del'=>'0'))->select();
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
        $rrr=$cc->where(array('user_id'=>$this->user_id, 'type'=>'2', 'goods_id'=>$id,'status'=>1))->select();
        if($rrr) $this->assign('coll',1);
        /*类似风格*/
        $cate_id = $goodsInfo['cate_id'];
        $id = $goodsInfo['id'];
        $cate_like = M('goods')
            ->where(array('is_del' => '0',  'is_sale' => '1', 'type'=>'2','id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit(4)
            ->select();
        /*同等价位*/
        $price_like = M('goods')
            ->where(array('is_del' => '0', 'type'=>'2', 'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit(4)
            ->select();
        /*同类热销*/
        $cate_like_hot = M('goods')
            ->where(array('is_del' => '0', 'type'=>'2', 'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('sales DESC')
            ->limit(4)
            ->select();
        /*用户id*/
        $user_id = $this->user_id;
        $this->assign('url', $url);
        $this->assign('header_bot', '1');
        $this->assign('user_id', $user_id);
        $this->assign('isactivity', '2');
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