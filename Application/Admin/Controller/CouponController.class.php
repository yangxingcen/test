<?php
namespace Admin\Controller;
class CouponController extends AdminCommonController
{

    /**
     * 优惠券列表
     */
    public function index()
    {
        $m = M("coupon");
        $title = I("title");
        if ($title) {
            $map['couponid'] = array("couponid", "{$title}");
            $map['couponname'] = array("couponname", "{$title}");
            $map['isdel'] = array("isdel", "1");
        }
        if (!empty($map)) {
            $m->where($map);
        }
        $res = $m->where(['isdel' => 0])->select();
        //dump($res);die;
        $this->assign("title", $title);
        $this->assign("res", $res);
        $this->display();

    }

    /**
     * 增加优惠券
     */
    public function addcoupon()
    {
        if (IS_POST) {
            $data = I("POST.");
            $sorts = I("post.sorts");
            $title = I("post.title");
            $timelimit = I("post.timelimit");
            $usefactor = I("post.usefactor");
            if ($usefactor == 0) {
                $timedays = I("post.timedays");
                $starttime = time();
                $endtime = time()+(60*60*24*$timedays);
            } else {
                $starttime = strtotime(I("post.starttime"));
                $endtime = strtotime(I("post.endtime"));
            }
            //dump($usefactor);die;
            $deduct = I("post.deduct");
            $total = I("post.total");
            $gettype = I("post.gettype");
            $limitgoodcatetype = I("post.limitgoodcatetype");
            $limitgoodtype = I("post.limitgoodtype");
            $m = M("coupon");
            $data['sorts'] = $sorts;
            $data['couponid'] = VIP.uniqid();
            //dump($data['couponid']);die;
            $data['title'] = $title;
            $data['gettype'] = $gettype;
            $data['deduct'] = $deduct;
            $data['timelimit'] = $timelimit;
            $data['usefactor'] = $usefactor;
            $data['timedays'] = $timedays;
            $data['starttime'] = $starttime;
            $data['endtime'] = $endtime;
            //dump($starttime);die;
            $data['limitgoodcatetype'] = $limitgoodcatetype;
            $res = $m->add($data);
            if ($res) {
                $this->success('添加成功', "/Admin/Coupon/index", 3);
            } else {
                $this->error('添加失败');
            }
        } else {
            $res = D('goodsCate')->field('id,classname')->where(['pid'=>0])->select();
            $this->assign('cityAll',$res);
            $this->display();
        }
    }

    /**
     *
     */
    public function coupondel()
    {
        //$this->logs('启用/禁用/删除 优惠券列表');
        if (IS_POST) {
            $id = I("post.id", '', 'intval');
            $invoice_type = I("post.invoice_type", '', 'intval');
            $item = I("post.item", '', 'trim');
            $info = D('coupon')->where(['id' => $id])->find();
            //dump($info);die;
            if ($info) {
                switch ($item) {
                    case 'status':
                        $res = D('coupon')->where(array('id' => $id))->setField('status', 1 - $info['status']);
                        //dump($res);die;
                        $res = D('coupon')->where(array('id' => $id))->setField('status', 1 - $info['status']);
                        $res = 1;
                        $t = '更新';
                        break;

                    case 'is_del':
                        $res = D('coupon')->where(array('id' => $id))->setField('isdel', 1);
                        $res = D('coupon')->where(array('id' => $id))->setField('isdel', 1);
                        $res = 1;
                        $t = '删除';
                        break;
                    default:
                        ajaxReturn(0, '未知错误');
                        break;
                }
                if ($res != false) {
                    ajaxReturn(1, $t . '成功');
                } else {
                    ajaxReturn(0, $t . '失败');
                }
            }
        }
        ajaxReturn(0, '未知错误');
    }

    /**
     * 选择商品库商品添加至营销活动
     * */
    public function goodsSubmit()
    {
        if (IS_POST) {
            $goods_ids = I('post.goods_ids');
            $type = I('post.type');
            //$goods_id = ltrim($goods_ids,',');
            $goods_id = array_filter(explode(',', $goods_ids));
            $coupon_id = array_filter(explode(',', $goods_ids));
            //dump($goods_ids);die;
            if ($type == 'shop') {
                foreach ($goods_id as $k => $v) {
                    $info = M('goods')->find($v);
                    $data = ['is_cuxiao' => 1];
                    $res = D('goods')->where(['id' => $info['id']])->save($data);
                    if ($res !== false) {
                        ajaxReturn(1, '成功添加');
                    } else {
                        ajaxReturn(0, '添加商品失败');
                    }
                }
                ajaxReturn(0, '添加失败');
            }
        }
    }

    /**
     * 修改优惠券
     */
    public function editcoupon(){
        if(IS_POST){
            $data = I("POST.");
            //dump($data);
            $sorts = I("post.sorts");
            $title = I("post.title");
            $timelimit = I("post.timelimit");
            $usefactor = I("post.usefactor");
            if ($usefactor == 0) {
                $timedays = I("post.timedays");
            } else {
                $starttime = time(I("post.starttime"));
                $endtime = time(I("post.endtime"));
            }
            //dump($usefactor);die;
            $deduct = I("post.deduct");
            $total = I("post.total");
            $gettype = I("post.gettype");
            $limitgoodcatetype = I("post.limitgoodcatetype");
            $limitgoodtype = I("post.limitgoodtype");
            $m = M("coupon");
            $data['sorts'] = $sorts;
            $data['id'] = I('post.id');
            $data['title'] = $title;
            $data['gettype'] = $gettype;
            $data['deduct'] = $deduct;
            $data['timelimit'] = $timelimit;
            $data['usefactor'] = $usefactor;
            $data['timedays'] = $timedays;
            $data['starttime'] = $starttime;
            $data['endtime'] = $endtime;
            $data['limitgoodcatetype'] = $limitgoodcatetype;
            $res = D('coupon')->save($data);
            if($res !==false){
                $this->success('修改成功','/Admin/Coupon/index');
            }else{
                $this->error('修改失败');
            }
        }else{
            $id = I('get.id');
            if(!is_numeric($id)){
                $this->error('参数非法');
            }
            $res = D('coupon')->where(['id'=>$id])->find();
            $starttime = date('Y-m-d H:i:s',$res['starttime']);
            $endtime = date('Y-m-d H:i:s',$res['endtime']);
            //dump($endtime);die;
            $this->assign('res',$res);
            $this->assign('starttime',$starttime);
            $this->assign('endtime',$endtime);
            $res = D('goodsCate')->field('id,classname')->where(['pid'=>0])->select();
            $this->assign('cityAll',$res);
            $this->display();
        }
    }
}