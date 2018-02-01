<?php
namespace Shop\Controller;
use Think\Controller;

class GoodsController extends PublicController{

    /*商品详情页可购买*/
    public function detail(){
        $cate = M('shop_goods_cate');
        $goods = M('goods');
        $id = I('get.id', 0, 'intval');
        $Time=time();
        $url = base64_encode("/detail.html?id=".$id);
 
        $goodsInfo = $goods->where(array('id'=>$id, 'is_del'=>0, 'is_sale'=>1, 'type'=>'1'))->find();
        if(!$goodsInfo) {
            $this->error();
        }
        $goodsInfo['price'] = number_format($goodsInfo['price'], 2);
        $goodsInfo['oprice'] = number_format($goodsInfo['oprice'], 2);
        $this->logs('查看商品详情页 商品id:'.$goodsInfo['cate_id']);
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
        $goodsInfo['pic1'] = array_filter($goodsInfo['pic1']);
        /*sku*/
        //$sku_item = "";
        if ($goodsInfo['is_sku']) {
            $sku_item = json_decode($goodsInfo['goods_sku_info'], true);
            $sku_data = M('sku_list')->where(array('goods_id' => $id, "status" => '0','is_del'=>'0'))->order('attr_list asc')->select();
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
        $rrr=$cc->where(array('user_id'=>$this->user_id, 'type'=>'1', 'goods_id'=>$id,'status'=>1))->find();
        if($rrr) $this->assign('coll',1);
        /*类似风格*/
        $cate_id = $goodsInfo['cate_id'];
        $id = $goodsInfo['id'];
        $cate_like = M('goods')
            ->where(array('is_del' => '0', 'type'=>'1',  'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit(4)
            ->select();
        /*同等价位*/
        $price_like = M('goods')
            ->where(array('type'=>'1', 'is_del' => '0',  'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('id DESC')
            ->limit(4)
            ->select();
        /*同类热销*/
        $cate_like_hot = M('goods')
            ->where(array('is_del' => '0', 'type'=>'1',  'is_sale' => '1', 'id'=>array('neq', $id)))
            ->field('id, goods_name, price, oprice, logo_pic')
            ->order('sales DESC')
            ->limit(4)
            ->select();
        /*用户id*/
        $user_id = $this->user_id;
        $this->assign("url",$url);
        $this->assign('isactivity', '1');
        $this->assign('header_bot', '1');
        $this->assign('user_id', $user_id);
        $this->assign('cate_like_hot', $cate_like_hot);
        $this->assign('price_like', $price_like);
        $this->assign('cate_like', $cate_like);
        $this->assign('goods_param', $goods_param);
        $this->assign("sku_data", json_encode($sku_data));
        $this->assign('goodsInfo', $goodsInfo);
        $this->assign('sku_item', $sku_item);
        $this->assign('cate_two', $cate_two);
        $this->assign('cate_one', $cate_one);
        $this->display();
    }


    /**20171220wzz
     * 商品列表页
     * */
    public function goodsList(){
        $this->logs('查看商品列表页');
        if(IS_POST){
            list($count,$lists,$page)=D('Goods')->get_list(1);
            $str='';
            foreach($lists as $kk=>$vv){
                $str .='<div class="col-sm-3 clp6">'.
                     '<a href="/detail.html?id='.$vv['id'].'">'.
                    '<div class="sec3_list">'.
                    '<div class="sec3_img">'.
                    '<img src="'.$vv['logo_pic'].'" width="100%">'.
                    '</div>'.
                    '<div class="sec3_zi">'.
                    '<h5>'.$vv['goods_name'].'</h5>'.
                    '<span>￥'.$vv['price'].'<i>评论：'.$vv['comment_num'].'</i></span>'.
                    '<hr>'.
                    '<p>'.$vv['cate_1'].$vv['cate_2'].'</p>'.
                    '</div>'.
                    '</div>'.
                    '</a>'.
                    '</div>';
            }
            $p=I('post.p');
            $str1='<div>';
            $pageNum = ceil($count/8); #获取页数
            if($pageNum>=2){#2页
                for($i=1;$i<$pageNum+1;$i++){
                    if($i==$p ||(!$p && $i==1)){
                        $str1 .='<span class="s_page current" >'.$i.'</span>';
                    }else{
                        $str1 .='<span class="s_page" >'.$i.'</span>';
                    }
                }
            }
            ajaxReturn(1,'请求成功','',array($str,$str1));
        }
        //图片管理--20171218lkg
        $propic = S('propic');
        if(!$propic){
            $propic = M('shop_banner')->where(array('is_del'=>0,'status'=>0,'type'=>23))->find();
            S('propic',$propic,array('expire'=>60*60));
        }
        $this->assign('propic',$propic);

        #获取分类
        $goods_cate = S('goods_cate');
        if(!$goods_cate){
            $goods_cate = M('ShopGoodsCate')->field('id,classname,pid,price_arr')->where(array('is_del'=>'0','status'=>'0'))->order('sorts desc')->select();
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
        list($count,$lists,$page)=D('Goods')->get_list(1);
        $this->assign('cache',$lists);
        $this->assign('page',$page);

        #时间排序  价格排序
        $this->assign('jg',I('get.jg'));
        $this->assign('sj',I('get.sj'));

        #获取感兴趣的
        $this->assign('interested',array_slice($lists,0,2));
        $this->assign('header_bot', '1');
        $this->display();

    }

    /*feye */
    public function lists($map, $m)
    {
        $count = $m->where($map)->count();
        $Page  = getpage($count, 4);
        $show  = $Page->show();
        $lists = $m->where($map)->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return array($count,$lists,$show);
    }
    /*根据一级分类查出二级分类*/
    public function goodsCateTwo(){
        $pid = I('get.pid', 0, 'intval');
        if($pid) {
            $cata_two = M('goods_cate')
                ->where(array('pid' => $pid, 'status' => '1'))
                ->select();
            $this->assign('cate_two', $cata_two);
        }
    }

    /**
     * 得到面包屑导航
     */
    private function getCrumbs($id = null){

    }

    /**
     * 产品详情得到面包屑的方法
     */
    private function getCrumbs2($goodsid) {

    }

    /**
     * 收藏
     */
    public function addcollect()
    {
        if(IS_AJAX) {
            $isactivity = I('post.isactivity');
            $data['user_id']=$this->user_id;
            $data['goods_id'] = I("post.goods_id");
            $data['create_at'] = time();
            $data['collect_time'] = time();
            $data['status'] = 1;
            if($isactivity == '1') {
                $data['type'] = '1';
                $g=M('goods');

                $where = array(
                    "user_id" => $data['user_id'],
                    "goods_id" => $data['goods_id'],
                    'type'     => '1',
                    'status' => '1',
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
                    'status' => '1',
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
                    'status' => '1',
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
?>