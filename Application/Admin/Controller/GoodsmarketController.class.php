<?php
namespace Admin\Controller;
class GoodsmarketController extends AdminCommonController
{
    /**20171222wzz
     * 限时特惠商品列表
     */
    public function spikeGoods()
    {
        $this->logs('查看限时特惠商品列表');
        $this->goodsMarket(1);
        $this->display();
    }

    /**20171222wzz
     * 限时特惠商品编辑
     */
    public function spikeGoodsAdd(){

        $this->logs('编辑 限时特惠商品');

        A('Goods')->AddGoods_Com();

        $this->display('Goods/addgoods');
    }

    /**20171222wzz
     * 保存限时特惠商品配置
     */
    public function goodsMarketConfig(){
        $this->logs('保存限时特惠商品配置');
        D('GoodsMarket')->goodsMarketConfig();
    }



    /**20171222wzz
     * 限时特惠-1商品列表
     * */
    private function goodsMarket($isactivity){
        $this->logs('限时特惠 商品列表');
        list($status,$count,$lists,$show,$arr_Array0,$arr_Array1,$arr_Array2,$arr_Array3,$arr_Array4)=D('Goods')->get_lists(1);
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
    }


    /**20171222wzz
     * 选择商品库商品添加至营销活动
     * */
    public function goodsSubmit(){
        $this->logs('选择商品库商品添加至营销活动');
        D('GoodsMarket')->goodsSubmit();
    }
}