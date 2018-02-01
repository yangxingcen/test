<?php
namespace Shop\Controller;
use Think\Controller;

/*底部 购物指南 支付配送 常见问题等所有*/

class HelpController extends PublicController {

    /*-------购物指南-------*/

    /*用户注册*/
    public function userRegistration(){
        $this->assign('header_bot', '1');
        $arr['classid']=50;
        $arr['status']=1;
        $arr['display']=1;
        $m=M('content');
        $result=$m->where($arr)->find();
        $this->assign('result',$result);
        $this->display();
    }

    /*订购流程*/
    public function orderFlow (){
        $this->assign('header_bot', '1');
        $arr['classid']=51;
        $arr['status']=1;
        $arr['display']=1;
        $m=M('content');
        $result=$m->where($arr)->find();
        $this->assign('result',$result);
        $this->display();
    }

    /*会员制度*/
    public function vipSystem (){
        $this->assign('header_bot', '1');
        $arr['classid']=52;
        $arr['status']=1;
        $arr['display']=1;
        $m=M('content');
        $result=$m->where($arr)->find();
        $this->assign('result',$result);
        $this->display();
    }
    /*-------购物条款-------*/
    //隐私保护政策
    public function help_13(){
        $this->assign('header_bot', '1');
        $arr['classid']=53;
        $arr['status']=1;
        $arr['display']=1;
        $m=M('content');
        $result=$m->where($arr)->find();
        $this->assign('result',$result);
        $this->display();
    }
    //会员注册协议
    public function help_14(){
        $this->assign('header_bot', '1');
        $arr['classid']=54;
        $arr['status']=1;
        $arr['display']=1;
        $m=M('content');
        $result=$m->where($arr)->select();
        $this->assign('result',$result);
        $this->display();
    }
    //商城使用条款
    public function help_15(){
        $this->assign('header_bot', '1');
        $arr['classid']=55;
        $arr['status']=1;
        $arr['display']=1;
        $m=M('content');
        $result=$m->where($arr)->select();
        $this->assign('result',$result);
        $this->display();
    }




    /*-------支付/配送-------*/

    /*付款方式*/
    public function help_12(){
        $this->assign('header_bot', '1');
		
		$fkfs = M('content')->where(array('classid'=>60,'status'=>1))->order('sort asc')->select();
		
		$this->assign('fkfs',$fkfs);
		
        $this->display();
    }

    /*配送方式*/
    public function help_11(){
        $this->assign('header_bot', '1');

		$psfs = M('content')->where(array('classid'=>61,'status'=>1))->find();
		
		$this->assign('psfs',$psfs);		
		
        $this->display();
    }

    /*验货签收*/
    public function help_9(){
        $this->assign('header_bot', '1');

		$yhqs = M('content')->where(array('classid'=>62,'status'=>1))->find();
		
		$this->assign('yhqs',$yhqs);			
		
        $this->display();
    }

    /*配送问题*/
    public function help_10(){
        $this->assign('header_bot', '1');

		$pswt = M('content')->where(array('classid'=>63,'status'=>1))->order('sort asc')->select();
		
		$this->assign('pswt',$pswt);		
		
        $this->display();
    }

    /*配送范围*/
    public function help_18(){
        $this->assign('header_bot', '1');
		
		$psfw = M('content')->where(array('classid'=>64,'status'=>1))->find();
		
		$this->assign('psfw',$psfw);
		
        $this->display();
    }

    /*-------常见问题-------*/

    /*服务政策*/
    public function help_7(){
        $this->assign('header_bot', '1');
		
		$fwzc = M('content')->where(array('classid'=>65,'status'=>1))->order('sort asc')->select();
		
		$this->assign('fwzc',$fwzc);
		
        $this->display();
    }

    /*退货流程*/
    public function help_1(){
        $this->assign('header_bot', '1');

		$thlc = M('content')->where(array('classid'=>66,'status'=>1))->order('sort asc')->select();
		
		$this->assign('thlc',$thlc);	
		
        $this->display();
    }

    /*退款说明*/
    public function help_3(){
        $this->assign('header_bot', '1');

		$tksm = M('content')->where(array('classid'=>67,'status'=>1))->order('sort asc')->select();
		
		$this->assign('tksm',$tksm);			
		
        $this->display();
    }

    /*顾客必读*/
    public function help_4(){
        $this->assign('header_bot', '1');

		$gkbd = M('content')->where(array('classid'=>68,'status'=>1))->order('sort asc')->select();
		
		$this->assign('gkbd',$gkbd);		
		
        $this->display();
    }

    /*积分奖励计划*/
    public function help_2(){
        $this->assign('header_bot', '1');
		
		$jfjl = M('content')->where(array('classid'=>69,'status'=>1))->order('sort asc')->select();
		
		$this->assign('jfjl',$jfjl);
		
        $this->display();
    }

}
?>