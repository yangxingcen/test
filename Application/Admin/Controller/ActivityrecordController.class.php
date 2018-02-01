<?php
namespace Admin\Controller;
use Admin\Model\ActivityConfigModel;

class ActivityrecordController extends AdminCommonController {


    /*20180106yxc
     * 抽奖列表
     * $status  奖品类型
     * $name  搜索关键字
     * $cate  抽奖类型
     */
    public  function activitylist(){

        $status=I('get.status',0);
        $name=I('get.name','');
        $cate=I('get.cate','');
        if($status!=0){
            $maps['a.prize_type']=$status;
        }
        if($cate!=''){
            $maps['a.type']=$cate;
        }
        if($name!=''){
        $maps['a.goods_name|a.tel|a.realname|m.telephone'] = array('like','%'.$name.'%','OR');
        }
        list($count,$lists,$show,$arr_Array2,$count12) = D('activity_lottery')->lists($maps);

        $this->assign('count',$count);
        $this->assign('lists',$lists);
        $this->assign('show',$show);
        $this->assign('status',$status);
        $this->assign('arr_Array2',$arr_Array2);
        $this->assign('count12',$count12);
        $this->assign('cate',$cate);
        $this->assign('name',$name);
        $this->display();
    }

}