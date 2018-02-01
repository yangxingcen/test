<?php
namespace Wx\Controller;
use Think\Controller;

class UcenterController extends PublicController {
	//个人中心
	public function _initialize()
    {
        parent::_initialize();
        $this->checkLogin();
//        $count = M("systemMessage")->where(array("user_id" => $this->user_id, "isdel" => 0, "islooked" => 0))->count();
//        $this->assign("count", $count);

        $this->assign("userinfo", $this->user_info);
        $this->assign("urlname", ACTION_NAME);

    }
	public function index(){
	   $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();

        $this->assign('info', $info);
		$this->display();
	}
	//地址管理
	public function address(){
	  	$addmodel = D('address');
        //根据user_id查找出对应的地址信息

        $info = $addmodel->where(array('userid' => $this->wx_user_id))->order('id desc')->select();
        $address_num = 10 - count($info);
        $this->assign('info', $info);
        $this->assign('address_num', $address_num);
		$this->display();
	}
	//添加地址
	public function add_address(){
	  
		$this->display();
	}
	//添加收货地址
    public function addAddress()
    {
        if (IS_AJAX) {

            $id = I("post")['id'];
            $data['telephone'] = I("post")['telephone'];
            $data['city'] = I("post")['city'];
            // $arr[] = explode('/', $data['city']);
            $data['province'] = I("post")['province'];
            $data['city'] = I("post")['city'];
            $data['district'] = I("post")['district'];
            $data['place'] = I("post")['place'];
            $data['consignee'] = I("post")['consignee'];
            $data['userid'] = $this->wx_user_id;
            $data['default'] = I("post")['default'];
            $data['update_at'] = date("Y-m-d h:i:s");
            // echo "<pre>";
            // print_r($data);
            // exit;
            // 验证
            if (empty($data['consignee'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写收货人！"));
            }
            if (empty($data['telephone'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写手机号！"));
            }
            if (!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $data['telephone'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写正确的手机号！"));
            }
            if (empty($data['city'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请选择地址！"));
            }
            if (empty($data['place'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写详细的收获地址！"));
            }
            if ($id) {
                if ($data['default']) {
                    $u_arr = array(
                        'isdefault' => $data['default'],
                        'update_at' => date("Y-m-d h:i:s"),
                    );
                    $ot_arr = array(
                        'isdefault' => 0,
                        'update_at' => date("Y-m-d h:i:s"),
                    );
                    $res1 = M("address")->where('id<>"'.$id.'" and userid="'.$data['userid'].'"')->save($ot_arr);
                    $res2 = M("address")->where('id="'.$id.'"')->save($u_arr);
                    if($res1 && $res2){
                        $this->ajaxReturn(array("status" => 1, "info" => "修改成功！"));
                    }else{
                        $this->ajaxReturn(array("status" => 0, "info" => "修改失败！"));
                    }
                }
                $res = M("address")->where(array("id" => $id, "user_id" => $data['userid']))->save($data);
            } else {
                if($data['default'] == 1){
                    $ot_arr = array(
                        'isdefault' => 0,
                        'update_at' => date("Y-m-d h:i:s"),
                    );
                    $res1 = M("address")->where('userid="'.$data['userid'].'"')->save($ot_arr);
                }
                $data['isdefault']=$data['default'];
                $res = M("address")->add($data);
            }
            if ($res) {
                $this->ajaxReturn(array("status" => 1, "info" => $id ? "修改成功！" : "添加成功！"));
            } else {
                $this->ajaxReturn(array("status" => 0, "info" => $id ? "修改失败！" : "添加失败！"));
            }
        }
    }
	//修改地址
	public function update_address(){
	  	$id = $_GET['id'] + 0;
        $addmodel = D('address');
        $info1 = $addmodel->where(array('id' => $id, 'user_id' => $this->wx_user_id))->find();
        $this->assign('info1', $info1);
		$this->display();
	}
	// 删除收货地址
	public function delAddress()
    {
        if (IS_AJAX) {
            $id = I("post.id", 0, "intval");
            $res = M('address')->where(array('id' => $id, 'user_id' => $this->wx_user_id))->delete();
            if ($res) {
                $this->ajaxReturn(array("info" => '删除成功！', "status" => 1));
            } else {
                $this->ajaxReturn(array("info" => '删除失败！', "status" => 0));
            }
        }
    }
    // 修改默认
    public function up_default()
    {
        if (IS_AJAX) {
        	$def = I("post.def");
        	if($def == 0){
        		$o_def = 1;
        	}else{
        		$o_def = 0;
        	}
        	$up_def = array(
				'isdefault' => $o_def,
        	);
        	
            $id = I("post.id", 0, "intval");
            $res = M('address')->where(array('id' => $id, 'userid' => $this->wx_user_id))->save($up_def);
            if($def == 0){
            	$def = array(
	        		'isdefault' => $def,
	        	);
            	M('address')->where('id<>"'.$id.'" and userid="'.$this->wx_user_id.'"')->save($def);
            }
            
            if ($res) {
                $this->ajaxReturn(array("info" => '修改成功！', "status" => 1));
            } else {
                $this->ajaxReturn(array("info" => '修改失败！', "status" => 0));
            }
        }
    }
    //个人中心设置
    public function myInfo(){
        $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();
        $this->assign('info', $info);
        $this->display();
    }
    //个人设置
    public function mySet(){
        $info = M("member")->alias('m')->join("tb_member_vip as mv on mv.id=m.grade")->where("m.id='".$this->wx_user_id."' and m.isdel=0 and m.status=0 and mv.status=0 and is_del=0")->field("m.id,m.person_name,m.person_img,m.sex,mv.vip_name,m.telephone,m.sex")->find();
        // dump($info);die();
        if($info['sex'] == 1){
            $info['sex'] = '男';
        }else if($info['sex'] == 2){
            $info['sex'] = '女';
        }else{
            $info['sex'] = '保密';
        }
        // echo $this->wx_user_id;
        // exit;
        // echo "<pre>";
        // print_r($info);
        // exit;
        $this->assign('info', $info);
        $this->display();
    }
    // 修改性别
    public function up_sex(){
       if (IS_AJAX) {
            $id = I("post.id", 0, "intval");
            $sex = I("post.sex");
            $up_sex = array(
                'sex' => $sex,
            );
            $res = M('member')->where("id='".$id."'")->save($up_sex);
            
            if ($res) {
                $this->ajaxReturn(array("info" => '修改成功！', "status" => 1));
            } else {
                $this->ajaxReturn(array("info" => '修改失败！', "status" => 0));
            }
        }
    }
    // 修改用户名页面
    public function myName(){
        $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();
        $this->assign('info', $info);
        $this->display();
    }
    // 修改用户名
    public function up_name_ajax(){
       if (IS_AJAX) {
            $person_name = I("post.person_name");
            $up_name = array(
                'person_name' => $person_name,
            );
            $res = M('member')->where("id='".$this->wx_user_id."'")->save($up_name);
            
            
            $this->ajaxReturn(array("info" => '修改成功！', "status" => 1));
            
        }
    }
    // 修改密码名页面
    public function myPassword(){
        $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();
        $this->assign('info', $info);
        $this->display();
    }
    // 修改用户密码
    public function up_pass_ajax(){
       if (IS_AJAX) {
            $old_pass = I("post.old_pass");
            $pass = I("post.pass");
            $ok_pass = I("post.ok_pass");
            $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();
            if(encrypt_pass($old_pass) != $info['password']){
                $this->ajaxReturn(array("info" => '原密码不正确！', "status" => 0));
            }
            if($pass == null){
                 $this->ajaxReturn(array("info" => '密码不能为空！', "status" => 0));
            }
            if($pass != $ok_pass){
                 $this->ajaxReturn(array("info" => '俩次密码不一致！', "status" => 0));
            }
            $up_pass = array(
                'password' => encrypt_pass($pass),
            );
            $res = M('member')->where("id='".$this->wx_user_id."'")->save($up_pass);
            if($res){
                session("wx_user_id", null);
                $this->ajaxReturn(array("info" => '修改成功！', "status" => 1));
            }   
        }
    }
    //赚取积分
    public function getIntegral(){
        $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();
        $user_id = $this->wx_user_id;
      
        $date_befor = date('Y-m-d H:i:s',strtotime(date('Y-m-d')));
        $date_after = date('Y-m-d H:i:s',strtotime("$date_befor +1 day"));
        
        $Integral_list = D("Integral")->alias('i')->where('i.is_del=0 and status=0')->field('i.id,i.title,i.integral,i.integral_type')->order('i.id')->select();
        foreach ($Integral_list as &$v) {
            $Integral_status = D("Integral_status")->where('add_time >="'.$date_befor.'" and add_time <="'.$date_after.'" and user_id="'.$user_id.'" and is_del=0')->field('action')->select();
            if(!$Integral_status){
                if($v['id'] == 1 || $v['id'] == 2 || $v['id'] == 7){
                    $v['status'] = 1;
                }else{
                    $v['status'] = 2;
                }
            }else{
                $v['status'] = 2;
                foreach ($Integral_status as &$z) {
                    if($v['id'] == $z['action'] || $v['id'] == 1 || $v['id'] == 2 || $v['id'] == 7){
                        $v['status'] = 1;
                    }
                }
            }
            
            
        }
        
        $this->assign('Integral_list', $Integral_list);
        $this->assign('info', $info);
        $this->display();
    }
    //积分明细
    public function integralInfo(){
        $info = M("member")->where("id='".$this->wx_user_id."' and isdel=0 and status=0")->find();
        $s_month=date("Y-m-d H:i",mktime(0,0,0,date('m'),1,date('Y')));
        $e_month=date("Y-m-d H:i",mktime(23,59,59,date('m'),date('t'),date('Y')));
        $integral_info = M("integral_status")->where("is_del=0 and user_id='".$info['id']."' and add_time >='".$s_month."' and add_time <='".$e_month."'")->select();
        
        foreach ($integral_info as &$v) {

            switch ($v['action']) {
                case '1':
                    $v['action_name'] = '登录';
                break;
                case '2':
                    $v['action_name'] = '注册';
                break;
                case '3':
                    $v['action_name'] = '分享';
                break;
                case '4':
                    $v['action_name'] = '关注';
                break;
                case '5':
                    $v['action_name'] = '邀请';
                break;
                case '6':
                    $v['action_name'] = '签到';
                break;
                default:
                    $v['action_name'] = '下单';
                break;
            }
           
        }
        $this->assign("integral_info",$integral_info);
        $this->assign('info', $info);
        $this->display();
    }
    //邀请码
    public function fen_x(){
        $this->display();
    }
    //消息
    public function user_new(){
      
        $this->display();
    }
    //交易助手
    public function user_new_inner(){
      
        $this->display();
    }
    //浏览记录
    public function browse(){
        $info = browse($this->wx_user_id);
        $this->assign('info',$info);
        $this->display();
    }
    //批量删除浏览记录
    public function del_browse(){
        if(IS_AJAX) {
            $id = I("post.id");
            $id = rtrim($id,',');
            $id_arr = explode(",", $id);
            $id = implode(",",array_unique($id_arr));
            $up_arr = array(
                'is_del' => 1,
            );
            $res = M('browse')->where('id in('.$id.')')->save($up_arr);
            if($res){
                $this->ajaxReturn(array("info" => '删除成功！', "status" => 1));
            }else{
                $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
            }
        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
        }
    }
    //我的收藏
    public function collect(){      
        $one_month = strtotime("-1 month");
        $three_month = strtotime("-3 month");
        // echo strtotime("-2 month");
        // exit;
        $now_month = time();
        //统计一共的个数
        $count = M("collection")->where('status=1 and user_id="'.$this->wx_user_id.'" and collect_time<="'.$now_month.'" and collect_time>="'.$three_month.'"')->count();
        //近一个月的数据
        $collection = M("collection")->where('status=1 and user_id="'.$this->wx_user_id.'" and collect_time<="'.$now_month.'" and collect_time>="'.$one_month.'"')->order('collect_time desc')->select();
        foreach ($collection as &$v) {
            if($v['type'] == 1 || $v['type'] == 2){
                $v['goods'] = M("goods")->where('is_del=0 and is_sale=1 and id="'.$v['goods_id'].'"')->find();
            }else{
                $v['goods'] = M("goods_market")->where("is_sale=1 and isactivity=1 and is_del=0 and id='".$v['goods_id']."'")->find();
            }
        }
        //近三个月的数据
        $collection3 = M("collection")->where('status=1 and user_id="'.$this->wx_user_id.'" and collect_time<="'.$now_month.'" and collect_time>="'.$three_month.'"')->order('collect_time desc')->select();
        foreach ($collection3 as &$v) {
            if($v['type'] == 1 || $v['type'] == 2){
                $v['goods'] = M("goods")->where('is_del=0 and is_sale=1 and id="'.$v['goods_id'].'"')->find();
            }else{
                $v['goods'] = M("goods_market")->where("is_sale=1 and isactivity=1 and is_del=0 and id='".$v['goods_id']."'")->find();
            }
        }
        // echo "<pre>";
        // print_r($collection);
        // exit;
        $this->assign('count',$count);
        $this->assign('collection',$collection);
        $this->assign('collection3',$collection3);
        $this->display();
    }
    //取消收藏
    public function qx_collect(){
        if(IS_AJAX) {
            $id = I("post.id");
            $up_arr = array(
                'status' => 0,
                'collect_time' => 0
            );
            $res = M('collection')->where('id="'.$id.'"')->save($up_arr);
            if($res){
                $this->ajaxReturn(array("info" => '取消成功！', "status" => 1));
            }else{
                $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
            }
        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
        }
    }
    //批量取消收藏
    public function del_collect(){
        if(IS_AJAX) {
            $id = I("post.id");
            $id = rtrim($id,',');
            $id_arr = explode(",", $id);
            $id = implode(",",array_unique($id_arr));
            $up_arr = array(
                'status' => 0,
                'collect_time' => 0
            );
            $res = M('collection')->where('id in('.$id.')')->save($up_arr);
            if($res){
                $this->ajaxReturn(array("info" => '取消成功！', "status" => 1));
            }else{
                $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
            }
        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
        }
    }
    //我的优惠券
    public function coupon(){
      
        $this->display();
    }
     //我的评价
    public function user_pingj(){
      
        $this->display();
    }
    //我的评价详情
    public function user_pingj_in(){
      
        $this->display();
    }
    //我的发票
    public function user_fap(){
        $info = M('invoice')->where("is_del=0 and user_id = '".$this->wx_user_id."'")->select();
        $this->assign('info',$info);
        $this->display();
    }
    //添加发票
    public function add_fap(){
        if(IS_AJAX) {
            $data = I("post.post");
            $name = M("member")->where('id="'.$this->wx_user_id.'"')->getField('person_name');
            $query = M("invoice")->where('unit_name="'.$data['unit_name'].'" and phone = "'.$data['phone'].'" and bank = "'.$data['bank'].'" and bank_num = "'.$data['bank_num'].'" and name_num = "'.$data['name_num'].'" and user_id = "'.$this->wx_user_id.'"')->count();
            if($query){
                $this->ajaxReturn(array("info" => '此发票已存在！', "status" => 0));
            }
            $add_arr = array(
                'unit_name' => $data['unit_name'],
                'name' => $name,
                'address' => $data['address'],
                'phone' => $data['phone'],
                'bank' => $data['bank'],
                'bank_num' => $data['bank_num'],
                'user_id' => $this->wx_user_id,
                'name_num' => $data['name_num'],
            );
            $res = M('invoice')->add($add_arr);
            if($res){
                $this->ajaxReturn(array("info" => '添加成功！', "status" => 1));
            }else{
                $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
            }
        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
        }
        
    }
    //删除发票
    public function del_fap(){
        if(IS_AJAX) {
            $id = I("post.id");
            $up_arr = array(
                'is_del' => 1,
            );
            $res = M('invoice')->where('id="'.$id.'"')->save($up_arr);
            if($res){
                $this->ajaxReturn(array("info" => '删除成功！', "status" => 1));
            }else{
                $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
            }
        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候在试！', "status" => 0));
        }
    }
    //我的发票详情
    public function user_fap_in(){
        $id = I("get.id");
        $info = M("invoice")->where('id="'.$id.'"')->find();
        $this->assign('info',$info);
        $this->display();
    }
    // 支付设置
    public function user_zhif(){
        $res = M("bank_list")->where(array("user_id" => $this->wx_user_id,'is_del'=>'0'))->order("is_default,create_at desc")->select();
        foreach ($res as &$v) {
            $v['wei_num'] = substr($v['bank_no'],-4);
        }
        // echo "<pre>";
        // print_r($res);
        // exit;
        $this->assign("info",$res);
        $this->display();
    }
    //修改支付设置默认
    public function up_zhif_default(){
        if (IS_AJAX) {
            $id = I("post.id");
            $is_default = I("post.is_default");
            $up_arr = array(
                'is_default' => $is_default,
            );
            $other_arr = array(
                'is_default' => 2,
            );
            $res = M("bank_list")->where("id='".$id."'")->save($up_arr);
            if($is_default == 1){
                $res1 = M('bank_list')->where('id<>"'.$id.'" and user_id="'.$this->wx_user_id.'"')->save($other_arr);
            }
            if ($res) {
                $this->ajaxReturn(array("info" => '修改成功！', "status" => 1));
            } else {
                $this->ajaxReturn(array("info" => '修改失败！', "status" => 0));
            }

        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候再试！', "status" => 0));
        }      
        
    }
    // 添加一行卡
    public function add_bank(){
        if (IS_AJAX) {
            $telephone = I("post.telephone");
            $bank_no = I("post.bank_no");
            //验证手机号
            if(!preg_match("/^1[34578]{1}\d{9}$/",$telephone)){ 
                $this->ajaxReturn(array("info" => '手机号格式不正确！', "status" => 0));
            }
            $add_arr = array(
                'bank_no' => $bank_no,
                'telephone' => $telephone,
                'user_id' => $this->wx_user_id,
                'is_default' => 2,
                'create_at' => time()
            );
            $res = M("bank_list")->add($add_arr);
            if ($res) {
                $this->ajaxReturn(array("info" => '修改成功！', "status" => 1));
            } else {
                $this->ajaxReturn(array("info" => '修改失败！', "status" => 0));
            }

        }else{
            $this->ajaxReturn(array("info" => '系统繁忙,请稍候再试！', "status" => 0));
        }  
    }
    //上传头像

 public function upload_base64()
    {
        import('@.ORG.Image.ThinkImage');
        $return = array('flag' => 0, 'msg' => '', 'img' => '');
        if (empty($this->wx_user_id)) {
            $return['msg'] = '登录超时，请重新登录！';
            echo json_encode($return);
            exit();
        }
        $dir = "./Uploads/image/headimg";

        $rand = substr(time(), -4);
        $image_name = $this->wx_user_id . '_' . $rand . ".jpg";


        $img_str = $_POST['img_str'];
        // echo "<pre>";
        // print_r($img_str);
        // exit;
        $img_str = str_replace('data:image/jpeg;base64,', '', $img_str);
        $img_str = str_replace('data:image/png;base64,', '', $img_str);
        $img_str = str_replace('data:image/gif;base64,', '', $img_str);
        file_put_contents($dir . '/' . $image_name, base64_decode($img_str));

        $return['flag'] = 1;
        $return['msg'] = '上传成功!';
        $return['img'] = trim($dir, ".") . '/thumb_' . $image_name;
        $img_source = $dir . '/' . $image_name;
        //生成缩略图
        $thumb = $dir . '/thumb_' . $image_name;
        $img = new \ThinkImage(THINKIMAGE_GD, $img_source);
        $img->thumb(200, 200, THINKIMAGE_THUMB_FIXED)->save($thumb);
        //保存数据库
        M('member')->where(array('id' => $this->wx_user_id))->save(array('person_img' => trim($thumb, ".")));
        echo json_encode($return);
        exit;
    }
    /*
     * 测试签到
     */
    public function qiandao(){
        $time_ti=date('Y-m-d H:i:s',time());


            //前一天时间
        $time=date("Ymd",strtotime("-1 day"));
         $info= M('sign_log')->where('user_id='.$this->wx_user_id.' and date_format(from_unixtime(addtime),\'%Y%m%d\')='.$time)->order('id desc')->find();
         //判断昨天是否点过签到
            if($info==null){
                   //查询用户表
                M('member')->where('id='.$this->wx_user_id)->setField('signday',1);
                $signday=M('member')->where('id='.$this->wx_user_id)->field('signday,integral')->find();
                //签到配置
                $qiandao=M('sign_config')->where('id=1')->find();
                    $sign_config=unserialize($qiandao['sign_config']);

                foreach ($sign_config as $k=>$v){

                    if($signday['signday']>=$v['start_day'] && $signday['signday']<=$v['end_day']){
                        //更新积分
                        M('member')->where('id='.$this->wx_user_id)->setInc('integral',$v['give_integral']);

                        $signday_er=M('member')->where('id='.$this->wx_user_id)->field('signday,integral')->find();

                                $datajifen['current_integral']=$signday['integral'];//当前积分
                                $datajifen['give_integral']=$v['give_integral'];//赠送积分
                                $datajifen['total_integral']=$signday_er['integral'];//更新后总共积分
                                $datajifen['total_day']=$signday_er['signday'];//连续签到天数
                                $datajifen['addtime']=$time_ti;//签到时间
                                $datajifen['user_id']=$this->wx_user_id;//用户id
                                $datajifen['source']='';//来源
                        M('sign_log')->add($datajifen);

                    }
                }
                $retdata['status']=1;
                $retdata['info']="签到成功";
                $retdata['day']=$signday['signday'];//签到天数
                echo json_encode($retdata);exit();
            }else{
                //更新签到天数
                M('member')->where('id='.$this->wx_user_id)->setInc('signday',1);
                //查询用户表
                $signday=M('member')->where('id='.$this->wx_user_id)->field('signday,integral')->find();
                //查询签到配置
                $qiandao=M('sign_config')->where('id=1')->find();
                $sign_config=unserialize($qiandao['sign_config']);
                foreach ($sign_config as $k=>$v){
                    if($signday['signday']>=$v['start_day'] && $signday['signday']<=$v['end_day']){
                        //更新积分
                        M('member')->where('id='.$this->wx_user_id)->setInc('integral',$v['give_integral']);
                        //查询用户表
                        $signday_er=M('member')->where('id='.$this->wx_user_id)->field('signday,integral')->find();
                        $datajifen['current_integral']=$signday['integral'];//当前积分
                        $datajifen['give_integral']=$v['give_integral'];//赠送积分
                        $datajifen['total_integral']=$signday_er['integral'];//更新后总共积分
                        $datajifen['total_day']=$signday_er['signday'];//连续签到天数
                        $datajifen['addtime']=$time_ti;//签到时间
                        $datajifen['user_id']=$this->wx_user_id;//用户id
                        $datajifen['source']='';//来源
                        M('sign_log')->add($datajifen);

                    }
                }
                $retdata['status']=1;
                $retdata['info']="签到成功";
                $retdata['day']=$signday['signday'];//签到天数
                echo json_encode($retdata);exit();



            }
    }

}
