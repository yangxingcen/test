<?php
namespace Admin\Controller;
class GoodscateController extends AdminCommonController
{
    /**20171213wzz
     * 商品分类列表
     * */
    public function goodsCate(){
        $this->logs('查看商品分类列表');
        $goodsCate  = M('ShopGoodsCate')->field("id,classname")->where(array('is_del'=>0,'pid'=>0))->order('sorts desc,id DESC')->select();
        $goodsCate = update_key($goodsCate);
        $this->assign('goodsCate',$goodsCate);

        $map  = array('is_del'=>0);
        $pid = I('get.pid');
        if($pid){
            $map['id|pid']=$pid;
            $this->assign('pid',$pid);
        }
        $count = M('ShopGoodsCate')->where($map)->count();
        $lists = M('ShopGoodsCate')
                ->where($map)
                ->order('id asc')
                ->select();
        $lists  = generateTree($lists);
        $this->assign('count',$count);
        $this->assign('cache',$lists);
        $this->display();
    }


    /**20171213wzz
     * 添加/编辑商品分类
     * */
    public function goodsCateAdd()
    {
        $this->logs('添加/编辑商品分类');
        D('ShopGoodsCate')->goodsCateAdd();
    }


    /**20171213wzz
     * 启用/禁用/删除 商品分类
     * */
    public function goodsCateDel()
    {
        $this->logs('启用/禁用/删除 商品分类');
        D('ShopGoodsCate')->goodsCateDel();
    }


    /**20171219wzz
     * 商品分类信息详情配置
     * */
    public function goodscateInfo(){
        if(IS_POST){
            $this->logs('配置 商品分类信息详情');
            D('ShopGoodsCate')->goodscateInfo();
        }
        $id  = I('get.id');
        if($id){
            $res = M('shop_goods_cate')->where(array('id'=>$id,'is_del'=>'0'))->find();
            if($res){
                $res['price_arr']=unserialize($res['price_arr']);
                $this->assign('cache',$res);
            }else{
                $this->error();
            }
        }
        $this->display();
    }
    
}