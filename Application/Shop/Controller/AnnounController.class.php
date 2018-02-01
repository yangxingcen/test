<?php
namespace Shop\Controller;
use Think\Controller;
class AnnounController extends PublicController {

	public function announ(){
		$this->assign('header_bot', '1');
		
		$zjwx = M('Announ')->where(array('is_display'=>1,'status'=>1,'cate_id'=>1))->order('addtime desc')->limit(0,3)->select();
		
		foreach($zjwx as $k=>$v){
			$zjwx[$k]['D']	=	 date('d',strtotime($v['addtime']));
			$zjwx[$k]['M']	=	 date('M',strtotime($v['addtime']));
			$zjwx[$k]['Y']	=	 date('Y',strtotime($v['addtime']));
		}		
				
        $this->assign('zjwx', $zjwx);
		
		$this->display();
    }
	public function announ2(){
		$this->assign('header_bot', '1');
				
		$dyxbs = M('Announ')->where(array('is_display'=>1,'status'=>1,'cate_id'=>2))->order('addtime desc')->limit(0,5)->select();

		foreach($dyxbs as $k=>$v){
			$dyxbs[$k]['D']	=	 date('d',strtotime($v['addtime']));
			$dyxbs[$k]['M']	=	 date('M',strtotime($v['addtime']));
			$dyxbs[$k]['Y']	=	 date('Y',strtotime($v['addtime']));
		}
		
        $this->assign('dyxbs', $dyxbs);
		
		$this->display();
    }

	public function announ3(){
		$this->assign('header_bot', '1');
		
	$scgg = M('Announ')->where(array('is_display'=>1,'status'=>1,'cate_id'=>3))->order('addtime desc')->limit(0,5)->select();

		foreach($scgg as $k=>$v){
			$scgg[$k]['D']	=	 date('d',strtotime($v['addtime']));
			$scgg[$k]['M']	=	 date('M',strtotime($v['addtime']));
			$scgg[$k]['Y']	=	 date('Y',strtotime($v['addtime']));
		}
		
        $this->assign('scgg', $scgg);			
		$this->display();
    }  
	
    public function announ_inner(){
		$this->assign('header_bot', '1');
    	$id    =   I('get.id');
    	if($id){
			$m      =  M('Announ');
			$news   =  $m ->find($id); 
			$map['click'] = $news['click']+1;
			$m->where(array('id'=>$id))->field('click')->save($map);			
			$res     =  $m->where(array('status'=>1,'is_display'=>1,'cate_id'=>$news['cate_id']))->order('addtime desc')->select();		
			foreach($res as $k=>$v){
				if($id==$v['id']){
					$getkey = $k;
				}
			}
			$nextid = $res[$getkey+1]['id'];
			$previd = $res[$getkey-1]['id'];			
			$next = $m->where(array('id'=>$nextid))->getField('title');
			if(!$next){
				$next = "none";
			}
			$prev = $m->where(array('id'=>$previd))->getField('title');

			if(!$prev){
				$prev = "none";
			}
			$this->assign('news',$news);
			$this->assign('prev',$prev);
			$this->assign('next',$next);
			$this->assign('previd',$previd);
			$this->assign('nextid',$nextid);  
		}			
		$this->display();
    }
    public function announ_inner2(){
		$this->assign('header_bot', '1');
    	$id    =   I('get.id');
    	if($id){
			$m      =  M('Announ');
			$news   =  $m ->find($id); 
			$map['click'] = $news['click']+1;
			$m->where(array('id'=>$id))->field('click')->save($map);			
			$res     =  $m->where(array('status'=>1,'is_display'=>1,'cate_id'=>$news['cate_id']))->order('addtime desc')->select();		
			foreach($res as $k=>$v){
				if($id==$v['id']){
					$getkey = $k;
				}
			}
			$nextid = $res[$getkey+1]['id'];
			$previd = $res[$getkey-1]['id'];
			
			$next = $m->where(array('id'=>$nextid))->getField('title');
			if(!$next){
				$next = "none";
			}
			$prev = $m->where(array('id'=>$previd))->getField('title');

			if(!$prev){
				$prev = "none";
			}
			$this->assign('news',$news);
			$this->assign('prev',$prev);
			$this->assign('next',$next);
			$this->assign('previd',$previd);
			$this->assign('nextid',$nextid);  
		}			
		
		
	    $this->display();     
    	
    }    
   
	
}
?>