<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf-8");

class IntegralController extends AdminCommonController{

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
            $where = ' and name like "%'.$title.'%"';
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
        $list=D("integral_shop_type")->where('is_del=0'.$where)->field("id,name,sort,status,add_time,update_time")->order('sort')->select();
        $this->assign('num',count($list));
        $this->assign('list',$list);
        $this->display();
    }
    // 获取积分商品分类修改信息
    public function integral_type_info(){
        $id = I("post.id");

        if($id){
            $res=D("integral_shop_type")->where('id="'.$id.'"')->field("id,name,sort as sorts,status,add_time,pic_logo")->select();
            $price = D("integral_type_price")->where("type_id='".$id."'")->field("price")->select();
            if($price){
                foreach ($price as &$v) {
                    $p_arr[]=explode("-", $v['price']);
                    $res[0]['price']=$p_arr;
                }
            }
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
        if(!$arr['name']){
            $this->ajaxReturn(array('status'=>0,'info'=>'请填写标题!'));
            exit;
        }
        if(!$arr['pic_logo']){
            $this->ajaxReturn(array('status'=>0,'info'=>'请上传图片logo!'));
            exit;
        }
        if(!$id){
            //添加分类
            $data=array(
                'name'=>$arr['name'],
                'sort'=>$arr['sort'],
                'status'=>$arr['status'],
                'pic_logo'=>$arr['pic_logo'],
            );
            
            $res = D("integral_shop_type")->add($data);
            //添加分类价格范围
            if($arr['type_price']){
                $arr_pricearr = explode(",",rtrim($arr['type_price'],","));
                foreach ($arr_pricearr as &$v) {
                    $data_price = array(
                        'price' => $v,
                        'type_id'=>$res
                    );
                    D("integral_type_price")->add($data_price);
                }
            }
            if($res){
                $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
            }
        }else{
            //修改
            $data=array(
                'name'=>$arr['name'],
                'sort'=>$arr['sort'],
                'status'=>$arr['status'],
                'update_time'=>date("Y-m-d H:i:s"),
                'pic_logo'=>$arr['pic_logo'],
            );
            //修改分类价格范围
            if($arr['type_price']){
                D("integral_type_price")->where("type_id='".$id."'")->delete();
                $arr_pricearr = explode(",",rtrim($arr['type_price'],","));
                foreach ($arr_pricearr as &$v) {
                    $data_price = array(
                        'price' => $v,
                        'type_id'=>$id
                    );
                    D("integral_type_price")->add($data_price);
                }
            }
            $res = D("integral_shop_type")->where('id="'.$id.'"')->save($data);
            $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
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
            $res = D("integral_shop_type")->where("id='".$id."'")->save($data);
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
            D("integral_type_price")->where("type_id='".$id."'")->delete();
            $res = D("integral_shop_type")->where("id='".$id."'")->save($data);
            if($res){
                $this->ajaxReturn(array('status'=>1,'info'=>'成功!'));
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
            }
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'系统繁忙,请稍后再试!'));
        }
    }
    
  
}

