<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class MemberController extends AdminCommonController
{

    public function index()
    {
        $this->logs('查看会员列表');
        list($count,$lists,$show)=D('member')->getMemberList();
        $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('cache',$lists);
        $this->display();
    }


    public function detail()
    {
        $post = I('post.');

        if($post['id'] && $post['type']){
            $update = [];
            switch ($post['type']){
                case 'edit_person_name':
                    $update = ['person_name'=>$post['person_name']];
                    break;
                case 'edit_sex':
                    $update = ['sex' => $post['sex']];
                    break;
                case 'edit_integral':
                    if(!is_numeric($post['edit_integral'])){
                        ajaxReturn(0,'积分操作有误');
                    }
                    if($post['do']){
                        $integral = $post['integral'] + $post['edit_integral'];
                    }else{
                        if($post['edit_integral'] > $post['integral'] ){
                            ajaxReturn(0,'积分操作有误');
                        }
                        $integral = $post['integral'] - $post['edit_integral'];
                    }
                    $update = ['integral' => $integral];
                    break;
                case 'edit_money':
                    if(!is_numeric($post['edit_money'])){
                        ajaxReturn(0,'钱包操作有误');
                    }
                    if($post['do']){
                        $wallet = $post['wallet'] + $post['edit_money'];
                    }else{
                        if($post['edit_money'] > $post['wallet'] ){
                            ajaxReturn(0,'钱包操作有误');
                        }
                        $wallet = $post['wallet'] - $post['edit_money'];
                    }
                    $update = ['wallet' => $wallet];
                    break;
                case 'edit_status':
                    $update = ['status' => $post['status']];
                    break;
                case 'edit_grade':
                    if(!is_numeric($post['grade']) || strpos($post['grade'],".")!==false){
                        ajaxReturn(0,'等级操作有误');
                    }
                    $update = ['grade' => $post['grade']];
                    break;
            }
            $re = M('member')->where(['id'=>$post['id']])->save($update);

            if($re){
                $this->logs('修改会员id:'.$post['id']);
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(1,'失败');
            }
        }
        $this->logs('查看会员详情');
        $get = I('get.');
        $vips = M('member_vip')->where(['is_del'=>0,'status'=>0])->select();

        $whe = [];
        if($get['id']){
            $whe['m.id'] = $get['id'];
        }
        if($get['phone']){
            $whe['m.telephone'] = $get['phone'];
        }

        $info = M("member m")->join("left join tb_member_vip v on v.id=m.grade")->where($whe)->field('m.*,v.vip_name')->select();

        if(!$info){
            $this->error('无此用户');
        }

        $this->assign('vips',$vips);
        $this->assign('memberdetail',$info[0]);
        $this->display();
    }

    public function member_vip()
    {
        $this->logs('查看会员等级');
        $list = M('member_vip')->where('is_del = 0')->select();
        $this->assign('cache',$list);
        $this->display();
    }

    public function do_vip()
    {
        $post = I('post.');
        if($post['type']){
            $res = '';
            switch ($post['type']){
                case 'add_vip':
                    if(!$post['vip'] || !is_numeric($post['num']) || !is_numeric($post['discount'])){
                        ajaxReturn(0,'数据填写有误');
                    }
                    $add = [
                        'vip_name' => $post['vip'],
                        'num' => $post['num'],
                        'discount' => $post['discount'],
                        'status' => $post['status'],
                        'add_time' => date('Y-m-d H:i:s')
                    ];

                    $res = M('member_vip')->add($add);
                    $this->logs('新增会员等级:'.$post['vip']);
                    break;
                case 'edit_vip':
                    if(!$post['edit_vip'] || !is_numeric($post['edit_num']) || !is_numeric($post['edit_discount'])){
                        ajaxReturn(0,'数据填写有误');
                    }
                    $update = [
                        'vip_name' => $post['edit_vip'],
                        'num' => $post['edit_num'],
                        'discount' => $post['edit_discount'],
                        'status' => $post['edit_status']
                    ];
                    $res = M('member_vip')->where(['id' => $post['edit_id']])->save($update);
                    $this->logs('修改会员等级id:'.$post['edit_id']);
                    break;
            }
            if($res!=false){
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(0,'失败');
            }
        }

    }

    /**20171021wzz
     * 会员概述
     * */
    public function summary(){
        $m  =M("member");
        $t1=array(
            '0'=>date("Y-m-d")." 00:00:00",
            '1'=>date("Y-m-d")." 23:59:59",
        );
        $t2=array(
            '0'=>date("Y-m-d",strtotime("-1 day"))." 00:00:00",
            '1'=>date("Y-m-d",strtotime("-1 day"))." 23:59:59",
        );
        $t3=array(
            '0'=>date("Y-m-d",strtotime("-7 day"))." 00:00:00",
            '1'=>date("Y-m-d")." 23:59:59",
        );
        $res['count'] = $m->where(array('isdel'=>0))->count('*');
        $res['count1'] = $m->where(array('isdel'=>0,'add_time'=>array('between',$t1)))->count('*');
        $res['count2'] = $m->where(array('isdel'=>0,'add_time'=>array('between',$t2)))->count('*');
        $res['count3'] = $m->where(array('isdel'=>0,'add_time'=>array('between',$t3)))->count('*');
        $this->logs('查看会员概述');
        $this->assign("cache",$res);
        $this->display();
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    



}