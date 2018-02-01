<?php
namespace Common\Model;
use Think\Model;
class GoodsCateModel extends Model
{   //商城商品分类
    public function getCateList($one_cate,$two_cate)
    {
        $where = '';
        if($one_cate && !$two_cate){
            $lists = $this->where('id="'.$one_cate.'"')->selectNext(0);
        }elseif($two_cate && $one_cate){
            $lists = $this->where('id="'.$one_cate.'"')->selectNext(0);
        }else{
            $lists = $this->selectNext(0);
        }
        if($lists){
            foreach($lists As $k=>$v){
                if($two_cate){
                    $lists[$k]['next'] = $this->where("id='".$two_cate."'")->selectNext($one_cate);
                }else{
                    $lists[$k]['next'] = $this->where()->selectNext($v['id']);
                }
                
                if($lists[$k]['next']){
                    foreach($lists[$k]['next'] As $key=>$val){
                        $lists[$k]['next'][$key]['next'] = $this->selectNext($val['id']);
                    }
                }
            }
        }
        return($lists);
    }
    public function cateToJson()
    {
        #三级分类转有效分类
        $map = array(
            'isdel' => 0,
            'status'=> 0,
        );
        $field = 'id,pid,classname';
        $ones = $this->field($field)->where($map)->select();
        if($ones){
            $twos = Array();
            foreach($ones As $k=>$v){
                $twos[$v['pid']][]=$v;
            }
            /* $threes = Array();
            foreach($twos[0] As $k=>$v){
                $threes[$k] = $v;
                $subs = $twos[$v['id']];
                if($subs){
                    foreach($subs As $key=>$val){
                        $subss = $twos[$val['id']];
                        if($subss){
                           $subs[$key]['sub'] = $val;
                        }else{
                           $subs[$key]['sub'] = 0;
                        }
                        $subs[$key]['sub'] = $subss;
                    }
                    $threes[$k]['sub'] = $subs;
                }else{
                    $threes[$k]['sub'] = 0;
                }
                
            } */
            return array("status"=>1,"info"=>$twos);
        }
        return array('status'=>0,"info"=>"没有分类");
    }
    public function selectNext($pid)
    {   #查询下级
        #$field = 'id,pid,type,create_at,classname,level,status,pic,advbanner,sorts,ishot,link_type,param,starttime,endtime';
        $field = 'id,pid,create_at,classname,level,status,pic,sorts,ishot,update_at';
        $map   = array(
            'pid'    => $pid,
            'isdel'  => 0,
            //'status' => 0,
            // 'type'   => 1,
            // 'storeid'=> 1,
        );
        $lists = $this->field($field)->where($map)->order('id DESC')->select();
        // echo $this->_sql();exit;
        if($lists){
            foreach($lists As $k=>$v){
                unset($v['create_at']);
                // $v['starttime']    = $v['starttime'] ? date('Y-m-d H:i:s',$v['starttime']) : '';
                // $v['endtime']      = $v['endtime'] ? date('Y-m-d H:i:s',$v['endtime']) : '';
                $lists[$k]['info'] = json_encode($v);
            }
            return $lists;
        }
        return 0;
    }
    public function addEditDelStatus()
    {   // 添加
        if(!IS_POST){
            return array('status'=>0,'info'=>'访问错误');
        }
        $action = trim(I('post.action'));
        switch($action)
        {   //添加修改
            case 'addEdit':
                $storeid   = trim(I('post.storeid'));
                $id        = trim(I('post.id'));
                $classname = trim(I('post.classname'));
                $pic       = trim(I('post.pic'));
                $advbanner = trim(I('post.advbanner'));
                $sorts     = trim(I('post.sorts'));
                $pid       = trim(I('post.pid'));
                $ishot     = trim(I('post.ishot'));
                // $link_type = trim(I('post.link_type'));
                // $param     = trim(I('post.param'));
                // $starttime = trim(I('post.starttime'));
                // $endtime   = trim(I('post.endtime'));
                if(!$classname){
                    return array('status'=>0,'info'=>'请填写标题');
                }
                if(!$pic){
                    return array('status'=>0,'info'=>'请填上传OGO');
                }
                // if(!$advbanner){
                //     return array('status'=>0,'info'=>'请上传banner');
                // }
                // if($starttime && $endtime){
                //     $starttime = strtotime($starttime);
                //     $endtime   = strtotime($endtime);
                // }else{
                //     return array("status"=>0,"info"=>'请选择时间段');
                // }
                $storeid = $storeid ? : 0;
                $data = array(
                    'classname' => $classname,
                    'sorts'     => $sorts,
                    // 'storeid'   => $storeid,
                    'malltype'  => $malltype,
                    'pid'       => $pid,
                    'pic'       => $pic,
                    // 'advbanner' => $advbanner,
                    'ishot'     => $ishot,
                    // 'link_type' => $link_type,
                    // 'param'     => $param,
                    // 'starttime' => $starttime,
                    // 'endtime'   => $endtime,
                );
                if($id > 0){
                    if($id == $pid){
                        return array('status'=>0,'info'=>'自己不能选择自己');
                    }
                    $retitle = '修改';
                    $data['update_at'] = date("Y-m-d H:i:s",NOW_TIME);
                    $id = $this->where(array('id'=>$id))->save($data);
                }else{
                    $level = 1;
                    if($pid){
                        $level = $this->where(array('id'=>$pid))->getField('level');
                        $level = $level + 1;
                    }
                    if($level > 3){
                        return array('status'=>0,'info'=>'不能再添加下一级了');
                    }else{
                        $data['level'] = $level;
                    }
                    $retitle = '添加';
                    // $data['type']      = 1;
                    $data['pid']       = $pid;
                    $data['create_at'] = date("Y-m-d H:i:s",NOW_TIME);
                    $data['status']    = 0;
                    $id = $this->add($data);
                }
                return $this->returnArr($id,$retitle);
            break;
            case 'Del':
                $id = I('post.id/d',0);
                $id = $this->where(array('id'=>$id))->setField('isdel',1);
                return $this->returnArr($id);
            break;
            case "changeStatus":
                $id  = trim(I('post.id'));
                $res = $this->where("id=$id")->field("id,status")->find();
                if($res){
                    $res['status'] = ($res['status']==1) ? 0 :1;
                    $res2 = $this->save($res);
                    if($res2){
                        $arr = array("显示","隐藏");
                        return array("status" => 1,"info" => '操作成功','text'=>$arr[$res['status']]);
                    }else{
                        return array("status" => 0,"info" => '操作失败');
                    }
                }else{
                    return array("status" => 2,"info" => '没有分类');
                }
            break;
            default:
                return array('status'=>0,'info'=>'访问错误');
            break;
        }
        return array('status'=>0,'info'=>'你真调皮');
    }
    public function returnArr($id,$title='操作')
    {
        if($id === false){
            return array('status'=>0,'info'=>$title.'失败');
        }
        return array('status'=>1,'info'=>$title.'成功');
    }
}
 ?>