<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class IngetralskuController extends AdminCommonController
{   //属性操作
    private $storeid;
    public function _initialize()
    {
        parent::_initialize();
        $this->storeid = 1;
        $this->assign('storeid',$this->storeid);
        
    }
    public function index()
    {   
        $m   = M("integral_skuAttr");
        $map = array(
            "pid"       => 0,
            //"storeid"   => $this->storeid,
            "isdel"     => 0,
        );
        $res = $m->where($map)->order("sort desc")->select();
        foreach($res as $k=>$v){
            $res[$k]["data"] = $m->where(array("pid"=>$v['id'], "isdel"=>0))->select();
        }
        $this->assign("cache", $res);
        $this->assign("cate",  $res);
        $this->assign("comptype", 1);
        $this->display();
    }
    public function addSku()
    {
        if(IS_AJAX){
            $classname = I("post.classname");
            $pid       = I("post.fid");
            $sort      = I("post.sort");
            $m = M("integral_skuAttr");
            $res = $m->where(array("classname"=>$classname, "pid"=>$pid, "isdel"=>0))->find();
            if($res){
                $this->ajaxReturn(array("status"=>0, "info"=>"类名已存在！"));
            }
            $data['classname'] = $classname;
            $data['pid']       = $pid;
            $data['sort']      = $sort;
            $data['storeid']   = $this->storeid;
            $data['time']      = date('Y-m-d H:i:s',NOW_TIME);
            $res = $m->add($data);
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"增加成功",'pid'=>$res));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"新增失败"));
            }
        }
    }
    public function delSku()
    {
        if(IS_POST){
            $id = I("id");
            $m  = M("integral_skuAttr");
            $data = $m->find($id);
            if(!$data){
                $this->ajaxReturn(array("status"=>0, "info"=>"sku不存在"));
            }
            if($data['pid']){
                $res = $m->where(array("id"=>$id))->setField("isdel", 1);
                if($res){
                    $this->ajaxReturn(array("status"=>1, "info"=>"删除成功"));
                }
            }else{
                $res1 = $m->where(array("id"=>$id))->setField("isdel", 1);
                $res2 = $m->where(array("pid"=>$id))->setField("isdel", 1);
                if($res1!==false && $res2!==false){
                    $this->ajaxReturn(array("status"=>1, "info"=>"删除成功"));
                }
            }
        }
        $this->ajaxReturn(array("status"=>0, "info"=>"删除失败"));
    }
    public function editSku()
    {
        if(IS_AJAX){
            $id        = I("post.categoryid");
            $classname = I("post.classname");
            $pid       = I("post.fid");
            $sort      = I("post.sort");
            $m = M("integral_skuAttr");
            $map = array(
                    "classname" => $classname,
                    "pid"       => $pid,
                    "id"        => array("neq", $id),
                );
            $sku_g = $m->find($id);
            $res   = $m->where($map)->find();
            if($res['classname'] == $sku_g['classname']){
                if($sort ==$res['sort']){
                    $this->ajaxReturn(array("status"=>0, "info"=>"类名已存在！"));
                }
            }
            $parid = $m->where(array("id"=>$id, "isdel"=>0))->getField("pid");
            if($parid == 0 && $pid != 0){
                $this->ajaxReturn(array("status"=>0, "info"=>"顶级sku无法改变sku！"));
            }
            $data['classname'] = $classname;
            $data['pid']       = $pid;
            $data['sort']      = $sort;
            $res = $m->where(array('id'=>$id))->save($data);
            if($res !== false){
                $this->ajaxReturn(array("status"=>1, "info"=>"修改成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"修改失败！"));
            }
        }
    }
}