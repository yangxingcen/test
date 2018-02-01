<?php
namespace Wx\Controller;
use Think\Controller;

class PublicController extends Controller {

	public $user_info  = "";
	public $user_id    = "";
	public $model_list = array();

    public function _initialize(){
        #网站配置
        $shop_config = S('shop_config');
        if(!$shop_config){
            $shop_config = M('ShopWebConfig')->find(1);
            S('shop_config',$shop_config,array('expire'=>3600));
        }
        $this->assign('shop_config',$shop_config);


        header("Access-Control-Allow-Origin: *");
        //前台的shopconfig门店设置
        if($invite_code = I("invite_code")){
            $_SESSION['invite_code'] = $invite_code;
        }
        if($_SESSION['wx_user_id']>0){

            $user_info = M("member")->where(array("id"=>$_SESSION['wx_user_id'],"status"=>0, "isdel"=>0))->find();
            if($user_info){
                $this->user_info = $user_info;
                $this->wx_user_id   = $_SESSION['wx_user_id'];
            }else{
                session("wx_user_id", null);
                $this->user_info = "";
                $this->wx_user_id   = "";
            }
            $res = $this->getTopInfo();
            $this->assign("topInfo", $res);
        }

    }

    /**
     * 得到头部导航栏的方法
     */
    public function getTopInfo(){
        if($this->wx_user_id){
            $data['id'] 		 = $this->user_info["id"];
            $data['person_name'] = $this->user_info["person_name"];
            $data['cart_nums'] 	 = M("cart")->where(array('user_id'=>$this->wx_user_id))->count();
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
	public function checkLogin(){
		if($_SESSION['wx_user_id']>0){
			if($this->user_info['status']){
				unset($_SESSION);
				if(IS_AJAX){
					$this->ajaxReturn(array('status'=>0, "info"=>"您未登录！"));
				}
				$this->redirect("Wx/User/login");
			}
		}else{
			if(IS_AJAX){
				$this->ajaxReturn(array('status'=>0, "info"=>"您未登录！"));
			}
			$this->redirect("Wx/User/login");
		}
	}

//	public function error($msg="啊~哦~ 您要查看的页面不存在或已删除！"){
//		$this->assign("error_msg", $msg);
//		$this->display("Public:error");die;
//	}


	public function setSeo($title="",$keywords="",$description=""){

	}

}