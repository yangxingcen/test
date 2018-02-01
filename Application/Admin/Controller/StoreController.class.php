<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 下午 16:45
 */

namespace Admin\Controller;


class StoreController extends AdminCommonController
{
    /**
     * 门店列表
     */
    public function index()
    {
        $whe = ['is_show' => 1];
        $store_name = I('store_name');
        if($store_name){
            $whe['storename'] = array("like","%$store_name%");
        }
        $list = M('store')->where($whe)->select();

        $this->logs('查看门店列表');
        $this->assign('count',count($list));
        $this->assign('cache',$list);
        $this->display();
    }


    // 增加门店
    public function addStore(){
        if(IS_POST){
            unset($_POST["id"]);
            $m = M("store");
            // 上传图片
            $data = I("post.");
            $res = $m->add($data);
            if($res){
                $this->logs('添加新门店: '.$data['storename']);
                $this->success('添加成功',U('/Admin/Store/index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    // 修改门店
    public function editstore(){
        $id = I("id");
        if(IS_POST){
            $m = M("store");
            // 上传图片
            $data = I("post.");
            $data["addtime"] = Gettime();
            $res = $m->where(array("id"=>$id))->save($data);
            if($res){
                $this->logs('编辑门店成功');
                $this->success('编辑成功',U('/Admin/Store/index',array('id'=>$id)));
            }else{
                $this->success('编辑失败');
            }
        }else{
            $this->logs('编辑门店页面: '.I('name'));
            $cache = M("store")->where(array("id"=>$id,"isdel"=>0))->find();
            $this->assign("title","修改门店");
            $this->assign("cache",$cache);
            $this->assign("comptype",0);
            $this->assign('com',5);
            $this->display();
        }
    }

    // 删除专卖店
    public function delStore(){
        $post = I('post.');
        if(isset($post['type']) && 'some' == $post['type']){
            //批量删除
            $ids = substr($post['id'],0,strlen($post['id'])-1);
            M("store")->delete($ids);
            $this->logs('批量删除门店 id为: '.$ids);
            $result = array(
                'status'=>1,
                'info'=>'删除成功'
            );
            echo json_encode($result);exit;
        }else{
            $get = I('get.');
            //error_log("\r\n".date('Y-m-d H:i:s').'【'.__LINE__.'】 : '.print_r($post,true),3,'E:/WWW/1.log');
            $res = M("store")->where(array("id"=>$get['id']))->delete();
            if($res){
                $this->logs('删除门店: '.$get['name']);
                $this->success('删除成功',U('/Admin/Store/index'));exit;
            }else{
                $this->error('删除失败');
            }
        }

    }

}