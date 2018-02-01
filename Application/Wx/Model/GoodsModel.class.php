<?php
namespace Wx\Model;
use Think\Model;
class GoodsModel extends Model
{
    /**20171223wzz
     * 获取商品列表
     * $type 1-普通商品 2-套餐商品
     * */
    public function get_list($type)
    {
        $pageSize = 8;  #每页展示数量
        $map=array(
            'is_sale'=>'1',
            'is_del' =>'0',
            'type'   =>$type,
        );
        $cate_pid   = I('param.cate_pid');  #一级分类id
        $cate_id    = I('param.cate_id');   #二级分类id
        $is_groom   = I('param.is_groom');  #推荐
        $price      = I('param.price');     #价格区间 '-'
        if($cate_pid){
            $map['cate_pid']=$cate_pid;
        }
        if($cate_id){
            $map['cate_id']=$cate_id;
        }
        if($is_groom){
            $map['is_groom']=1;
        }
        if($price){
            $price_new=array_filter(explode('-',$price));
            $map['price']=array('between',$price_new);
        }
        $goods_cate=M('shop_goods_cate')->field('id,classname')->where(array('is_del'=>'0','status'=>'0'))->select();
        $goods_cate_new  = array_reduce($goods_cate,function(&$goods_cate_new,$v){
            $goods_cate_new[$v['id']] = $v;
            return $goods_cate_new;
        });

        #价格
        $order='';
        $jg=I('get.jg');
        if($jg){
            switch($jg){
                case '1':
                    $order='price desc';
                    break;
                case '2':
                    $order='price asc';
                    break;
            }
        }
        #上市时间
        $sj=I('get.sj');
        if($sj){
            switch($sj){
                case '1':
                    $order='add_time desc';
                    break;
                case '2':
                    $order='add_time asc';
                    break;
            }
        }

        #人气
        $rq=I('get.rq');
        if($rq){
            switch($rq){
                case '1':
                    $order='sales desc';
                    break;
                case '2':
                    $order='sales asc';
                    break;
            }
        }
        $count = $this->where($map)->count();
        if(!$order){
            $order ='sorts desc,id desc';
        }
        #动态分页
        $p=I('post.p','','trim');
        if($p){
            $PageNum = $p-1;
            $Num =$PageNum*$pageSize;
            $lists = $this->where($map)->limit($Num,$pageSize)->order($order)->select();
        }else{
            $P     = getpage($count,$pageSize);
            $lists = $this->where($map)->limit($P->firstRow, $P->listRows)->order($order)->select();
        }


        foreach($lists as $key=>$value){
            $lists[$key]['cate_1']=$goods_cate_new[$value['cate_id']]['classname'];
            $lists[$key]['cate_2']=$goods_cate_new[$value['series_id']]['classname'];
        }
        $page='';
        if($count>8){
            $page  = $P->show();
        }
        return array($count,$lists,$page);
    }

}

?>