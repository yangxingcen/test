<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class AdminCommonController extends CommonController
{
    public function _initialize(){
        //判断用户是否已经登录
        $uid =$_SESSION['admin_id'] ;
        if(!$uid){
            $this->redirect('/Admin/User/login');
        }
        $this->getAccess($_SESSION['admin_id']);
        $this->checkAuth();
        $this->showNodeList();
        $this->assign("HOST", C("HOST"));
        $this->setSeo();
    }

//===============================权限节点 1======================================================
    /**wzz 20170415
     * 获取当前用户的权限节点
     * @param  $uid     管理员ID
     * @return $module  权限节点ID
     */
    public function getAccess($uid){

        $cate = M("shop_user")->where(array('id'=>$uid))->getField('cate');
        $_SESSION['access'] =M('shop_admin_cate')->where(array('id'=>$cate))->getField('module');

    }


    /**wzz 20170415
     * 获取头部导航/左侧导航栏/
     */
    public function showNodeList(){
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name     = strtolower(ACTION_NAME);
        ##输出顶部导航
        $access = $_SESSION['access'];
        $m = M("shop_admin_node");
        $map = array(
            'level'  => 1,
            'is_del' => 0,
            'id'     => array("in", $access),
        );
        $node_head_list = $m->where($map)->order("sorts asc")->select();
        $this->assign("node_head_list", $node_head_list);
        ##输出左侧导航
        $map = array(
            'controller' => $controller_name,
            'action'     => $action_name,
            'is_del'     => 0,
        );
        $q = $m->where($map)->order("level desc")->find();

        $map = array(
            'id' => array("in",$access)
        );
        switch($q['level']){
            case "1":
                $map["pid"] = $q['id'];
                break;
            case "3":
                $map["pid"] = $q['pid2'];
                break;
            case "4":
                $map["pid"] = $q['pid3'];
                break;
            default:
                die("no access");
        }
        $left = $m->where($map)->order("sorts asc")->select();
        foreach($left as $k=>$v){
            $map_res = array(
                'id'        => array("in",$access),
                'pid'       => $v['id'],
                'is_del'    => 0,
            );
            $nodes= $m->field('id,controller,action,classname')->where($map_res)->order("sorts asc")->select();
            foreach($nodes as $kk =>$vv){
                $nodes[$kk]['left_menu'] =$vv['controller'].$vv['action'];
            }
            $left[$k]['nodes'] =$nodes;
        }
        $this->assign("node_left_list", $left);
    }

    /*wzz 20170415
     * 检查管理员操作权限，由当前控制器和方法 输出左侧的urlname
     */
    public function checkAuth(){

        $m = M("shop_admin_node");
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name     = strtolower(ACTION_NAME);
        $access          = $_SESSION['access'];
        $map = array(
            'id'            => array("in", $access),
            'level'         => 4,
            'controller'    => $controller_name,
            'action'        => $action_name,
            'is_del'        => 0,
        );
        $res = $m->where($map)->order("level desc")->find();

//        $res = $m->where($map)->order("level desc")->fetchsql(true)->find();
//        var_dump($res);
//        die();
        $this->assign('head_id',$res['pid3']);
        $this->assign('left_id',$res['pid']);


        if(!$res){

            if(IS_AJAX){
                $this->ajaxReturn(array('status'=>0,"info"=>"您没有此操作权限"));
            }else{

                die("no access!");
            }
        }
    }
//===============================权限节点 2======================================================





    /**20171226wzz
     * 单个/批量更新状态
     * tab     操作表名(去除前缀)
     * id      操作对象(多个id时使用英文逗号拼接)  id
     * item    操作项(对应数据库字段名 字段值为0，1)     is_del status
     * value   操作项的值(对应字段值为0/1)
     */
    public function changeStatusCom(){
        if(IS_AJAX){
            $tab   = I("post.tab");
            $ids   = I("post.ids");
            $item  = I("post.item");
            $value = I("post.value");
            if(in_array($item,array('is_del','status')) && in_array($value,array('0','1'))){
                if($tab && $ids){
                    $m     = M($tab);
                    $idArr = array_filter(explode(',',$ids));
                    $res2  = $m->where(array("id"=>array('in',$idArr)))->setField($item, 1-intval($value));
                    if($res2!=false){ajaxReturn(1,'操作成功');}
                }
            }
            ajaxReturn(0,'操作失败');
        }
        $this->error();
    }

	//上下移
	public function updown(){
	  if(IS_AJAX){
            
            $id    = I('post.id');
            $num   = I('post.num');
            $pid   = I('post.pid');
            $tab   = I('post.tab');
            $title = I('post.title');
            $val = I('post.val');
            $pname = I('post.pname');
            $sort = I('post.sort');
            $classid = I('post.classid');
            // $ctab = I('post.ctab');
   
            if($classid){
                $data['classid'] = $classid;
            }

            if(!$sort){
                $sort = 'sort';
            }
            // $res   = $this->getupdown($tab,'sort',$id,$num,'goods_name',$title,$pid,'cate_id');
            
  
			$m = M($tab);
			$c = M($ctab);
			if($num == 1){//上移
				$unum = -1;
			}	
			if($num == 2){//下移
				$unum = 1;
			}
			
			$news = $m->find($id);
            // $cate = $c->find($pid);
			$oldsort = $news[$sort];//原排序号
			if($val){
				$data[$title] =array('like',"%$val%");
			}
			if($pid != null){
       
				$data[$pname] = $pid;			
			}
			if($cate_id  != null){
				$data['cate_id'] = $cate_id;
			}
		
			$res  = $m->where($data)->order($sort.' asc')->select();
		
			$count  = $m->where($data)->count();
			
			foreach($res as $k=>$v){
				if($res[$k]['id']==$id){
					$sum = $k + $unum;
				}				
			}
			$newsort = $res[$sum][$sort];//新排序号
		
			if($sum<0){
                 $this->ajaxReturn(array('status'=>0, 'info'=>'不能再上移了' ));
			}
			if($sum>=$count){
                 $this->ajaxReturn(array('status'=>0, 'info'=>'不能再下移了' ));
			}
			$data[$sort] = $newsort;
			$upnews = $m->where($data)->find();
			$upid   = $upnews['id'];

			$res1   = $m->where(array('id'=>$id))->save(array('sort'=>$newsort));
			$res2   = $m->where(array('id'=>$upid))->save(array('sort'=>$oldsort));
			
		
        if($res1&&$res2){
                $this->ajaxReturn(array('status'=>1, 'info'=>'移动成功'));
            }else{
                $this->ajaxReturn(array('status'=>0, 'info'=>'移动失败' ));
            }
        }
	}
	
    //转移分类
	public function change(){
			if(IS_AJAX){
            $ids   =   I('post.ids');
            $pid   =   I('post.pid');
            $tab   =   I('post.tab');
            $pname =   I('post.pname');
            $classid = I('post.classid');

            if(!$ids){
                $this->ajaxReturn(array('status'=>0, 'info'=>'请选择数据！'));
            }
			if($pid=='-请选择分类-'||$pid==''){
				$this->ajaxReturn(array('status'=>0, 'info'=>'请选择分类！'));
			}
            if($classid){
                $data['classid'] = $classid;
            }
			
			$arrr = array_unique(explode('-',($ids)));
		    
			$data[$pname] = $pid;
		
			$data['id'] = array('in',$arrr);
			$res = M($tab)->save($data);
			
			if($res){
				$this->ajaxReturn(array('status'=>1, 'info'=>'转移成功'));
			}else{
				$this->ajaxReturn(array('status'=>0, 'info'=>'转移失败'));
			}
         }
	}
	
      /**
     * 删除
     */
    public function delAll(){
        if(IS_AJAX){
            $ids = I('post.id');
            $tab = I('post.tab');
            $url = I('post.url');
        
            $arr = array_unique(explode('-',($ids)));
            if(!$ids){
                $this->ajaxReturn(array("status"=>0,"info"=>"请选择要删除的数据"));
            }
            $data['id'] = array('in',$arr);

            $del = M($tab)->where($data)->delete();

            if($del){
                $this->ajaxReturn(array("status"=>1,"info"=>" 删除成功","url"=>U($url)));
            }else{
                $this->ajaxReturn(array("status"=>0,"info"=>" 删除失败"));
            }
        }
    }

        /**
     * 修改部分状态
     */
    public function changeStatus(){
        if(IS_AJAX){
            $id   = I("post.id");
            $item = I("post.item");
            $tab  = I("post.tab");
            $m    = M($tab);
            $res  = $m->where(array("id"=>$id))->find();
            if(!$res){
                $this->ajaxReturn(array("status"=>0 ,"info"=>"修改失败！"));
            }
            $res2 = $m->where(array("id"=>$id))->setField($item, 1-intval($res[$item]));/*array('$item'=>'ThinkPHP','email'=>'ThinkPHP@gmail.com');*/

            if($res2){
                $arr = array(1,2);
                $this->ajaxReturn(array("status"=>$arr[$res[$item]]));
            }
            $this->ajaxReturn(array("status"=>0 ,"info"=> "修改失败！"));
        }
    }


   //表的添加
   function getcontentadd(){
        if(IS_AJAX){
            $data  =  I('post.');
            $tab   =  $data['tab'];
            $url   =  $data['url'];
			$m     =  M($tab);
			
            unset($data['tab']);
            unset($data['url']);
            foreach($data as $k=>$v){
                if($v == null){
                    unset($data[$k]);
                }     
				$data[$k]	=	trim(stripslashes(htmlspecialchars_decode($v)));
            }
            if(!$data['sort']){
                $sort   =   $m->max('sort');
                $data['sort'] = $sort+1;
            }

			if($data['is_display']==null){
                $data['is_display'] = 1;
            }
			if($data['status']==null){
                $data['status'] = 1;
            }
          	$map = array(
				'classid' => $data['classid'],
				'sort'    => $data['sort'],
			);
			foreach($map as $k=>$v){
                if($v == null){
                    unset($map[$k]);
                }
            }
            $sele  =  $m->where($map)->find();
			$map1 = array(
				'classid' => $data['classid'],
				'sort'    => array('gt',$data['sort']-1),
			);
			foreach($map1 as $k=>$v){
                if($v == null){
                    unset($map1[$k]);
                }
            }
            if($sele){
                $m->where($map1)->setInc('sort'); 
            }
            $res   =  $m->add($data);
            if($res){
                $this->ajaxReturn(array("status"=>1,"info"=>" 添加成功！","url"=>U($url))); 
            }else{
                $this->ajaxReturn(array("status"=>0 ,"info"=> "添加失败！"));
            }

        }    
   }

   //表的修改
   function getcontentedit(){
        if(IS_AJAX){
            $data  =  	I('post.');
            $tab   =  	$data['tab'];
            $url   =  	$data['url'];
            unset($data['tab']);
            unset($data['url']);
            $m     =  	M($tab);
			$cache =	$m->find($data['id']);	
            foreach($data as $k=>$v){
                if($v == null&&$cache[$k] == null){
                    unset($data[$k]);
                }
				$data[$k]	=	trim(stripslashes(htmlspecialchars_decode($v)));
            }
            if(!$data['id']){
                $this->error('缺少参数');
            }
			$map = array(
				'classid' => $data['classid'],
				'id'      => array('neq',$data['id']),
				'sort'    => $data['sort'],
			);
			foreach($map as $k=>$v){
                if($v == null){
                    unset($map[$k]);
                }
            }
            $sele  =  $m->where($map)->find();
			$map1 = array(
				'classid' => $data['classid'],
				'sort'    => array('gt',$data['sort']-1),
			);
			foreach($map1 as $k=>$v){
                if($v == null){
                    unset($map1[$k]);
                }
            }
		
            if($sele){
                $m->where($map1)->setInc('sort'); 
            }
            $res  =  $m->save($data);
            $check  =   $m->where($data)->find();
            if($check){
                $this->ajaxReturn(array("status"=>1,"info"=>" 修改成功！","url"=>U($url))); 
            }
            if($res){
                $this->ajaxReturn(array("status"=>1,"info"=>" 修改成功！","url"=>U($url))); 
            }else{
                $this->ajaxReturn(array("status"=>0 ,"info"=> "修改失败！"));
            }

        }
   }

       /**
     * 软删除
     */
    public function delsoftAll(){
        if(IS_AJAX){
            $ids = I('post.id');
            $tab = I('post.tab');
            $url = I('post.url');
            $status = I('post.status');
			if($status==null){
				$status = "status";
			}
            $arr = array_unique(explode('-',($ids)));
            if(!$ids){
                $this->ajaxReturn(array("status"=>0,"info"=>"请选择要删除的数据"));
            }
            $map['id'] = array('in',$arr);
            $data[$status] = 0;
            $del = M($tab)->where($map)->save($data);

            if($del){
                $this->ajaxReturn(array("status"=>1,"info"=>" 删除成功","url"=>U($url)));
            }else{
                $this->ajaxReturn(array("status"=>0,"info"=>"删除失败"));
            }
        }
    }

    public function setSeo($title="",$keywords="",$description="")
    {   // 得到商城SEO配置
        $shop_seo = S("shop_seo");
        if(empty($shop_seo))
        {
            $shop_seo = M('shop_web_config')->find(1);
            S("shop_seo", $shop_seo, array('expire'=>24*60*60));
        } elseif ($shop_seo != M('shop_web_config')->find(1)){
            $shop_seo = M('shop_web_config')->find(1);
            S("shop_seo", $shop_seo, array('expire'=>24*60*60));
        }
        $shop_seo['title'] = $title?$title:$shop_seo['seo_title'];
        $shop_seo['keywords'] = $keywords?$keywords:$shop_seo['seo_keywords'];
        $shop_seo['description'] = $description?$description:$shop_seo['seo_description'];
        $this->assign("shop_seo_config", $shop_seo);
    }

    /**
     * 后台管理员日志记录
     * @param $content
     * @return bool
     */
    protected function logs($content)
    {
        if(!$content){
            return false;
        }
        $add = [
            'account' => session('admin'),
            'content' => $content,
            'add_time' => date('Y-m-d H:i:s')
        ];
        M('admin_log')->add($add);
        return true;
    }

}