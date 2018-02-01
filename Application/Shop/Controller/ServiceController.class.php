<?php
namespace Shop\Controller;
use Think\Controller;

/*门店服务*/

class ServiceController extends PublicController {
    /*配送方式*/
    public function index(){
        $this->assign('header_bot', '1');
		
		$psfs = M('content')->where(array('classid'=>46,'status'=>1))->find();
		
		$this->assign('psfs',$psfs);
		
		$azlc = M('content')->where(array('classid'=>47,'status'=>1))->find();
		
		$this->assign('azlc',$azlc);	

		$shfw = M('content')->where(array('classid'=>48,'status'=>1))->find();
		
		$this->assign('shfw',$shfw);

		//图片管理--20171218lkg
		
		$propic = M('shop_banner')->where(array('is_del'=>0,'status'=>0,'type'=>24))->find();
		
		$this->assign('propic',$propic);		
		
        $this->display();
    }

    /*安装流程*/
    public function procedure(){
        $this->assign('header_bot', '1');
        $this->display();
    }

    /*售后服务*/
    public function afterSales(){
        $this->assign('header_bot', '1');
        $this->display();
    }
}
?>