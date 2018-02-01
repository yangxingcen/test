<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 下午 16:45
 */

namespace Admin\Controller;


class LogsController extends AdminCommonController
{
    public function index()
    {
        $get = I('get.');
        $whe = [];
        if($get['account']){
            $whe['account'] = array('like',"%".$get['account']."%");
        }
        if($get['id']){
            $whe['id'] = $get['id'];
        }

        $count = M('admin_log')->where($whe)->count();
        $Page  = getpage($count,15);
        $show  = $Page->show();
        $list = M('admin_log')->where($whe)->order('add_time desc')->limit($Page->firstRow, $Page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('cache',$list);
        $this->display();
    }

    public function user_log()
    {
        $get = I('get.');
        $whe = [];
        if($get['telephone']){
            $whe['telephone'] = array('like',"%".$get['telephone']."%");
        }
        if($get['id']){
            $whe['id'] = $get['id'];
        }

        $count = M('user_log')->where($whe)->count();
        $Page  = getpage($count,15);
        $show  = $Page->show();
        $list = M('user_log')->where($whe)->order('add_time desc')->limit($Page->firstRow, $Page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('cache',$list);
        $this->display();
    }

}