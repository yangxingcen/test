<?php
namespace Admin\Controller;
class BannerController extends AdminCommonController
{

    /**20171213wzz
     * 广告位列表
     * */
    public function bannerType()
    {
        $this->logs('查看广告位列表');
        $count = M('ShopBannerType')->where(array('is_del'=>0))->count();
        $page = getpage($count,10);

        $cache = M("ShopBannerType")->where(array('is_del'=>0))->limit($page->firstRow,$page->listRows)->order('sorts desc,id asc')->select();
        $this->assign("cache", $cache);
        $this->assign("page", $page->show());
        $this->display();
    }


    /**20171213wzz
     * 添加/编辑广告位
     * */
    public function bannerTypeAdd()
    {
        $this->logs('编辑广告位');
        D("ShopBannerType")->bannerTypeAdd();
    }


    /**20171213wzz
     * 删除广告位
     * */
    public function bannerTypeDel()
    {
        $this->logs('删除广告位');
        D('ShopBannerType')->bannerTypeDel();
    }


    /**20171213wzz
     * 广告列表
     * */
    public function banner(){
        $this->logs('查看广告列表');
        $bannerType  = M('ShopBannerType')->field("id,classname")->where(array('is_del'=>0))->order('sorts desc,id DESC')->select();
        $bannerType = update_key($bannerType);
        $this->assign('bannerType',$bannerType);

        $map  = array('is_del'=>0);
        $type = I("get.type");
        if($type){
            $map['type'] =$type;
            $this->assign("type",$type);
        }
        $count = M('shop_banner')->where($map)->count();
        $Page  = getpage($count,10);
        $lists = M('shop_banner')
                ->where($map)
                ->order('type asc,id asc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach($lists as $key=>$value){
            $lists[$key]['classname']=$bannerType[$value['type']]['classname'];
        }
        $this->assign('count',$count);
        $this->assign('cache',$lists);
        if($count > 10){
            $this->assign('page',$Page->show());
        }
        $this->display();
    }


    /**20171213wzz
     * 添加编辑广告
     * */
    public function bannerAdd()
    {
        $this->logs('添加/编辑广告');
        D('ShopBanner')->bannerAdd();
    }


    /**20171213wzz
     * 启用/禁用/删除 广告
     * */
    public function bannerDel()
    {
        $this->logs('启用/禁用/删除广告');
        D('ShopBanner')->bannerDel();
    }

}