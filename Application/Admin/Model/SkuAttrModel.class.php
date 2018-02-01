<?php
namespace Admin\Model;
use Think\Model;
class SkuAttrModel extends Model
{
    /**20171213wzz
     * 添加/编辑商品规格
     * */
    public function skuAttrAdd()
    {
        if(IS_POST){
            $data=array(
                'id'    => I('post.id','','intval'),
                "pid"   => I('post.pid','','trim'),
                "classname" => I('post.classname','','trim'),
                "sorts" => I('post.sorts','','trim'),
            );
            $res1 = $this->where(array('id'=>array('neq',$data['id']),"classname"=>$data['classname'], "pid"=>$data['pid'], "is_del"=>0))->find();
            if($res1){
                ajaxReturn(0,'类名已存在');
            }
            if($data['id']){#编辑
                $parid = $this->where(array("id"=>$data['id'], "is_del"=>0))->getField("pid");
                if($parid == 0 && $data['pid']){
                    ajaxReturn(0,'规格无法改变');
                }
                $data['edit_time']  = date("Y-m-d H:i:s");
                $r ='编辑';
                $res = $this->save($data);
            }else{#添加
                unset($data['id']);
                $data['add_time']   = date("Y-m-d H:i:s");
                $data['edit_time']  = date("Y-m-d H:i:s");
                $data['is_del']     =  0;
                $data['status']     =  0;
                $r ='添加';
                $res = $this->data($data)->add();
                $res_s = json_encode(array('sku_name'=>$data['classname'],'sku_id'=>$res));
            }
            if($res!=false)
            {
                ajaxReturn(1,$r.'成功','',$res_s);
            }else{
                ajaxReturn(0,$r.'失败');
            }
        }
        ajaxReturn(0,'未知错误');
    }

    /**20171213wzz
     * 启用/禁用/删除 商品规格
     * */
    public function skuAttrDel()
    {
        if(IS_POST){
            $id = I("post.id",'','intval');
            $item = I("post.item",'','trim');
            check_data(I('post.'),array('id','item'));
            $info  =$this->find($id);
            if($info){
                switch($item){

                    case 'status':
                        $res = $this->where(array('id'=>$id))->setField('status',1-$info['status']);
                        $res = $this->where(array('pid'=>$id))->setField('status',1-$info['status']);
                        $res =1;
                        $t = '更新';
                        break;

                    case 'is_del':
                        $res = $this->where(array('id'=>$id))->setField('is_del',1);
                        $res = $this->where(array('pid'=>$id))->setField('is_del',1);
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
 ?>