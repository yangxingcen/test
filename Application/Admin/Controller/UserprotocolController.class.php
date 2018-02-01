<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf-8");

class UserprotocolController extends AdminCommonController{

    public function index(){
        $info = M("member_reg_agreement")->find();
        $this->assign('info',$info);
        $this->display();
    }

    public function update(){
        $data = I("post.");
        // echo "<pre>";
        // print_r($data);
        if($data['id']){
            $array = array(
                'title' => $data['title'],
                'content' => $data['detail'],
                'update_time' => date("Y-m-d h:i:s")
            );
            $res = M("member_reg_agreement")->where('id="'.$data['id'].'"')->save($array);
            if($res!==false){
                $this->ajaxReturn(array("status"=>1,"info"=>"保存成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0,"info"=>"保存失败！"));
            }
        }else{
            $array = array(
                'title' => $data['title'],
                'content' => $data['detail'],
                'add_time' => date("Y-m-d h:i:s")
            );
            $res = M("member_reg_agreement")->add($array);
            if($res){
                $this->ajaxReturn(array("status"=>1,"info"=>"保存成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0,"info"=>"保存失败！"));
            }
        }
    }
    
}

