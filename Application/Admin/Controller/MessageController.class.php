<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 下午 16:45
 */

namespace Admin\Controller;


class MessageController extends AdminCommonController
{
    /**
     * 短信模板
     */
    public function template()
    {
        if(IS_POST){
            $post = I('post.');
            if($post['edit_id']){
                $res = M('sms_template')->where(['id'=>$post['edit_id']])->save(['msg'=>$post['sms']]);
                if($res){
                    $this->logs('编辑短信模板');
                    ajaxReturn(1,'成功');
                }else{
                    ajaxReturn(1,'失败');
                }
            }
        }
        $this->logs('查看短信模板');
        $sms = M('sms_template')->select();
        $this->assign('cache',$sms);
        $this->display();
    }

    public function note()
    {
        if(IS_POST){
            $post = I('post.');
            if($post['edit_id']){
                $res = M('sms_template')->where(['id'=>$post['edit_id']])->save(['msg'=>$post['sms']]);
                if($res){
                    $this->logs('编辑短信模板');
                    ajaxReturn(1,'成功');
                }else{
                    ajaxReturn(1,'失败');
                }
            }
        }

        $count = M('user_verify')->count();
        $Page  = getpage($count,10);
        $show  = $Page->show();
        $this->logs('查看消息列表');
        $sms = M('user_verify')->limit($Page->firstRow, $Page->listRows)->select();

        $this->assign('page',$show);
        $this->assign('cache',$sms);
        $this->display();
    }
}