<?php
namespace Admin\Model;
use Think\Model;
class ShopGoodsCateModel extends Model
{
    /**20171213wzz
     * 添加/编辑商品分类
     * */
    public function goodsCateAdd()
    {
        if(IS_POST){
            $data=array(
                'id'    => I('post.id','','intval'),
                "pid"  => I('post.pid','','trim'),
                "is_tui" => I('post.is_tui','','trim'),
                "classname" => I('post.classname','','trim'),
                "pic"   => I('post.pic','','trim'),
                "pic_s"   => I('post.pic_s','','trim'),
                "sorts" => I('post.sorts','','trim'),
            );
            if($data['id']){#编辑
                $data['edit_time']  = date("Y-m-d H:i:s");
                $r ='编辑';
                $res = $this->save($data);
            }else{#添加
                #验证相同
                $count = $this->where(array('pid'=>$data['pid'],'classname'=>$data['classname']))->count();
                if($count){
                    ajaxReturn(0,'分类已存在');
                }
                unset($data['id']);
                $data['add_time']   = date("Y-m-d H:i:s");
                $data['edit_time']  = date("Y-m-d H:i:s");
                $data['is_del']     =  0;
                $data['status']     =  0;
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
        ajaxReturn(0,'未知错误');
    }

    /**20171213wzz
     * 启用/禁用/删除 商品分类
     * */
    public function goodsCateDel()
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


    /**20171219wzz
     * 商品分类配置
     * */
    public function goodscateInfo(){
        if(IS_POST){
            $data = I('post.');
            $small = $data['small'];
            $big = $data['big'];
            $arr=array();
            if($small){
                foreach($small as $key=>$value){
                    $arr[] =array($value,$big[$key]);
                }
            }
            $data['price_arr']=serialize($arr);
            $res = $this->save($data);
            if($res!=false){
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(0,'失败');
            }
        }
    }
}
 ?>