<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf-8");

class IntegralcateController extends AdminCommonController{

    public function index(){
        $title=I("get.title");
        $e_status=I("get.e_status");
        $id=I("get.id");
        $where = '';
        if($id){
            $where = ' and id="'.$id.'"';
            $this->assign('id',$id);
        }
        if($title){
            $where = ' and (title like "%'.$title.'%" or integral_type like "%'.$title.'%")';
            $this->assign('title',$title);
        }
        if($e_status){
            $this->assign('e_status',$e_status);
            if($e_status==1){
                $e_status=0;
            }else{
                $e_status=1;
            }
            $where = ' and status="'.$e_status.'"';
        }
        $list=D("integral")->where('is_del=0'.$where)->field("id,title,sorts,status,add_time,update_time,integral,integral_type")->order('sorts')->select();
        $this->assign('num',count($list));
        $this->assign('list',$list);
        $this->display();
    }
    // 获取积分商品分类修改信息
    public function integral_type_info(){
        $id = I("post.id");

        if($id){
            $res=D("integral")->where('id="'.$id.'"')->field("id,title,sorts,status,add_time,update_time,integral,integral_type")->select();
           
            if($res){
                $this->ajaxReturn($res[0]);
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
            }
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
    }
    //添加或者修改积分商品分类
    public function integral_type_addOrUpdate(){
        $arr = I("post.array");
        $id = I("post.id");
        //修改
        if(!$arr['integral_type']){
            $this->ajaxReturn(array('status'=>0,'info'=>'请填写分类!'));
            exit;
        }
        if(!$arr['title']){
            $this->ajaxReturn(array('status'=>0,'info'=>'请填写内容!'));
            exit;
        }
        if(!$arr['integral']){
            $this->ajaxReturn(array('status'=>0,'info'=>'请填写积分!'));
            exit;
        }
        $data=array(
            'title'=>$arr['title'],
            'integral_type'=>$arr['integral_type'],
            'status'=>$arr['status'],
            'sorts' => $arr['sorts'],
            'integral' => $arr['integral'],
            'update_time'=>date("Y-m-d H:i:s")
        );
        $res = D("integral")->where('id="'.$id.'"')->save($data);
        if($res){
            $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
        
        
    }
    //修改积分商品分类状态
    public function integral_type_status(){
        $id=I("post.id");
        $status=I("post.data");
        if($id){
            $data = array(
                'status'=>$status,
                'update_time'=>date("Y-m-d h:i:s")
            );
            $res = D("integral")->where("id='".$id."'")->save($data);
            if($res){
                $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
            }
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
    }
    //删除积分商品分类
    public function integral_type_del(){
        $id=I("post.id");
        if($id){
            $data = array(
                'is_del'=>1
            );
            $res = D("integral")->where("id='".$id."'")->save($data);
            if($res){
                $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
            }
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
    }


    //积分配置
    public  function  sign_config(){


        $this->display();
    }
    
  
}

