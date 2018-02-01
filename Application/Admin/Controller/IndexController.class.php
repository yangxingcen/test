<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf-8");
class IndexController extends AdminCommonController{

    public function index()
    {
        $this->display();
    }

    /**20171213wzz
     * 官网配置
     * */
    public function web_config()
    {
        if(IS_POST){
            $this->logs('官网配置');
            $data=I("post.");
            $data['update_time']=date("Y-m-d H:i:s");
            $res = M("ShopWebConfig")->where("id=1")->save($data);
            if($res !== false){
                ajaxReturn(1,'保存成功');
            }else{
                ajaxReturn(0,'保存失败');
            }
        }
        $cache = M("ShopWebConfig")->where(array("id"=>1))->find();
        $this->assign("cache",$cache);
        $this->display();
    }


    /**20171213wzz
     * 商城首页配置
     * */
    public function shopindexConfig()
    {
        if(IS_POST){
            $this->logs('配置 商城首页');
            $data=I("post.");
            $data['update_time']=date("Y-m-d H:i:s");
            $res = M("ShopIndexConfig")->where("id=1")->save($data);
            if($res !== false){
                ajaxReturn(1,'保存成功');
            }else{
                ajaxReturn(0,'保存失败');
            }
        }
        $cache = M("ShopIndexConfig")->where(array("id"=>1))->find();
        $this->assign("cache",$cache);
        $this->display();
    }

    /**20171212wzz
     * 修改管理员登录密码
     * */
    public function updatePwd()
    {
        if(IS_POST){
            $action         = M('ShopUser');
            $password       = I('post.password');
            $re_password    = I('post.re_password');
            if($password!==$re_password){
                ajaxReturn(0,'修改失败');
            }
            if($password)
            {
                $md5_pass=encrypt_pass($password);
                $re=$action->where("id='".$_SESSION['admin_id']."'")->setField('password',$md5_pass);
                if($re!==false){
                    $this->logs('修改管理员登录密码');
                    ajaxReturn(1,'修改成功',U('Admin/User/login'));
                }else{
                    ajaxReturn(0,'修改失败');
                }

            }
        }else{

        }
        $this->display();
    }

}

