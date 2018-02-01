<?php
namespace Shop\Model;
use Think\Model;
class GoodsModel extends Model
{
    public function get_list($type)
    {
        $pageSize = 8;  #每页展示数量
        $map=array(
            'is_sale'=>'1',
            'is_del' =>'0',
            'type'   =>$type,
        );
        $cate       = I('param.cate');
        $series     = I('param.series');
        $price      = I('param.price');
        $keyword      = I('param.keyword');
        if($cate){
            $map['cate_pid|cate_id']=$cate;
        }
        if($series){
            $map['cate_id']=$series;
        }
        if($keyword){
            $map['goods_name']=array('like',"%$keyword%");
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

        $order='cate_pid asc,cate_id asc,sorts DESC,id desc';
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
        $count = $this->where($map)->count();
        #动态分页
        $page='';
        $p=I('post.p','','trim');
        if($p){
            $PageNum = $p-1;
            $Num =$PageNum*$pageSize;
            $lists = $this->where($map)->limit($Num,$pageSize)->order($order)->select();
        }else{
            $P     = getpage($count,$pageSize);
            $lists = $this->where($map)->limit($P->firstRow, $P->listRows)->order($order)->select();
            if($count>8){
                $page  = $P->show();
            }
        }
        foreach($lists as $key=>$value){
            $lists[$key]['cate_1']=$goods_cate_new[$value['cate_pid']]['classname'];
            $lists[$key]['cate_2']=$goods_cate_new[$value['cate_id']]['classname'];
        }

        return array($count,$lists,$page);
    }

}

?>