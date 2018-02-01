<?php
namespace Admin\Model;
use Think\Model;
class ShopAdminCateModel extends Model
{
    /**20171213wzz
     * 添加/编辑角色
     * */
    public function addRole()
    {
        if(IS_POST){
            $data=array(
                'id'        => I('post.id','','intval'),
                "per_name"  => I('post.per_name','','trim'),
            );
            if($data['id'])
            {#编辑
                $rs = $this->where(array('per_name' =>$data['per_name'],'id'=>array('neq',$data['id'])))->count();
            }else{#添加
                $rs = $this->where(array('per_name' =>$data['per_name']))->count();
            }
            if($rs){
                ajaxReturn(0,'已存在');
            }else{
                if($data['id']){#编辑
                    $data['edit_time']  = date("Y-m-d H:i:s");
                    $r ='编辑';
                    $res = $this->save($data);
                }else{#添加
                    $data['add_time']   = date("Y-m-d H:i:s");
                    $data['edit_time']  = date("Y-m-d H:i:s");
                    $data['is_open']    =  0;
                    $r ='添加';
                    $res = $this->data($data)->add();
                }
                if($res!=false)
                {
                    ajaxReturn(1,$r.'成功');
                }else{
                    ajaxReturn(0,$r.'失败');
                }
            }
        }
        ajaxReturn(0,'未知错误');
    }

    /**20171213wzz
     * 启用/禁用/删除 角色
     * */
    public function delRole()
    {
        if(IS_POST){
            $id = I("post.id",'','intval');
            $item = I("post.item",'','trim');
            check_data(I('post.'),array('id','item'));
            $info  =$this->find($id);
            if($info){
                switch($item){
                    case 'is_open':
                        $res = $this->where(array('id'=>$id))->setField('is_open',1-$info['is_open']);
                        $t = '更新';
                        break;

                    case 'is_del':
                        $res = $this->where(array('id'=>$id))->setField('is_del',1);
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
            ajaxReturn(0,'未知错误');
        }
    }
}
 ?>