<?php
namespace Admin\Model;
use Think\Model;
class ShopAdminNodeModel extends Model
{

    /**20171213wzz
     * 获取节点列表
     * */
    public function get_node_list(){
        $nodes = $this->where(array("level"=>1,'is_del'=>0))->order("sorts ASC,id ASC")->select();
        foreach($nodes as $k=>$v)
        {
            $nodes2 = $this->where(array("level"=>2,"pid"=>$v['id'],'is_del'=>0))->order("sorts ASC,id ASC")->select();
            $nodes[$k]["nodes"] = $nodes2;
            foreach($nodes2 as $kk=>$vv)
            {
                $nodes3 = $this->where(array("level"=>3,"pid"=>$vv['id'],'is_del'=>0))->order("sorts ASC,id ASC")->select();
                $nodes[$k]["nodes"][$kk]['nodes'] = $nodes3;
                foreach($nodes3 as $kkk=>$vvv)
                {
                    $nodes4 = $this->where(array("level"=>4,"pid"=>$vvv['id'],'is_del'=>0))->order("sorts ASC,id ASC")->select();
                    $nodes[$k]["nodes"][$kk]['nodes'][$kkk]['nodes'] = $nodes4;
                }
            }
        }
        return $nodes;
    }


    /**20171213wzz
     * 添加/编辑节点
     * */
    public function addNode()
    {
        if(IS_POST){
            $data=array(
                "id"         => I("post.id"),
                "pid"        => I("post.pid"),
                "classname"  => I("post.classname"),
                "sorts"      => I("post.sorts"),
                "controller" => strtolower(I("post.controller")),
                "action"     => strtolower(I("post.action")),
            );
            if($data['id']){#编辑
                unset($data['pid']);
                $data['edit_time']  = date("Y-m-d H:i:s");
                $r ='编辑';
                $res = $this->save($data);
            }else{#添加
                if($data['pid']){
                    $p = $this->find( $data['pid'] );
                    if(!$p){
                        ajaxReturn(0,'创建失败');
                    }else {
                        $data['level'] = $p['level']+1;
                        $data['pid']   = $p['id'];
                        $data['pid2']  = $p['pid'];
                        $data['pid3']  = $p['pid2'];
                    }
                }else {
                    $data['level'] = 1;
                    $data['pid']   = 0;
                    $data['pid2']  = 0;
                    $data['pid3']  = 0;
                }
                $data['add_time']   = date("Y-m-d H:i:s");
                $data['edit_time']  = date("Y-m-d H:i:s");
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
     * 删除 节点
     * */
    public function delNode()
    {
        if(IS_POST){
            $id = I("post.id",'','intval');
            $item = I("post.item",'','trim');
            check_data(I('post.'),array('id','item'));
            $info  =$this->find($id);
            if($info){
                switch($item){
                    case 'is_del':
                        $this->where(array("id"=>$id))->setField('is_del',1);
                        $this->where(array("pid"=>$id))->setField('is_del',1);
                        $this->where(array("pid2"=>$id))->setField('is_del',1);
                        $this->where(array("pid3"=>$id))->setField('is_del',1);
                        $t = '删除';
                        $res ='1';
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