<?php
namespace Shop\Controller;
use Think\Controller;

/*产品中心*/

class ProductController extends PublicController {
    public function index(){
        $this->logs('查看产品中心');
        $this->assign('header_bot', '1');
        $this->display();
    }
}
?>