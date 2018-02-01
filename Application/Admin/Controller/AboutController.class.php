<?php
namespace Admin\Controller;
class AboutController extends AdminCommonController {
    public $classid;
    public $action;
    public function _initialize(){
        parent::_initialize();
        $this->classid  =   I('get.classid');
        $this->action   =   I('get.action');
        $this->assign('action',$this->action);
        $left_urlname   =   $this->action;
        if($left_urlname)
        $this->assign('left_urlname',$left_urlname);

    }


    public function first(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  41
        );  
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function second(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  42
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function third(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  43
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
        $this->display();
    }




    public function fourth(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  44
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }


    public function fifth(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  45
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
        $this->display();
    }

    
    public function sixth(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  46
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function seventh(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  47
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    } 
    public function eighth(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  48
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    } 
    public function ninth(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  49
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    } 	
    public function yhzc(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  50
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    } 
    public function dglc(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  51
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function hyzd(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  52
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    //隐私保护政策
	public function priva(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  53
        );
        $res = $this->querylist1("content",$data);
        $this->assign($res);
        $this->display();
    }

    //会员注册协议
    public function hyxy(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  54
        );
        $res = $this->querylist1("content",$data);
        $this->assign($res);
        $this->display();
    }
    //商城使用条款
    public function sytk(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  55
        );
        $res = $this->querylist1("content",$data);
        $this->assign($res);
        $this->display();
    }	
	
	
	
    public function fkfs(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  60
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function psfs(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  61
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }	
    public function yhqs(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  62
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function pswt(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  63
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function psfw(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  64
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }

    public function fwzc(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  65
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function thlc(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  66
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }	
    public function tksm(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  67
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function gkbd(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  68
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function jfjl(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  69
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function gdgg(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  70
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function dhxz(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  71
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }
    public function dhyd(){
        $data   =   array(
            'status'    =>  1,
            'classid'   =>  72
        );    
        $res =  D('content')->querylist($data);
        $this->assign($res);
		$this->display();
    }	
    //content表的添加修改
    public function addeditcontent(){
        $id = I('get.id');
        $res = M('content')->find($id);
        if($id){
            $classid    =   $res['classid'];
        }else{
            $classid    =   $this->classid;
        }
        $categorylist = M('content')->where(array('classid'=>6,'status'=>1))->order('sort asc')->select();

        $this->assign("categorylist", $categorylist);
        $this->assign('classid',$classid);
        $this->assign("cache", $res);
        $this->display();
    }
    public function querylist1($tab,$data,$m_c=""){

        $re    = M($tab)->where($data)->order('sort asc')->select();
        $count  = count($re);
        $p = getpage($count, 10);
        $show   = $p->show();
        $res    = M($tab)->limit($p->firstRow.','.$p->listRows)->where($data)->field("id,classid,title,content")->order('sort asc')->select();
        //$res = array_slice($res,$p->firstRow,$p->listRows);
        if($m_c){
            foreach($res as $k=>$v){
                $res[$k]['classname']   =   M($m_c)->where(array('id'=>$v['cate_id']))->getField('classname');
            }
        }
        foreach($res as $k=>$v) {
            $v["content"] = strip_tags($v["content"]);
            $res[$k]["con"] = str_replace(mb_substr($v["content"], 20), "...", $v["content"]);
        }

        $this->assign('cache',$res);
        if($count > 10)
            $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('cache',$res);
        $this->assign('classid',$data['classid']);
    }
    //删除
    public function delsoftAll(){
        $id = I('post.id');
        $tab = I('post.tab');
        $arr = array_unique(explode('-',(rtrim($id,'-'))));
        $data['id'] = array('in',$arr);
        $del=M("$tab")->where($data)->delete();
        if($del){
            $this->ajaxReturn(array("status"=>1,"info"=>" 删除成功"));
        }else{
            $this->ajaxReturn(array("status"=>0,"info"=>"删除失败"));
        }
    }   

}