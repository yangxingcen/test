<?php
namespace Shop\Controller;
use Think\Controller;

class UserController extends PublicController
{

    /**
     * 登录模块
     */
    public function login(){
        if(session("user_id")){
			session("user_id",null);
		}
		if(I("get.nowurl")){
		    session("nowurl",I("get.nowurl"));
		}
        if(I("get.type") == '1'){
            $type='1';
        }

        $this->assign('nowurl', I("get.nowurl"));
        $this->assign('type', $type);
        $this->setSeo('账户登录');
        $this->display();
    }


    /**20170708wzz
     * 执行登录
     */
    public function doLogin()
    {
        if (IS_AJAX) {
            $url = base64_decode(I("post.nowurl"));

            if (!$url || empty($url)) {
                $url = "/my_info.html";
            }
            if(I('post.type') == '1') {
                $url = '';
                $url = "/integral.html";
            }
            $telephone = I("post.telephone");
            $password  = I("post.password");
            if (!$telephone) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写手机号！"));
            }
            if (!preg_match("/^1[345789][0-9]{9}$/", $telephone)) {
                $this->ajaxReturn(array("status" => 0, "info" => "手机号码格式错误！"));
            }
            if (!$password) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写密码！"));
            }
            $res = M("member")->where(array('telephone' => $telephone, "isdel" => 0))->find();
            if (!$res) {
                $this->ajaxReturn(array("status" => 2, "info" => "账号不存在，去注册",'url'=>C('HOST').'/register.html'));
            }
            if ($res['status']) {
                $this->ajaxReturn(array("status" => 0, "info" => "您的账号已被冻结，请联系管理员"));
            }
            if ($res["password"] == encrypt_pass($password)) {
                session("user_id", $res['id']);
                $date_befor = date('Y-m-d H:i:s',strtotime(date('Y-m-d')));
                $date_after = date('Y-m-d H:i:s',strtotime("$date_befor +1 day"));
                if(strtotime($res['last_login_time']) < strtotime($date_befor)) {
                    $integral = M('integral')->where(array('id'=>'1'))->find();
                    $new_integral = $res['integral'] + $integral['integral'];
                    $integral_data = array(
                        'integral' => $new_integral
                    );
                    $save = M('member')->where(array('id' => $res['id']))->save($integral_data);
                    if(!$save) {
                        $this->ajaxReturn(array("status" => 0, "info" => "系统错误，请稍后再试！"));
                        die;
                    }
                }
                $login_r = array(
                    'last_login_time'    => date("Y-m-d H:i:s", time()),
                    'login_num'     => $res['login_num']+1,
                    );
                M('member')->where(array('id'=>$res['id']))->save($login_r);
                $this->user_info['telephone'] = $telephone;
                $this->logs('登陆成功');
                $this->ajaxReturn(array("status" => 1, "info" => "登录成功！", "url" => $url));
            } else {
                $this->ajaxReturn(array("status" => 0, "info" => "密码错误！"));
            }
        }
    }

    /**20170708 wzz
     * 注册模块
     */
    public function reg(){

        $this->setSeo('注册用户');
        $this->display();
    }

    /**20171212
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

    //获取手机验证码
    public function validate(){
        $data = I("post.data");
        //验证手机号
        if((!preg_match("/^1[345789][0-9]{9}$/", $data['telephone']))){
            $res = array(
                'status'=>0,
                'msg'=>'手机号格式不正确！',
            );
            exit(json_encode($res));
        }
        /*查出手机号是否存在*/
        if($data['type'] != '2' ) {
            $telephone = M('member')->where(array('telephone' => $data['telephone']))->field('id')->find();
            if($telephone) {
                $res = array(
                    'status'=>0,
                    'msg'=>'该手机号已经注册！',
                );
                exit(json_encode($res));
            }
        }
        //验证图形验证码
        if(!$data['vcode']) {
            $res = array(
                'status'=>0,
                'msg'=>'请输入图片验证码！',
            );
            exit(json_encode($res));
        }
        if(!check_verify($data['vcode'],'')){
            $res = array(
                'status'=>0,
                'msg'=>'图片验证码不正确！',
            );
            exit(json_encode($res));
        }
        $tel_code = sendMessage($data['telephone'],2);
        $res = array(
            'status'=>$tel_code['status'],
            'msg'=>$tel_code['info'],
        );
        exit(json_encode($res));

    }

    /**20170708 wzz
     * 执行注册
     * $telephone   手机号
     * $password    密码
     * $repassword  重复密码
     * $code        验证码
     */
    public function doReg()
    {
        if (IS_AJAX) {
            $telephone      = I("post.telephone");
            $password       = I("post.password");
            $repassword     = I("post.repassword");
            $code           = I("post.code");
            if (!$telephone) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写手机号！"));
            }
            if (!preg_match("/^1[345789][0-9]{9}$/", $telephone)) {
                $this->ajaxReturn(array("status" => 0, "info" => "手机号码格式错误！"));
            }
            if (!$password) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写密码！"));
            }
            if (!preg_match("/.{6,24}/", $password)) {
                $this->ajaxReturn(array("status" => 0, "info" => "密码格式错误！"));
            }
            if (!$repassword) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写重复密码！"));
            }
            if (!preg_match("/.{6,24}/", $repassword)) {
                $this->ajaxReturn(array("status" => 0, "info" => "重复密码格式错误！"));
            }
            if($password !==$repassword){
                $this->ajaxReturn(array("status" => 0, "info" => "两次密码不一致！"));
            }
            if (!$code) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写验证码！"));
            }
            // 判断手机号是否存在
            $count = M("member")->where(array("telephone" => $telephone))->count();
            if ($count) {
                $this->ajaxReturn(array("status" => 0, "info" => "手机号已存在！"));
            }
            /*检测验证码*/
            $res_code = checkMessage($telephone, $code, 2);
            /*检测验证码*/
            if ($res_code['status'] != 1) {
                $this->ajaxReturn(array("status" => 0, "info" => $res_code['info']));
            } else {
                // 注册成功
                $data['telephone']  = $telephone;
                $data['password']   = encrypt_pass($password);
                $data['add_time']    = date("Y-m-d H:i:s", time());
                $data['last_login_time']    = date("Y-m-d H:i:s", time());
                $data['person_img'] = C("HOST").'/Public/Shop/Images/user.jpg';
                $data['reg_type'] = '1';
                $data['grade']  = '2';
                $res = M("member")->add($data);
                if ($res) {
                    session("user_id", $res);
                    /*如果注册成功，增加该用户的注册积分*/
                    /*查出注册成功赠送多少积分*/
                    $integral = M('integral')->where(array('id' =>'2'))->field('id', 'integral')->find();
                    $integral_login = M('integral')->where(array('id' =>'1'))->field('id', 'integral')->find();
                    $new_integral = $integral['integral'] + $integral_login['integral'];
                    if($integral) {
                        $data_i = array(
                            'integral' => $new_integral
                        );

                        $save = M("member")->where(array('id' => $res))->save($data_i);
                        if(!$save) {
                            $this->ajaxReturn(array("status" => 0, "info" => "注册失败！"));
                            die;
                        }
                    }
					$url=base64_decode(session("nowurl"));
					if($url){
					    $this->user_info['telephone'] = $telephone;
                        $this->logs('注册成功');
					   $this->ajaxReturn(array("status" => 1, "info" => "注册成功！", "url" => $url));
					   session("nowurl",null);
					   die;
					}
                    $post_data=array(
                        'telephone'=>$telephone,
                        'password'=>$password,
                    );
                    $url = 'http://deyi1.unohacha.com/Shop/Index/reg';
                    curlSend($url,$post_data);
                    $this->ajaxReturn(array("status" => 1, "info" => "注册成功！", "url" => '/my_info.html'));
                } else {
                    $this->ajaxReturn(array("status" => 0, "info" => "注册失败！"));
                }
            }
        }
    }

    /**20170708wzz
     * 忘记密码模块
     */
    public function forgetPass()
    {

        $this->setSeo('找回密码');
        $this->display();
    }

    /**20170708wzz
     * 找回密码
     */
    public function findPass()
    {
        if (IS_AJAX) {
            $telephone      = I("post.telephone");
            $password       = I("post.password");
            $repassword     = I("post.repassword");
            $code           = I("post.code");
            if (!$telephone) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写手机号！"));
            }
            if (!preg_match("/^1[345789][0-9]{9}$/", $telephone)) {
                $this->ajaxReturn(array("status" => 0, "info" => "手机号码格式错误！"));
            }
            if (!$password) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写密码！"));
            }
            if (!preg_match("/.{6,24}/", $password)) {
                $this->ajaxReturn(array("status" => 0, "info" => "密码格式错误！"));
            }
            if (!$repassword) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写重复密码！"));
            }
            if (!preg_match("/.{6,24}/", $repassword)) {
                $this->ajaxReturn(array("status" => 0, "info" => "重复密码格式错误！"));
            }
            if($password !==$repassword){
                $this->ajaxReturn(array("status" => 0, "info" => "两次密码不一致！"));
            }
            if (!$code) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写验证码！"));
            }
            // 判断手机号是否存在
            $count = M("member")->where(array("telephone" => $telephone))->count();
            if (!$count) {
                $this->ajaxReturn(array("status" => 0, "info" => "手机号不存在！"));
            }

            $res = checkMessage($telephone, $code, 2);
            if ($res['status'] != 1) {
                $this->ajaxReturn($res);
            } else {
                // 注册成功
                $data=array();
                $data['password'] = encrypt_pass($password);
                $res = M("member")->where(array('telephone' => $telephone, 'isdel'=>'0'))->save($data);
                if ($res!==false) {
                    session("user_id", $res);
                    $this->user_info['user_id'] = $res;
                    $this->user_info['telephone'] = $telephone;
                    $this->logs('找回密码成功');
                    $this->ajaxReturn(array("status" => 1, "info" => "找回密码成功！", "url" => '/my_index.html'));
                } else {
                    $this->ajaxReturn(array("status" => 0, "info" => "找回密码失败！"));
                }
            }
        }
    }

    /**
     * 完成注册模块
     */
    public function completeReg()
    {
        $userid = $this->user_id;
        $userinfo = $this->user_info;

        if ($userinfo['telephone'] == $userinfo['person_name']) {
            $this->assign("userinfo", $userinfo)->display();
        } else {
            $this->redirect("Shop/Ucenter/index");
            die;
        }
    }

    /**
     * 得到唯一的注册码
     */
    public function getUniqueCode()
    {
        $code = randStr();
        $m = M("member");
        while ($m->where(array("reg_code" => $code))->find()) {
            $code = $this->getUniqueCode();
        }
        return $code;
    }

    /**
     * 完善用户昵称
     */
    public function saveName()
    {
        $this->checkLogin();
        if (IS_AJAX) {
            if ($this->user_info['telephone'] != $this->user_info['person_name']) {
                $this->ajaxReturn(array("status" => 0, "info" => "您已修改过昵称！"));
            }
            $person_name = I("post.name");
            if (!$person_name) {
                $this->ajaxReturn(array("status" => 0, "info" => "请输入昵称！"));
            }
            // 判断昵称是否存在
            $m = M("member");
            $count = $m->where(array("person_name" => $person_name))->count();
            if ($count) {
                $this->ajaxReturn(array("status" => 0, "info" => "该用户名已存在！"));
            } else {
                $res = $m->where(array("id" => $this->user_id))->save(array("person_name" => $person_name));
                if ($res) {
                    $this->ajaxReturn(array("status" => 1, "info" => "修改成功！", '/my_index.html'));
                } else {
                    $this->ajaxReturn(array("status" => 0, "info" => "修改失败！"));
                }
            }
        }
        $this->redirect("/main.html");
    }
}