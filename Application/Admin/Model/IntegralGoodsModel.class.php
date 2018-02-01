<?php
namespace Admin\Model;
use Think\Model;
class IntegralGoodsModel extends Model
{   //商品模块

    /**20171025wzz
     * 商品列表
     * */
    public function lists($map)
    {
        $count = $this->where($map)->count();
        $Page  = getpage($count, 10);
        $show  = $Page->show();
        $lists = $this->where($map)->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return array($count,$lists,$show);
    }

    /**20171025wzz
     *获取商品详情
     * */
    public function goodsInfo($map)
    {  
        $info = $this->where($map)->find();
        if($info){
            $cate = array();
            $cate = M('integral_shop_type')->where(array('id' => $info['cate_id']))->field('name,id')->find();
            $info['cate_name'] = '&nbsp;&nbsp; |--'.$cate['name'];
            $info['cate_id'] = $cate['id'];
            $info['pic1'] = explode(",",$info['pic1']);
            
        }
        return $info;
    }

     /**20171025wzz
      * 添加 编辑商品
      * #Cyonger  iwanjiao@qq.com  201711061548
      * 向下兼容老数据  商品属性  序列化存储
      * */
    public function addGoods()
    {
        if(!IS_POST){
            return array('status'=>0 , 'info'=>'访问错误');
        }

        $data                = array();                                                     //初始化数据
        $goodsid             = I('post.id',0,'intval');                                     //商品id
        // $data['storeid']     = I('post.storeid',0,'intval');                                //门店
        // if(!isset($data['storeid'])){
        //     return array('status'=>0 , 'info'=>'错误的提交');
        // }
        // $data['malltype']    = I('post.malltype',1,'intval');                               //商品 1普通,2积分
        // /* if($data['malltype'] ==2){
        //     $url             = U("/Admin/goods/scoregoods");
        // } */

        // $data['isactivity']  = I('post.isactivity',0,'intval');                             //活动 0正常,1秒杀,2团购,3砍价
        // if($data['isactivity'] ==1){
        //     $data['timepoint'] = I('post.timepoint',0,'intval');                           //秒杀时间点
        //     $url             = U("/Admin/Spikegoods/index");
        // }elseif($data['isactivity'] ==2){
        //     $url             = U("/Admin/Tuangoods/index");
        // }elseif($data['isactivity'] ==3){
        //     $url             = U("/Admin/Discountgoods/index");
        // }elseif($data['isactivity'] ==4){
        //     $url             = U("/Admin/Bargaingoods/index");
        // }

        $data['sort']       = I('post.sorts',0,'intval');                                  //排序
        $data['goods_name']       = I('post.title','','trim');                                   //商品名称
        if(!$data['goods_name']){
            return array('status'=>0 , 'info'=>'请填写商品名称');
        }
        $data['goods_des']    = I('post.subtitle','','trim');                                //商品简介
        if(!$data['goods_des']){
            return array('status'=>0 , 'info'=>'请填写商品简介');
        }
        $data['goods_ser']    = I('post.goods_ser','','trim');                                //商品服务
        if(!$data['goods_ser']){
            return array('status'=>0 , 'info'=>'请填写商品服务');
        }
        $data['price']      = I('post.price',0,'trim');                                 //商品价格售价
        $data['oprice']     = I('post.oprice',0,'trim');                                //商品价格原价
        $data['cate_id']         = I('post.cateid','','trim');                               //分类id
        $data['ischoice']       = I('post.ischoice',0,'intval');                            //推荐
        $data['ishot']          = I('post.ishot',0,'intval');                               //热卖
        $data['isnew']          = I('post.isnew',0,'intval');                               //新品
        $data['logo_pic']       = I('post.logo','','trim');                                 //商品logo图片
        $data['pic1']      = I('post.detailpic','','trim');                            //商品图片(多选)
        $data['is_sale']         = I('post.issale',0,'intval');                              //上架

        $data['spu']      = I('post.goodscode','','trim');                            //编码
        $data['share_title']         = I('post.share_title','','trim');                              //分享标题
        if(!($data['share_title'])) {
            $data['share_title'] = I('post.title','','trim');
        }
        $data['share_desc']         = I('post.share_desc','','trim');                              //分享描述
        if(!($data['share_desc'])) {
            $data['share_desc'] = I('post.subtitle','','trim');
        }
        $data['share_logo']         = I('post.share_logo','','trim');                              //分享图片
        if(!($data['share_logo'])) {
            $data['share_logo'] = I('post.logo','','trim');
        }
        $goods_db               = M('integral_goods');
       if($data['spu']){                                                             //商品编码检索重复
           if(!$goodsid){
               $map = array(
                   'spu' => $data['spu'],
                   'isactivity'=> $data['isactivity'],
               );
               $count = $goods_db->where($map)->count();
               if($count){
                   return array('status'=>0 , 'info'=>'此编码商品已添加');
               }
           }
       }else{
           return array('status'=>0 , 'info'=>'请填写商品编码');
       }

        
        $skulist_db             = M('integral_sku_list');
        if($data['isactivity']){
            $goods_db           = M('integral_goods_market');
            $skulist_db         = M('integral_sku_list_market');
        }

        $data['stock']          = I('post.stock',0,'intval');                               //库存
        $data['is_sku']         = I('post.is_sku',0,'intval');                              //是否启用SKU
        if($data['is_sku']){
            //$guige = json_decode(I('post.guige','','trim'),true);
            $guige = I('post.guige','','trim');
            if($guige){
                //$data['goods_sku_info'] = serialize($guige);
                $data['goods_sku_info']   = $guige;
            }else{
                return array('status'=>0 , 'info'=>'请选择规格属性');
            }
        }
        $data['parameter']    = I('post.goods_param');              //商品参数
        $data['detail']         = I('post.detail','','trim');                               //商品详情
        M()->startTrans();
        if($goodsid){                                                                       //修改
            $data['edit_at']    = date("Y-m-d H:i:s",NOW_TIME);
            $retitle            = '修改';
            $res                = $goods_db->where(array('id'=>$goodsid))->save($data);
        }else{                                                                              //添加
            $data['create_at']  = date('Y-m-d H:i:s',NOW_TIME);
            $retitle            = '添加';
            $res                = $goods_db->add($data);
            $goodsid            = $res;
        }
        if(!$res){
            M()->rollback();
            return array('status'=>0 , 'info'=>$retitle.'失败1');
        }
        $filename= './log/Sku/skuList_'.date("Y-m-d H:i:s",NOW_TIME).'_'.rand(111,999).'.txt';
        if($data['is_sku']){                                                                //开启了SKU
            file_put_contents($filename, print_r(array('开启',$data['is_sku']),true).PHP_EOL, FILE_APPEND);
            $skulistidarr = I('post.skulistidarr',0,'trim');                                //已经有的id
            $skulistarr   = I('post.skulistarr',0,'trim');
            file_put_contents($filename, print_r(array('获取参数',array($skulistidarr,$skulistarr)),true).PHP_EOL, FILE_APPEND);
            $listidarr    = $skulist_db->where(array('goods_id'=>$goodsid))->getField('id',true);
            file_put_contents($filename, print_r(array('已近存在的sku',array($listidarr)),true).PHP_EOL, FILE_APPEND);
            if($listidarr){
                if($skulistidarr){
                    $result = array_diff($listidarr,$skulistidarr);
                    if($result){
                        $res = $skulist_db->where(array('id'=>array('in',$result)))->delete();
                        if(!$res){
                            M()->rollback();
                            file_put_contents($filename, print_r(array('删除不存在失败',$result),true).PHP_EOL, FILE_APPEND);
                            return array('status'=>0 , 'info'=>$retitle.'失败2');
                        }
                    }
                }else{
                    $res = $skulist_db->where(array('id'=>array('in',$listidarr)))->delete();
                    if(!$res){
                        M()->rollback();
                        file_put_contents($filename, print_r(array('清空不存在失败',$listidarr),true).PHP_EOL, FILE_APPEND);
                        return array('status'=>0 , 'info'=>$retitle.'失败3');
                    }
                }
            }else{
                if($skulistarr){
                    foreach($skulistarr As $k=>$v){
                        $skulistarr[$k]['skulistid'] = 0;
                    }
                }
            }

            if(is_array($skulistarr)){
                $data = array(); $i=0; $status=0;
                foreach($skulistarr As $k=>$v){
                    $attrlist = $v['skuidstr'];
                    $attrlist = explode(',',$attrlist);
                    sort($attrlist);
                    $attrlist = '-'.implode('-',$attrlist).'-';
                    $sdata = array(
                        'goods_id'  => $goodsid,
                        'attr_list' => $attrlist,
                        'bar_code'  => $v['number'],
                        'oprice'    => $v['oprice'],
                        'price'     => $v['price'],
                        'fprice'    => $v['fprice'],
                        'stock'     => $v['num'],
                        'pic'       => $v['pic'],
                        'status'    => 1,
                    );
                    if($v['skulistid']){
                        $sdata['update_at'] = date('Y-m-d H:i:s',NOW_TIME);
                        $res = $skulist_db->where(array('id'=>$v['skulistid']))->save($sdata);
                        if(!$res){
                            M()->rollback();
                            file_put_contents($filename, print_r(array('更新SKU失败',$v['skulistid'],$sdata),true).PHP_EOL, FILE_APPEND);
                            return array('status'=>0 , 'info'=>$retitle.'失败4');
                        }
                    }else{
                        $sdata['create_at'] = date('Y-m-d H:i:s',NOW_TIME);
                        $data[$i] = $sdata;
                        $i++;
                        $status = 1;
                    }
                }
                if($status){
                    if(is_array($data) && $data){
                        $res = $skulist_db->addAll($data);
                        if(!$res){
                            M()->rollback();
                            file_put_contents($filename, print_r(array('批量添加失败',$data),true).PHP_EOL, FILE_APPEND);
                            return array('status'=>0 , 'info'=>$retitle.'失败5');
                        }
                    }else{
                        M()->rollback();
                        file_put_contents($filename, print_r(array('批量添加，不是数组',$data),true).PHP_EOL, FILE_APPEND);
                        return array('status'=>0 , 'info'=>$retitle.'失败6');
                    }
                }
            }
        }
        M()->commit();
        $url                 = $url ? $url : U("/Admin/integralgoods/index");
        return array('status'=>1 , 'info'=>$retitle.'成功','url'=>$url);
    }

    /**20171028wzz
     * 单个、批量 更新商品上架 下架 删除 恢复
     * */
    public function changeAllStatus(){
        $item = I("post.item");
        if(!in_array($item,array('is_sale','is_del'))){
            return array('status'=>0,'info'=>'访问错误');
        }
        $ids   = array_filter(explode("-", I("post.ids",'','trim')));
        $data = I("post.data");
        if(!in_array($data,array('0','1'))){
            return array('status'=>0,'info'=>'访问错误');
        }
        $m = M("integral_goods");

        foreach($ids as $id){
            $res  = $m->where(array("id"=>$id))->find();
            if(!$res){
                return array('status'=>0,'info'=>'部分商品修改失败');
            }
            $res2 = $m->where(array("id"=>$id))->setField($item, $data);
            if(!$res2){
                return array('status'=>0,'info'=>'部分商品修改失败');
            }
        }
        return array('status'=>1,'info'=>'操作成功');
    }

    public function returnArr($id,$title='操作')
    {
        if($id === false){
            return array('status'=>0,'info'=>$title.'失败!');
        }
        return array('status'=>1,'info'=>$title.'成功!');
    }

    /**20171030wzz
     * APP根据商品类型获取商品列表
     * @param
     * $malltype    1普通,2积分,3秒杀,4团购
     * $num     显示数量
     * $type     1-普通 2-折扣 3-积分
     * @return
     *  goods_id 商品id
     *  title 商品标题
     *  logo 产品logo
     *  giftpoints 赠送积分
     *  oprice 原价
     *  price 售价
     *  virtualsales 虚拟销量
     *  sales 销量
     * */
    public function get_goods_list_by_malltype($malltype="",$num=6,$type=""){
        $map=array(
            'isdel'=>0,
            'isend'=>1,
            'issale'=>1,
        );
        if($malltype){
            $map['malltype']= $malltype;
        }
        //秒杀产品时间
        if($malltype==3){
            $time = date("G");
            $map1=array(
                'miaosha_time'=>array("like","%"."-".$time."-"."%"),
                'malltype'=>3
            );
            //查询商品id
            $goods_id = M("goods_info")->where($map1)->getField("goods_id",true);
            $map['id']=array("in",$goods_id);
        }

        if($type==1){#普通
            $map['is_part_zhekou'] = "1";   //不参与会员折扣
            $map['integralprice'] = "0";   //可抵现积分

        }elseif ($type==2){#折扣
            $map['is_part_zhekou'] = "0";   //参与会员折扣
            $map['integralprice'] = "0";   //可抵现积分
        }elseif ($type==3){#积分
            $map['integralprice'] = array("gt",0);   //可抵现积分 大于0
        }elseif ($type==12){#积分
            $map['integralprice'] = "0";   //可抵现积分
        }

        $list = $this->field("id as goods_id,title,logo,giftpoints,oprice,price,virtualsales,sales")->where($map)->order("sorts desc,id DESC")->limit($num)->select();
        if(!$list){
            returnJson(0,'暂无商品');
        }
        returnJson(1,'请求成功',$list);
    }


    /**20171031wzz
     * 搜索获取商品列表
     * @param
     * $map 条件
     * $page     页码
     * $num     每页显示数量
     * @return
     *  goods_id 商品id
     *  title 商品标题
     *  logo 产品logo
     *  giftpoints 赠送积分
     *  oprice 原价
     *  price 售价
     *  virtualsales 虚拟销量
     *  sales 销量
     * */
    public function get_goods_list($map,$page,$num){
        $map1=array(
            'isdel'=>0,
            'isend'=>1,
            'issale'=>1,
        );
        $this->page("$page, $num");
        $list =$this->field('id as goods_id,title,logo,giftpoints,oprice,price,virtualsales,sales')->where($map1)->where($map)->order('sorts desc,id DESC')->select();
        foreach ($list as $key =>$value){
            $list[$key]['pic']=deal_img($value['pic']);
        }
        if($list){returnJson(1,"请求成功",$list);}
        returnJson(0,'暂无商品');

    }
}
 ?>