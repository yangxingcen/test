<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28 0028
 * Time: 上午 10:57
 */
namespace Admin\Controller;
class BillController extends AdminCommonController
{
    //发票列表
    public function index(){
        $type  = I("get.invoice_type");
        if(isset($type) && $type== 3 ){
            $res = D('orderInfo')->alias('o')->field('o.id,o.order_no,o.invoice_type,o.user_id,m.telephone,m.person_name')
                ->join('tb_member as m on m.id=o.user_id')
                ->where(['o.invoice_type'=>$type,'is_del'=>0])->select();

            $count3 = D('orderInfo')->where(['invoice_type'=>3])->count();
        }else if(isset($type) && $type== 1){
            $res = D('orderInfo')->alias('o')->field('o.id,o.order_no,o.invoice_type,o.user_id,m.telephone,m.person_name')
                ->join('tb_member as m on m.id=o.user_id')
                ->where(['o.invoice_type'=>$type,'is_del'=>0])->select();
            $count1 = D('orderInfo')->where(['invoice_type'=>1])->count();
        }else if(isset($type) && $type== 2){
            $res = D('orderInfo')->alias('o')->field('o.id,o.order_no,o.invoice_type,o.user_id,m.telephone,m.person_name')
                ->join('tb_member as m on m.id=o.user_id')
                ->where(['o.invoice_type'=>$type,'is_del'=>0])->select();
            $count2 = D('orderInfo')->where(['invoice_type'=>2])->count();
        }else{
            $res = D('orderInfo')->alias('o')->field('o.id,o.order_no,o.invoice_type,o.user_id,m.telephone,m.person_name')
                ->join('tb_member as m on m.id=o.user_id')
                ->where(['is_del'=>0])
                ->select();
            $count3 = D('orderInfo')->where(['invoice_type'=>3])->count();
            $count2 = D('orderInfo')->where(['invoice_type'=>2])->count();
            $count1 = D('orderInfo')->where(['invoice_type'=>1])->count();
            //dump($count2);die;
        }
        $page = I("get.page",1,'intval');
        $this->assign('page',$page);
        $this->assign("data",  $res);
        $this->assign("count1",  $count1);
        $this->assign("count2",  $count2);
        $this->assign("count3",  $count3);
        $this->display();
    }
    //发票详情
    public function billdetail(){
        $invoice_type = I('get.invoice_type','','intval');
        if ($invoice_type == 0) {
            $this->error('参数非法','/Admin/bill/index');
        }
        //查询发票信息
        $bill = D('orderInfo')->where(['id'=>$invoice_type])->find();
        //dump($bill);die;
        $this->assign('cache',$bill);
        $this->display();
    }
    public function billdel(){
        //$this->logs('启用/禁用/删除 发票列表');
        if(IS_POST){
            $id = I("post.id",'','intval');
            $invoice_type = I("post.invoice_type",'','intval');
            $item = I("post.item",'','trim');
            //dump($item);die;
            //check_data(I('post.'),array('id','item'));
            $info  =D('OrderInfo')->where(['id'=>$id])->find();
            //dump($info);die;
            if($info){
                switch($item){
                    case 'type':
                        $res = D('OrderInfo')->where(array('id'=>$id,'invoice_type'=>$invoice_type))->setField('invoice_type',3-$info['invoice_type']);
                        //dump($res);die;
                        $res = D('OrderInfo')->where(array('id'=>$id,'invoice_type'=>$invoice_type))->setField('invoice_type',1+$info['invoice_type']);
                        $res =1;
                        $t = '更新';
                        break;

                    case 'is_del':
                        $res = D('OrderInfo')->where(array('id'=>$id))->setField('is_del',1);
                        $res = D('OrderInfo')->where(array('id'=>$id))->setField('is_del',1);
                        $res =1;
                        $t = '删除';
                        break;
                    default:
                        ajaxReturn(0,'未知错误');
                        break;
                }
                if($res!=false){
                    ajaxReturn(1,$t.'成功');
                }else{
                    ajaxReturn(0,$t.'失败');
                }
            }
        }
        ajaxReturn(0,'未知错误');
    }
}