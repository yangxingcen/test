<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class SpikegoodsController extends AdminCommonController
{   //秒杀商城
    private $storeid;    //商家id  平台0
    public function _initialize()
    {
        parent::_initialize();
        $this->storeid  = 1;
        $this->assign('storeid',$this->storeid);
    }
    public function index()
    {
        $goods_db   = M('goods_market');
        $map        = array(
            'isactivity' => 1,
        );
        #商品名称
        $name = I('get.name','','trim');
        if($name){
            $map['goods_name'] = array('like','%'.$name.'%');
            $this->assign('name',$name);
        }
        dump($map);
        #商品ID
        $id = I('get.id','','trim');
        if($id){
            $map['id']=$id;
            $this->assign("id",$id);
        }
        $status     = I('get.status','','intval');
        $status=$status?$status:10;
        if($status == 11){
            $map['is_del'] = 0;
            $map['is_sale'] = 1;
        }elseif($status == 14){
            $map['is_del'] = 1;
        }elseif($status == 12){
            $map['is_del'] = 0;
            $map['is_sale'] = 1;
            $map['stock'] = 0;
        }elseif($status == 13){
            $map['is_del'] = 0;
            $map['is_sale'] = 0;
        }
        //特惠商品
        $res10 = $goods_db->count();
        $this->assign('count10',$res10);
        //出售中
        $res11 = $goods_db->where('is_del = 0 and is_sale=1')->select();
        $this->assign('count11',count($res11));
        // 回收站
        $res14 = $goods_db->where('is_del = 1')->select();
        $this->assign('count14',count($res14));
        // 仓库中
        $res13 = $goods_db->where('is_del = 0 and is_sale=0')->select();
        $this->assign('count13',count($res13));
        // 已售馨
        $res12 = $goods_db->where('is_del = 0 and is_sale=1 and stock=0')->select();
        $this->assign('count12',count($res12));
        $this->assign("status",$status);

        #商品名称
        $name = I('get.name','','trim');
        if($name){
            $maps['goods_name'] = array('like','%'.$name.'%');
            $this->assign('name',$name);
        }
        #商品ID
        $id = I('get.id','','trim');
        if($id){
            $maps['id']=$id;
            $this->assign("id",$id);
        }

        list($count,$lists,$show) = $this->lists($map, $goods_db);
        $this->assign('count', $count);
        $this->assign('lists', $lists);
        if($count > 10){
            $this->assign('page', $show);// 赋值分页输出
        }
        $page = I('get.p',1,'intval');
        $this->assign('pag',$page);
        $this->display();
    }
    public function lists($map, $goods_db)
    {
        $count = $goods_db->where($map)->count();
        $Page  = getpage($count, 10);
        $show  = $Page->show();
        $lists = $goods_db->where($map)->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return array($count,$lists,$show);
    }

    #添加修改和商品
    public function addEdit()
    {
        if(IS_POST){
            $res  = D('Goods')->addGoods();
            if ($res['status'] == 0) {
                $this->ajaxReturn(array('status'=>0,'info'=>$res['info']));
            }else{
                $this->ajaxReturn(array('status'=>1,'info'=>$res['info'],'url'=>$res['url']));
            }
            exit;
        }
        $malltype = I('get.malltype',0,'intval');
        $id = I('get.id',0,'trim');
        if($id){
            $info = D('Goods')->goodsInfo(array('id'=>$id), $malltype);
            if(!$info){
                $this->error('商品不存在');
            }
            $cates = array();
            $cates['id'] = $info['cate_id'];
            $cates['name'] = $info['cate_name'];
            $cates['pid'] = $info['cate_pid'];
            $this->assign('cates',$cates);
            $tagidarrList = explode(',',$info['tagid']);
            foreach ($tagidarrList as $k=>$v) {
                $name = M('Goods_tag')->where(array('id'=>$v))->getField('classname');
                $hastaglist[$k]['id']        = $v;
                $hastaglist[$k]['classname'] = $name;
            }
            $this->assign('hastaglist',$hastaglist);
            //商品参数
            $paramlist = unserialize($info['goods_param']);
            if($paramlist){
                foreach ($paramlist as $key =>$value){
                    $paramlist[$key]=explode('-',$value);
                }
            }
            if(!$paramlist){
                $goodsattrs = $this->GoodsTagList($info['id'],$info['tagid']);
                $paramlist  = array();$i=0;
                foreach($goodsattrs As $k=>$v){
                    $paramlist[$i] = array($v['gtagid'],$v['gclassname']);
                    $i++;
                }
            }
            $this->assign('paramlist',$paramlist);
            //获取sku列表信息
            if($info['is_sku']){
                $skulist = M('sku_list_market')->where(array('goods_id'=>$id))->select();
                if($skulist){
                    foreach($skulist As $k=>$v){
                        $skulist[$k]['attr_list'] = rtrim(ltrim(str_replace('-',',',$v['attr_list']),','),',');
                        unset($skulist[$k]['update_at']);
                        unset($skulist[$k]['create_at']);
                        unset($skulist[$k]['code']);
                        unset($skulist[$k]['is_del']);
                        unset($skulist[$k]['goods_id']);
                        unset($skulist[$k]['integral']);
                        unset($skulist[$k]['weight']);
                    }
                    $skulist = json_encode($skulist);
                    $this->assign('skulist',$skulist);                          //dump($skulist);

                    $guigeshuxing = json_decode($info['goods_sku_info'],true);  //dump($guigeshuxing);
                    if(!$guigeshuxing){
                        $goodsskuinfo = unserialize($info['goods_sku_info']);
                        if($goodsskuinfo){
                            $skuinfo    = array();$i=0;
                            $skuattr_db = M('sku_attr');
                            foreach($goodsskuinfo As $k=>$v){
                                if($v){
                                    $skuinfo[$i]['classname']= $v['skuName'];
                                    $skuinfo[$i]['skuid']    = $skuattr_db->where(array('classname'=>$v['skuName'],'pid'=>0))->getField('id');
                                    if($v['data']){
                                        $j=0;
                                        foreach($v['data'] As $key=>$val){
                                            $skuinfo[$i]['subset'][$j]['classname'] = $val['name'];
                                            $skuinfo[$i]['subset'][$j]['skuid']     = $val['sku_id'];
                                            if($j<1){
                                                $skuinfo[$i]['skuid'] = $skuattr_db->where(array('id'=>$val['sku_id']))->getField('pid');
                                            }
                                            $j++;
                                        }
                                    }
                                    $i++;
                                }
                            }
                            $guigeshuxing = $skuinfo;
                        }
                    }
                    $this->assign('guigeshuxing',$guigeshuxing);
                }else{
                    $info['is_sku'] = 0;
                }
            }
            if($info){
                $pic1 = explode(',', $info['pic1']);
                $this->assign('pic1',$pic1);
                $this->assign('info',$info);
            }
            $page = I("get.page",1,'intval');
            $this->assign('page',$page);
        }else{
            $goodsid = I('get.goodsid',0,'trim');
            if($goodsid){
                $info = M('goods')->where(array('id'=>$goodsid))->find();
                if($info){
                    if($info['is_sku']){
                        $skulists = M('sku_list')->where(array('goods_id'=>$goodsid))->select();
                        if($skulists){
                            foreach($skulists As $k=>$v){
                                $skulists[$k]['id'] = 0;
                            }
                            $info['sku_list']       = $skulists;
                        }else{
                            $info['is_sku']         = 0;
                            $info['goods_sku_info'] = '';
                        }
                    }
                    $info = $this->processDetails($info);   #dump($info);
                    $info['pgoodsid'] = $info['id'];
                    $info['id']       = 0;
                    $this->assign('info',$info);
                }
            }else{
                $this->error('请先选择商品');
            }
        }
        //获取分类
        $c = M("shop_goods_cate");
        $categorylist = $c->where(array("pid"=>0, "is_del"=>0))->select();
        foreach($categorylist as $k=>$v){
            $categorylist[$k]['cate'] = $c->where(array('pid'=>$v['id'],'is_del'=>0))->select();
        }
        //秒杀时间场次
        $seckilltimespotstr = M('web_config')->where(array('id'=>1))->getField('seckill_time_spot');
        if($seckilltimespotstr){
            $seckilltimespots = explode('-',rtrim(ltrim($seckilltimespotstr,'-'),'-'));
            if($seckilltimespots){
                $this->assign('seckilltimespots',$seckilltimespots);
            }else{
                $this->error('请先设置秒杀场次',U('/Admin/index/web_config'));
            }
        }else{
            $this->error('请先设置秒杀场次',U('/Admin/index/web_config'));
        }
        $this->assign('catelists',$categorylist);
        $this->assign('seckilltimespots',$seckilltimespots);
        $info['malltype'] = $malltype;
        $this->assign('malltype', $malltype);
        $this->display();
    }
    #添加时查询搜索商品
    public function actionDo(){
        if(IS_POST){
            $action = I('post.action','','trim');
            switch($action){
                case 'add_serch_goods':
                    $keystr     = I('post.goods_keystr','','trim');
                    $isactivity = I('post.goods_isactivity',1,'intval');
                    if($keystr){
                        $this->ajaxReturn($this->searchGoods(6,$keystr,$isactivity));
                    }
                    $this->ajaxReturn(array('status'=>0,'info'=>'请填写搜索关键字'));
                break;
                default:
                    $this->ajaxReturn(array('status'=>0,'info'=>'非法请求'));
                break;
            }
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'非法请求'));
    }

    #根据关键字查询商品  默认全部非营销商品
    public function searchGoods($nums,$keystr='',$isactivity)
    {
        $nums  = $nums ? $nums : 10;
        $field = 'id As Goodsid,goods_name';
        $map   = array(
            'is_del'=>0,
            'is_sale'=>1,
        );
        if($keystr){
            $map['goods_name'] = array('like',"%".$keystr."%");
        }
        $lists = M('goods')->field($field)->where($map)->order('id DESC')->limit($nums)->select();
        if($lists){
            return array('status'=>1,'info'=>$lists);
        }
        return array('status'=>0,'info'=>'没有商品');
    }
    #检索商品
    public function retrieve()
    {   
        if(IS_POST){
            $goodsid = I('post.goodsid',0,'intval');
            $this->ajaxReturn($this->goodsInfo($goodsid));
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'非法请求'));
    }
    #查询商品详情
    public function goodsInfo($goodsid=0)
    {
        if($goodsid){
            $info = M('goods')->where(array('id'=>$goodsid))->find();
            if($info){
                if($info['is_sku']){
                    $skulists = M('sku_list')->where(array('goods_id'=>$goodsid))->select();
                    if($skulists){
                        $info['sku_list']       = $skulists;
                    }else{
                        $info['is_sku']         = 0;
                        $info['goods_sku_info'] = '';
                    }
                }
                $info = $this->processDetails($info);   #dump($info);
                return array('status'=>1,'info'=>$info);
            }
            return array('status'=>0,'info'=>'没有找到商品');
        }
        return array('status'=>0,'info'=>'请求的商品ID错误');
    }
    #处理商品详情
    public function processDetails($info)
    {
        if($info['sku_list']){
            $skulist        = $info['sku_list'];
            foreach($skulist As $k=>$v){
                $skulist[$k]['attr_list'] = rtrim(ltrim(str_replace('-',',',$v['attr_list']),','),',');
                unset($skulist[$k]['update_at']);
                unset($skulist[$k]['create_at']);
                unset($skulist[$k]['bar_code']);
                unset($skulist[$k]['is_del']);
                unset($skulist[$k]['goods_id']);
                unset($skulist[$k]['integral']);
                //unset($skulist[$k]['weight']);
            }
            $info['sku_list'] = json_encode($skulist);
            $info['guigeshuxing']     = $info['goods_sku_info'];  //dump($guigeshuxing);

            if(!$info['guigeshuxing']){
                $goodsskuinfo = unserialize($info['goods_sku_info']);
                if($goodsskuinfo){
                    $skuinfo    = array();$i=0;
                    $skuattr_db = M('sku_attr');
                    foreach($goodsskuinfo As $k=>$v){
                        if($v){
                            $skuinfo[$i]['classname']= $v['classname'];
                            $skuinfo[$i]['skuid']    = $skuattr_db->where(array('classname'=>$v['classname'],'pid'=>0))->getField('id');
                            if($v['data']){
                                $j=0;
                                foreach($v['data'] As $key=>$val){
                                    $skuinfo[$i]['subset'][$j]['classname'] = $val['name'];
                                    $skuinfo[$i]['subset'][$j]['skuid']     = $val['sku_id'];
                                    if($j<1){
                                        $skuinfo[$i]['skuid'] = $skuattr_db->where(array('id'=>$val['sku_id']))->getField('pid');
                                    }
                                    $j++;
                                }
                            }
                            $i++;
                        }
                    }
                    $info['guigeshuxing'] = $skuinfo;
                }
            }
        }
        if($info['pic1']){
           $info['detailpic'] = array_filter(explode(',',$info['detailpic']));                //商品轮播图
        }
        $info['detail'] = $info['detail'] ? htmlspecialchars_decode($info['detail']) : '';//商品详情
        $goods_param = unserialize($info['goods_param']);                       //商品参数
        if($goods_param){
            $paramlist = array();
            foreach ($goods_param As $k =>$v){
                $paramlist[$k]=array_filter(explode('-',$v));
            }
            $info['goods_param'] = $paramlist;
        }else{
            $info['goods_param'] = '';
        }
        if($info['is_buy_power']){                                              //购买权限
            //$info['buy_grade_powers'] = $info['buy_grade_power'] ? array_filter(explode(',',$info['buy_grade_power'])) : '';
        }
        $info['youxiaoqi']   = $info['youxiaoqi'] ? date("Y-m-d H:i:s",$info['youxiaoqi']) : '';       //有效期
        return $info;
    }
    #自定义数据库修改字段的值
    public function changeStatus()
    {
        if(IS_POST){
            $table_db   = I('post.table_db','','trim');                           //数据库
            $fieldstr   = I('post.fieldstr','','trim');                           //修改则字段
            $idstr      = I('post.idstr','','trim');
            $valuestr   = I('post.valuestr','','trim');                           //修改的值
            if($table_db && $fieldstr && $idstr){
                $idstr   = rtrim(ltrim($idstr,','),',');
                if($idstr){
                    $data = array(
                        $fieldstr=>$valuestr,
                        'edit_at'=>date("Y-m-d H:i:s",NOW_TIME),
                    );
                    $id = M($table_db)->where(array('id'=>array('in',$idstr)))->save($data);
                    if($id){
                        $this->ajaxReturn(array('status'=>1,'info'=>'修改成功'));
                    }
                    $this->ajaxReturn(array('status'=>0,'info'=>'修改失败'));
                }
                $this->ajaxReturn(array('status'=>0,'info'=>'请选择需要修改的行'));
            }
            $this->ajaxReturn(array('status'=>0,'info'=>'参数错误'));
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'非法请求'));
    }

    Public Function GoodsTagList($goodsid,$tagid)
    {
        $m = M('Goods_tag');
        if(!$tagid){
            $info = array();
        }else{
            $array_list = explode(',', $tagid);
            foreach ($array_list as $k => $v) {
                $info[$k]['gtagid'] = $v;
                $name =  $m->where(array('id'=>$v))->getField('classname');
                $info[$k]['gclassname'] = $name;
            }
        }
        return $info;
    }
}