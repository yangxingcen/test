<?php
namespace Admin\Controller;
class GoodsController extends AdminCommonController
{
    /**20171222wzz
     * 商品列表
     * */
    public function index(){
        $this->logs('查看商品列表');
        list($status,$count,$lists,$show,$arr_Array0,$arr_Array1,$arr_Array2,$arr_Array3,$arr_Array4)=D('Goods')->get_lists(0);
        $this->assign('status',$status);
        $this->assign('count',$count);
        $this->assign('cache',$lists);
        $this->assign('page',$show);
        $this->assign('count10',$arr_Array0['1']['sum']);
        $this->assign('count20',$arr_Array0['2']['sum']);
        $this->assign('count11',$arr_Array1['1']['sum']);
        $this->assign('count21',$arr_Array1['2']['sum']);
        $this->assign('count12',$arr_Array2['1']['sum']);
        $this->assign('count22',$arr_Array2['2']['sum']);
        $this->assign('count13',$arr_Array3['1']['sum']);
        $this->assign('count23',$arr_Array3['2']['sum']);
        $this->assign('count14',$arr_Array4['1']['sum']);
        $this->assign('count24',$arr_Array4['2']['sum']);
        #商品分类
        $goods_cate = M('shop_goods_cate')->field('id,classname,pid')->where(array('is_del'=>'0','status'=>'0'))->select();
        $goods_cate_new = generateTree($goods_cate);

        $this->assign('goods_cate_new',$goods_cate_new);
        $this->display();
    }

    /**20171221wzz
     * 添加/编辑 商品
     * */
    public function addgoods()
    {
        if(IS_POST){
            $this->logs('添加/编辑 商品');
            D('Goods')->addGoods();
        }
        $this->AddGoods_Com();
        $this->display();
    }


    /*20171223wzz
     * 商品添加--官网配置
     * */
    public function goods_pc(){
        if(IS_POST){
            $this->logs('商品添加--官网配置');
            D('Goods')->goods_pc();
        }
        $id=I('get.id');
        if($id){
            $info = M('Goods')
                ->where(array('is_del'=>'0','is_pc'=>1,'id'=>$id))
                ->field('id,sorts_pc,en_goods_name_pc,pic1_pc,pic2_pc,pic_install_pc,goods_tedian_pc,detail_pc')->find();
            if($info){
                $this->assign('info',$info);
                $this->display();
            }else{
                $this->error();
            }
        }else{
            $this->error();
        }
    }

    public function AddGoods_Com(){
        $this->logs('添加商品');
        $id = I('get.id',0,'intval');
        if($id) {

            list($info,$skulist)=D('Goods')->goods_info($id);
            if(!$info){
                $this->error();
            }
            $this->assign('info',$info);
            $this->assign('skulist',$skulist);
        }
        $page = I("get.page",1,'intval');
        $this->assign('page',$page);
        #商品分类
        $goods_cate = M('shop_goods_cate')->field('id,classname,pid')->where(array('is_del'=>'0','status'=>'0'))->select();
        $goods_cate_new = array_group($goods_cate,'pid');
        $this->assign('goods_cate_new',$goods_cate_new);
        $this->assign('j_goods_cate',json_encode($goods_cate_new));
    }


    /**20171028wzz
     * 更新商品上架 下架 删除 恢复
     * */
    public function changeStatus()
    {
        if(IS_POST){
            $this->logs('更新商品上架 下架 删除 恢复');
            D("Goods")->changeStatus();
        }
    }
    



    /**20171221wzz
     * 获取规格列表
     */
    public function skuNameList()
    {
        if(IS_POST){
            $this->logs('获取规格列表');
            $pid  = I('post.pid',0,'intval');
            $sku_id_checked  = array_filter(explode('-',I('post.sku_id_checked','','trim')));
            $res  = M("skuAttr")->field("id,classname")->where(array('pid'=>$pid,'is_del'=>0))->order('id DESC')->select();
            if($res){
                $html = '';
                foreach($res As $k=>$v){
                    if(in_array($v["id"],$sku_id_checked)){
                        $html.='<input type="checkbox" name="sku_id[]" data-value="'.$v['classname'].'" value="'.$v["id"].'" checked="checked">'.$v['classname'].'&nbsp&nbsp&nbsp';
                    }else{
                        $html.='<input type="checkbox" name="sku_id[]" data-value="'.$v['classname'].'" value="'.$v["id"].'">'.$v['classname'].'&nbsp&nbsp&nbsp';
                    }
                }
                $this->ajaxReturn(array("status"=>1, "info"=>$html));
            }
            $this->ajaxReturn(array("status"=>2, "info"=>"没有规格/属性"));
        }
        $this->ajaxReturn(array("status"=>0, "info"=>"非法访问"));
    }


    /**20171222wzz
     * 添加营销活动搜索商品
     * */
    public function goodsSelect()
    {
        if(IS_POST){
            $this->logs('添加营销活动搜索商品');
            D('Goods')->goodsSelect();
        }
    }


    public function match()
    {

        $this->logs('查看商品搭配');
        $goods_id = I('id');
        $class = I('get.class','1');

        $matchModel = M('goods_match');

        $list = $matchModel->alias('m')->join('tb_goods g on g.id=m.match_id')->where(['m.goods_id'=>$goods_id,'m.class'=>$class])->field('m.mh_id,m.sorts,m.class,m.status,g.price,g.stock,g.sales,g.goods_name,g.logo_pic')->select();

        $count12 = $matchModel->alias('m')->join('tb_goods g on g.id=m.match_id')->where(['m.goods_id'=>$goods_id])->field('count(*) as sum,m.class')->group('m.class')->select();

        $arr_Array2 = array_reduce($count12,function(&$arr_Array2,$v){
            $arr_Array2[$v['class']] = $v;
            return $arr_Array2;
        });

        $this->assign('cache',$list);
        $this->assign('status',$class);
        $this->assign('count1',$arr_Array2[1][sum]);
        $this->assign('count2',$arr_Array2[2][sum]);
        $this->assign('count3',$arr_Array2[3][sum]);

        $this->assign('goods_id',$goods_id);

        $this->display();
    }

    public function goods_match_select()
    {
        //error_log("\r\n".date('Y-m-d H:i:s').'【'.__LINE__.'】 : '.print_r(I(''),true),3,'E:/WWW/1.log');
        $map=array(
            'is_del'         =>'0',
            'is_sale'        =>'1',#1上架,0下架
        );

        $keyword = I('post.keyword','','trim');
        if($keyword){
            $map['goods_name']=array('like',"%$keyword%");
            $map['type']='1';
        }else{
            ajaxReturn(0,'请输入搜索商品名称');
        }

        $goods_type = I('goods_type');
        if($goods_type){
            $model = M('goods_market');
            $list = $model->field('goods_pid as id,goods_name,logo_pic,price')->where($map)->order('sorts desc,id DESC')->select();

        }else{
            $model = M('goods');
            $list = $model->field('id,goods_name,logo_pic,price')->where($map)->order('sorts desc,id DESC')->select();
        }

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

    public function do_match()
    {
        $post = I('post.');
        error_log("\r\n".date('Y-m-d H:i:s').'【'.__LINE__.'】 : '.print_r(I(''),true),3,'E:/WWW/1.log');
        if(!$post['status'] || !$post['goods_id'] || !$post['goods_ids']){
            $this->ajaxReturn(array("status"=>0, "info"=>"操作错误"));
        }
        $ids = explode(',',$post['goods_ids']);
        if(count($ids) > 1){
            unset($ids[0]);
        }
        $data = [];
        foreach($ids as $k => $v){
            $data[] = [
                'goods_id' => $post['goods_id'],
                'match_id' => $v,
                'class' => $post['status'],
                'type' => $post['type'],
            ];
        }

        try{
            M('goods_match')->addAll($data);
        }catch (\Exception $e){
            $this->ajaxReturn(array("status"=>0, "info"=>"操作错误"));
        }
        $this->ajaxReturn(array("status"=>1, "info"=>"操作成功"));
        //error_log("\r\n".date('Y-m-d H:i:s').'【'.__LINE__.'】 : '.print_r(I(''),true),3,'E:/WWW/1.log');
    }


    /*删除搭配  */

    function  del_match(){

        $ids  = I('post.id','','trim');
        $res  = M('goods_match')->where(array("mh_id"=>array('in',$ids)))->delete();
//        $res  = M('goods_match')->where(array("mh_id"=>array('in',$ids)))->setField('status', 0);

        if($res){
        ajaxReturn(1, "操作成功");
        }
    }

    /*
     * 更新排序
     */

    function  match_order(){
        $table  = I('get.table');//表名
        $id_name  = I('get.id_name');//字段名称
        $id_value  = I('get.id_value');//商品id
        $field  = I('get.field');//更新字段名
        $value  = I('get.value');//更新排序

        $res  = M($table)->where($id_name.'='.$id_value)->setField($field, $value);

        if($res){
            ajaxReturn(1, "操作成功");
        }

    }



}