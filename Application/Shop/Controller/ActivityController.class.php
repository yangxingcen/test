<?php
namespace Shop\Controller;
use Think\Controller;
/*促销活动*/
class ActivityController extends PublicController {
    public function index(){
        /*促销活动顶部图片*/
        $activity_index_config = S('activity_index_config');
        if(!$activity_index_config){
            $activity_index_config = M('ShopBanner')->where(array('id'=>'16'))->getField('pic');
            S('activity_index_config',$activity_index_config,array('expire'=>3600));
        }
        $this->assign('activity_index_config',$activity_index_config);
        $this->assign('header_bot', '1');
        $this->display();
    }
}
?>