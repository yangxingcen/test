<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 下午 16:45
 */

namespace Admin\Controller;


class DealerController extends AdminCommonController
{
    /**
     * 经销商列表
     */
    public function index()
    {
        $whe = ['is_del' => 0];

        $dealer_search = I('dealer_search');
        if($dealer_search){
            $whe['card|name|telephone'] = array('like',"%{$dealer_search}%");
        }

        $province = I('s_province');
        if($province){
            $whe['province'] = $province;
        }

        $city = I('s_city');
        if($city){
            $whe['city'] = $city;
        }

        $county = I('s_county');
        if($county){
            $whe['county'] = $county;
        }

        $list = M('dealer')->where($whe)->select();

        $this->logs('查看经销商列表');
        $this->assign('count',count($list));
        $this->assign('cache',$list);
        $this->display();
    }

    public function do_dealer()
    {
        if(IS_POST){
            $post = I('post.');
            if($post['type']){
                //修改
                if(!$post['edit_id']){
                    ajaxReturn(1,'网络出错');
                    return false;
                }
                if(!$post['edit_name']){
                    ajaxReturn(1,'经销商姓名不能为空');
                    return false;
                }
                if(!$post['edit_telephone']){
                    ajaxReturn(1,'经销商手机不能为空');
                    return false;
                }
                if(!$post['edit_province']){
                    ajaxReturn(1,'经销商地区不能为空');
                    return false;
                }
                $data = [
                    'name' => $post['edit_name'],
                    'telephone' => $post['edit_telephone'],
                    'province' => $post['edit_province'],
                    'city' => $post['edit_city'],
                    'county' => $post['edit_county'],
                    'status' => $post['edit_status'],
                    'update_time' => date('Y-m-d H:i:s')
                ];
                try{
                    $this->logs('修改经销商 '.$post['edit_name']);
                    $res = M('dealer')->where(['id'=>$post['edit_id']])->save($data);
                }catch (\Exception $e){
                    ajaxReturn(1,$post['edit_name'].' 经销商已经存在');
                }
            }else{
                //新增
                if(!$post['card']){
                    ajaxReturn(1,'经销商编号不能为空');
                    return false;
                }
                if(!$post['name']){
                    ajaxReturn(1,'经销商姓名不能为空');
                    return false;
                }
                if(!$post['telephone']){
                    ajaxReturn(1,'经销商手机不能为空');
                    return false;
                }
                if(!$post['province']){
                    ajaxReturn(1,'经销商地区不能为空');
                    return false;
                }
                $data = [
                    'card' => $post['card'],
                    'name' => $post['name'],
                    'telephone' => $post['telephone'],
                    'province' => $post['province'],
                    'city' => $post['city'],
                    'county' => $post['county'],
                    'add_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s')
                ];
                try{
                    $this->logs('新增经销商 '.$post['name']);
                    $res = M('dealer')->add($data);
                }catch (\Exception $e){
                    ajaxReturn(1,'经销商姓名或编号已存在');
                }
            }
            if($res){
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(1,'失败');
            }
        }
    }

    public function del_dealer()
    {
        if(IS_POST){
            $post = I('post.');
            if(!$post['id']){
                return false;
            }
            if($post['type']){
                //批量删除
                $ids = substr($post['id'],0,strlen($post['id'])-1);
                $whe = [
                    'id' => ['in',$ids]
                ];
                $res = M("dealer")->where($whe)->save(['is_del'=>1]);
                $this->logs('批量删除经销商 id为: '.$ids);
            }else{
                //单个删除
                $res = $this->logs('删除经销商 id为: '.$post['id']);
                M('dealer')->where(['id'=>$post['id']])->save(['is_del'=>1]);
            }
            if($res){
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(1,'失败');
            }
        }
    }



}