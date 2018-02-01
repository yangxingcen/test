<?php
namespace Admin\Model;
use Think\Model;
class GoodsMarketModel extends Model
{


    /**20171222wzz
     * 搜索添加商品
     * */
    public function goodsSubmit(){
        if(IS_POST){
            $isactivity =I('post.isactivity');
            $goods_ids  = I('post.goods_ids');
            check_data(I('post.'),array('isactivity','goods_ids'));

            $goods_id = array_filter(explode(',',$goods_ids));
            if($goods_id){
                M()->startTrans();
                $num =0;
                foreach($goods_id as $k=>$v){
                    $info = M('goods')->find($v);
                    $goods_pid              = $info['id'];
                    unset($info['id']);
                    $info['goods_pid']      = $goods_pid;
                    $info['isactivity']     = $isactivity;
                    $info['add_time']       = date('Y-m-d H:i:s');
                    $info['update_time']    = date('Y-m-d H:i:s');
                    $res  = $this->add($info);
                    if(!$res){
                        M()->rollback();
                        ajaxReturn(0,'添加商品失败');
                    }

                    #商品sku复制
                    $sku_list = M('sku_list')->where(array('goods_id'=>$goods_pid,'is_del'=>'0'))->select();
                    if($sku_list){
                        foreach($sku_list as $kk=>$vv){
                            unset($sku_list[$kk]['id']);
                            $sku_list[$kk]['goods_id']=$res;
                            $sku_list[$kk]['add_time']=date('Y-m-d H:i:s');
                            $sku_list[$kk]['update_time']=date('Y-m-d H:i:s');
                        }
                        $res1 =M('sku_list_market')->addAll($sku_list);
                        if(!$res1){
                            M()->rollback();
                            ajaxReturn(0,'添加商品规格失败');
                        }
                    }

                    $num +=1;
                }
                if($num>0){
                    M()->commit();
                    ajaxReturn(1,'成功添加【'.$num.'】款商品，请继续配置相应的活动信息');
                }
            }
            ajaxReturn(0,'添加失败');
        }
    }


    /**20171215wzz
     * 保存秒杀商品配置
     */
    public function goodsMarketConfig(){
       if(IS_POST){
           $data =I('post.');
           $isactivity = I('post.isactivity','','trim');
           if($isactivity==1){#限时特惠
               check_data($data,array('id','limited_time','promotion_label'));
               $limited_time = explode(' To ',$data['limited_time']);
               $n_data=array(
                   'promotion_label'    => $data['promotion_label'],#抢购活动标签
                   'is_preference'    => $data['is_preference'],#抢购活动标签
                   'limited_time_start' => $limited_time[0],#开始日期时间
                   'limited_time_end'   => $limited_time[1],#结束日期时间
               );
           }else{
               ajaxReturn(0,'营销活动类型错误');
           }
           $res = $this->where(array('isactivity'=>$isactivity,'id'=>$data['id']))->save($n_data);
           if($res!==false){
               ajaxReturn(1,'配置成功');
           }
           ajaxReturn(0,'配置失败');
       }
    }


}
 ?>