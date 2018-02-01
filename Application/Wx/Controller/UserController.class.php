<?php
namespace Wx\Controller;
use Think\Controller;

class UserController extends PublicController {
  
	// 注册
	public function reg(){
		$this->display();
	}
	//登录
	public function login(){
	       
		$this->display();
	}
    //忘记密码
    public function forget(){
        
        $this->display();
    }
    // 验证找回密码手机
    public function forget_zy_tel(){
        $telephone = I("post.data")['telephone'];
        $telcode = I("post.data")['telcode'];
        // 判断手机号是否存在
        $count = M("member")->where(array("telephone" => $telephone,'status'=>0,'isdel'=>0))->count();
        if (!$count) {
            $this->ajaxReturn(array("status" => 0, "info" => "手机号不存在！"));
        }
        //验证手机号
        if(!preg_match("/^1[34578]{1}\d{9}$/",$telephone)){ 
            $this->ajaxReturn(array("status" => 0, "info" => "手机号格式不正确！"));
        }
        if(!$telcode){
            $this->ajaxReturn(array("status" => 0, "info" => "请填写手机验证码！"));
        }
        //手机验证码
        $res_code = checkMessage($telephone,$telcode,6);
        if(!$res_code['status']){
           $this->ajaxReturn(array("status" => 0, "info" => $res_code['info']));
        }
        
        $this->ajaxReturn(array("status" => 1, "info" => $telephone));

    }
    //忘记密码1
    public function forget1(){
        $telephone = I("get.tel");
        $this->assign('telephone',$telephone);
        $this->display();
    }
    //忘记密码
    public function forget1_ajax(){
        $telephone = I("post.data")['telephone'];
        $password = I("post.data")['pass'];
        $ok_pass = I("post.data")['okpass'];
        if($password == null){
            $this->ajaxReturn(array("status" => 0, "info" => "请输入密码！"));
        }
        if($ok_pass != $password){
            $this->ajaxReturn(array("status" => 0, "info" => "俩次输入的密码不一致"));
        }
        $up_pass = array(
            'password' => encrypt_pass($password)
        );

        $res = M("member")->where(array("telephone" => $telephone,'status'=>0,'isdel'=>0))->save($up_pass);
        // dump($res);
        // exit;
        if($res !== false){
            $this->ajaxReturn(array("status" => 1, "info" => '找回成功！'));
        }else{
            $this->ajaxReturn(array("status" => 0, "info" => "系统繁忙，请稍候再试！"));
        }
        
    }
    //用户注册协议
    public function h5view(){
        $info = M('member_reg_agreement')->find();
        $this->assign('info',$info);
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
    //获取手机验证码
    public function validate_telcode(){
    	$data = I("post.data");
         //验证手机号是否为空
        if(!$data['telephone']){
            $res = array(
                'status'=>0,
                'msg'=>'请填写手机号！',
            );
            exit(json_encode($res));
        }
    	//验证手机号
    	if(!preg_match("/^1[34578]{1}\d{9}$/",$data['telephone'])){ 
    		$res = array(
    			'status'=>0,
    			'msg'=>'手机号格式不正确！',
    		);
    		exit(json_encode($res));
    	}
        $count = M("member")->where(array("telephone" => $data['telephone']))->count();
        if($data['type'] == 3){
            if ($count) {
                $res = array(
                    'status'=>0,
                    'msg'=>'该手机号已经注册！',
                );
                exit(json_encode($res));
            }
        }
        //验证图形验证码是否为空
        if(!$data['vcode']){
            $res = array(
                'status'=>0,
                'msg'=>'请填写图片验证码！',
            );
            exit(json_encode($res));
        }
        
    	//验证图形验证码
    	if(!check_verify($data['vcode'],'')){
    		$res = array(
    			'status'=>0,
    			'msg'=>'图片验证码不正确！',
    		);
    		exit(json_encode($res));
    	}
        // dump($data);die;
    	$tel_code = sendMessage($data['telephone'],$data['type']);
    	
		$res = array(
			'status'=>$tel_code['status'],
			'msg'=>$tel_code['info'],
		);
    	exit(json_encode($res));
    	
    }
    //验证注册
    public function validate_reg(){
    	$data = I("post.data");
        //验证手机号是否为空
        if(!$data['telephone']){
            $res = array(
                'status'=>0,
                'msg'=>'请填写手机号！',
            );
            exit(json_encode($res));
        }
    	//验证手机号格式
    	if(!preg_match("/^1[34578]{1}\d{9}$/",$data['telephone'])){ 
    		$res = array(
    			'status'=>0,
    			'msg'=>'手机号格式不正确！',
    		);
    		exit(json_encode($res));
    	}
        //验证手机验证码是否为空
        if(!$data['telcode']){
            $res = array(
                'status'=>0,
                'msg'=>'请填写手机验证码！',
            );
            exit(json_encode($res));
        }
    	// 验证密码
    	if(!$data['password']){
    		$res = array(
    			'status'=>0,
    			'msg'=>'请填写密码！',
    		);
    		exit(json_encode($res));
    	}
        if(strlen($data['password'])<6){
            $res = array(
                'status'=>0,
                'msg'=>'密码长度最少6位！',
            );
            exit(json_encode($res));
        }
        // 验证密码是否一致
        if(!$data['ok_password']){
            $res = array(
                'status'=>0,
                'msg'=>'请输入确认密码！',
            );
            exit(json_encode($res));
        }
    	// 验证密码是否一致
    	if($data['password'] != $data['ok_password']){
    		$res = array(
    			'status'=>0,
    			'msg'=>'密码不一致！',
    		);
    		exit(json_encode($res));
    	}

        if( $data['clearfix'] != 'tongyi2 clearfix on'){
            $res = array(
                'status'=>0,
                'msg'=>'请同意用户协议！',
            );
            exit(json_encode($res));
        }
    	//是否注册过
    	$count = M("member")->where(array("telephone" => $data['telephone']))->count();
        if ($count) {
            $res = array(
                'status'=>0,
                'msg'=>'该手机号已经注册！',
            );
            exit(json_encode($res));
        }
        //手机验证码
        $res_code = checkMessage($data['telephone'],$data['telcode'],3);
        if(!$res_code['status']){
            $res = array(
                'status'=>0,
                'msg'=>$res_code['info'],
            );
            exit(json_encode($res));
        }
    	//注册成功
    	$add_arr = array(
    		'telephone' => $data['telephone'],
    		'password' => encrypt_pass($data['password']),
    		'add_time' => date("Y-m-d H:i:s", time()),
    		'last_login' => date("Y-m-d H:i:s", time()),
    		'person_img' => C("HOST").'/Public/Shop/Images/user.jpg',
            'reg_type' => 2
    	);
  
        $id = M("member")->add($add_arr);
        $integral = M("integral")->where("is_del=0 and status=0 and id=2")->field("integral")->find();
        $integral = $integral['integral'];
        $up_integral = array(
            'integral'=>$integral
        );
        $res = M("member")->where("id='".$id."'")->save($up_integral);
        $add_integral = array(
            'action' => 2,
            'user_id' => $id,
            'integral' => $integral,
            'integral_befor' => 0,
            'integral_after' => $integral,
            's_type' => 1
        );
        M("Integral_status")->add($add_integral);
        if($id && $res){
        	$res = array(
    			'status'=>1,
    			'msg'=>'注册成功！',
    		);
    		exit(json_encode($res));
        }else{
        	$res = array(
    			'status'=>1,
    			'msg'=>'系统繁忙,请稍候再试！',
    		);
    		exit(json_encode($res));
        }

    	
    }

    //验证登录
    public function validate_login(){
    	$data = I("post.data");
        if(!$data['telephone']){
            $res = array(
                'status'=>0,
                'msg'=>'请填写手机号！',
            );
            exit(json_encode($res));
        }
    	//验证手机号
    	if(!preg_match("/^1[34578]{1}\d{9}$/",$data['telephone'])){ 
    		$res = array(
    			'status'=>0,
    			'msg'=>'手机号格式不正确！',
    		);
    		exit(json_encode($res));
    	}
    	// 验证密码
    	if(!$data['password']){
    		$res = array(
    			'status'=>0,
    			'msg'=>'请填写密码！',
    		);
    		exit(json_encode($res));
    	}
        //验证密码长度
        if(strlen($data['password'])<6){
            $res = array(
                'status'=>0,
                'msg'=>'密码长度最少6位！',
            );
            exit(json_encode($res));
        }
    	$query = M("member")->where(array('telephone' => $data['telephone'], "isdel" => 0))->find();
        $integral = M("integral")->where("is_del=0 and status=0 and id=1")->field("integral")->find();
        $integral=$integral['integral'];
        $date_befor = date('Y-m-d H:i:s',strtotime(date('Y-m-d')));
        $date_after = date('Y-m-d H:i:s',strtotime("$date_befor +1 day"));

        if (!$query) {
            $res = array(
    			'status'=>0,
    			'msg'=>'账号不存在！',
    		);
    		exit(json_encode($res));
        }
        if ($query['status']) {
        	$res = array(
    			'status'=>0,
    			'msg'=>'您的账号已被冻结，请联系管理员！',
    		);
    		exit(json_encode($res));
        }
    	if ($query["password"] == encrypt_pass($data['password'])) {
            session("wx_user_id", $query['id']);
            $Integral_status = D("Integral_status")->where('add_time >="'.$date_befor.'" and add_time <="'.$date_after.'" and user_id="'.$query['id'].'" and is_del=0 and action=1')->field('action')->limit("1")->find();
            if(!count($Integral_status)){
                $up_integral = array(
                    'integral' => $query['integral']+$integral,
                );
                M('member')->where(array('id'=>$query['id']))->save($up_integral);
                $add_integral = array(
                    'action' => 1,
                    'user_id' => $query['id'],
                    'integral' => $integral,
                    'integral_befor' => $query['integral'],
                    'integral_after' => $query['integral']+$integral,
                    's_type' => 1
                );
                M("Integral_status")->add($add_integral);

            }
            $login_r = array(
                'last_login'    => date("Y-m-d H:i:s", time()),
                'login_num'     => $query['login_num']+1,
               );
            M('member')->where(array('id'=>$query['id']))->save($login_r);
            $res = array(
    			'status'=>1,
    			'msg'=>'登录成功！',
    		);
    		exit(json_encode($res));
        } else {
            $res = array(
    			'status'=>0,
    			'msg'=>'密码错误！',
    		);
    		exit(json_encode($res));
        }
	
    }
    //退出登录
    public function tlogin(){
        session("wx_user_id",null);
        if(!session("wx_user_id")){
           $res = array(
                'status'=>1,
            );
            exit(json_encode($res));
        }

    }
}
