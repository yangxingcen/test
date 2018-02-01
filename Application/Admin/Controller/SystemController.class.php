<?php
namespace Admin\Controller;
class SystemController extends AdminCommonController
{
    /**20171213wzz
     * 管理员列表
     * */
    public function admin()
    {
        $cache      = M('shop_user')
                    ->field('id,username,cate,is_open,login_num,last_login,add_time')
                    ->where(array('is_del'=>0))
                    ->order('cate asc,add_time asc')
                    ->select();
        $cate_list  = M("shop_admin_cate")->select();
        $arr_Array  = array_reduce($cate_list,function(&$arr_Array,$v){
            $arr_Array[$v['id']] = $v;
            return $arr_Array;
        });
        foreach($cache as $key=>$value){
            $cache[$key]['j_info']  = json_encode($value);
            $cache[$key]['per_name']= $arr_Array[$value['cate']]['per_name'];
        }
        $this->logs('查看管理员列表');
        $this->assign("cache",$cache);
        $this->assign("cate_list",$cate_list);
        $this->display();
    }


    /**20171213wzz
     * 添加/编辑管理员
     * */
    public function addAdmin()
    {
        $this->logs('添加/编辑管理员');
        D('shop_user')->addAdmin();
    }


    /**20171213wzz
     * 启用/禁用/删除 管理员
     * */
    public function ableAdmin()
    {
        $this->logs('启用/禁用/删除 管理员');
        D('shop_user')->ableDelAdmin();
    }





    /**20171213wzz
     * 角色列表
     * */
    public function roleList()
    {
        $cache = M("shop_admin_cate")->where(array('is_del'=>0))->select();
        $this->assign("cache", $cache);
        $this->display();
    }


    /**20171213wzz
     * 添加/编辑角色
     * */
    public function addRole()
    {
        D("ShopAdminCate")->addRole();
    }


    /**20171213wzz
     * 删除群组角色
     * */
    public function delRole()
    {
        D('ShopAdminCate')->delRole();
    }


    /**20171213wzz
     * 角色权限设置
     */
    public function roleSet()
    {
        if(IS_POST){
            $ids = I("post.ids");
            $id  = I("post.id");
            if(!$id)
                ajaxReturn(0,'修改失败');
            $ids = array_filter(explode(",", $ids));
            sort($ids);
            $ids = implode(",", $ids);
            $res = M("shop_admin_cate")->where(array('id'=>$id))->setField("module", $ids);
            if($res!==false){
                ajaxReturn(1,'修改成功');
            }
            ajaxReturn(0,'修改失败1');
            die;
        }
        $id = I('id');
        $node_arr = M("shop_admin_cate")->find($id);
        if(!$node_arr)
            $this->error();
        $per_name = $node_arr['per_name'];
        $node_arr = $node_arr['module'];
        $node_arr = explode(",",  $node_arr);
        $this->assign("node_arr", $node_arr);
        $this->assign("per_name", $per_name);
        $this->assign("id",       $id);
        $this->nodeList();
    }






    /**20171213wzz
     * 权限节点列表
     * */
    public function nodeList()
    {
        $nodes =D("shop_admin_node")->get_node_list();

        $this->assign("cache", $nodes);
        $this->display();
    }


    /**20171213wzz
     * 添加/编辑权限节点
     * */
    public function addNode()
    {
        D('ShopAdminNode')->addNode();
    }


    /**20171213wzz
     * 删除权限节点
     * */
    public function delNode()
    {
        D('ShopAdminNode')->delNode();
    }








}