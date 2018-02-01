<?php
namespace Admin\Controller;
use Admin\Model\ActivityConfigModel;

class ActivityController extends AdminCommonController {
   public function activitygoods(){

       $this->display();
   }



    /**20171227wzz
     * 活动配置
     * */
    public function activityConfig(){
        $cache = M('activity_config')->where(array('is_del'=>0))->select();
        $this->assign('cache',$cache);
        $this->display();
    }

    /**20171227wzz
     * 活动配置详情
     * */
    public function activityConfigInfo(){
        if(IS_POST){
            D('ActivityConfig')->activityConfigInfo();
        }
        $id = I('get.id','','trim');
        $cache = M('activity_config')->where(array('is_del'=>0))->find($id);

        //奖品配置列表

        $jiang_list = unserialize($cache['prize_config']);


        $this->assign('cache',$cache);
        $this->assign('id',$id);
        $this->assign('jiang_list',$jiang_list);
        $this->display();
    }
    /*
     * 20180103yxc
     * 奖品配置奖品配置
     */
    public function activityConfigInfo_prize(){
        if(IS_POST){
            D('ActivityConfig')->activityConfigInfo_prize();
        }

    }
    public function activityConfigInfo_prize_del(){
        if(IS_POST){
            D('ActivityConfig')->activityConfigInfo_prize_del();
        }

    }

    /*20180106yxc
     * 抽奖列表
     */
    public  function activitylist(){

        $this->display();
    }

}