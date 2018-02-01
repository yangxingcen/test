<?php
namespace Shop\Controller;
use Think\Controller;
/*关于我们*/
class AboutController extends PublicController {
    /*关于我们*/
    public function index(){
        $this->assign('header_bot', '1');
		
		/*关于我们*/
		$gywm = M('content')->where(array('classid'=>41,'status'=>1))->find();
		
		$this->assign('gywm',$gywm);
		
		$fwlc = M('content')->where(array('classid'=>42,'status'=>1))->find();
		
		$this->assign('fwlc',$fwlc);
		
		$zxbz = M('content')->where(array('classid'=>43,'status'=>1))->find();
		
		$this->assign('zxbz',$zxbz);

		$cjwt = M('content')->where(array('classid'=>44,'status'=>1))->find();
		
		$this->assign('cjwt',$cjwt);		
		
        $this->display();
    }
}
?>