<?php
namespace Admin\Controller;

class NewsController extends AdminCommonController{
	public $classid;
    public $action;
    public $idd;
    public function _initialize(){
        parent::_initialize();
        $this->classid  =   I('get.classid');
        $this->idd     =   I('get.id');
        $this->assign('idd',$this->idd);
        $this->action  =   I('get.action');
        $this->assign('action',$this->action);
	}
    /**
     * 新闻分类列表
     */
    public function cateList(){
        $m   = M("announ_cate");
        $count = $m->count();    //总数
        $res = $m->where(array("pid"=>0,'status'=>1))->order("sort asc")->select();           
        foreach($res as $k=>$v){
            $res[$k]["data"] = $m->where(array("pid"=>$v['id'],'status'=>1))->order("sort asc")->select();
        }
        $this->assign("cache", $res);
        $this->display();
    }
    public function addeditcate(){
        $m = M("announ_cate");
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
    /**
     * 增加新闻分类
     */
    public function addCate(){
        if(IS_AJAX){
            $classname      = I("post.classname");
            $en_classname     = I("post.en_classname");
            $englishname  = I("post.englishname");
            $pid          = I("post.fid");
            $pic          = I("post.pic");
            $pic1           = I("post.pic1");
            $pic2         = I("post.pic2");
            $color        = I("post.color");
            $sort           = I("post.sort");
            $is_recommend   = I("post.is_recommend");
            if(!$is_recommend){
                $is_recommend = 0;
            }
            $describe      = I("post.describe");
            $describe2      = I("post.describe2");
            $m = M("announ_cate");
            $res = $m->where(array("classname"=>$classname, "pid"=>$pid, "isdel"=>0))->find();
            if($res){
                $this->ajaxReturn(array("status"=>0, "info"=>"类名已存在！"));
            }

            $data['classname']      = $classname;
            $data['en_classname']   = $en_classname;
            $data['is_recommend']   = $is_recommend;
            $data['englishname']    = $englishname;
            $data['describe']       = $describe;
            $data['pid']          = $pid;
            $data['sort']         = $sort;
            $data['pic']            = $pic;
            $data['pic1']           = $pic1;
            $data['pic2']         = $pic2;
            $data['color']      = $color;
            $data['create_at']    = time();
            $res = $m->add($data);
            if($res){
                $this->ajaxReturn(array("status"=>1, "info"=>"增加成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"新增失败！"));
            }
        }
    }

     /**
     * 删除产品分类
     */
    public function delCate(){
        $id = I("id");
        $m  = M("announ_cate");
        $data = $m->find($id);
        if(!$data){
            $this->error("分类不存在!");
            die;
        }
        if($data['pid']!=0){
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
     * 编辑新闻分类
     */
    public function editCate(){

        if(IS_AJAX){

            $id        = I("post.categoryid");
            $classname = I("post.classname");
            $en_classname = I("post.en_classname");
            $englishname = I("post.englishname");
            $is_recommend = I("post.is_recommend");
            $pid       = I("post.fid");
            $pic       = I("post.pic");
            $pic1       = I("post.pic1");
            $pic2       = I("post.pic2");
            $color       = I("post.color");
            $sort        = I("post.sort");
            $describe      = I("post.describe");
            $describe2      = I("post.describe2");
            $m = M("announ_cate");
            $map = array(
                "classname"     => $classname,
                "en_classname"  => $en_classname,
                "describe"      => $describe,
                "pid"           => $pid,
                "id"            => array("neq", $id),
                "isdel"         => 0,
            );
            $res = $m->where($map)->find();
            if($res){
                $this->ajaxReturn(array("status"=>0, "info"=>"类名已存在！"));
            }
            $parid = $m->where(array("id"=>$id, "isdel"=>0))->getField("pid");

            if($parid == 0 && $pid != 0){
                $this->ajaxReturn(array("status"=>0, "info"=>"顶级分类无法改变分类！"));
            }

            $data['classname']      = $classname;
            $data['en_classname']   = $en_classname;
            $data['englishname']    = $englishname;
            $data['pid']            = $pid;
            $data['color']          = $color;
            $data['sort']           = $sort;
            $data['describe1']      = $describe1;
            $data['describe2']      = $describe2;
            $data['pic']            = $pic;
            $data['pic1']           = $pic1;
            $data['pic2']           = $pic2;
            $data['is_recommend']   = $is_recommend;
            $data['describe']       = $describe;
            if(!$is_recommend){
                $data['is_recommend'] = 0 ;
            }
            if($pic==""){
                unset($data['pic']);
            }
            if($pic1==""){
                unset($data['pic1']);
            }
            if($pic2==""){
                unset($data['pic2']);
            }
            $res = $m->where(array('id'=>$id))->save($data);
            if($res !== false){
                $this->ajaxReturn(array("status"=>1, "info"=>"修改成功！"));
            }else{
                $this->ajaxReturn(array("status"=>0, "info"=>"修改失败！"));
            }
        }
    }



   //主页显示
   public function index(){
        $title = I('get.name');
		$pid   = I('get.cate_id');
        
     
		if($pid){
			 $sql['cate_id'] = $pid;
		}	
        if($title){
                $type   =   I('get.type');
                /* if(!$type)
                    $title      = iconv('GB2312', 'UTF-8', $title); //服务器需转码
                */
                $sql['title'] = array('like',"%$title%");
        }

		$this->assign('name',$title);
		$this->assign('pid',$pid);
		$count=M('Announ')->where($sql)->count();
		$Page  = getpage($count,10);
		$show  = $Page->show();//分页显示输出
		$news = M('Announ')->where($sql)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc, id asc')->select();
					
		foreach($news as $k=>$v){
			$cate = M('announ_cate')->where(array('id'=>$v['cate_id']))->find();
			$news[$k]['classname'] = $cate['classname'];
		}
		$c = M('announ_cate');
		$categorylist = $c->where(array("pid"=>0))->order('sort asc,id asc')->select();
		$this->assign("page",$show);
		$this->assign('categorylist',$categorylist);
		$this->assign('news',$news);
		$this->assign('counts',$count);
		$this->display();
   }

   //新闻修改
   public function addeditNews(){
 
      $id = I('get.id');
      $cache = M('Announ')->find($id);
  
      $c = M("announ_cate");
     
      $categorylist = $c->where(array("pid"=>0))->order('sort asc,id asc')->select();
      $en_classname = $c->where(array('id'=>$cache['cate_id']))->find();
      $cache['classname'] = $en_classname['classname'];
      $this->assign("cache", $cache);
      $this->assign("categorylist", $categorylist);
      $this->display();
      


   }
   
   public function newsimg(){
        $news_id = I('get.news_id');
        $this->assign('news_id',$news_id);
        $m = M('news_img');
        $res = $m->where(array('news_id'=>$news_id))->order('sort asc,id desc')->select();
        $this->assign('cache',$res);
        $this->display();
    }

    public function addnewsimg(){
        if(IS_POST){
            $news_id = I('post.news_id'); 
            $pic = I('post.pic');
            $en_title = I('post.en_title');
            $sort = I('post.sort');

            $data['news_id'] = $news_id;
            $data['pic'] = $pic;
            $data['en_title'] = $en_title;
            $data['sort'] = $sort;
            $data['is_display'] =I('post.is_display');;
            if(!$sort){
                $data['sort'] = 0;
            }
            if(!$data['is_display']){
                $data['is_display'] = 1;
            }
            if(!$news_id){
               $this->error("缺少参数！");
            }
            if(!$pic){
                $this->error("缺少图片！");
            }
            $m = M('news_img');
            $sele  = $m->where(array('news_id'=>$news_id,'sort'=>$data['sort']))->find();
            if($sele){
                if($id!=$sele['id']){
                    $m->where(array('sort'=>array('gt',$data['sort']-1)))->setInc('sort'); 
                }
            }
      
            $res = $m->add($data);
            if($res){
                $this->success("添加成功！",U('Admin/News/newsimg/news_id/'.$data['news_id']));exit;
            }else{

                $this->error("添加失败！");
            }
 
        }else{
          $m = M('news_img');
          $news_id = I('get.news_id');
          $this->assign('news_id',$news_id);
          $this->display();
        }

   
    
    }

    public function editnewsimg(){
        if(IS_POST){
            $news_id = I('post.news_id'); 
            $id = I('post.id'); 
            $pic = I('post.pic');
            $en_title = I('post.en_title');
            $sort = I('post.sort');
            $data['news_id'] = $news_id;
            $data['pic'] = $pic;
            $data['en_title'] = $en_title;
            $data['sort'] = $sort;
            $data['id'] = $id;
            $data['is_display'] =I('post.is_display');;
            if(!$sort){
                $data['sort'] = 0;
            }
            if(!$data['is_display']){
                $data['is_display'] = 1;
            }
            if(!$news_id){
               $this->error("缺少参数！");
            }
            if(!$pic){
                unset($data['pic']);
            }
            $m = M('news_img');
            $sele  = $m->where(array('news_id'=>$news_id,'sort'=>$data['sort']))->find();
            if($sele){
                if($id!=$sele['id']){
                    $m->where(array('sort'=>array('gt',$data['sort']-1)))->setInc('sort'); 
                }
            }
      
            $res = $m->save($data);
            if($res){
                $this->success("修改成功！",U('Admin/News/newsimg/news_id/'.$data['news_id']));exit;
            }else{

                $this->error("修改失败！");
            }
 
  
        }else{
          $m = M('news_img');
          $id = I('get.id');
          $res = $m->find($id);
          $this->assign('cache',$res);
          $this->display();
        }

   
    
    }
   /**
     * 新闻详情列表
     */
    public function newsdetail(){
        $m = M('news_detail');
        $news_id = I('get.news_id');
        if(!$news_id){
            $this->error("缺少参数！");
        }
        $res = $m->where(array('news_id'=>$news_id))->order('sort asc')->select();
        $this->assign("cache", $res);
        $this->display();
    }

    /**
     * 编辑新闻详情
     */
    public function editnewsdetail(){
        $m = M("news_detail");
        if(IS_POST){
            $id = I('post.id');
            if(!$id){
                $this->error("缺少参数！");
            }
            $news_id = I('post.news_id');
            if(!$news_id){
            $this->error("缺少参数！");
            }
            $data = I("post.");
            foreach($data as $k=>$v){
                if($v == null){
                    unset($data[$k]);
                }
            }
            $res = $m->where(array('id'=>$id))->save($data);
            if(!$res){
                 $this->error("修改失败！");
            }else{
                $this->success("修改成功！",U('Admin/News/newsdetail/news_id/'.$data['news_id']));exit;
            }
        }
        $id = I("id");
        if(!$id){
            $this->error("缺少参数！");
        }
        $res = $m->where(array('id'=>$id))->find();

        $this->assign("cache", $res);
        $this->display();
    }
 
  /**
     * 编辑新闻详情
     */
    public function addnewsdetail(){
        $m = M("news_detail");
        if(IS_POST){
           
            $news_id = I('post.news_id');
            if(!$news_id){
            $this->error("缺少参数！");
            }
            $data = I("post.");
            foreach($data as $k=>$v){
                if($v == null){
                    unset($data[$k]);
                }
            }
            $res = $m->add($data);
            if(!$res){
                 $this->error("添加失败！");
            }else{
                $this->success("添加成功！",U('Admin/News/newsdetail/news_id/'.$data['news_id']));exit;
            }
        }
        $id = I("id");
     
        $news_id = I('get.news_id');
        $this->assign("news_id", $news_id);
        $this->display();
    }
 
}
