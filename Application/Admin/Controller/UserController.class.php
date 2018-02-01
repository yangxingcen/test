<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class UserController extends CommonController
{
    /**20171212wzz
     * 后台用户登录页面
     * */
    public function login()
    {
        session('admin_id',null);
        session_destroy();
        $this->display();
    }


    /**20171212wzz
     * 验证码生成
     * */
    public function verify_c()
    {
        ob_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->useCurve = false;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 130;
        $Verify->imageH = 50;
        $Verify->entry();
    }


    /**20171212wzz
     * 后台检测登录
     * */
    public function checkloginajax()
    {
        $verify = I('param.vcode','');
        if(!check_verify($verify))
        {
            $data['info']   =   '亲，验证码输错了哦！'; // 提示信息内容
            $data['status'] =   0;  // 状态 如果是success是1 error 是0
            $data['url']    =   ''; // 成功或者错误的跳转地址
            $this->ajaxReturn($data);
        }
        D("ShopUser")->login();
    }


}