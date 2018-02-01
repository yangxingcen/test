<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28 0028
 * Time: 下午 14:02
 */
namespace Admin\Controller;
class FinanceController extends AdminCommonController
{
    public function index(){
        $m = M("takemoney_log");
        $type  = I("type");
        $title = I("title");
        $admins = M("user")->select();
        foreach($admins as $v){
            $admin[$v['id']] = $v['username'];
        }
        if($type!==""){
            $map['status'] = $type;
        }
        if($title){
            $map['username'] = array("like","%{$title}%");
            $map['telephone'] = array("like","%{$title}%");
            $map['bank_no'] = array("like","%{$title}%");
            $map["_logic"] = "or";
        }
        if(!empty($map)){
            $m->where($map);
        }
        $res = $m->order("create_at desc")->select();
        foreach($res as $k=>$v){
            $res[$k]['admin'] = $admin[$v['admin_id']];
        }
        $this->assign("title",  $title);
        $this->assign("count",  $m->count());
        $this->assign("count0", $m->where(array('status'=>0))->count());
        $this->assign("count1", $m->where(array('status'=>1))->count());
        $this->assign("count2", $m->where(array('status'=>2))->count());
        $this->assign("sum",    $m->sum("money"));
        $this->assign("sum0",   $m->where(array('status'=>0))->sum("money"));
        $this->assign("sum1",   $m->where(array('status'=>1))->sum("money"));
        $this->assign("sum2",   $m->where(array('status'=>2))->sum("money"));
        $this->assign("cache",  $res);
        $this->display();
    }

    public function tixian(){
        if(IS_AJAX){
            $id   = I("post.id");
            $data = array(
                "status"    => 1,
                "admin_id"  => $_SESSION['admin_id'],
                "deal_at"   => time(),
            );
            $res = M("takemoney_log")->where(array('id'=>$id,"status"=>0))->save($data);
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"提现成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"提现失败！"));
            }
        }
    }

    public function jujue(){
        if(IS_AJAX){
            $id  = I("post.id");
            $m   = M("takemoney_log");
            $m_m = M("member");
            $m  ->startTrans();
            $m_m->startTrans();
            $info = $m->find($id);
            if(!$info){
                $this->ajaxReturn(array("status"=>0, "info"=>"数据不存在！"));
            }
            $res1 = $m_m->where(array("id"=>$info['user_id']))->setInc("wallet", $info['money']);
            if(!$res1){
                $this->ajaxReturn(array("status"=>1, "info"=>"用户返现失败，拒绝失败！"));
            }
            $data = array(
                "status"    => 2,
                "admin_id"  => $_SESSION['admin_id'],
                "deal_at"   => time(),
            );
            $res = $m-> where(array('id'=>$id,"status"=>0))->save($data);
            if($res){
                $m  ->commit();
                $m_m->commit();
                $this->ajaxReturn(array("status"=>1, "info"=>"拒绝成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"拒绝失败！"));
            }
        }
    }
}
