<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class IntegralgoodsController extends AdminCommonController
{

    private $storeid;    //商家id  平台1
    public function _initialize()
    {
        parent::_initialize();
        $this->storeid  = 1;
        $this->assign('storeid',$this->storeid);
    }

    public function cate(){
        $m   = M("goods_cate");
        $count = $m->count();    //总数
        $res = $m->where(array("pid"=>0,'status'=>1))->order("sort asc")->select();
        foreach($res as $k=>$v){
            $res[$k]["data"] = $m->where(array("pid"=>$v['id'],'status'=>1))->order("sort asc")->select();
        }
        $this->assign("cache", $res);
        $this->display();
    }

    public function addeditcate(){
        $m = M("goods_cate");
        $id = I('get.id');
        if($id){
            $res = $m->find($id);
            $this->assign("cache", $res);
        }else{
            $this->assign('time',time())   ;
        }
        $cate = $m->where(array("pid"=>0,'status'=>1))->order("sort asc")->select();
        $this->assign("cate", $cate);
        $this->display();

    }
    public function hidecate(){
        $id = I("post.id");
        $url = I('post.url');
        $m  = M("goods_cate");
        if(!$id){
            $this->ajaxReturn(array("status"=>0,"info"=>"请选择要删除的数据"));
        }
        $arr = array_unique(explode('-',(rtrim($id,'-'))));
        $data['id'] = array('in',$arr);
        if($data['pid']!=0){
            $res = $m->where($data)->save(array('status'=>0));
            if($res){
                $this->ajaxReturn(array("status"=>1,"info"=>"删除成功！","url"=>U($url)));
            }else{
                $this->ajaxReturn(array("status"=>0,"info"=>"删除失败！"));
            }
        }else{
            $res1 = $m->where($data)->save(array('status'=>0));
            $res2 = $m->where(array("pid"=>$data['id']))->save(array('status'=>0));
            if($res1!==false && $res2!==false){
                $this->ajaxReturn(array("status"=>1,"info"=>"删除成功！","url"=>U($url)));
            }else{
                $this->ajaxReturn(array("status"=>0,"info"=>"删除失败！"));
            }
        }
    }
    public function cateToJson()
    {
        #分类转json
        $this->ajaxReturn(D("GoodsCate")->cateToJson());
    }
    
    //商品
    public function index(){
        $this->com_status();
        $this->display();
    }

    //商品列表
    private function com_status($malltype=''){

        #商品状态
        $status = I('get.status','','intval');
        $status=$status?$status:10;
        $map=array();
        $maps=array();
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
        //积分商品
        $res10 = D('integral_goods')->select();
        $this->assign('count10',count($res10));
        //出售中
        $res11 = D('integral_goods')->where('is_del = 0 and is_sale=1')->select();
        $this->assign('count11',count($res11));
        // 回收站
        $res14 = D('integral_goods')->where('is_del = 1')->select();
        $this->assign('count14',count($res14));
        // 仓库中
        $res13 = D('integral_goods')->where('is_del = 0 and is_sale=0')->select();
        $this->assign('count13',count($res13));
        // 已售馨
        $res12 = D('integral_goods')->where('is_del = 0 and is_sale=1 and stock=0')->select();
        $this->assign('count12',count($res12));
        
        $this->assign("status",$status);



        if(in_array($status,array('10','11','12','13','14','15'))){
            $m = M("integral_goods");
        }

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
        $map = array_merge($map,$maps);
        list($count,$lists,$show) = D('integral_goods')->lists($map);

        $this->assign('count', $count);
        $this->assign('lists', $lists);
        // dump($lists);
        if($count > 10){
            $this->assign('page', $show);// 赋值分页输出
        }


        $page = I('get.p',1,'intval');
        $this->assign('pag',$page);
    }
    public function getSelectTagList()
    {
        if(IS_POST){
            $taglist = I('post.taglist');
            $taglist = ltrim($taglist,',');
            $tag_arr = explode(',', $taglist);
            $html = '';
            foreach ($tag_arr as $k => $v) {
                $ppp = array();
                $ppp['pid'] = $v;
                $ppp['isdel'] = 0;
                $ppp['status'] = 0;
                $child = M('goods_tag')->where($ppp)->field('id,classname')->select();
                if($child){
                    foreach ($child as $kk => $vv) {
                        $html .= "<li style='height:30px;margin: 10px;display: inline-block;' data-id='".$vv['id']."' data-type='1'><span style='color: #c00;font-size: 20px;text-align: center;cursor: pointer;' class='deltag' data-id='".$vv['id']."'>×</span><span style='border: 1px solid #eee;padding: 5px;'>".$vv['classname']."</span></li>" ;
                        // $html .= $vv['id'];
                    }
                }
            }
            $this->ajaxReturn(array('status'=>1,'info'=>$html));
        }
    }
    /**20171028
     * 添加/编辑 商品
     * */
    public function addgoods()
    {   #Cyonger iwanjiao@qq.com  201711061547
        if(IS_POST){
            $res  = D('integral_goods')->addGoods();
            if ($res['status'] == 0) {
                $this->ajaxReturn(array('status'=>0,'info'=>$res['info']));
            }else{
                $this->ajaxReturn(array('status'=>1,'info'=>$res['info'],'url'=>$res['url']));
            }
            exit;
        }
        $id = I('get.id',0,'intval');
        if($id){
            $info = D('integral_goods')->goodsInfo(array('id'=>$id));
            if(!$info){
                $this->error('商品不存在');
            }

            $cates = array();
            $cates['id'] = $info['cate_id'];
            $cates['name'] = $info['cate_name'];
            $this->assign('cates',$cates);
            $tagidarrList = explode(',',$info['tagid']);
            foreach ($tagidarrList as $k=>$v) {
                $name = M('integral_goods_tag')->where(array('id'=>$v))->getField('classname');
                $hastaglist[$k]['id']        = $v;
                $hastaglist[$k]['classname'] = $name;
            }
            $this->assign('hastaglist',$hastaglist);
            //获取sku列表信息
            if($info['is_sku']){
                $skulist = M('integral_sku_list')->where(array('goods_id'=>$id))->select();
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
                            $skuattr_db = M('integral_sku_attr');
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
            $malltype = I("get.malltype",1,'intval');
            $info = array();
            if($malltype == 3){
                $info['isactivity'] = 1;
            }elseif($malltype == 4){
                $info['isactivity'] = 2;
            }
            if($malltype > 2){
                $malltype = 1;
            }
            $info['malltype'] = $malltype;
            $this->assign('info',$info);
        }
        //获取分类
        $c = M("integral_shop_type");
        $type = $c->where("is_del=0 and status=0")->field("id,name")->select();
        // echo "<pre>";
        // print_r($type);
        $this->assign('type',$type);
        // $categorylist = $c->where(array("pid"=>0, "isdel"=>0))->select();
        // foreach($categorylist as $k=>$v){
        //     $categorylist[$k]['cate'] = $c->where(array('pid'=>$v['id'],'isdel'=>0))->select();
        // }
        // $this->assign("catelists", $categorylist);
        //获取标签
        // $taglist =  D("GoodsTag")->getTagList($this->storeid);
        // $this->assign('taglist',$taglist);
        //获取商城信息
        if($info['malltype']){
            $malltype = $info['malltype'];
        }
        $this->assign('malltype',$malltype);
        $this->assign('storeid',$this->storeid);
        $this->display();
    }
    #商品属性
    Public Function goodsAttr($goodsid)
    {   #商品属性
        $lists = M('Goods_attribute')->field('title,value')->where(Array('goodsid'=>$goodsid))->select();
        iF(!$lists){
            $lists = 0;
        }
        Return $lists;
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

    /**20171028wzz
     * 更新商品上架 下架 删除 恢复
     * */
    public function changestatus()
    {
        if(IS_POST){
            $this->ajaxReturn(D("integral_goods")->changeAllStatus());
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'你真调皮!'));
    }
    
    //商品属性
    public function attribute()
    {
        $id = I('get.id',0,'intval');
        if($id){
            $info = D('Goods')->goodsInfo(array('id'=>$id));
            if(!$info){
                $this->error('商品不存在!');
            }
        }
        $this->assign('goodsinfo',$info);
        $this->assign('goodsid',$id);
        $lists = D("GoodsAttribute")->Lists(array('goodsid'=>$id));
        $this->assign('lists',$lists);
        $this->display();
    }

    //属性添加修改删除
    public function attributeAddEditDel()
    {   //修改添加删除
        if(IS_POST){
            $this->ajaxReturn(D("GoodsAttribute")->addEditDel());
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'你真调皮!'));
    }

    //上架
    public function top()
    {
        $map = array('storeid'=>$this->storeid,'isdel'=>'0','issale'=>'1');
        $title = I('post.title','','trim');
        if($title){
            $map['title'] = array('like','%'.$title.'%');
            $this->assign('title',$title);
        }
        list($count,$lists,$show) = D('Goods')->lists($map);
        $this->assign('count', $count);
        $this->assign('lists', $lists);
        if($count > 10){
            $this->assign('page', $show);// 赋值分页输出
        }
        $this->display();
    }

    //下架
    public function down()
    {
        $map = array('storeid'=>$this->storeid,'isdel'=>'0','issale'=>'0');
        $title = I('post.title','','trim');
        if($title){
            $map['title'] = array('like','%'.$title.'%');
            $this->assign('title',$title);
        }
        list($count,$lists,$show) = D('Goods')->lists($map);
        $this->assign('count', $count);
        $this->assign('lists', $lists);
        if($count > 10){
            $this->assign('page', $show);// 赋值分页输出
        }
        $this->display();
    }

    //删除所选商品
    public function changeAllStatus()
    {
        $ids = I('post.ids');
        $arrid = explode('-',$ids);
        $arrid = array_pop($arrid);
        foreach ($arrid as $k => $v) {
            D("GoodsAttribute")->addEditDel();
        }
        $this->ajaxReturn(1);
    }
    //商品页，sku设置开始--------------------------------------------
    /**
     * sku列表
     */
    /* public function skuNameList(){
        $m   = M("skuAttr");
        $res = $m->where(array('pid'=>0, "isdel"=>0))->field("id,classname")->select();
        $html='<div class="select_sku">sku属性：<select class="select sku_id" name="sku_id[]"><option value="">请选择sku属性</option>';
        foreach($res as $k=>$v){
            $html.='<option value="'.$v["id"].'">'.$v['classname'].'</option>';
        }
        $html.='</select><input class="btn btn-primary" type="button" value="选择属性值" onclick="select_sku($(this))">&nbsp;&nbsp;<input class="btn btn-primary" type="button" value="自定义" onclick="dingyi_sku($(this))"><br/></div>';
        exit($html);
    } */
    #动态刷新Sku父级
    public function skuNameList()
    {   #Cyonger iwnajiao@qq.com  201711021605
        if(IS_POST){
            $pid  = I('post.pid',0,'intval');
            $res  = M("integral_skuAttr")->field("id,classname")->where(array('pid'=>$pid,'storeid'=>$this->storeid,'isdel'=>0))->order('sort ASC,id DESC')->select();
            if($res){
                $html = '<select class="select" name="skuid" data-pid="'.$pid.'">';
                foreach($res As $k=>$v){
                    $html.='<option value="'.$v["id"].'">'.$v['classname'].'</option>';
                }
                $html .='</select>';
                $this->ajaxReturn(array("status"=>1, "info"=>$html));
            }
            $this->ajaxReturn(array("status"=>2, "info"=>"没有属性和规格"));
        }
        $this->ajaxReturn(array("status"=>0, "info"=>"非发访问"));
    }
    //拼凑skutable 
    public function get_table($id,$idss,$goods,$goods_skus,$table){
        $m  = M("skuAttr");
        if (!$goods) {
            echo "<script>alert('没有这个产品！');window.history.back();</script>";
            die;
        }
        $table_str=$table;
        if (!empty($goods_skus)) {
            if ($goods["type"] == 2) {
                $table_str .= "<th>库存</th><th>原积分</th><th>现积分</th></tr>";
            } else {
                $table_str .= "<th>库存</th><th>积分</th><th>金额</th><th>编码</th><th>条码</th><th>重量（克）</th><th>上传SKU图片</th><th>删除</th></tr>";
            }
        }
        $table_str .= "</tr>";
        foreach ($goods_skus as $k => $v) {
            $table_str .= "<tr>";
            $skus_arr = array_filter(explode("-", $v['attr_list']));
            $input = "-";
            foreach ($skus_arr as $kk => $vv) {
                $table_str .= "<td class='sku-attr-data' data-id='{$vv}'>";
                $table_str .= $m->where(array('id' => $vv))->getField("classname");
                $table_str .= "</td>";
                $input .= $vv . "-";
            }
            $table_str .= "<input type='hidden' name='attr_list[]' value='" . $input . "'>";
            $table_str .= "<td><input name='stores[]' value='{$v['stock']}' class='input mini'></td>";
            $table_str .= "<td><input name='integral[]' value='{$v['integral']}' class='input mini'></td>";
            $table_str .= "<td><input name='price[]' value='{$v['price']}' class='input mini'></td>";
            $table_str .= "<td><input name='code[]' value='{$v['code']}' class='input mini'></td>";
            $table_str .= "<td><input name='bar_code[]' value='{$v['bar_code']}' class='input mini'></td>";
            $table_str .= "<td><input name='weight[]' value='{$v['weight']}' class='input mini'></td>";
            if ($goods["type"] == 2) {
                $table_str .= "<td><input name='oprice[]' value='{$v['oprice']}'></td>";
                $table_str .= "<td><input name='prices[]' value='{$v['price']}'></td>";
                // $table_str .= "<td><input type='button' class='btn btn-danger' value='删除' data-id='" . $v['id'] . "'  ></td>";
            } else {
                $table_str .= "<td><div class='btnimage fl'>选择图片<form action='/Admin/Index/addImage' method='post' enctype='multipart/form-data' class='uploadSku'><input type='file' accept='image/jpg,image/jpeg,image/png' class='skuFile' name='skuFile'></form></div><img src='{$v['pic']}' height='40' onclick='delSkuImg(this)'><input type='hidden' name='skuPic[]'  class='skuPic' value='{$v['pic']}'></td><td><a href='javascript:;' class='btn j-delClass btn-warning' title='删除' data-id='".$v['id']."' onclick='delsku($(this))'>删除</a></td>";
            }
            $table_str .= "</tr>";
        }
          return $table_str;
    }
    //删除sku列表
    public function delSkuList(){
        if(IS_POST){

            $id=I('post.id');
            if(!$id){
                $this->ajaxReturn(array("status"=>0, "info"=>"操作失败！"));
            }
            $res=M('sku_list')->where(array('id'=>$id))->delete();
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"删除成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"删除失败！"));
            }
        }
    }
    /**
     * 生成对应的sku表格
     * 得到sku的id,组合成表格
    */
    public function makeSkuTable(){
        $ids = I("post.ids");
        $id  = I("post.id");
        $sku_ids=I('post.sku_ids');
        $goods = M("goods")->where(array("id"=>$id))->find();
        // 获取到子sku参数
        $m = M("skuAttr");
        $skuarr=array();
        $where=array();
        $ids=array_unique(explode(',',$ids));
        $sku_ids=array_unique(explode(',',$sku_ids));
        $str = "<tr>";
        // dump($sku_ids);die();
        foreach($ids as $k=>$v){
            foreach($sku_ids as $k1=>$v1) {
                $re=$m->where(array('id'=>$v1))->find();
                if($re['pid']==$v){
                    $skuarr[$k][$k1] = $m->where(array("id" => $v1, "isdel" => 0, "status" => 1))->field("id,classname")->order("sort desc")->find();
                }
            }
            $str .= "<th>";
            $str .= $m->where(array('id'=>$v))->getField("classname");
            $str .= "</th>";
        }
        $skuarr=remove_null($skuarr);
      // dump($skuarr);die();
        if ($goods["type"] == 2) {
            $str .= "<th>库存</th><th>原积分</th><th>现积分</th><th>上传SKU图片</th>";
        } else {
            $str .= "<th>库存</th><th>积分</th><th>金额</th><th>编码</th><th>条码</th><th>重量（克）</th><th>上传SKU图片</th><th>删除</th>";
        }
        $str .= makeTable(mixSku($skuarr), "<input type='hidden' name='attr_list[]' /><td><input name='stores[]' onkeyup='num(this)' class='input mini'></td><td><input name='integral[]' onkeyup='num(this)' class='input mini'></td><td><input name='price[]' onkeyup='num(this)' class='input mini'></td><td><input name='code[]' onkeyup='num(this)' class='input mini'></td><td><input name='bar_code[]' onkeyup='num(this)' class='input mini'></td><td><input name='weight[]' onkeyup='num(this)' class='input mini'></td><td><div class='btnimage fl'>选择图片<form action='/Admin/Index/addImage' method='post' enctype='multipart/form-data' class='uploadSku'><input type='file' accept='image/jpg,image/jpeg,image/png' class='skuFile' name='skuFile'></form></div></td><td><a href='javascript:;' class='btn j-delClass btn-warning' title='删除' data-id='0' onclick='delsku($(this))'>删除</a></td>");
        exit($str);
    }

    //拼凑sku列表
    public function get_sku($id,$idss,$goods,$goods_skus){
        $m  = M("skuAttr");
        if (!$goods) {
            echo "<script>alert('没有这个产品！');window.history.back();</script>";
            die;
        }
        $sku_l = $idss = substr($idss, 0, strlen($idss) - 1);
        $sku_l = explode(',', $sku_l);
        $skus_arr=array();
        foreach ($goods_skus as $k1 => $v1) {
            $skus_arr[]= array_filter(explode("-", $v1['attr_list']));
        }
        $arr=array_unique(array_reduce($skus_arr, 'array_merge', array()));
        $arr=array_filter($arr);
        $htm='';
        $skuarr = $m->where(array("pid" => 0, "isdel" => 0, "status" => 1))->field("id,classname")->order("sort desc")->select();
        foreach ($sku_l as $k => $v) {
            $htm .= '<div class="select_sku">sku属性：<select class="select sku_id" name="sku_id[]"><option value="">请选择sku属性</option>';
            foreach ($skuarr as $k1 => $v1) {
                $htm .= '<option ';
                if ($v1["id"] == $v) {
                    $htm .= "selected ";
                }
                $htm .= 'value="' . $v1[id] . '" >' . $v1['classname'] . '</option>';
            }
            $htm .= '</select><input class="btn btn-primary" type="button" value="选择属性值" onclick="select_sku($(this))">&nbsp;&nbsp;<input class="btn btn-primary" type="button" value="自定义" onclick="dingyi_sku($(this))"><br/>';
            foreach ($arr as $k1 => $v1) {
                $sku_a = $m->where(array('id' => $v1))->field('id,pid,classname')->find();
                $sku_all = $m->where(array('pid' => $sku_a['pid'], 'isdel' => 0, 'status' => 1))->select();
                if ($v == $sku_a['pid']) {
                    $htm .= 'sku属性值：<select class="select sku_idss" name="sku_id[]"><option value="">请选择sku属性值</option>';
                    foreach ($sku_all as $k2 => $v2) {
                        $htm .= '<option ';
                        if ($v2["id"] == $sku_a['id']) {
                            $htm .= "selected ";
                        }
                        $htm .= 'value="' . $v2[id] . '" >' . $v2['classname'] . '</option>';
                    }
                    $htm .= "</select>&nbsp;&nbsp;&nbsp;";
                }
            }
            $htm .= "</div>";
        }
        return $htm;
    }
    /**
     * 生成对应的追加sku表格
     *     得到sku的id,组合成表格
     */
    public function makeSkuTable1(){

        $id = I("post.sku_id"); 
        $m = M("skuAttr");
        $skuarr=array();
        $str = 'sku属性值：<select class="select sku_idss" name="sku_id[]"><option value="">请选择sku属性值</option>';
        $skuarr = $m->where(array("pid" => $id, "isdel" => 0, "status" => 1))->field("id,classname")->order("sort desc")->select();
        foreach($skuarr as $k=>$v){
               $str.='<option value="'.$v["id"].'">'.$v['classname'].'</option>';
        }
        $str.="</select>&nbsp;&nbsp;&nbsp;";
        exit($str);
    }
    public function dingyiSkuTable(){
        $m = M("skuAttr");
        $ids = I("post.ids");
        $id1  = I("post.id1");
        $sku_ids=I('post.sku_ids');
        $id=I('post.id');
        $type=I('post.type');
        $stype=I('post.stype');
        //dump($stype);die();
        $goods = M("goods")->where(array("id"=>$id1))->find();
        // 获取到子sku参数
        $skuarr=array();
        $where=array();
        $ids=array_unique(explode(',',$ids));
        $sku_ids=array_unique(explode(',',$sku_ids));
        $str = "<tr>";
        // dump($sku_ids);die();
        $pid=$m->where(array('id'=>$id))->getField('pid');
        foreach($sku_ids as $k=>$v){
            $res=$m->where(array('id'=>$v))->find();
            if($res['pid']!=$pid){
                $sku_id[]=$v;
            }
        }

        $sku_id[]=$id;
        $sku_id=array_filter($sku_id);
        $ids=array_filter($ids);
        $a="-";
        foreach($ids as $k=>$v){
            foreach($sku_id as $k1=>$v1){
                $re=$m->where(array('id'=>$v1))->find();
                if($re['pid']==$v){
                    $skuarr[$k][$k1] = $m->where(array("id" => $v1, "isdel" => 0, "status" => 1))->field("id,classname")->order("sort desc")->find();
                }
            }
            if($stype==0) {
                $str .= "<th>";
                $str .= $m->where(array('id' => $v))->getField("classname");
                $str .= "</th>";
            }

            
        }
        $skuarr=remove_null($skuarr);
        //dump($stype);die();
        if($stype==0) {
            if ($goods["type"] == 2) {
                $str .= "<th>库存</th><th>原积分</th><th>现积分</th>";
            } else {
                $str .= "<th>库存</th><th>积分</th><th>金额</th><th>编码</th><th>条码</th><th>重量（克）</th><th>上传SKU图片</th><th>删除</th>";
            }
        }
        $str .= makeTable(mixSku($skuarr), "<input type='hidden' name='attr_list[]' value=''/><td><input name='stores[]' onkeyup='num(this)' class='input mini'></td><td><input name='integral[]' onkeyup='num(this)' class='input mini'></td><td><input name='price[]' onkeyup='num(this)' class='input mini'></td><td><input name='code[]' onkeyup='num(this)' class='input mini'></td><td><input name='bar_code[]' onkeyup='num(this)' class='input mini'></td><td><input name='weight[]' onkeyup='num(this)' class='input mini'></td><td><div class='btnimage fl'>选择图片<form action='/Admin/Index/addImage' method='post' enctype='multipart/form-data' class='uploadSku'><input type='file' accept='image/jpg,image/jpeg,image/png' class='skuFile' name='skuFile'></form></div></td><td><a href='javascript:;' class='btn j-delClass btn-warning' title='删除' data-id='0' onclick='delsku($(this))'>删除</a></td>");
        exit($str);
    }
    /**
     * 增加sku
     */
    public function addSku(){
        //var_dump(I('post.'));die;
        if(IS_AJAX){
            
            $m   = M("skuAttr");
            $add       = I("post.add");
            $classname = I("post.classname");
            $sort      = I("post.sort");
            $data['classname'] = $classname;
            $data['sort']      = $sort;
            $data['create_at'] = date('Y-m-d h:i:s',time());
            if($add==2){
                $data['pid']       = 0;
            }else{
                $pid = I("post.fid");   
                $res = $m->where(array("classname"=>$classname, "pid"=>$pid, "isdel"=>0))->find();
                if($res){
                    $this->ajaxReturn(array("status"=>0, "info"=>"类名已存在！"));
                }
                $data['classname'] = $classname;
                $data['pid']       = $pid;
                $data['sort']      = $sort;      
            }     
            $res = $m->add($data);
            if($res){
                $this->ajaxReturn(array("status"=>$res, "info"=>"增加成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"新增失败！"));
            }
        }
    }

    /**
     * 删除sku
     */
    public function delSku(){
        $id = I("id");
        $m  = M("skuAttr");
        $data = $m->find($id);
        if(!$data){
            $this->error("sku不存在!");
        }
        if($data['pid']){
            $res = $m->where(array("id"=>$id))->delete();
            if($res){
                $this->success("删除成功！");die;
            }else{
                $this->error("删除失败！");
            }
        }else{
            $res1 = $m->where(array("id"=>$id))->delete();
            $res2 = $m->where(array("pid"=>$id))->delete();
            if($res1!==false && $res2!==false){
                $this->success("删除成功！");die;
            }else{
                $this->error("删除失败！");
            }
        }
    }
    /**
     * 生成table的方法
     * @param arr sku生成过后的数组
     */
    function makeTable($arr, $other=""){
        $str = "";
        foreach($arr as $v){
            $str .= "<tr>";
            foreach($v as $vv){
                $str .= "<td class='sku-attr-data' data-id='{$vv[id]}'>{$vv[classname]}</td>";
            }
            $str .= $other;
            $str .= "</tr>";
        }
        return $str;
    }
    public function set_sku($sku_info,$id,$type="")
    {                                                                           #设置sku 数据筛选添加修改
        $m              = M("sku_list"); 
        $goods_m        = M("goods");
        $sku_m          = M("skuAttr");
        $sku_arr        = $sku_info; 
        $goods_id       = $id;
        $arrs           = '';
        $goods_sku_info = array();
        foreach($sku_arr as $k=>$v){
            $ids_arr = array_filter(explode("-",$v['attr_list']));
            sort($ids_arr);
            foreach($ids_arr as $kk=>$vv){
                $sku_a  = $sku_m->where(array('id'=>$vv))->find();
                $pid    = $sku_a['pid'];
                $psku   = $sku_m->where(array('id'=>$pid, "pid"=>0, "isdel"=>0))->getField("classname");
                if(array_key_exists($psku, $goods_sku_info)){                   #二级
                    $goods_sku_info[$psku][$sku_a['id']] = $sku_a['classname'];
                }else{                                                          #一级
                    $goods_sku_info[$psku] = array($sku_a['id']=>$sku_a['classname']);
                }
                //$goods_sku_info[$kk] = $arr;
            }
            $arrs[$k] = "-".implode("-", $ids_arr)."-";
        }
        $i=0;
        $arrczq =array();
        foreach ($goods_sku_info as $k => $v) {
            $arrczq[$i]['skuName'] = $k;
            $j=0;
            foreach ($v as $key => $value) {
                $arrczq[$i]['data'][$j]['sku_id'] = $key;
                $arrczq[$i]['data'][$j]['name'] = $value;
                $j++;
            }
            $i++;
        }
        // 得到对应pid的classname，并组成下表
        $old_sku = $m->where(array("goods_id"=>$goods_id))->select();
        $arr_keys = array_flip($arrs);
        foreach($sku_info as $k=>$v){
            $arr=$m->where(array('goods_id'=>$goods_id,'attr_list'=>$v['attr_list']))->find();
            if($arr){
                $sku_info[$k]['id'] = $arr['id'];
                $m->save($sku_info[$k]);
            }else{
                $sku_info[$k]['status']=1;
                $sku_info[$k]["goods_id"]=$goods_id; 
                // $sku_info[$k]["attr_list"]=$sku_info[$k]['ids'];
                // unset($sku_info[$k]['ids']);
                $m->add($sku_info[$k]);
            }
        }
        $goods_sku_info = serialize($arrczq);
        $goods_m->where(array('id'=>$goods_id))->save(array("goods_sku_info"=>$goods_sku_info,"is_sku"=>1));
    }
    //验证是否新增属性
    public function checkAttrId(){
        $m = M("skuAttr");
        $id = I("post.id");
        $save_id=I('post.save_id');
        $save_id=array_unique(explode(',',$save_id));
        $pid=$m->where(array('id'=>$id))->getField('pid');
        $pids=array();
        foreach($save_id as $k=>$v){
            $pidss=$m->where(array('id'=>$v))->getField('pid');
            $pids[]=$pidss;
        }
        $pids=array_filter($pids);
      /*  dump($pids);
        echo "<br/>";
        dump($pid);
        echo "<br/>";
        dump(in_array($pid, $pids));die();*/
        if(in_array($pid, $pids)){
            $this->ajaxReturn(array("status"=>1));
        }else{
            $this->ajaxReturn(array("status"=>0));
        }
    }

    //商品页，sku设置结束--------------------------------------------

    //sku展示页
    public function goodsskulist($value='')
    {
        //获取列表
        $where['pid'] = 0;
        $where['storeid'] = $this->storeid;
        $skulist = D('SkuAttr')->listSku($where);
        $id = I('get.goodsid');
        $table_str = D('SkuAttr')->getSkuList($id);
        $this->assign('storeid',$this->storeid);
        $this->assign('table',$table_str);
        $this->assign('id',$id);
        $this->assign('skulist',$skulist['list']);
        $this->display();
    }
    /**
     * 保存商品对应的sku
     */
    public function addGoodsSkuAttr(){
        if(IS_AJAX){
            $m        = M("skuList");
            $sku_m    = M("skuAttr");
            $sku_arr  = I("post.");
            $goods_id = $sku_arr['goods_id'];
            unset($sku_arr['goods_id']);
            // 查询旧sku，将暂时用不到的sku isdel=》1   

            // 添加新的sku
            $arrs=array();
            $goods_sku_info=array();
            foreach($sku_arr as $k=>$v){
                $ids_arr = array_filter(explode("-",$v['ids']));
                sort($ids_arr);
                foreach($ids_arr as $kk=>$vv){
                    $sku_a  = $sku_m->where(array('id'=>$vv))->find();
                    $pid  = $sku_a['pid'];
                    $psku = $sku_m->where(array('id'=>$pid, "pid"=>0, "isdel"=>0))->getField("classname");
                    if(array_key_exists($psku, $goods_sku_info)){
                        //$goods_sku_info[$psku][$sku_a['id']] = array('name'=>$sku_a['classname'],"img"=>$sku_a['img']);
                        $goods_sku_info[$psku][$sku_a['id']] = $sku_a['classname'];
                    }else{
                        //$goods_sku_info[$psku] = array($sku_a['id']=>array('name'=>$sku_a['classname'],"img"=>$sku_a['img']));
                        $goods_sku_info[$psku] = array($sku_a['id']=>$sku_a['classname']);
                    }
                }
                $arrs[$k] = "-".implode("-", $ids_arr)."-";
            }
            // 得到对应pid的classname，并组成下表
            $old_sku = $m->where(array("goods_id"=>$goods_id))->select();
            $arr_keys = array_flip($arrs);

            foreach($old_sku as $k=>$v){
                if(in_array($v['attr_list'], $arrs)){
                    // 这里未做完
                    $data = array(
                            "price" => $sku_arr[$arr_keys[$v['attr_list']]]['price'],     
                            "stock"  => $sku_arr[$arr_keys[$v['attr_list']]]['stock'],
                            "image" =>$sku_arr[$arr_keys[$v['attr_list']]]['image'],
                            "status" => 1,
                        );
                    $m->where(array('id'=>$v['id']))->save($data);
                    unset($sku_arr[$arr_keys[$v['attr_list']]]);
                }else{
                    $m->where(array('id'=>$v['id']))->delete();
                }
            }
     
            foreach($sku_arr as $k=>$v){
                $data = array(
                        "goods_id"  => $goods_id,
                        "attr_list" => $arrs[$k],
                        "price"    => $v['price'],
                        "image"     =>$v['image'],
                        "stock"     => $v['stock'],
                        "status"    => 1,
                    );
                 $m->add($data);
            }
               
           
            $goods_sku_info = serialize($goods_sku_info);            
            M("goods")->where(array('id'=>$goods_id))->setField(array("goods_sku_info"=>$goods_sku_info,"is_sku"=>1));
            $this->ajaxReturn(array("status"=>1 ,"info"=>"执行成功！"));
        }
    }



    //sku
    public function goodssku()
    {
        $title = I('post.title');
        if ($title) {
            $where['classname'] = array('like', "%$title%");
        }
        $where['storeid'] = $this->storeid;
        //获取列表
        $list = D('SkuAttr')->listSku($where,10);
        $this->assign('goodsid',$goodsid);
        $this->assign('list',$list['list']);
        $this->display();
    }

    //添加编辑sku
    public function addgoodssku()
    {
        //获取上级sku数据
        $list = D('SkuAttr')->getPid();
        $this->assign('list',$list);
        $data = I('post.');
        if ($data['classname']) {
            $res = D('SkuAttr')->addSku($data);
            if ($res == 1) {
                $this->redirect('Admin/goods/goodssku');
            }
        }else{
            $id = I('get.id');
            $info = D('SkuAttr')->getOneSku($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //删除/置顶
    public function skudel()
    {
        $data = I('post.');
        $res = D('SkuAttr')->saveStatus($data);
        $this->ajaxReturn($res);die;
    }



    //批量删除
    public function skudelall()
    {
        $id = explode('-', I('post.ids'));
        array_pop($id);
        foreach ($id as $k => $v) {
            $res = M('sku_attr')->where("id=$v")->setField('isdel','1');
        }
        echo 1;
    }


    //限时设置部分 
    public function timeLimit()
    {   //限时设置
        $lists = D("GoodsTimelimit")->lists($this->storeid);
        $this->assign('lists',$lists);
        $this->assign('storeid',$this->storeid);
        $this->display();
    }
    public function timeLimitAddEditDelStatus()
    {   //时间点添加删除修改状态
        if(IS_POST){
            $this->ajaxReturn(D("GoodsTimelimit")->addEditDelStatus());
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'你真调皮!'));
    }

    //评论管理
    public function comment()
    {
        $goodsid    = I('get.goodsid');
        $isactivity    = I('get.isactivity');
        $goods_name = I('get.goods_name','','trim');
        $keywords   = I('get.keywords','','trim');
        $content    = I('get.content','','trim');
        $id         = I('get.id','','trim');
        $this->assign("goods_name",$goods_name);
        $this->assign("keywords",$keywords);
        $this->assign("content",$content);
        $this->assign("id",$id);
        $where      = array();
        if ($goodsid) {
            $where['goodsid']       = $goodsid;
        }
        if ($isactivity) {
            $where['isactivity']   = $isactivity;
        }
        if($goods_name){
            $where['goods_name']    = array("like","%$goods_name%");
        }
        if($keywords){
            $where['person_name|telephone'] = array("like","%$keywords%");
        }
        if($content){
            $where['content']   = array("like","%$content%");
        }
        if($id){
            $where['id']        = $id;
        }
        $where['isdel'] = 0;
        $where['sorts'] = 1;
        $list = D('GoodsComment')->lists($where,10);
        $this->assign('count',$list['count']);
        $this->assign('page',$list['page']);
        $this->assign('lists',$list['lists']);
        $this->display();
    }

    //评论删除修改状态
    public function checkdel()
    {   
        if(IS_POST){
            $this->ajaxReturn(D("GoodsComment")->addEditDelStatus());
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'你真调皮!'));
    }


    // 运费规则
    public function explist(){
        $count = M('express_list')->where(array('isdel'=>0))->count();
        $Page  = getpage($count,15);
        $show  = $Page->show();
        $a = $Page->firstRow;
        $b = $Page->listRows;

        $list = M('express_list')->where(array('isdel'=>0))->limit($a,$b)->order('sort desc')->select();
        $this->assign('lists',$list);
        $this->assign('page',$show);

        $this->display();
    }

    public function expressListAddEditDelStatus()
    {   //运费添加删除修改状态
        if(IS_POST){
            $this->ajaxReturn(D("ExpressList")->addEditDelStatus());
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'你真调皮!'));
    }
    // 编辑运费规则
    public function editExp()
    {
        if(IS_POST){
            $this->addEditExp();
            exit('end');
            /* $id = trim(I('post.id',0,'intval'));
            $title = trim(I('post.title'));
            $sorts = I('post.sorts',0,'intval');
            $status = I('post.status',0,'intval');
            $not_exp_area_id = trim(I('post.not_exp_area_id'));
            $default_firstweight = trim(I('post.default_firstweight',0,'floatval'));
            $default_secondweight = trim(I('post.default_secondweight',0,'floatval'));
            $default_firstprice = trim(I('post.default_firstprice',0,'floatval'));
            $default_secondprice = trim(I('post.default_secondprice',0,'floatval'));
            $param = I('post.param');
            $rrr = M('express_list')->where(array('id'=>$id,'isdel'=>0))->find();
            if(!$rrr){
                $this->ajaxReturn(array('status'=>0,'info'=>'运费规则不存在了'));
            }
            $map['title'] = $title;
            $map['isdel'] = 0;
            $map['id'] = array('neq',$id);
            $res = M('express_list')->where($map)->select();
            if($res){
                $this->ajaxReturn(array('status'=>0,'info'=>'运费规则名称重复'));
            }
            $mapp['id'] = $id;
            $mapp['title'] = $title;
            $mapp['sort'] = $sorts;
            $mapp['status'] = $status;
            $mapp['edit_time'] = date('Y-m-d H:i:s',time());
            $mapp['not_exp_area_id'] = $not_exp_area_id;
            $mapp['default_firstweight'] = $default_firstweight;
            $mapp['default_secondweight'] = $default_secondweight;
            $mapp['default_firstprice'] = $default_firstprice;
            $mapp['default_secondprice'] = $default_secondprice;
            M()->startTrans();
            $reg = M('express_list')->save($mapp);
            if(!$reg){
                M()->rollback();
                $this->ajaxReturn(array('status'=>0,'info'=>'编辑失败'));
            }
            if(empty($param)){
                $del = M('express_area_list')->where(array('expid'=>$id))->delete();
                M()->commit();
                $this->ajaxReturn(array('status'=>0,'info'=>'编辑成功'));
            }else{
                $del = M('express_area_list')->where(array('expid'=>$id))->delete();
                $yyy['expid'] = $id;
                $yyy['create_at'] = date('Y-m-d H:i:s',NOW_TIME);
                foreach ($param as $kc => $vc) {
                    $paramq = explode('-', $vc);
                    $yyy['areaid'] = $paramq[0];
                    $yyy['firstweight'] = $paramq[1];
                    $yyy['secondweight'] = $paramq[3];
                    $yyy['firstprice'] = $paramq[2];
                    $yyy['secondprice'] = $paramq[4];
                    $fff = M('express_area_list')->add($yyy);
                    if(!$fff){
                        M()->rollback();
                        $this->ajaxReturn(array('status'=>0,'info'=>'编辑失败了'));
                    }
                }
                M()->commit();
                $this->ajaxReturn(array('status'=>0,'info'=>'编辑成功'));
            } */
        }
        $id = I('get.id',0,'intval');
        $res = M('express_list')->where(array('id'=>$id))->find();
        $not_exp_area_id = $res['not_exp_area_id'];
        if(!$not_exp_area_id){
            $not_exp_area_name = '';
        }else{
            $arrlist = explode(',',$not_exp_area_id);
            $not_exp_area_name = '';
            foreach ($arrlist as $k => $v) {
                $name = M('region')->where(array('id'=>$v))->getField('region_name');
                $not_exp_area_name .= $name.',' ;
            }
            $not_exp_area_name = rtrim($not_exp_area_name,',');
        }
        $res['not_exp_area_name'] = $not_exp_area_name;
        $this->assign('info',$res);
        // 运费规则区域信息
        $list = M('express_area_list')->where(array('expid'=>$id))->select();
        if($list){
            foreach ($list as $k => $v) {
                $arrlist = explode(',',$v['areaid']);
                $exp_area_name = '';
                foreach ($arrlist as $kk => $vv) {
                    $name = M('region')->where(array('id'=>$vv))->getField('region_name');
                    $exp_area_name .= $name.',' ;
                }
                $list[$k]['exp_area_name'] = rtrim($exp_area_name,',');
                $list[$k]['randomStr'] = $v['id']."fgafWfh".$v['id'];
            }
        }
        // dump($list);
        // die();
        $this->assign('explist',$list);
        $this->display();
    }
    public function addEditExp()
    {   #运费 添加修改
        if(IS_POST){
            $id               = I('post.id',0,'intval');
            $rulename         = I('post.rulename','','trim');
            $sorts            = I('post.sorts',0,'intval');
            $status           = I('post.status',0,'intval');
            $not_exp_area_id  = I('post.not_exp_area_id','','trim');
            $dispatchtype     = I('post.dispatchtype','','intval');
            $listid           = I('post.listid','','trim');
            $moren            = I('post.moren');
            $baby             = I('post.baby','','trim');
            $expresslist_db   = M('express_list');$expressarealist_db = M('express_area_list');
            $map = array(
                'title' => $rulename,
                'isdel' => 0,
            );
            if($id){
                $map['id'] = array('neq',$id);
                $rtitle    = '修改';
            }else{
                $rtitle    = '添加';
            }
            $count = $expresslist_db->where($map)->count();
            if($count){
                $this->ajaxReturn(array('status'=>0,'info'=>'运费规则名称重复'));
            }
            $field = 'freeprice';
            if($dispatchtype){
                //计件配送   firstnum,firstnumprice,secondnum,secondnumprice
                $afield='firstnum'; $bfield='firstnumprice'; $cfield='secondnum'; $dfield='secondnumprice';
                $title='首件'; $titleo='运费'; $titlet='续件';
            }elseif($dispatchtype==0){
                //计重配送   firstweight,firstprice,secondweight,secondprice
                $afield='firstweight'; $bfield='firstprice'; $cfield='secondweight'; $dfield='secondprice';
                $title='首重'; $titleo='首费'; $titlet='续重';
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'计费方式错误'));
            }
            if(!is_array($moren)){
                $this->ajaxReturn(array('status'=>0,'info'=>'提交失败'));
            }
            $data =array(
                'storeid'           => $this->storeid,
                'sort'              => $sorts,
                'dispatchtype'      => $dispatchtype,
                'title'             => $rulename,
                'status'            => $status,
                'not_exp_area_id'   => $not_exp_area_id,
            );
            if($moren['default_'.$afield] > 0){
                $data['default_'.$afield] = $moren['default_'.$afield];
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'第1行'.$title.'错误'));
            }
            if($moren['default_'.$bfield] > 0){
                $data['default_'.$bfield] = $moren['default_'.$bfield];
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'第1行'.$titleo.'错误'));
            }
            if($moren['default_'.$cfield] > 0){
                $data['default_'.$cfield] = $moren['default_'.$cfield];
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'第1行'.$titlet.'错误'));
            }
            if($moren['default_'.$dfield] > 0){
                $data['default_'.$dfield] = $moren['default_'.$dfield];
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'第1行续费错误'));
            }
            if($moren['default_'.$field] > 0){
                $data['default_'.$field] = $moren['default_'.$field];
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'第1行满额包邮错误'));
            }
            if($baby){
                if(!is_array($baby)){
                    $this->ajaxReturn(array('status'=>0,'info'=>'配送区域错误'));
                }
                foreach($baby As $k=>$v){
                    if(!$v['areaid']){
                        $this->ajaxReturn(array('status'=>0,'info'=>'第'. $k+1 .'行请选择配送区域'));break;
                    }
                    if(!$v[$afield]){
                        $this->ajaxReturn(array('status'=>0,'info'=>'第'. $k+1 .'行请设置'.$title));break;
                    }
                    if(!$v[$bfield]){
                        $this->ajaxReturn(array('status'=>0,'info'=>'第'. $k+1 .'行请设置'.$titleo));break;
                    }
                    if(!$v[$cfield]){
                        $this->ajaxReturn(array('status'=>0,'info'=>'第'. $k+1 .'行请设置'.$titlet));break;
                    }
                    if(!$v[$dfield]){
                        $this->ajaxReturn(array('status'=>0,'info'=>'第'. $k+1 .'行请设置续费'));break;
                    }
                    if(!$v[$field]){
                        $this->ajaxReturn(array('status'=>0,'info'=>'第'. $k+1 .'行请设置满额包邮'));break;
                    }
                }
            }
            M()->startTrans();
            if($id){
                $data['edit_time'] = date('Y-m-d H:i:s',NOW_TIME);
                $res = $expresslist_db->where(array('id'=>$id))->save($data);
            }else{
                $data['create_at'] = date('Y-m-d H:i:s',NOW_TIME);
                $id = $res = $expresslist_db->add($data);
            }
            if(!$res){
                M()->rollback();
                $this->ajaxReturn(array('status'=>0,'info'=>$rtitle.'失败'));
            }
            $status = 1;
            if($id){
                $listidarr = $expressarealist_db->where(array('expid'=>$id))->getField('id',true);
                if($listidarr){
                    if($listid){
                        $result = array_diff($listidarr,$listid);
                        if($result){
                            $res = $expressarealist_db->where(array('id'=>array('in',$result)))->delete();
                            if(!$res){
                                M()->rollback();
                                $this->ajaxReturn(array('status'=>0,'info'=>$rtitle.'失败'));
                            }
                        }
                    }else{
                        $res = $expressarealist_db->where(array('id'=>array('in',$listidarr)))->delete();
                        if(!$res){
                            M()->rollback();
                            $this->ajaxReturn(array('status'=>0,'info'=>$rtitle.'失败'));
                        }
                        $status = 0;
                    }
                }else{
                    if($baby){
                        foreach($baby As $k=>$v){
                            $baby[$k]['listid'] = 0;
                        }
                    }
                }
            }
            if($status){
                if(is_array($baby)){
                    $data = array();$i=0;
                    foreach($baby As $k=>$v){
                        $sdata = array(
                            'expid'     => $id,
                            'areaid'    => $v['areaid'],
                            $afield     => $v[$afield],
                            $bfield     => $v[$bfield],
                            $cfield     => $v[$cfield],
                            $dfield     => $v[$dfield],
                            $field      => $v[$field],
                            'create_at' => date('Y-m-d H:i:s',NOW_TIME),
                        );
                        if($v['listid']){
                            $res = $expressarealist_db->where(array('id'=>$v['listid']))->save($sdata);
                            if(!$res){
                                M()->rollback();
                                $this->ajaxReturn(array('status'=>0,'info'=>$rtitle.'失败'));break;
                            }
                        }else{
                            $data[$i] = $sdata;
                            $i++;
                        }
                    }
                    if($data){
                        $res = $expressarealist_db->addAll($data);
                        if(!$res){
                            M()->rollback();
                            $this->ajaxReturn(array('status'=>0,'info'=>$rtitle.'失败'));
                        }
                    }
                }
            }
            M()->commit();
            $this->ajaxReturn(array('status'=>1,'info'=>$rtitle.'成功'));
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'非凡访问'));
    }
    // 添加运费规则
    public function addExp()
    {
        if(IS_POST){
            $this->addEditExp();
            exit('end');
            /*$title = trim(I('post.title'));
            $sorts = I('post.sorts',0,'intval');
            $status = I('post.status',0,'intval');
            $not_exp_area_id = trim(I('post.not_exp_area_id'));
            $default_firstweight = trim(I('post.default_firstweight',0,'floatval'));
            $default_secondweight = trim(I('post.default_secondweight',0,'floatval'));
            $default_firstprice = trim(I('post.default_firstprice',0,'floatval'));
            $default_secondprice = trim(I('post.default_secondprice',0,'floatval'));
            $param = I('post.param');
            $map['title'] = $title;
            $map['isdel'] = 0;
            $res = M('express_list')->where($map)->select();
            if($res){
                $this->ajaxReturn(array('status'=>0,'info'=>'运费规则名称重复'));
            }
            $map['sort'] = $sorts;
            $map['status'] = $status;
            $map['create_at'] = date('Y-m-d H:i:s',time());
            $map['not_exp_area_id'] = $not_exp_area_id;
            $map['default_firstweight'] = $default_firstweight;
            $map['default_secondweight'] = $default_secondweight;
            $map['default_firstprice'] = $default_firstprice;
            $map['default_secondprice'] = $default_secondprice;
            M()->startTrans();
            $reg = M('express_list')->add($map);
            if(!$reg){
                M()->rollback();
                $this->ajaxReturn(array('status'=>0,'info'=>'添加失败'));
            }
            if(empty($param)){
                M()->commit();
                $this->ajaxReturn(array('status'=>0,'info'=>'添加成功'));
            }else{
                $yyy['expid'] = $reg;
                $yyy['create_at'] = date('Y-m-d H:i:s',NOW_TIME);
                foreach ($param as $kc => $vc) {
                    $paramq = explode('-', $vc);
                    $yyy['areaid'] = $paramq[0];
                    $yyy['firstweight'] = $paramq[1];
                    $yyy['secondweight'] = $paramq[3];
                    $yyy['firstprice'] = $paramq[2];
                    $yyy['secondprice'] = $paramq[4];
                    $fff = M('express_area_list')->add($yyy);
                    if(!$fff){
                        M()->rollback();
                        $this->ajaxReturn(array('status'=>0,'info'=>'添加失败了'));
                    }
                }
                M()->commit();
                $this->ajaxReturn(array('status'=>0,'info'=>'添加成功'));
            } */
        }
        $this->display();
    }

    // 获取区域
    public function changeArea()
    {
        if(IS_POST){
            $changeArea = trim(I('post.changeArea'));
            $map['parent_id'] = 1;
            $map['id'] = array('notin',$changeArea);
            $list = M('region')->where($map)->field('id,region_name')->select();
            $this->ajaxReturn(array('status'=>1,'info'=>$list));
        }
    }


    /**20171019wzz
     * 审核评论详情页
     * */
    public function checkComment(){
        $id = I("get.id");
        $res = D("GoodsCommentView")->where(array('isdel'=>0,'sorts'=>1))->find($id);
        $res['content_1']=$res['content'];
        $res['shoucishenhe']=$res['ischeck'];
        if($res['imgstr']){
            $res['imgstr_1']=array_filter(Explode(',',$res['imgstr']));
        }
        $m = M("goods_comment");
        $shoucipingjiahuifu = $m->where(array('pid'=>$res['id']))->field("content,imgstr,id")->find();
        $res['content_2'] =$shoucipingjiahuifu['content'];
        $res['shoucipingjiahuifu_id'] = $shoucipingjiahuifu['id'];
        if($shoucipingjiahuifu['imgstr']){
            $res['imgstr_2']=array_filter(Explode(',',$shoucipingjiahuifu['imgstr']));
        }

        $res1 =$m->where(array('isdel'=>0,'sorts'=>1,'order_goods_id'=>$res['order_goods_id'],'sorts'=>2))->field("content,imgstr,id,ischeck")->find();
        $res['zhuijia_id']=$res1['id'];
        $res['zhuijiashenhe']=$res1['ischeck'];
        $res['content_3']=$res1['content'];
        if($res1['imgstr']){
            $res['imgstr_3']=array_filter(Explode(',',$res1['imgstr']));
        }
        $zhuijiapingjiahuifu = $m->where(array('pid'=>$res1['id']))->field("content,imgstr,id")->find();
        $res['content_4']=$zhuijiapingjiahuifu['content'];
        $res['zhuijiapingjiahuifu_id'] = $zhuijiapingjiahuifu['id'];
        if($zhuijiapingjiahuifu['imgstr']){
            $res['imgstr_4']=array_filter(Explode(',',$zhuijiapingjiahuifu['imgstr']));
        }

        if($res){
            $this->assign('info',$res);
        }
        $this->display();
    }


    /**20171019wzz
     * 审核评论
     * */
    public function shenhe_comment()
    {
        if (IS_AJAX) {
            $m = M("goods_comment");
            $data = I("post.");
            $dd = array();


            //判断评论记录是否存在
            $info = $m->where(array('is_del' => 0, 'id' => $data['id']))->find();
            if (!$info) {
                $this->ajaxReturn(array('status' => 1, 'info' => "评论记录不存在"));
            }
//  huifu_status回复状态
//1-未首次回复
//2-已首次回复
//3-未首次回复 未追加回复
//4-未首次回复 已追加回复
//5-已首次回复 未追加回复
//6-已首次回复 已追加回复
//            审核状态
//1-首次评价待审核
//2-首次评价通过
//3-首次评价不通过
//4-首次评价待审核 追加评价待审核
//5-首次评价通过 追加评价待审核
//6-首次评价通过 追加评价通过
//7-首次评价通过 追加评价不通过
            //首次回复审核  说明审核了
            if (in_array($data['shoucishenhe'], array('1', '2'))) {
                $dd['ischeck'] = $data['shoucishenhe'];   #0 待审核 1 审核通过 2不通过
                $dd['shenhe_status'] = $data['shoucishenhe']+1; #2  3
                $m->where(array('id' => $data['id']))->save($dd); //更新首次评论审核记录

                if ($data['shoucihuifu']) {   #添加首次评价回复
                    $ddd = array(
                        'pid' => $info['id'],
                        'content' => $data['shoucihuifu'],
                        'imgstr' => $data['shoucihuifu_img'],
                        'order_id' => $info['order_id'],
                        'huifu_status' => "2",                #已首次回复
                    );
                    if($data['shoucipingjiahuifu_id']){
                        $m->where(array('id'=>$data['shoucipingjiahuifu_id']))->save($ddd);
                    }else{
                        $m->add($ddd);
                    }
                    $info111 = $m->where(array('is_del' => 0, 'id' => $data['id']))->find();
                    if ($info111['huifu_status'] == 3) {    #3-未首次回复 未追加回复
                        $m->where(array('id' => $data['id']))->setField("huifu_status",5);  #5-已首次回复 未追加回复
                    }elseif ($info111['huifu_status'] == 4) {    #4-未首次回复 已追加回复
                        $m->where(array('id' => $data['id']))->setField("huifu_status",6);  #6-已首次回复 已追加回复
                    }else{
                        if(!$data['zhuijia_id']){
                            M("goods_comment")->where(array('id'=>$data['id']))->setField('huifu_status',2); #更新首次评论的 回复状态
                        }
                    }


                }
                if ($data['shoucishenhe'] == 1) {
                    $m->where(array('id' => $data['id']))->setField("shenhe_status", 2);
                } else {
                    $m->where(array('id' => $data['id']))->setField("shenhe_status", 3);
                }

                /*追加评价*/
                if ($data['zhuijia_id']) {

                    $info_zhuijia = $m->where(array('is_del' => 0, 'id' => $data['zhuijia_id']))->find();
                    if ($info_zhuijia) {
                        #审核了
                        if (in_array($data['zhuijiashenhe'], array('1', '2'))) {
                            $dd['ischeck'] = $data['zhuijiashenhe'];
                            $m->where(array('id' => $data['zhuijia_id']))->save($dd);//更新追加评论审核记录

                                if($data['shoucishenhe']==1 && $data['zhuijiashenhe']==1){
                                    $shenhe_status= 6;
                                }elseif ($data['shoucishenhe']==1 && $data['zhuijiashenhe']==2){
                                    $shenhe_status= 7;
                                }elseif ($data['shoucishenhe']==1 && $data['zhuijiashenhe']==0){
                                    $shenhe_status= 5;
                                }elseif ($data['shoucishenhe']==2 && $data['zhuijiashenhe']==1){
                                    $shenhe_status= 9;
                                }elseif ($data['shoucishenhe']==2 && $data['zhuijiashenhe']==2){
                                    $shenhe_status= 10;
                                }elseif ($data['shoucishenhe']==2 && $data['zhuijiashenhe']==0){
                                    $shenhe_status= 8;
                                }elseif ($data['shoucishenhe']==0 && $data['zhuijiashenhe']==1){
                                    $shenhe_status= 11;
                                }elseif ($data['shoucishenhe']==0 && $data['zhuijiashenhe']==2){
                                    $shenhe_status= 12;
                                }

                            $m->where(array('id' => $data['id']))->setField("shenhe_status", $shenhe_status);
                            if ($data['zhuijiahuifu']) {
                                $info22 = $m->where(array('is_del' => 0, 'id' => $data['id']))->find();
                                if ($info22['huifu_status'] == 3) {    #3-未首次回复 未追加回复
                                    $m->where(array('id' => $data['id']))->setField("huifu_status",4);  #4-未首次回复 已追加回复
                                }elseif ($info22['huifu_status'] == 5) {   #5-已首次回复 未追加回复
                                    $m->where(array('id' => $data['id']))->setField("huifu_status",6);  #6-已首次回复 已追加回复
                                }
                                $dddd = array(
                                    'pid' => $info_zhuijia['id'],
                                    'content' => $data['zhuijiahuifu'],
                                    'imgstr' => $data['zhuijiahuifu_img'],
                                    'order_id' => $info_zhuijia['order_id'],
                                    'status' => "1",
                                    'shenhe_status' => $data['shoucishenhe'] + 1,
                                );
                                if($data['zhuijiapingjiahuifu_id']){
                                    $m->where(array('id'=>$data['zhuijiapingjiahuifu_id']))->save($dddd);
                                }else{
                                    $m->add($dddd);
                                }
                            }

                        }else{
                            if ($data['shoucishenhe']==1 && $data['zhuijiashenhe']==0){
                                $shenhe_status= 5;
                            }elseif ($data['shoucishenhe']==2 && $data['zhuijiashenhe']==0){
                                $shenhe_status= 8;
                            }
                            $m->where(array('id' => $data['id']))->setField("shenhe_status", $shenhe_status);
                        }
                    }

                }
            }

            $this->ajaxReturn(array('status' => 1, 'info' => "操作完成"));

        }
    }



    /**20171020wzz
     * 添加虚拟评价
     * */
    public function addcomment(){
        if(IS_POST){
            $gc = M("goods_comment");
            $data  = I("param.");
            if(!$data['goodsid']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请选择商品"));
            }
            if(!$data['xuni_name']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请填写虚拟会员昵称"));
            }
            if(!$data['xuni_img']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请上传虚拟会员头像"));
            }
            if(!$data['star']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请选择评分等级"));
            }
            if(!$data['shouci']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请选择评分等级"));
            }
            $goods_info = M("goods")->field('title,id,logo,malltype')->where(array("isdel"=>0,'issale'=>1,'id'=>$data['goodsid']))->find();
            if($goods_info){
                $pd =array(
                    'type'=>1,
                    'isdel'=>0,
                    'ischeck'=>1,
                );

                #首次
                if($data['shouci']){
                    $pd['xuni_name']=$data['xuni_name'];
                    $pd['xuni_img']=$data['xuni_img'];
                    $pd['goodsid']=$data['goodsid'];
                    $pd['malltype']=$goods_info['malltype'];
                    $pd['content']=$data['shouci'];
                    $pd['sorts']=1;
                    $pd['imgstr']=$data['shouci_img'];
                    $pd['star']=$data['star'];
                    $pd['create_time']=date("Y-m-d H:i:s",time());

                    if($data['id']>0){
                        $gc->where(array('id'=>$data['id']))->save($pd);    #修改

                        $pid = $data['id'];
                    }else{
                        $r = $gc->add($pd); #增加
                        $pid =$r;
                    }

                    #首次回复
                    if($data['shoucihuifu']){
                        $q=array(
                            'pid'=>$pid,
                            'content'=>$data['shoucihuifu'],
                            'imgstr'=>$data['shoucihuifu_img'],
                            'create_time'=>date("Y-m-d H:i:s",time()),
                        );
                        if($data['shoucihuifu_id']>0){
                            $gc->where(array('id'=>$data['shoucihuifu_id']))->save($q); #更新
                        }else{
                            $gc->add($q);   #增加
                        }
                    }

                    #追加评价
                    if($data['zhuijia']){
                        $qq=array(
                            'xuni_link_id'=>$pid,
                            'content'=>$data['zhuijia'],
                            'sorts'=>2,
                            'imgstr'=>$data['zhuijia_img'],
                            'create_time'=>date("Y-m-d H:i:s",time()),
                        );
                        if($data['zhuijia_id']>0){
                            $gc->where(array('id'=>$data['zhuijia_id']))->save($qq); #更新
                            $pid1 = $data['zhuijia_id'];
                        }else{
                            $r1 = $gc->add($qq);   #增加
                            $pid1 = $r1;
                        }


                        #追加回复
                        if($data['zhuijiahuifu']){
                            $q=array(
                                'pid'=>$pid1,
                                'content'=>$data['zhuijiahuifu'],
                                'imgstr'=>$data['zhuijiahuifu_img'],
                                'create_time'=>date("Y-m-d H:i:s",time()),
                            );
                            if($data['zhuijiahuifu_id']>0){
                                $gc->where(array('id'=>$data['zhuijiahuifu_id']))->save($q); #更新
                            }else{
                                $gc->add($q);   #增加
                            }
                        }
                    }
                }
                $this->ajaxReturn(array('status' => 1, 'info' => "提交成功"));
            }
            $this->ajaxReturn(array('status' => 0, 'info' => "提交失败"));
        }


        $id = I("get.id");
        $gc = M("goods_comment");
        #首次评价
        $info = $gc->where(array('type'=>1,'id'=>$id))->find();
        if($info){
            if($info['goodsid']){
                $goods_info = M("goods")->field('title,logo')->where(array('id'=>$info['goodsid']))->find();
                $rr['goods_name']=$goods_info['title'];
                $rr['goods_pic']=$goods_info['logo'];
                $rr['goods_id']=$goods_info['id'];

                $rr['xuni_name'] = $info['xuni_name'];
                $rr['xuni_img']=$info['xuni_img'];
                $rr['star'] =$info['star'];
                $rr['id']=$info['id'];
                $rr['content_1'] = $info['content'];
                $rr['imgstr_1'] = array_filter(explode(',',$info['imgstr']));;

                #首次回复
                $shoucihuifu = $gc->where(array('pid'=>$info['id']))->field('id,content,imgstr')->find();
                if($shoucihuifu){
                    $rr['shoucihuifu_id']=$shoucihuifu['id'];
                    $rr['content_2']=$shoucihuifu['content'];
                    $rr['imgstr_2']=array_filter(explode(',',$shoucihuifu['imgstr']));
                }

                #追加评价
                $zhuijia = $gc->where(array('xuni_link_id'=>$info['id']))->field('id,content,imgstr')->find();
                if($zhuijia){
                    $rr['zhuijia_id']=$zhuijia['id'];
                    $rr['content_3']=$zhuijia['content'];
                    $rr['imgstr_3']=array_filter(explode(',',$zhuijia['imgstr']));

                    #追加评价回复
                    $zhuijiahuifu = $gc->where(array('pid'=>$zhuijia['id']))->field('id,content,imgstr')->find();
                    if($zhuijiahuifu){
                        $rr['zhuijiahuifu_id']=$zhuijiahuifu['id'];
                        $rr['content_4']=$zhuijiahuifu['content'];
                        $rr['imgstr_4']=array_filter(explode(',',$zhuijiahuifu['imgstr']));
                    }
                }
            }
            $this->assign("info",$rr);
        }

        $this->display();
    }


    /**
     * 搜索商品
     * */
    public function sousuogoods(){
        $sel_goods_name = I("post.sel_goods_name");

        $res = M("goods")->field('id,title,logo')->where(array("isdel"=>0,'issale'=>1,'title'=>array('like',"%$sel_goods_name%")))->select();

        if($res){
            $str="";
            foreach ($res as $key =>$val){
                $str.= "<option class='ss_goods' data-title='".$val['title']."' data-img='".$val['logo']."'  value='".$val['id']."'>".$val['title']."</option>";
            }
            $this->ajaxReturn(array('status' => 1, 'info' => $str,'data'=>$res));
        }
        $this->ajaxReturn(array('status' => 0, 'info' => "查询商品不存在"));
    }


    //分类banner列表
    public function banner_list(){
        $cate_banner = M('cate_banner');
        $cate = M('goods_cate');
        $id = trim($_GET['id']);

        $cate_name = $cate->where("id='".$id."'")->field('classname')->select();


        $banner_list = $cate_banner->alias('a')->join('app_goods_cate as g ON g.id = a.cateid')->where('a.is_del=0 and g.isdel=0 and cateid="'.$id.'"')->field('a.id,a.pic,a.pic_url,a.start_time,a.end_time,a.sort,a.status,a.add_time,a.type')->order('sort')->select();
        foreach ($banner_list as &$v){
            if($v['type'] == 1){
                $shop_logo = $cate_banner->alias('a')->join('app_goods as g ON g.id = a.shop_id')->where('a.is_del=0 and g.isdel="0"')->field('g.logo')->select();
                $v['shop_logo'] = $shop_logo[0]['logo'];
            }else{
                $v['shop_logo'] = '';
            }

            if($v['type'] == 2){
                $store_logo = $cate_banner->alias('a')->join('app_store as s ON s.id = a.stor_id')->where('a.is_del=0 and s.is_del="0" and s.status="0"')->field('s.store_logo')->select();
                $v['store_logo'] = $store_logo[0]['store_logo'];
            }else{
                $v['store_logo'] = '';
            }

            
        }

        // echo "<pre>";
        // print_r($cate_name[0]['classname']);
        $this->assign("cate_id",$id);
        $this->assign("bannernum",count($banner_list));
        $this->assign("banner_list", $banner_list);
        $this->assign("cate_name", $cate_name[0]['classname']);
        $this->display();
    }
    // 获取修改bunner信息
    public function update_banner(){
        $cate_banner = M('cate_banner');
        $id = trim(I('post.updateid'));
        $banner_list = $cate_banner->where('is_del=0 and id="'.$id.'"')->field('id,pic,pic_url,start_time,end_time,sort as sorts,add_time,status,type,active_id,stor_id,shop_id')->select();
        // echo "<pre>";
        // print_r($banner_list);

        $this-> ajaxReturn($banner_list);
    }
    //添加，修改banner
    public function addOrUpdateBanner(){
        if(IS_POST){
            $banner = D("cate_banner");
            $banner_array = I('post.addarray');
            // if(!$banner_array['name']){
            //    $this-> ajaxReturn(array('status' => 0, 'info' => "请填写名称!"));
            // }
            if(!$banner_array['pic']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请填上传banner!"));
            }
            // if(!$banner_array['pic_url']){
            //     $this->ajaxReturn(array('status' => 0, 'info' => "请填写url链接!"));
            // }
            if(!$banner_array['start_time']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请填写开始时间!"));
            }
            if(!$banner_array['end_time']){
                $this->ajaxReturn(array('status' => 0, 'info' => "请填写结束时间!"));
            }
            if($banner_array['type']==1){
                $banner_array['shop_id'] = $banner_array['pic_url'];
                unset($banner_array['pic_url']);
            }
            if($banner_array['type']==2){
                $banner_array['stor_id'] = $banner_array['pic_url'];
                unset($banner_array['pic_url']);
            }
            if($banner_array['type']==3){
                $banner_array['active_id'] = $banner_array['pic_url'];
                unset($banner_array['pic_url']);
            }
            if($banner_array['type']==4){
                $banner_array['pic_url'] = $banner_array['pic_url'];
            }

            // echo "<pre>";
            // print_r($banner_array);
            // exit;
            if(!$banner_array['updateid']){
                if($banner_array['cateid']){
                    $res = $banner->add($banner_array);
                    // echo $banner->_sql();
                    if($res){
                        $this->ajaxReturn(array('status' => 1, 'info' => "成功!"));
                    }else{

                        $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
                    }
                }else{
                    $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
                }
            }else{
                $res = $banner->where("id='".$banner_array['updateid']."'")->save($banner_array);
                
                $this->ajaxReturn(array('status' => 1, 'info' => "成功!"));

            }
            
        }else{
            $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
        }
    }
    //启用停用banner
    public function startOrEnd(){
        if(IS_POST){
            $banner = D("cate_banner");
            $banner_array = I('post.arr');
            $array = array(
                'status' => $banner_array['status']
            );
            $res = $banner->where("id='".$banner_array['id']."'")->save($array);
            if($res){
                $this->ajaxReturn(array('status' => 1, 'info' => "成功!"));
            }else{
                $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
            }
            
            
        }else{
            $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
        }
    }
    //查看banner详情
    public function banner_info(){
        $id=$_GET['id'];
        
        $cate_banner = D("cate_banner");
        $banner_info = $cate_banner->alias('a')->join('app_goods_cate as g ON g.id = a.cateid')->where('a.is_del=0 and g.isdel=0 and a.id="'.$id.'"')->field('a.id,a.pic,a.pic_url,a.start_time,a.end_time,a.sort,a.status,a.add_time,a.type,shop_id,stor_id,active_id')->select();

        foreach ($banner_info as &$v) {
            if($v['type'] == 1){
                $v['type_name'] = '商品';
                $v['canshu'] = $v['shop_id'];
            }
            if($v['type'] == 2){
                $v['type_name'] = '店铺';
                $v['canshu'] = $v['stor_id'];
            }
            if($v['type'] == 3){
                $v['type_name'] = '活动模板';
                $v['canshu'] = $v['active_id'];
            }
            if($v['type'] == 4){
                $v['type_name'] = 'url';
                $v['canshu'] = $v['pic_url'];
            }

        }
        // echo "<pre>";
        // print_r($banner_info);


        $this->assign("banner_info", $banner_info);

        $this->display();
    }
    //删除banner
    public function banner_del(){
        if(IS_POST){
            $banner = D("cate_banner");
            $id = I('post.id');
            $array = array(
                'is_del' => 1
            );
            $res = $banner->where("id='".$id."'")->save($array);
            if($res){
                $this->ajaxReturn(array('status' => 1, 'info' => "成功!"));
            }else{
                $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
            }
            
            
        }else{
            $this->ajaxReturn(array('status' => 0, 'info' => "系统繁忙,请稍后再试!"));
        }
    }

}