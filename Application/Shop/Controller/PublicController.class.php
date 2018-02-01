<?php
namespace Shop\Controller;
use Think\Controller;

class PublicController extends Controller {

	public $user_info  = "";
	public $user_id    = "";
	public $model_list = array();

    public function _initialize(){

        #官网跳转
        $telephone = I('get.telephone','','trim');
        if($telephone){
            $user_id = M('member')->where(array('telephone'=>$telephone))->getField('id');
            if($user_id){
                $_SESSION['user_id'] = $user_id;
            }
        }

        #首页文案配置
        $shop_index_config = S('shop_index_config');
        if(!$shop_index_config){
            $shop_index_config = M('ShopIndexConfig')->find(1);
            S('shop_index_config',$shop_index_config,array('expire'=>3600));
        }
        $this->assign('shop_index_config',$shop_index_config);

        #头部滚动公告
        $gundong_gonggao = S('gundong_gonggao');
        if(!$gundong_gonggao){
            $gundong_gonggao = M('Announ')->where(array('cate_id'=>4))->order('id desc')->find();
            S('gundong_gonggao',$gundong_gonggao,array('expire'=>3600));
        }
        $this->assign('gundong_gonggao',$gundong_gonggao['title']);


        #网站配置
        $shop_config = S('shop_config');
        if(!$shop_config){
            $shop_config = M('ShopWebConfig')->find(1);
            S('shop_config',$shop_config,array('expire'=>3600));
        }
        $this->assign('shop_config',$shop_config);



        //前台的shopconfig门店设置
        if($invite_code = I("invite_code")){
            $_SESSION['invite_code'] = $invite_code;
        }
        if($_SESSION['user_id']>0){

            $user_info = M("member")->where(array("id"=>$_SESSION['user_id'],"status"=>0, "isdel"=>0))->find();
            if($user_info){
                $this->user_info = $user_info;
                $this->user_id   = $_SESSION['user_id'];
            }else{
                session("user_id", null);
                $this->user_info = "";
                $this->user_id   = "";
            }
            $res = $this->getTopInfo();
            $this->assign("topInfo", $res);
        }

        //获取产品分类列表
//        $cateList = S("cateList");
        $cateList = array();
        if(empty($cateList)){
            $m=M('shop_goods_cate');
            $cateList=$m->where(array('pid'=>0,'status'=>0,'is_del'=>0))->order('sorts desc')->select();
            //获取每个一级分类下的所有分类pid
            foreach($cateList as $k=>$v)
            {
                $cateList[$k]['sub']=$m->where(array("pid"=>$v['id'],'status'=>0, "is_del"=>0))->order('sorts desc,id asc')->select();
                /*查出每个pid分类下的六款推荐产品*/
                $product = M('goods')
                    ->where(array('cate_pid'=>$v['id'], 'is_del' => '0', 'is_tui' => '1', 'type' => '1'))
                    ->order('sorts Asc, id Desc')
                    ->field('id, logo_pic, goods_name')
                    ->limit(4)
                    ->select();
                foreach($product as $k1 => $v1){
                    $strlen = mb_strlen($v1['goods_name'], 'utf-8');
                    if ($strlen > 15) {
                        $product[$k1]['goods_name'] = mb_substr($v1['goods_name'], 0, 15, 'utf-8') . "...";
                    }
                }
                $cateList[$k]['product'] = $product;

            }
            S("cateList", $cateList, array('expire'=>60*5));
        }
        
        //推荐的产品分类
//        $tui_goodsCate = S("tui_goodsCate");
        if(empty($tui_goodsCate)){
        	$tui_goodsCate=M('shop_goods_cate')->field('id,classname,pid')->where(array('pid'=>0,'isdel'=>0,'status'=>'0','is_tui'=>'1'))->order('sorts asc')->limit(6)->select();
        	S("tui_goodsCate", $tui_goodsCate, array('expire'=>60*5));
		}
        $this->assign('tui_goodsCate',$tui_goodsCate);
		
//        $banner = M("banner")->select();
//        $this->assign("banner", $banner);
        $this->assign('cateList',$cateList);
    }

    /**
     * 得到头部导航栏的方法
     */
    public function getTopInfo(){
        if($this->user_id){
            $data['id'] 		 = $this->user_info["id"];
            $data['person_name'] = $this->user_info["person_name"];
            $data['cart_nums'] 	 = M("cart")->where(array('user_id'=>$this->user_id))->count();
            $data['telephone'] 	 = $this->user_info["telephone"];
            $data['person_img']  = $this->user_info["person_img"];
            return $data;
        }else{
            return array();
        }
    }

    /*得到sku字符串的方法*/
    public function getSkuDes($skuid){
        if(!$skuid){
            return "";
        }
        $sku_l_m = M("sku_list");
        $sku_a_m = M("sku_attr");
        $skuids  = $sku_l_m->find($skuid);
        if(!$skuids){
            return "";
        }
        $sku_arr = array_filter(explode("-", $skuids['attr_list']));
        $str     = "";
        foreach($sku_arr as $v){
            $sku_info = $sku_a_m->where(array("id"=>$v))->find();
            $sku_pname = $sku_a_m->where(array("id"=>$sku_info['pid']))->getField('classname');
            $str .= $sku_pname.":".$sku_info['classname']."<br>";
        }
        return trim($str, "<br>");
    }

	/**
	 * 检测用户登录的方法
	 */
	public function checkLogin($type=''){
        if($type){
            $type='/type/'.$type;
        }else{
            $type='';
        }
		if($_SESSION['user_id']>0){
			if($this->user_info['status']){
				unset($_SESSION);
				if(IS_AJAX){
					$this->ajaxReturn(array('status'=>0, "info"=>"您未登录！"));
				}
				$this->redirect("Shop/User/login".$type);
			}
		}else{
			if(IS_AJAX){
				$this->ajaxReturn(array('status'=>0, "info"=>"您未登录！"));
			}
			$this->redirect("Shop/User/login".$type);
		}
	}

//	public function error($msg="啊~哦~ 您要查看的页面不存在或已删除！"){
//		$this->assign("error_msg", $msg);
//		$this->display("Public:error");die;
//	}


	public function setSeo($title="",$keywords="",$description=""){

	}

    /**
     * 前台会员日志记录
     * @param $content
     * @return bool
     */
    protected function logs($content)
    {
        if(!$content){
            return false;
        }
        $add = [
            'user_id' => $this->user_info["id"] ? : 0,
            'telephone' => $this->user_info["telephone"] ? : 0,
            'content' => $content,
            'controller' => CONTROLLER_NAME,
            'action' => ACTION_NAME,
            'add_time' => date('Y-m-d H:i:s')
        ];
        M('user_log')->add($add);
        return true;
    }

}