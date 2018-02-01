<?php
namespace Wx\Model;
use Think\Model;
class ActivityConfigModel extends Model
{
    public $user_info    = "";
    public function _initialize(){

        $sess_uid=  session('wx_user_id');
        if($sess_uid){
            $user_in= M('member')->where('id='.$sess_uid)->find();
            $this->user_info=$user_in;
        }



    }
    /*
* 大转盘抽奖
*  $idata['type']=1; 刮刮乐
*  $idata['type']=2; 砸金蛋
*  $idata['type']=3; 大转盘
*/
    public  function dazhuanpan_chou(){

        $prize_arr=M('activity_config')->where('id=3')->find();
        $add_days=$prize_arr['add_days'];//优惠券有效天数
        //判断活动是否开始
        if(strtotime($prize_arr['start_time'])>time()){
            $data['status']='error';
            $data['html']='活动还未开始';
            echo json_encode($data);
            die();
        }    //判断活动是否结束
        if(strtotime($prize_arr['end_time'])<time()){
            $data['status']='error';
            $data['html']='活动已结束';
            echo json_encode($data);
            die();
        }

        $chounum=$prize_arr['num'];//抽奖次数
        //抽奖活动参与次数
        $nian=date('Ymd',time());
        $zou=M('activity_lottery')->where("uid=".$this->user_info['id']."  and type=3  and date_format(from_unixtime(addtime),'%Y%m%d')=$nian")->count();
        if($zou >= $chounum){

            $data['status']='error';
            $data['html']='很遗憾,每天只能抽奖'.$chounum.'次/人';
            echo json_encode($data);
            die();
        }
        //更新积分  插入抽奖记录
        if($this->user_info['integral']>=$prize_arr['integral']){
            M('member')->where('id='.$this->user_info['id'])->setDec('integral',$prize_arr['integral']);
            $user_in= M('member')->where('id='.$this->user_info['id'])->find();
            $log['user_id']=$this->user_info['id'];
            $log['action']=10;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
            $log['integral']=$prize_arr['integral'];//消费多少积分
            $log['integral_befor']=$this->user_info['integral'];//用户当前积分
            $log['integral_after']=$user_in['integral'];//使用后的积分
            $log['s_type']=2;//花销积分 2
            $log['goods_id']=null;//大转盘 3
            $log['goods_name']='大转盘抽奖积分-'.$prize_arr['integral'].'积分';
            $log['addtime']=time();
            M('integral_status')->add($log);
        }else{
            $data['status']='error_er';
            $data['html']='很遗憾积分不足,当前积分'.$this->user_info['integral'];
            echo json_encode($data);
            die();
        }


        $prize_arr=unserialize($prize_arr['prize_config']);//抽奖奖品
        foreach ($prize_arr as $key => $val) {
            $arr[$val['jiang_id']] = $val['percent'];
        }
        $rid = $this->get_rand($arr); //根据概率获取奖项id

        $prize_find='';
        foreach ($prize_arr  as $k=>$v){

            if($v['jiang_id']==$rid){
                $prize_find['type']=$v['type'];
                $prize_find['jiang_id']=$v['jiang_id'];
                $prize_find['param']=$v['param'];
            }
        }

        switch ($prize_find['type'])
        {
            case 1://优惠券
                $idata['type']=3;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']=$prize_find['param'].'元优惠券';
                $idata['prize_type']=1;
                $idata['status']=1;//0 未领取,1已领取
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);

                $data['msg']='砸中'.$prize_find['param'].'元优惠券';
                $data['status']='success';
                $data['item']=$prize_find['jiang_id']+1;

                //start 插入中奖记录日志
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=10;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='大转盘中'.$prize_find['param'].'元优惠券';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录

                //start 录入优惠券到用户表 表 coupon_data
                $log_coupan['member_id']=$this->user_info['id'];
                $log_coupan['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log_coupan['memory']=$prize_find['param']; //优惠券金额
                $log_coupan['title']=$prize_find['param'].'优惠券'; //优惠券名称
                $dainq=strtotime("+".$add_days."day",time());//优惠券有效时间 add_days
                $log_coupan['end_valid']=date('Y-m-d H:i:s',$dainq); //优惠券有效时间 add_days
                $log_coupan['create_at']=date('Y-m-d H:i:s',time()); //领取时间
                M('coupon_data')->add($log_coupan);
                //end 录入优惠券到用户表 表 coupon_data
                echo json_encode($data);

                break;

            case 2://积分
                $idata['type']=3;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']=$prize_find['param'].'积分';
                $idata['prize_type']=2;
                $idata['status']=1;//0 未领取,1已领取
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);//录入奖品信息
                //start 插入积分记录
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=10;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='大转盘中'.$prize_find['param'].'积分';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录
                //更新用户积分
                M('member')->where('id='.$this->user_info['id'])->setInc('integral',$prize_find['param']);

                $data['msg']='砸中'.$prize_find['param'].'积分';
                $data['status']='success';
                $data['item']=$prize_find['jiang_id']+1;
                echo json_encode($data);
                die();
                break;
            case 3://积分商品

                $info= M('integral_goods')->where("id=".$prize_find['param'])->find();
                $data['msg']=$info['goods_name'];
                $idata['type']=3; //活动类型
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']=$info['goods_name'];
                $idata['goods_pic']=$info['logo_pic'];
                $idata['prize_type']=3;
                $idata['status']=1;//0 未领取,1已领取
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);//抽奖信息插入数据库

                $data['item']=$prize_find['jiang_id']+1;
                $data['id']=$pr_id;
                $data['case_status']=3;
                $data['status']='success';
                //start 插入中奖记录日志
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=10;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='大转盘中-'.$info['goods_name'];
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录
                echo json_encode($data);
                die();
                break;

            default://很遗憾
                $idata['type']=3;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']='很遗憾没有中奖';
                $idata['prize_type']=4;
                $idata['status']=1;//0 未领取,1已领取
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);
                $data['item']=$prize_find['jiang_id']+1;
                $data['case_status']=4;
                $data['status']='success';

                //start 插入中奖记录日志
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=10;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='很遗憾没有中奖';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录

                echo json_encode($data);
        }
    }

    /*
* 砸金蛋抽奖
*  $idata['type']=1; 刮刮乐
*  $idata['type']=2; 砸金蛋
*  $idata['type']=3; 大转盘
*/

    public function zajindan_chou(){
        $prize_arr=M('activity_config')->where('id=2')->find();
        $chounum=$prize_arr['num'];//抽奖次数
        $add_days=$prize_arr['add_days'];//优惠券有效天数
        if(I('post.id')==2){
            //判断活动是否开始
            if(strtotime($prize_arr['start_time'])>time()){
                $data['status']='error_er';
                $data['html']='活动还未开始';
                echo json_encode($data);
                die();
            }    //判断活动是否结束
            if(strtotime($prize_arr['end_time'])<time()){
                $data['status']='error_er';
                $data['html']='活动已结束';
                echo json_encode($data);
                die();
            }
            //抽奖活动参与次数
            $nian=date('Ymd',time());
            $zou=M('activity_lottery')->where("uid=".$this->user_info['id']." and type=2  and date_format(from_unixtime(addtime),'%Y%m%d')=$nian")->count();
            if($zou >= $chounum){
                $data['status']='error_er';
                $data['html']='很遗憾每天只能抽奖'.$chounum.'次/人';
                echo json_encode($data);
                die();
            }
            //更新积分  插入抽奖记录
            if($this->user_info['integral']>=$prize_arr['integral']){
                M('member')->where('id='.$this->user_info['id'])->setDec('integral',$prize_arr['integral']);
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']=$prize_arr['integral'];//消费多少积分
                $log['integral_befor']=$this->user_info['integral'];//用户当前积分
                $log['integral_after']=$user_in['integral'];//使用后的积分
                $log['s_type']=2;
                $log['goods_id']=null;
                $log['goods_name']='砸金蛋抽奖-'.$prize_arr['integral'].'积分';
                $log['addtime']=time();
                M('integral_status')->add($log);
            }else{
                $data['status']='error_er';
                $data['html']='很遗憾积分不足,当前积分'.$this->user_info['integral'];
                echo json_encode($data);
                die();
            }
        }

        $prize_arr=unserialize($prize_arr['prize_config']);//奖品反序列化
        foreach ($prize_arr as $key => $val) {
            $arr[$val['jiang_id']] = $val['percent'];
        }
        $rid = $this->get_rand($arr); //根据概率获取奖项id
        $prize_find='';
        foreach ($prize_arr  as $k=>$v){

            if($v['jiang_id']==$rid){

                $prize_find['type']=$v['type'];

                $prize_find['jiang_id']=$v['jiang_id'];
                $prize_find['param']=$v['param'];
            }
        }
        switch ($prize_find['type'])
        {
            case 1://优惠券
                $idata['type']=2;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']=$prize_find['param'].'元优惠券';
                $idata['prize_type']=1;
                $idata['status']=1;//0 未领取,1已领取
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);
                $data['msg']='砸中'.$prize_find['param'].'元优惠券';
                $data['status']='success';
                $data['html']=   '<h5>恭喜您<br/>'.$prize_find['param'].'元优惠券'.'</h5>
			    	<img src="/Public/Wx/Images/zhongjiang_icon1.png" width="40">
			    	    <a href="javascript:;"></a>';

                //start 插入中奖记录日志 表 integral_status
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='砸金蛋砸中'.$prize_find['param'].'优惠券';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录

                //start 录入优惠券到用户表 表 coupon_data
                $log_coupan['member_id']=$this->user_info['id'];
                $log_coupan['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log_coupan['memory']=$prize_find['param']; //优惠券金额
                $log_coupan['title']=$prize_find['param'].'优惠券'; //优惠券名称
                $dainq=strtotime("+".$add_days."day",time());//优惠券有效时间 add_days
                $log_coupan['end_valid']=date('Y-m-d H:i:s',$dainq); //优惠券有效时间 add_days
                $log_coupan['create_at']=date('Y-m-d H:i:s',time()); //领取时间
                M('coupon_data')->add($log_coupan);
                //end 录入优惠券到用户表 表 coupon_data
                echo json_encode($data);
                break;

            case 2://积分
                $idata['type']=2;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']=$prize_find['param'].'积分';
                $idata['prize_type']=2;
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);

                $data['msg']='砸中'.$prize_find['param'].'积分';
                $data['status']='success';
                $data['html']=   '<h5>恭喜您<br/>'.$prize_find['param'].'积分'.'</h5>
			    	<img src="/Public/Wx/Images/zhongjiang_icon1.png" width="40">
			    	<a href="javascript:;"></a>';
                echo json_encode($data);


                //start 插入积分记录
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//砸金蛋 3
                $log['goods_name']='砸金蛋中'.$prize_find['param'].'积分';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录
                //更新用户积分
                M('member')->where('id='.$this->user_info['id'])->setInc('integral',$prize_find['param']);
                die();
                break;
            case 3://积分商品

                $info= M('integral_goods')->where("id=".$prize_find['param'])->find();
                $data['msg']=$info['goods_name'];
                $idata['type']=2;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']=$info['goods_name'];
                $idata['goods_pic']=$info['logo_pic'];
                $idata['prize_type']=3;
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);//抽奖信息插入数据库

                $data['html']=   '<h5>恭喜您<br/>'.$info['goods_name'].''.'</h5>
			    	<img src="/Public/Wx/Images/zhongjiang_icon1.png" width="40">
			    	<a href="/Wx/Games/infor/id/'.$pr_id.'">请填写物流信息</a>';
                $data['status']='success';

                //start 插入中奖记录日志
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='砸金蛋砸中-'.$info['goods_name'].'积分商品';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录
                echo json_encode($data);
                die();
                break;

            default://很遗憾

                $idata['type']=2;
                $idata['uid']=$this->user_info['id'];
                $idata['goods_name']='很遗憾'.'<br/>'.'您没有砸中奖品';
                $idata['prize_type']=4;
                $idata['addtime']=time();
                $pr_id= M('activity_lottery')->add($idata);
                $data['msg']='很遗憾'.'<br/>'.'您没有砸中奖品';
                $data['status']='error';

                //start 插入中奖记录日志
                $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                $log['user_id']=$this->user_info['id'];
                $log['action']=9;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                $log['integral']='';//消费多少积分
                $log['integral_befor']=$user_in['integral'];//用户当前积分
                $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                $log['s_type']=1;//花销积分 2
                $log['goods_id']=null;//大转盘 3
                $log['goods_name']='砸金蛋砸中-'.'很遗憾没有砸中奖品';
                $log['addtime']=time();
                M('integral_status')->add($log);
                //end 插入积分记录

                echo json_encode($data);
        }

    }
    /*
     * 刮刮乐抽奖
     * $leixingid
     */
    public  function  guaguale_chou(){


       $leixingid=I('post.id');
       $type_in=I('post.jiang_id');//中奖id


       //查询配置信息
        $prize_arr=M('activity_config')->where('id=1')->find();
       // 1获得中奖信息   2 插数据库
       if($leixingid==1){

           $prize_arr=unserialize($prize_arr['prize_config']);//抽奖奖品
           foreach ($prize_arr as $key => $val) {
               $arr[$val['jiang_id']] = $val['percent'];
           }
           $rid = $this->get_rand($arr); //根据概率获取奖项id

           $prize_find='';
           foreach ($prize_arr  as $k=>$v){

               if($v['jiang_id']==$rid){
                   $prize_find['type']=$v['type'];
                   $prize_find['jiang_id']=$v['jiang_id'];
                   $prize_find['param']=$v['param'];
               }
           }
           $data['status']='success';
           $data['jiang_id']=$prize_find['jiang_id'];//中奖id
//           $data['item']=$prize_find['jiang_id']+1;
           echo json_encode($data);
       }
       elseif($leixingid==2){

           $add_days=$prize_arr['add_days'];//优惠券有效天数
           //判断活动是否开始
           if(strtotime($prize_arr['start_time'])>time()){
               $data['status']='error';
               $data['html']='活动还未开始';
               echo json_encode($data);
               die();
           }    //判断活动是否结束
           if(strtotime($prize_arr['end_time'])<time()){
               $data['status']='error';
               $data['html']='活动已结束';
               echo json_encode($data);
               die();
           }

           $chounum=$prize_arr['num'];//抽奖次数
           //抽奖活动参与次数
           $nian=date('Ymd',time());
           $zou=M('activity_lottery')->where("uid=".$this->user_info['id']."  and type=1  and date_format(from_unixtime(addtime),'%Y%m%d')=$nian")->count();

           if($zou >= $chounum){

               $data['status']='error';
               $data['html']='很遗憾,每天只能刮奖'.$chounum.'次/人';
               echo json_encode($data);
               die();
           }
           //更新积分  插入抽奖记录
           if($this->user_info['integral']>=$prize_arr['integral']){
               M('member')->where('id='.$this->user_info['id'])->setDec('integral',$prize_arr['integral']);
               $user_in= M('member')->where('id='.$this->user_info['id'])->find();
               $log['user_id']=$this->user_info['id'];
               $log['action']=11;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
               $log['integral']=$prize_arr['integral'];//消费多少积分
               $log['integral_befor']=$this->user_info['integral'];//用户当前积分
               $log['integral_after']=$user_in['integral'];//使用后的积分
               $log['s_type']=2;//花销积分 2
               $log['goods_id']=null;//大转盘 3
               $log['goods_name']='刮刮乐抽奖积分-'.$prize_arr['integral'].'积分';
               $log['addtime']=time();
               M('integral_status')->add($log);
           }else{
               $data['status']='error_er';
               $data['html']='很遗憾积分不足,当前积分'.$this->user_info['integral'];
               echo json_encode($data);
               die();
           }
           $prize_arr=unserialize($prize_arr['prize_config']);//抽奖奖品
           $prize_find='';
           foreach ($prize_arr  as $k=>$v){

               if($v['jiang_id']==$type_in){
                   $prize_find['type']=$v['type'];
                   $prize_find['jiang_id']=$v['jiang_id'];
                   $prize_find['param']=$v['param'];
               }
           }


           switch ($prize_find['type'])
           {
               case 1://优惠券
                   $idata['type']=1;//抽奖类型:1刮刮乐,2砸金蛋,3大转盘
                   $idata['uid']=$this->user_info['id'];
                   $idata['goods_name']=$prize_find['param'].'元优惠券';
                   $idata['prize_type']=1;//中奖类型:1优惠券,2积分,3积分商品,4未中奖
                   $idata['status']=1;//0 未领取,1已领取
                   $idata['addtime']=time();
                   $pr_id= M('activity_lottery')->add($idata);

                   $data['msg']='刮中'.$prize_find['param'].'元优惠券';
                   $data['status']='success';
                   $data['item']=$prize_find['jiang_id']+1;

                   //start 插入中奖记录日志
                   $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                   $log['user_id']=$this->user_info['id'];
                   $log['action']=11;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                   $log['integral']='';//消费多少积分
                   $log['integral_befor']=$user_in['integral'];//用户当前积分
                   $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                   $log['s_type']=1;//花销积分 2
                   $log['goods_id']=null;//大转盘 3
                   $log['goods_name']='刮刮乐中'.$prize_find['param'].'元优惠券';
                   $log['addtime']=time();
                   M('integral_status')->add($log);
                   //end 插入积分记录

                   //start 录入优惠券到用户表 表 coupon_data
                   $log_coupan['member_id']=$this->user_info['id'];
                   $log_coupan['action']=11;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                   $log_coupan['memory']=$prize_find['param']; //优惠券金额
                   $log_coupan['title']=$prize_find['param'].'优惠券'; //优惠券名称
                   $dainq=strtotime("+".$add_days."day",time());//优惠券有效时间 add_days
                   $log_coupan['end_valid']=date('Y-m-d H:i:s',$dainq); //优惠券有效时间 add_days
                   $log_coupan['create_at']=date('Y-m-d H:i:s',time()); //领取时间
                   M('coupon_data')->add($log_coupan);
                   //end 录入优惠券到用户表 表 coupon_data
                   echo json_encode($data);

                   break;

               case 2://积分
                   $idata['type']=1;//抽奖类型:1刮刮乐,2砸金蛋,3大转盘
                   $idata['uid']=$this->user_info['id'];
                   $idata['goods_name']=$prize_find['param'].'积分';
                   $idata['prize_type']=2;
                   $idata['status']=1;//0 未领取,1已领取
                   $idata['addtime']=time();
                   $pr_id= M('activity_lottery')->add($idata);//录入奖品信息
                   //start 插入积分记录
                   $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                   $log['user_id']=$this->user_info['id'];
                   $log['action']=11;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                   $log['integral']='';//消费多少积分
                   $log['integral_befor']=$user_in['integral'];//用户当前积分
                   $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                   $log['s_type']=1;//花销积分 2
                   $log['goods_id']=null;//大转盘 3
                   $log['goods_name']='刮刮乐中'.$prize_find['param'].'积分';
                   $log['addtime']=time();
                   M('integral_status')->add($log);
                   //end 插入积分记录
                   //更新用户积分
                   M('member')->where('id='.$this->user_info['id'])->setInc('integral',$prize_find['param']);

                   $data['msg']='刮中'.$prize_find['param'].'积分';
                   $data['status']='success';
                   $data['item']=$prize_find['jiang_id']+1;
                   echo json_encode($data);
                   die();
                   break;
               case 3://积分商品

                   $info= M('integral_goods')->where("id=".$prize_find['param'])->find();
                   $data['msg']=$info['goods_name'];
                   $idata['type']=1; //抽奖类型:1刮刮乐,2砸金蛋,3大转盘
                   $idata['uid']=$this->user_info['id'];
                   $idata['goods_name']=$info['goods_name'];
                   $idata['goods_pic']=$info['logo_pic'];
                   $idata['prize_type']=3;
                   $idata['status']=0;//0 未领取,1已领取
                   $idata['addtime']=time();
                   $pr_id= M('activity_lottery')->add($idata);//抽奖信息插入数据库

                   $data['item']=$prize_find['jiang_id']+1;
                   $data['id']=$pr_id;
                   $data['case_status']=3;
                   $data['status']='success';
                   //start 插入中奖记录日志
                   $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                   $log['user_id']=$this->user_info['id'];
                   $log['action']=11;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                   $log['integral']='';//消费多少积分
                   $log['integral_befor']=$user_in['integral'];//用户当前积分
                   $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                   $log['s_type']=1;//花销积分 2
                   $log['goods_id']=null;//大转盘 3
                   $log['goods_name']='刮中-'.$info['goods_name'];
                   $log['addtime']=time();
                   M('integral_status')->add($log);
                   //end 插入积分记录
                   echo json_encode($data);
                   die();
                   break;

               default://很遗憾
                   $idata['type']=1;
                   $idata['uid']=$this->user_info['id'];
                   $idata['goods_name']='很遗憾没有中奖';
                   $idata['prize_type']=4;
                   $idata['status']=1;//0 未领取,1已领取
                   $idata['addtime']=time();
                   $pr_id= M('activity_lottery')->add($idata);
                   $data['item']=$prize_find['jiang_id']+1;
                   $data['case_status']=4;
                   $data['status']='success';

                   //start 插入中奖记录日志
                   $user_in= M('member')->where('id='.$this->user_info['id'])->find();
                   $log['user_id']=$this->user_info['id'];
                   $log['action']=11;//抽奖状态 ,9砸金蛋,10大转盘,11刮刮乐)
                   $log['integral']='';//消费多少积分
                   $log['integral_befor']=$user_in['integral'];//用户当前积分
                   $log['integral_after']=$prize_find['param']+$user_in['integral'];//使用后的积分
                   $log['s_type']=1;//花销积分 2
                   $log['goods_id']=null;//大转盘 3
                   $log['goods_name']='很遗憾没有中奖';
                   $log['addtime']=time();
                   M('integral_status')->add($log);
                   //end 插入积分记录

                   echo json_encode($data);
           }
       }





    }

    //计算中奖概率
    function get_rand($proArr) {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }



}

?>