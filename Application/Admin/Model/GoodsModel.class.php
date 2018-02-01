<?php
namespace Common\Model;
use Think\Model;
class GoodsModel extends Model
{   //商品模块

    /**20171025wzz
     * 商品列表
     * */
    public function get_lists($tt)
    {

        #商品状态
        $status = I('get.status','','intval');
        $map = array();
        $status=$status?$status:10;
        if(in_array($status,array('10','20'))){#全部
        }elseif(in_array($status,array('11','21'))){#出售中
            $map['is_del'] = '0';
            $map['is_sale'] = '1';
        }elseif(in_array($status,array('12','22'))){#已售罄
            $map['is_del']  = '0';
            $map['is_sale'] = '1';
            $map['stock']   = 0;
        }elseif(in_array($status,array('13','23'))){#仓库中
            $map['is_del']  = '0';
            $map['is_sale'] = '0';
        }elseif(in_array($status,array('14','24'))){#回收站
            $map['is_del'] = '1';
        }else{
            return array(0);        #错误返回
        }

        if(in_array($status,array('10','11','12','13','14'))){#普通
            $type = 1;
        }elseif(in_array($status,array('20','21','22','23','24'))){#套餐
            $type = 2;
        }else{
            return array(0);        #错误返回
        }
        $map['type'] = $type;
        $maps=array();
        #商品名称
        $keyword = I('get.keyword','','trim');
        if($keyword){
            $maps['goods_name'] = array('like',"%$keyword%");
        }
        #商品ID
        $id = I('get.id','','trim');
        if($id){
            $maps['id']=$id;
        }
        $mg=M('Goods');
        if($tt){
            $mg = M('GoodsMarket');
        }
        $map =$map+$maps;
        $count = $mg->where($map)->count();
        $Page  = getpage($count, 6);
        $show  = $Page->show();
        $lists = $mg->where($map)->order('sorts desc,id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $count10 = $mg->field('count(*) as sum,type')->where($maps)->group('type')->select();
        $arr_Array0 = array_reduce($count10,function(&$arr_Array0,$v){
            $arr_Array0[$v['type']] = $v;
            return $arr_Array0;
        });
        #出售中
        $count11 = $mg->field('count(*) as sum,type')->where($maps)->where('is_del = 0 and is_sale=1')->group('type')->select();
        $arr_Array1 = array_reduce($count11,function(&$arr_Array1,$v){
            $arr_Array1[$v['type']] = $v;
            return $arr_Array1;
        });
        #已售馨s
        $count12 = $mg->field('count(*) as sum,type')->where($maps)->where('is_del = 0 and is_sale=1 and stock=0')->group('type')->select();
        $arr_Array2 = array_reduce($count12,function(&$arr_Array2,$v){
            $arr_Array2[$v['type']] = $v;
            return $arr_Array2;
        });
        // 仓库中
        $count13 = $mg->field('count(*) as sum,type')->where($maps)->where('is_del = 0 and is_sale=0')->group('type')->select();
        $arr_Array3 = array_reduce($count13,function(&$arr_Array3,$v){
            $arr_Array3[$v['type']] = $v;
            return $arr_Array3;
        });
        // 回收站
        $count14 = $mg->field('count(*) as sum,type')->where($maps)->where('is_del = 1')->group('type')->select();
        $arr_Array4 = array_reduce($count14,function(&$arr_Array4,$v){
            $arr_Array4[$v['type']] = $v;
            return $arr_Array4;
        });
        return array($status,$count,$lists,$show,$arr_Array0,$arr_Array1,$arr_Array2,$arr_Array3,$arr_Array4);
    }

    /**20171222wzz
     *获取商品详情
     * 通过 tt 变量来区分是goods 表  还是  goods_market表
     * */
    public function goods_info($id)
    {
        $tt = I('get.tt');
        if($tt=='1'){#营销活动商品
            $mg = M('GoodsMarket');
            $msl = M('SkuListMarket');
        }else{#普通商品
            $mg = M('Goods');
            $msl = M('SkuList');
        }

        $map=array(
            'id'=>$id,
            'is_del'=>'0',
        );
        $info = $mg->where($map)->find();

        if (!$info) {
            return array();
        }

        #商品参数
        $goods_param = unserialize($info['goods_param']);
        if ($goods_param) {
            foreach ($goods_param as $key => $value) {
                $goods_param[$key] = explode('-', $value);
            }
        }
        $info['goods_param'] = $goods_param;

        #商品轮播图
        $info['pics'] = explode(',', $info['pics']);

        #获取sku列表信息
        if($info['is_sku']){
            $skulist = $msl->where(array('goods_id'=>$id,'is_del'=>'0'))->select();
            if($skulist){
                foreach($skulist As $k=>$v){
                    $skulist[$k]['attr_list'] = rtrim(ltrim(str_replace('-',',',$v['attr_list']),','),',');
                }

                $skulist = json_encode($skulist);

                $guigeshuxing = json_decode($info['goods_sku_info'],true);
                $info['guigeshuxing']=$guigeshuxing;
            }else{
                $info['is_sku'] = 0;
            }
        }
        return array($info,$skulist);
    }


     /**20171222wzz
      * 添加 编辑商品
      * * 通过 isactivity 变量来区分是goods 表  还是  goods_market表
      * */
    public function addGoods()
    {
        if(!IS_POST){
            ajaxReturn(0,'访问错误');
        }

        $data                = array();                                                     #初始化数据
        $goodsid             = I('post.goodsid',0,'intval');                                #商品id
        $isactivity          = I('post.isactivity','','intval');                            #营销活动商品 $isactivity=1限时特惠商品 普通商品$isactivity='';
        $goods_db            = M('Goods');
        $skulist_db          = M('SkuList');
        if($isactivity){
            $goods_db           = M('GoodsMarket');
            $skulist_db         = M('SkuListMarket');
        }
        $data['type']               = I('post.type',0,'intval');                                #商品类型 1-普通商品  2-套餐商品
        $data['sorts']              = I('post.sorts',0,'intval');                               #排序
        $data['goods_name']         = I('post.goods_name','','trim');                           #商品名称
        $data['goods_des']          = I('post.goods_des','','trim');                            #商品简介
        $data['goods_ser']          = I('post.goods_ser','','trim');                            #商品服务
        $data['cate_pid']           = I('post.cate_pid','','trim');                             #商品一级分类
        $data['cate_id']            = I('post.cate_id','','trim');                              #商品二级分类
        $data['is_sale']            =I('post.is_sale','','trim');                               #上架
        $data['is_new']             = I('post.is_new','','trim');                               #新品
        $data['is_cuxiao']          = I('post.is_cuxiao','','trim');                            #促销
        $data['is_groom']           = I('post.is_groom','','trim');                             #首页推荐

//        $data['is_baoyou']                       = I('post.is_baoyou',0,'intval');            #包邮
//        if($data['isbaoyou']=='0'){
//            $data['express_model']      = I('post.express_model',0,'intval');                 #运费规则
//            if(!$data['express_model']){
//                ajaxR(0,'请选择运费规则');
//            }
//        }else{
//            $data['express_model']      = '';                                                 #运费规则
//        }
        $data['ship_province']                  = I('post.ship_province','','trim');                   #发货地省
        $data['ship_city']                      = I('post.ship_city','','trim');                       #发货地市
        $data['ship_county']                    = I('post.ship_county','','trim');                     #发货地区


        $data['goods_code']                      = I('post.goods_code','','trim');                       #编码
        if($data['goods_code']){                                                                #商品编码检索重复
            $map = array(
                'goods_code' => $data['goods_code'],
            );
            if($goodsid){
                $map['id']=array('neq',$goodsid);
            }
            $count = $goods_db->where($map)->select();
            if($count){
                ajaxReturn(0,'此商品编码已存在');
            }
        }else{
            ajaxReturn(0,'请填写商品编码');
        }
        $data['weight']                         = I('post.weight','','trim');                           #重量
        $data['virtual_sales']                  = I('post.virtual_sales','','trim');                    #虚拟销量
        $data['integral']                       = I('post.integral','','trim');                         #赠送积分
        $data['oprice']                         = I('post.oprice',0,'trim');                            #商品价格原价
        $data['price']                          = I('post.price',0,'trim');                             #商品价格售价
        $data['cost_price']                     = I('post.cost_price',0,'trim');                        #商品价格成本价
        $data['stock']                          = I('post.stock',0,'intval');                           #库存
        $data['goods_unit']                     = I('post.goods_unit','','trim');                       #单位
        $data['is_sku']                         = I('post.is_sku',0,'intval');                          #是否启用SKU
        $data['goods_sku_info']                 = I('post.goods_sku_info','','trim');                   #sku详情

        $param_name    = I('post.param_name');
        $param_val    = I('post.param_val');
        $arr            = array();

        foreach($param_name as $k=>$v){
            $arr[]=$v.'-'.$param_val[$k];
        }
        $data['goods_param']                    = serialize($arr);                                       #商品参数
        $data['logo_pic']                           = I('post.logo_pic','','trim');                              #商品logo图片
        $data['pics']                           = implode(',',I('post.pics','','trim'));                 #商品图片(多选)
        $data['detail']                         = I('post.detail','','trim');                            #商品详情

        $data['share_title']                    = I('post.share_title','','trim');                        #分享标题
        $data['share_desc']                     = I('post.share_desc','','trim');                         #分享描述
        $data['share_logo']                     = I('post.share_logo','','trim');                         #分享LOGO



        if($data['isactivity']){
            $data['pgoodsid']                   = I('post.pgoodsid',0,'trim');                              #主商品id
            if($data['pgoodsid']){
                if(!$goodsid){
                    $map   = array(
                        'pgoodsid'  => $data['pgoodsid'],
                        'isactivity'=> $data['isactivity'],
                    );
                    $count = $goods_db->where($map)->count();
                    if($count){
                        return  array('status'=>0,'info'=>'此类商品活动已经存在了');
                    }
                }
            }else{
                ajaxReturn(0,'请先选择商品');
            }
        }
        M()->startTrans();
        if($goodsid){                                                                       //修改
            $data['update_time']    = date("Y-m-d H:i:s");
            $retitle            = '修改';
            $res                = $goods_db->where(array('id'=>$goodsid))->save($data);
        }else{                                                                              //添加
            $data['add_time']  = date('Y-m-d H:i:s');
            $data['update_time']    = date("Y-m-d H:i:s");
            $data['is_del']     ='0';
            $retitle            = '添加';
            $res                = $goods_db->add($data);
            $goodsid            = $res;
        }
        if(!$res){
            M()->rollback();
            ajaxReturn(0,$retitle.'失败');
        }

        if($data['is_sku']==1){                                                                //开启了SKU
            $Txt_OPrice         = I('post.Txt_OPrice');                                         #原价
            $Txt_Price          = I('post.Txt_Price');                                          #现价
            $Txt_Cost_Price      = I('post.Txt_Cost_Price');                                      #成本价
            $Txt_Stock          = I('post.Txt_Stock');                                          #库存
            $Txt_Goods_Code      = I('post.Txt_Goods_Code');                                      #商品编码
            $Txt_Pic            = I('post.Txt_Pic');                                            #商品图片
            //$sku_name_str       = I('post.sku_name_str');                                       #商品skuname组合 xxxx
            $sku_id_str         = I('post.sku_id_str');                                         #商品sku_id组合
            $sku_id             = I('post.sku_id');                                             #商品sku_list表的id  添加时为空，编辑时不为空
            $sku_id_old = $skulist_db->where(array('goods_id'=>$goodsid,'is_del'=>'1'))->getField('id',true); #获取该商品已经存在的sku_id
            //该商品数据库sku有存在

            if($sku_id_old){
                if($sku_id){
                    $result = array_diff($sku_id_old,$sku_id);//返回第一个数组有，第二个数组没有的元素
                    if($result){
                        $res = $skulist_db->where(array('id'=>array('in',$result)))->setField('is_del',1);
                        if(!$res){
                            M()->rollback();
                            ajaxReturn(0,'数据库删除规格属性失败');
                        }
                    }
                }
            }
            if(is_array($Txt_OPrice)){
                $data_arr = array();
                $i=0;
                $status=0;
                foreach($Txt_OPrice As $k=>$v){
                    $a =array_filter(explode('-',$sku_id_str[$k]));
                    asort($a);
                    $s_data = array(
                        'goods_id'  => $goodsid,
                        'attr_list' => '-'.implode('-',$a).'-',
                        'goods_code'=> $Txt_Goods_Code[$k],
                        'oprice'    => $Txt_OPrice[$k],
                        'price'     => $Txt_Price[$k],
                        'cost_price'=> $Txt_Cost_Price[$k],
                        'stock'     => $Txt_Stock[$k],
                        'pic'       => $Txt_Pic[$k],
                        'status'    => 0,
                        'add_time' => date('Y-m-d H:i:s'),
                    );
                    if($sku_id[$k]){
                        $s_data['update_time'] = date('Y-m-d H:i:s');
                        $res = $skulist_db->where(array('id'=>$sku_id[$k]))->save($s_data);
                        if(!$res){
                            M()->rollback();
                            ajaxReturn(0,'更新规格属性失败');
                        }
                    }else{
                        $sdata['add_time'] = date('Y-m-d H:i:s');
                        $data_arr[$i] = $s_data;
                        $i++;
                        $status = 1;
                    }
                }
                if($status){
                    if(is_array($data_arr) && $data_arr){
                        $res = $skulist_db->addAll($data_arr);
                        if(!$res){
                            M()->rollback();
                            ajaxReturn(0,'批量添加规格属性失败');

                        }
                    }else{
                        M()->rollback();
                        ajaxReturn(0,'批量添加的规格属性数据类型有误');
                    }
                }
            }
        }
        M()->commit();
        switch($isactivity){
            case '1':
                $url =  U("/Admin/Goodsmarket/spikeGoods");
                break;
            default:
                $url =  U("/Admin/Goods/index");
                break;
        }
        ajaxReturn(1,'提交成功',$url);
    }


    /**20171202wzz
     * 单个、批量 更新商品上架-下架 删除-恢复
     * ids id
     * item
     * value
     * */
    public function changeStatus(){

        $item = I("post.item");
        if(!in_array($item,array('is_sale','is_new','is_cuxiao','is_groom','is_del','is_pc','is_preference'))){
            ajaxReturn(0, "操作失败");
        }
        $ids   = array_filter(explode(",", I("post.ids",'','trim')));
        $value  = I('post.value','','trim');
        if($ids){
            $value= $value?0:1;
            if(I('post.tt','','trim')=='1'){
                $res  = M('GoodsMarket')->where(array("id"=>array('in',$ids)))->setField($item, $value);
                if($item == 'is_del' && $value = '1') {
                    $time = date('Y-m-d H:i:s');
                    $save_time  = M('GoodsMarket')->where(array("id"=>array('in',$ids)))->setField('del_time', $time);
                }
            }else{
                $res  = $this->where(array("id"=>array('in',$ids)))->setField($item, $value);
                $time = date('Y-m-d H:i:s');
                if($item == 'is_del' && $value = '1') {
                    $save_time  = $this->where(array("id"=>array('in',$ids)))->setField('del_time', $time);
                }
            }
            if(!$res){
                ajaxReturn(0, "部分商品修改失败");
            }
            ajaxReturn(1, "操作成功");
        }
    }

    /**20171031wzz
     * 营销活动搜索获取商品列表
     * */
    public function goodsSelect(){
        check_data(I('post.'),array('isactivity','keyword'));
        #查询已经添加过的相应活动的商品id
        $isactivity  = I('post.isactivity','','trim');
        $goods_pid  =M('GoodsMarket')->where(array('isactivity'=>$isactivity))->getField('goods_pid',true);
        $map=array(
            'is_del'         =>'0',
            'is_sale'        =>'1',#1上架,0下架
        );

        if($goods_pid){
            $map['id']=array('notin',$goods_pid);
        }
        $keyword = I('post.keyword','','trim');
        if($keyword){
            $map['goods_name']=array('like',"%$keyword%");
            $map['type']='1';
        }else{
            ajaxReturn(0,'请输入搜索商品名称');
        }
        $list =$this->field('id,goods_name,logo_pic,price')->where($map)->order('sorts desc,id DESC')->select();
        if($list){
            $str ="";
            foreach ($list as $key=>$val){
                $str .='<tr>
                    <td><input type="checkbox" class="checkbox table-ckbs" value="'.$val["id"].'"></td>
                    <td>'.$val["id"].'</td>
                    <td align="left"><div class="table-item-img" style="float: left"><img src="'.$val["logo_pic"].'" alt=""></div><div>'.$val["goods_name"].'</div></td>
                    <td>￥'.$val["price"].'元</td>
                </tr> ';
            }
            ajaxReturn(1,"请求成功",'',$str);
        }
        ajaxReturn(0,'暂无商品');
    }


    public function goods_pc(){
        if(IS_POST){
            $data=I('post.');
            $data['update_time']=date('Y-m-d H:i:s');
            $res = $this->save($data);
            if($res){
                ajaxReturn(1, "操作成功",U('Admin/Goods/index'));
            }else{
                ajaxReturn(1, "操作成功");
            }
        }

    }
}
 ?>