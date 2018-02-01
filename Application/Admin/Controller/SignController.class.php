<?php
namespace Admin\Controller;
class SignController extends AdminCommonController
{
    /*
     * 列表页
     */
    public  function  index(){
        $list=M('sign_config')->order('id asc')->select();

        $this->assign('list',$list);

        $this->display();
    }

    /*
    * 积分配置
     * $id  1.每日签到积分配置,2.额外获得积分奖励配置
    */
    public  function  sign_config(){

        if(IS_POST){
            $id=I('post.id');
             D('SignConfig')->query($id);
             die();
        }

             $list= M('sign_config')->where('id=1')->find();
            $sign_config=unserialize($list['sign_config']);

                $this->assign('sign_config',$sign_config);

        $this->display();
    }

    /*
* 积分配置
 * $id  1.每日签到积分配置,2.额外获得积分奖励配置
*/
    public  function  sign_config_jl(){
        if(IS_POST){
            $id=I('post.id');
            D('SignConfig')->query($id);
            die();
        }
        $list= M('sign_config')->where('id=2')->find();
        $sign_config=unserialize($list['sign_config']);
        $this->assign('sign_config',$sign_config);

        $this->display();
    }


    /*
     * 签到列表
     */
    public  function sign_list(){

        $this->display();
    }

}