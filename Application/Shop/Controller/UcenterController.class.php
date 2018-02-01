<?php
namespace Shop\Controller;

use Think\Controller;

class UcenterController extends PublicController
{

    public function _initialize()
    {
        parent::_initialize();
        $this->checkLogin();
//        $count = M("systemMessage")->where(array("user_id" => $this->user_id, "isdel" => 0, "islooked" => 0))->count();
//        $this->assign("count", $count);
        $this->assign("userinfo", $this->user_info);
        $this->assign("urlname", ACTION_NAME);

    }

    // 以下是用户中心
    /**
     * 个人中心首页
     */
    public function index()
    {
        $this->logs('查看个人中心首页');
        $this->user_info['birth'] = substr($this->user_info['birth'], 0, 10);
        $this->assign("userinfo", $this->user_info)->display();

    }

    /**
     *  收货地址
     */
    public function address()
    {
        $this->logs('查看收货地址');
        $addmodel = D('address');
        //根据user_id查找出对应的地址信息
        $info = $addmodel->where(array('userid' => $this->user_id))->order('isdefault DESC, id desc')->select();
        /*剩余可添加的地址数量*/
        $address_num = 10 - count($info);
        $this->assign('info', $info);
        $this->assign('address_num', $address_num);
        $this->display();
    }

    //添加收货地址
    public function addAddress()
    {
        if (IS_AJAX) {
            $this->logs('添加收货地址');
            $id = I("post.id", 0, "intval");
            $data['telephone'] = I("post.telephone");
            $data['city'] = I("post.city");
            $arr[] = explode('/', $data['city']);
            $data['province'] = $arr[0][0];
            $data['city'] = $arr[0][1];
            $data['district'] = $arr[0][2];
            $data['place'] = I("post.place");
            $data['consignee'] = I("post.consignee");
            $data['userid'] = $this->user_id;
            $data['default'] = I('post.default');
            $data['update_at'] = date("Y-m-d h:i:s");
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
                $res = M("address")->where(array("id" => $id, "userid" => $data['userid']))->save($data);
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

    //编辑收货地址
    public function editAddress()
    {
        $this->logs('编辑收货地址');
        $id = $_GET['id'] + 0;
        $addmodel = D('address');
        $info1 = $addmodel->where(array('id' => $id, 'user_id' => $this->user_id))->find();
        $this->assign('info1', $info1);
    }

    //删除收货地址
    public function delAddress()
    {
        if (IS_AJAX) {
            $id = I("post.id", 0, "intval");
            $res = M('address')->where(array('id' => $id, 'user_id' => $this->user_id))->delete();
            if ($res) {
                $this->logs('删除收货地址');
                $this->ajaxReturn(array("info" => '删除成功！', "status" => 1));
            } else {
                $this->ajaxReturn(array("info" => '删除失败！', "status" => 0));
            }
        }
    }

    /**
     *  修改密码
     */
    public function editPwd()
    {
        if (IS_AJAX) {
            $data['nowpassword'] = I('post.nowpassword', 0, "md5");
            $data['newpassword'] = I('post.newpassword');
            if (!preg_match("/.{6,20}/", $data['newpassword'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "新密码格式错误"));
            }
            $res = M('member')->where(array('password' => $data['nowpassword'], 'user_id' => $this->user_id))->find();
            if ($res) {
                //当前密码与数据库密码一致,更新新密码
                $result = M('member')->where(array("id" => $this->user_id))->setField('password', md5($data['newpassword']));
                if ($result) {
                    $this->ajaxReturn(array("status" => 1, "info" => "修改成功！"));
                } else {
                    $this->ajaxReturn(array("status" => 0, "info" => "修改失败！"));
                }
            } else {
                $this->ajaxReturn(array("status" => 0, "info" => "当前密码错误！"));
            }
        }
        $this->display();
    }


    /**
     * 登出模块
     */
    public function logout()
    {
        $this->logs('退出登陆');
        session("user_id", null);
        $this->redirect("Home/User/login");
        die;
    }

    /**
     * 我的订单
     */
    public function myOrderList(){
        $status = I('get.status', '', 'intval');
        $o_m   = M("order_info");
        $o_g_m = M("order_goods");
    
        if($status) {
           $map['order_status'] = $status;
            $this->assign('status', $status);
        } elseif($status === 0) {
            $map['order_status'] = $status;
        } else {
           $map['order_status'] = array('lt', '7');
        }
        $map['user_id'] = $this->user_id;
        $map['is_del'] = 0;
        $count = $o_m->where($map)->count();
        $p     = getPage($count, 10);
        $order = $o_m->where($map)->order("order_time desc")->
        field("id, order_no, order_status, pay_status, total_fee, pay_price, consignee, order_time, order_status")->
        limit($p->firstRow, $p->listRows)->select();
        foreach($order as $k=>$v){
            $order[$k]['data'] = $o_g_m->where(array("user_id"=>$this->user_id,"order_id"=>$v['id']))->select();
            $order[$k]['count'] = count($order[$k]['data']);
            switch ($v['order_status']){
                case 0 : $order[$k]['status'] = '已取消';
                    break;
                case 1 :
                    $order[$k]['status'] = '待付款';
                    break;
                case 2 : $order[$k]['status'] = '待发货';
                    break;
                case 3 : $order[$k]['status'] = '已发货';
                    break;
                case 4 : $order[$k]['status'] = '已完成';
                    break;
                case 5 : $order[$k]['status'] = '已关闭';
                    break;
                case 6 : $order[$k]['status'] = '退款中';
                    break;
            }
            $order[$k]['order_time'] = date('Y-m-d H:i:s', $v['order_time']);

        }
        $this->assign("cache", $order)->assign("page",$p->show())->display();
    }

    /**
     * 订单详情
     */
    public function orderDetail(){
        $id = I("id", 0, "intval");
        if(!$id){
            $this->error("没有这个订单！");
        }
        $cache['order'] = M("order_info")->where(array("id"=>$id, "user_id"=>$this->user_id))->find();
        if(!$cache['order']){
            $this->error("没有这个订单！");
        }
        switch ($cache['order']['order_status']){
            case 0 : $cache['order']['status'] = '已取消';
                break;
            case 1 :
                $cache['order']['status'] = '待付款';
                break;
            case 2 : $cache['order']['status'] = '待发货';
                break;
            case 3 : $cache['order']['status'] = '已发货';
                break;
            case 4 : $cache['order']['status'] = '已完成';
                break;
            case 5 : $cache['order']['status'] = '已关闭';
                break;
            case 6 : $cache['order']['status'] = '退款中';
                break;
        }
        $cache['order']['order_time'] = date('Y-m-d H:i:s', $cache['order']['order_time']);
        $cache['goods'] = M("order_goods")->where(array("order_id"=>$id, "user_id"=>$this->user_id))->select();
        $cache['order']['count'] = count($cache['goods']);
        $express = json_decode(get_express_info($cache['order']['express_name'], $cache['order']['express_no']),true);
        $this->assign("express", $express['Traces']);
        //订单信息中的快递编码转换成公司名称
        $cache['order']['express_name'] = M("express")->where(array("express_ma"=>$cache['order']['express_name']))->getField("express_company");
        //dump($cache);
        $this->assign('info', $cache)->display();
    }

    /**
     * 退款/退货
     */
    public function refundOrder(){
        if(IS_AJAX){
            $id = I("post.id");
            $m = M("orderInfo");
            $map = array("user_id"=>$this->user_id,"id"=>$id);
            $order_res = $m->where($map)->find();
            if(!$order_res){
                $this->ajaxReturn(array("status"=>0, "info"=>"无效的订单！"));
            }
            if(!in_array($order_res['order_status'],array(2,3))){
                $this->ajaxReturn(array("status"=>0, "info"=>"订单不可退款！"));
            }
            $res = $m->where($map)->save(array("order_status"=>6));
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"申请退款成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"申请退款失败！"));
            }
        }
        $this->error("非法访问！");
    }


    /**
     * 我的购物车
     */
    public function myCart()
    {
        $this->logs('我的购物车页面');
        $this->display();
    }

    /**
     * 我的收藏
     */
    public function collections()
    {
        /*普通商品*/
        $info = M('collection')->alias("a")->join("tb_goods b on a.goods_id=b.id")->where(array('a.user_id' => $this->user_id, 'a.status' => 1, 'a.type'=>'1'))->field('a.*,b.logo_pic,b.goods_name,b.price, b.type, b.id as goods_id')->select();
        /*限时*/
        $info_time = M('collection')->alias("a")->join("tb_goods_market b on a.goods_id=b.id")->where(array('a.user_id' => $this->user_id, 'a.status' => 1, 'a.type'=>'3'))->field('a.*,b.logo_pic,b.goods_name,b.price, b.isactivity, b.id as goods_id')->select();
        /*套餐*/
        $info_meal = M('collection')->alias("a")->join("tb_goods b on a.goods_id=b.id")->where(array('a.user_id' => $this->user_id, 'a.status' => 1, 'a.type'=>'2'))->field('a.*,b.logo_pic,b.goods_name,b.price, b.type, b.id as goods_id')->select();
        if($info_time) {
            foreach($info_time as $key=>$val) {
                $info[] = $val;
            }
        }
        if($info_meal) {
            foreach($info_meal as $key=>$val) {
                $info[] = $val;
            }
        }
        foreach($info as $key=>$val) {
            if($val['type'] == '1') {
                $info[$key]['goods_type'] = '普通商品';
            } else if($val['type'] == '2') {
                $info[$key]['goods_type'] = '套餐商品';
            } if($val['isactivity'] == '1') {
                $info[$key]['goods_type'] = '限时特惠';
            }
        }
        $this->assign('info', $info);
        $this->display();
    }

    //移除收藏
    public function delCollections()
    {
        if(IS_AJAX){
            $id = I('get.id');
            $type = I('get.type');
            $goods_id = I('get.goods_id');
            if($type == '1'){
                $model = M('goods');
                $where = array(
                    'id' => $goods_id,
                    'type' => '1',
                );
            } else if($type == '2') {
                $model = M('goods');
                $where = array(
                    'id' => $goods_id,
                    'type' => '2',
                );
            } else if($type == '3') {
                $model = M('goods_market');
                $where = array(
                    'id' => $goods_id,
                    'isactivity' => '1  ',
                );
            }
            $res = M('collection')->where(array("id"=>$id,'user_id'=>$this->user_id))->setField("status",0);
            if($res !==false ){
                $model->where($where)->setDec('collection_num',1);
                $this->ajaxReturn(array("status"=>1));
            }else{
                $this->ajaxReturn(array("status"=>0 ,"info"=>"移除收藏失败！"));
            }
        }
    }

    /**
     * 我的消息
     */
    public function myMessage()
    {
        $this->logs('我的消息页面');
        $this->display();
    }

    /**
     * 删除我的消息
     */
    public function delSysMessage()
    {

    }

    /**
     * 显示未评价的商品
     */
    public function myEvaluate()
    {   

        $this->display();
    }


    /**
     * 浏览记录
     */
    public function myVisited()
    {

        $this->display();
    }


    /**
     * 我的评价记录
     */
    public function myEvaluateDetail()
    {
        $this->display();
    }

    /**
     * 评价
     */
    public function saveComment(){
        $order_id=I("get.order_id");
        $type=I("get.type");
        $info = discuss($type,$order_id);
        // echo "<pre>";
        // print_r($info);
        $this->assign('info',$info);
        $this->display();
    }
    //确认评价商品
    public function ok_discuss(){
        $discuss_content = I('post.discuss_content');
        $discuss_pic = I('post.discuss_pic');
        $id = I("post.id");
        $uo_order_info = array(
            'discuss_content' => $discuss_content,
            'discuss_pic' => $discuss_pic,
            'discuss_time' => date("Y-m-d h:i:s"),
            "discuss_type" => 1
        );
        $res = M("integral_order_info")->where('id="'.$id.'"')->save($uo_order_info);
        // echo M("integral_order_info")->_sql();

        if($res){
            $this->ajaxReturn(array("status" => 1, "info" => "操作成功！"));
        }else{
            $this->ajaxReturn(array("status" => 0, "info" => "系统繁忙,请稍后再试！"));
        }
        // echo $id."-".$discuss_content."-".$discuss_pic;
    }
    //确认评价订单
    public function discuss_order(){
        $startone = I('post.startone');
        $startone1 = I('post.startone1');
        $startone2 = I('post.startone2');
        $startone3 = I('post.startone3');
        $content = I('post.content');
        $id = I("post.id");
        $goods_id = M("integral_order_info")->where('order_id="'.$id.'"')->getField('id');
        switch ($startone) {
            case '5':
                $startone = 1;
            break;
            case '4':
                $startone = 2;
            break;
            case '3':
                $startone = 3;
            break;
            case '2':
                $startone = 4;
            break;
            case '1':
                $startone1 = 5;
            break;
            default:
                $startone = 5;
            break;
        }
        switch ($startone1) {
            case '5':
                $startone1 = 1;
            break;
            case '4':
                $startone1 = 2;
            break;
            case '3':
                $startone1 = 3;
            break;
            case '2':
                $startone1 = 4;
            break;
            case '1':
                $startone1 = 5;
            break;
            default:
                $startone1 = 5;
            break;
        }
        switch ($startone2) {
            case '5':
                $startone2 = 1;
            break;
            case '4':
                $startone2 = 2;
            break;
            case '3':
                $startone2 = 3;
            break;
            case '2':
                $startone2 = 4;
            break;
            case '1':
                $startone1 = 5;
            break;
            default:
                $startone2 = 5;
            break;
        }
        switch ($startone3) {
            case '5':
                $startone3 = 1;
            break;
            case '4':
                $startone3 = 2;
            break;
            case '3':
                $startone3 = 3;
            break;
            case '2':
                $startone3 = 4;
            break;
            case '1':
                $startone1 = 5;
            break;
            default:
                $startone3 = 5;
            break;
        }
        $up_order = array(
            'update_time_p' => date("Y-m-d h:i:s"),
            'content' => $content,
            'startone' => $startone,
            'startone1' => $startone1,
            'startone2' => $startone2,
            'startone3' => $startone3,
            'status' => 4
        );
        $uo_order_info = array(
            'discuss_content' => '非常完美',
            'discuss_time' => date("Y-m-d h:i:s"),
            "discuss_type" => 1
        );
        $res = M("integral_order")->where('id="'.$goods_id.'"')->save($up_order);
        $res1 = M("integral_order_info")->where('id="'.$id.'"')->save($uo_order_info);
        if($res){
            $this->ajaxReturn(array("status" => 1, "info" => "操作成功！"));
        }else{
            $this->ajaxReturn(array("status" => 0, "info" => "系统繁忙,请稍后再试！"));
        }
    }
    /**
     * 我的推广
     * url+二维码
     */
    public function myExtend()
    {
        $this->display();
    }


    /**
     * 我的推广二维码
     */
    public function qrcode(){

    }

    /**
     * 我的积分
     */
    public function credits(){
        $this->logs('查看我的积分');
        $user_id = $this->user_id;
        $integral_info = M("integral_status")->where("is_del=0 and user_id='".$user_id."'")->select();
        // echo "<pre>";
        $integral = M("member")->where("isdel=0 and status=0 and id='".$user_id."'")->field("integral")->select();
        $integral = $integral[0]['integral'];
        // print_r($integral_info);
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
                case '7':
                    $v['action_name'] = '下单';
                break;
                default:
                    $v['action_name'] = '退款';
                break;
            }
           
        }
        $this->assign("integral_info",$integral_info);
        $this->assign("integral",$integral);

        $this->display();
    }

    /**
     * 赚积分
     */
    public function addCredits(){
        $this->display();
    }


    /**
     * 积分兑换记录
     */
    public function conversionRecord(){
        $status = I("get.status");
        $where = '';
        if($status){
            $where .= " and o.status = '".$status."'";
            $this->assign('status',$status);
        }
        $user_id=$this->user_id;
        $order_list = M("integral_order")->alias('o')->join("tb_integral_order_info as oi on oi.order_id = o.id")->where("o.is_del=0 and oi.is_del=0 and o.user_id='".$user_id."'".$where)->field("o.id,o.order_id,o.add_time,o.status,oi.goods_name,oi.goods_logo,oi.num,oi.price")->order("status desc,o.add_time desc")->select();
        foreach ($order_list as &$v) {
            switch ($v['status']) {
                case '1':
                    $v['status_name'] = '待发货';
                break;
                case '2':
                    $v['status_name'] = '待收货';
                break;
                case '3':
                    $v['status_name'] = '待评价';
                break;
                case '4':
                    $v['status_name'] = '已完成';
                break;
                case '5':
                    $v['status_name'] = '申请退积分';
                break;
                default:
                    $v['status_name'] = '退积分完成';
                break;   
            }
        }
        // echo "<pre>";
        // print_r($order_list);
        $this->assign("order_list",$order_list);
        $this->display();
    }
    // 积分详情
    public function user_inner(){
        $order_id=I("get.order_id");
        if($order_id){
            $order_info = M("integral_order_info")->alias('oi')->join("tb_integral_order as o on oi.order_id = o.id")->where("o.is_del=0 and oi.is_del=0 and oi.order_id = '".$order_id."'")->field("o.add_time,o.telephone,o.consignee,o.address,o.order_id,oi.price_num,oi.goods_name,oi.goods_logo,oi.price,oi.num,o.status,oi.sku_info,o.startone,o.startone1,o.startone2,o.startone3,o.content,o.update_time_p,o.express_ma,o.express_no")->select();
        }
        switch ($order_info[0]['status']) {
                case '1':
                    $order_info[0]['status_name'] = '待发货';
                break;
                case '2':
                    $order_info[0]['status_name'] = '待收货';
                break;
                case '3':
                    $order_info[0]['status_name'] = '待评价';
                break;
                case '4':
                    $order_info[0]['status_name'] = '已完成';
                break;
                default:
                    $order_info[0]['status_name'] = '退款';
                break;   
            }
        // echo "<pre>";
        // print_r($order_info);
        if($order_info[0]['status'] > 1 && $order_info[0]['status'] <5){
            $express = get_express_message($order_info[0]['express_ma'],$order_info[0]['express_no']);  //第三方物流查询api
            // echo "<pre>";
            // print_r($express);
            $this->assign("express",$express[1]);
        }
        $this->assign("order_info",$order_info[0]);
        $this->display();
    }
    /**
     * 优惠券
     */
    public function coupon(){
        $this->display();
    }

    /**
     * 邀请好友
     */
    public function inviteFriends(){
        $this->display();
    }

    /**
     * 我的分享
     */
    public function myShare(){
        $this->display();
    }

    /**
     * 我的交易记录
     */
    public function myTradingRecord(){
        $this->display();
    }

    /**
     * 佣金记录
     */
    public function commissionRecord(){
        $this->display();
    }


    // 以下是基础信息
    /**
     * 个人资料
     */
    public function myInfo(){

//        $this->user_info['birth'] = substr($this->user_info['birth'], 0, 10);

        //$this->assign("userinfo", $this->user_info)->display();
        /*查出该用户积分*/
        $user_id = $this->user_id;
        $userinfo = M('member')->where(array('id'=>$user_id))->find();
        /*等级*/
        $grade = M('member_vip')->where(array('id' => $userinfo['grade']))->field('vip_name')->find();
        $this->assign('grade', $grade);
        $this->assign('userinfo', $userinfo);
        $this->display();
    }

    /**
     * 修改个人资料
     */
    public function editInfo()
    {
        if (IS_AJAX) {
            $data['person_name'] = I("post.person_name");
            $data['sex'] = I("post.sex");
            $data['realname'] = I("post.realname");
            $data['birth'] = I("post.birth");
            $data['email'] = I("post.email");
            $data['QQ'] = I("post.QQ");
            $data['wx_number'] = I("post.wx_number");
            $data['weibo'] = I("post.weibo");
            $data['telephone'] = I("post.telephone");
            $data['IDcard'] = I("post.IDcard");
            $data['address'] = I("post.address");
            //$data['email']    = I("post.email");
            // 验证格式
            if ($data['birth'] && !preg_match("/^(19|20)\d{2}-(1[0-2]|0?[1-9])-(0?[1-9]|[1-2][0-9]|3[0-1])$/", $data['birth'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "生日格式错误！"));
            }
			if($data['email'] && !preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $data['email'])){
				$this->ajaxReturn(array("status"=>0 ,"info"=>"邮箱格式错误！"));
			}
            if($data['IDcard'] && !preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/", $data['IDcard'])){
                $this->ajaxReturn(array("status"=>0 ,"info"=>"身份证格式错误！"));
            }
            if($data['QQ'] && !preg_match("/[1-9][0-9]{4,14}/", $data['QQ'])){
                $this->ajaxReturn(array("status"=>0 ,"info"=>"QQ号格式错误！"));
            }
            $res = M("member")->where(array("id" => $this->user_id))->save($data);/*$this->user_id*/
            if ($res !== false) {
                $this->logs('修改个人资料 成功');
                $this->ajaxReturn(array("status" => 1, "info" => "修改成功！"));
            } else {
                $this->ajaxReturn(array("status" => 0, "info" => "修改失败！"));
            }
        }
    }

    /**
     * 我的银行卡
     */
    public function myBankCard()
    {
        $this->logs('查看我的银行卡');
        $res = M("bank_list")->where(array("user_id" => $this->user_id))->order("create_at desc")->select();
        $this->assign("cache", $res)->display();
    }

    /**
     * 修改银行卡
     */
    public function saveBank()
    {
        if (IS_AJAX) {
            $m = M("bank_list");
            $id = I("post.id");
            $data['bank_no'] = I("post.bank_no");
            $data['bank_name'] = I("post.bank_name");
            $data['bank_branch'] = I("post.bank_branch");
            $data['username'] = I("post.username");
            $data['telephone'] = I("post.telephone");
            $data['create_at'] = time();
            if (!preg_match("/^(\d{16}|\d{19})$/", $data['bank_no'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "银行卡号格式错误！"));
            }
            if (empty($data['bank_name'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写银行名称！"));
            }
            if (empty($data['bank_branch'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写开户支行名称！"));
            }
            if (empty($data['username'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写户名！"));
            }
            if (!preg_match("/^1[356789][0-9]{9}$/", $data['telephone'])) {
                $this->ajaxReturn(array("status" => 0, "info" => "请填写正确的手机号！"));
            }
            if ($id) {
                $res = $m->where(array("id" => $id, "user_id" => $this->user_id))->save($data);/*$this->user_id*/
            } else {
                $data['user_id'] = $this->user_id;/*$this->user_id*/
                $res = $m->add($data);
            }
            if ($res) {
                $this->logs('修改我的银行卡');
                $this->ajaxReturn(array("status" => 1, "info" => $id ? "修改成功！" : "添加成功！"));
            } else {
                $this->ajaxReturn(array("status" => 1, "info" => $id ? "修改失败！" : "添加失败！"));
            }
        }
    }

    /**
     * 删除银行卡
     */
    public function delBank()
    {
        if (IS_AJAX) {
            $m = M("bank_list");
            $id = I("post.id");
            $res = $m->where(array('id' => $id, "user_id" => $this->user_id))->delete();/*$this->>user_id*/
            if ($res) {
                $this->logs('删除银行卡');
                $this->ajaxReturn(array("status" => 1, "info" => "删除成功！"));
            } else {
                $this->ajaxReturn(array("status" => 0, "info" => "删除失败！"));
            }
        }
    }

    /**
     * 我的增值发票税
     */
    public function ValueAddedInvoices()
    {
        //添加增值发票税
        if(IS_AJAX){
            $id 					= I("post.id", 0,"intval");
            $data['phone'] 			= I("post.phone");
            $data['company']      	= I("post.company");
            $data['invoice_title']  = I("post.invoice_title");
            $data['address'] 		= I("post.address");
            $data['bank']   		= I('post.bank');
            $data['bank_account']   = I('post.bank_account');
            $data['user_id']   		= $this->user_id;
            foreach($data as $v){
                if(empty($v)){
                    $this->ajaxReturn(array("status"=>0, "info"=>"请将信息填写完整！"));
                }
            }
            if($id){
                $res = M("receipt")->where(array('id'=>$id,"user_id"=>$this->user_id))->save($data);
            }else{
                $res = M("receipt")->add($data);
            }
            if($res){
                $this->ajaxReturn(array("status"=>1 ,"info"=>$id?"修改成功！":"添加成功！","id"=>$res));
            }else{
                $this->ajaxReturn(array("status"=>0 ,"info"=>$id?"修改失败！":"添加失败！"));
            }
        }
        //展示增值发票税
        $model = M('receipt');
        $data = $model->select();
        $this->assign('data',$data);
        $this->display();
    }
    //删除增值发票税
    public function delValueAddTax(){
        if(IS_AJAX){
            $id = I('get.id');
            $res = M('receipt')->where(array("id"=>$id,'user_id'=>$this->user_id))->delete();
            if($res){
                $this->ajaxReturn(array("status"=>1 ,"info"=>"删除成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0 ,"info"=>"删除失败！"));
            }
        }
    }
    /**
     * 提现
     */
    public function takeMoney()
    {
        $userid = $this->user_id;
        $res = M("member")->where(array("id"=>$this->user_id))->select();
        //$banks = M("bank_list")->where(array("user_id"=>$this->user_id))->order("create_at desc")->select();
        //dump($res);die;
        $this->
        assign("res",$res)->
        //assign("banks",$banks)->
        display();
    }

    /**
     * 申请提现
     */
    public function applyTakeMoney()
    {
        $user = $this->user_id;
        $m = M('member');
        if(IS_AJAX){
            $userinfo = $this->user_info;
            $bankid   = I("post.bankid");
            $money    = floatval(I("post.money"));
            if($money<=0){
                $this->ajaxReturn(array('status'=>0 ,"info"=>"请输入正确的提取金额！"));
            }
            $m_m = M("member");
            $t_m = M("takemoney_log");
            if(!$money){
                $this->ajaxReturn(array('status'=>0 ,"info"=>"请输入正确的提取金额！"));
            }
            if($money>$userinfo['wallet']){
                $this->ajaxReturn(array('status'=>0 ,"info"=>"您的账号余额不足！"));
            }
            $bank = M("bank_list")->where(array('user_id'=>$this->user_id,"id"=>$bankid))->find();
            //dump($bank);die;
            if(!$bank){
                $this->ajaxReturn(array('status'=>0 ,"info"=>"请选择正确的银行卡！"));
            }
            unset($bank['id']);
            unset($bank['create_at']);
            $data = $bank;
            $data['create_at'] = time();
            $data['money']     = $money;
            $m_m->startTrans();
            $t_m->startTrans();
            $res = $m_m->where(array('id'=>$this->user_id))->setDec("wallet", $money);
            if($res){
                $res1 = $t_m->add($data);
                if($res1){
                    $m_m->commit();
                    $t_m->commit();
                    $this->ajaxReturn(array('status'=>1 ,"info"=>"申请提现成功，请耐心等待！"));
                }else{
                    $m_m->rollback();
                    $t_m->rollback();
                    $this->ajaxReturn(array('status'=>0 ,"info"=>"申请提现失败！"));
                }
            }else{
                $m_m->rollback();
                $this->ajaxReturn(array('status'=>0 ,"info"=>"申请提现失败！"));
            }
        }
        $res = M("takemoney_log")->where(array("user_id"=>$this->user_id))->order("deal_at desc, create_at desc")->select();
        $banks = M("bank_list")->where(array("user_id"=>$this->user_id))->order("create_at desc")->select();
        //dump($banks);die;
        $this->
        assign("cache",$res)->
        assign("banks",$banks)->
        display();
    }

    /**
     * 修改密码
     */
    public function changePass()
    {
        $this->display();
    }

    /**
     * 账号安全1
     */
    public function accountSecurity()
    {
        $this->display();
    }


    /*
        上传base64
    */
    public function upload_base64()
    {
        import('@.ORG.Image.ThinkImage');
        $return = array('flag' => 0, 'msg' => '', 'img' => '');
        if (empty($this->user_id)) {
            $return['msg'] = '登录超时，请重新登录！';
            echo json_encode($return);
            exit();
        }
        $dir = "./Uploads/image/headimg";

        $rand = substr(time(), -4);
        $image_name = $this->user_id . '_' . $rand . ".jpg";


        $img_str = $_POST['img_str'];
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
        //var_dump($thumb);exit;
        $img = new \ThinkImage(THINKIMAGE_GD, $img_source);

        $img->thumb(100, 100, THINKIMAGE_THUMB_FIXED)->save($thumb);
        //保存数据库
        M('member')->where(array('id' => $this->user_id))->save(array('person_img' => trim($thumb, ".")));
        //echo M()->_sql();exit;
        echo json_encode($return);
        exit;
    }
    //确认收货
    public function ok_shou(){
        if(IS_AJAX){
            $id=I("post.id");
            $up_order = array(
                'status' => 3,
                'update_time_s' => date("Y-m-d h:i:s")
            );
            if($id){
                $res = M("integral_order")->where('id="'.$id.'"')->save($up_order);
                if($res){
                    $this->ajaxReturn(array("status" => 1, "info" => "操作成功！"));
                }else{
                    $this->ajaxReturn(array("status" => 0, "info" => "系统繁忙,请稍候再试！"));
                }
            }else{
                $this->ajaxReturn(array("status" => 0, "info" => "订单不存在！"));
            }
        }else{
            $this->ajaxReturn(array("status" => 0, "info" => "系统繁忙,请稍候再试！"));
        }
    }
}