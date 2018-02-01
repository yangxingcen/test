<?php
namespace Admin\Model;
use Think\Model;
class ContentModel extends Model{
	public function query($data){
        $res = $this->where($data)->select();
        foreach($res as $k=>$v){
            if($v['pics'])
                $res[$k]['pics']    =   explode(',',$v['pics']);
        }
        return $res;
    }
        //多条查询
    public function querylist($data,$num="10"){
		$res    = $this->where($data)->order('sort asc')->select();
        $count  = count($res);    
        $p = getpage($count, $num);
        $show   = $p->show();
 
        $res = array_slice($res,$p->firstRow,$p->listRows);
  
        foreach($res as $k=>$v){
                if($v['pics'])
                    $res[$k]['pics']    =   explode(',',$v['pics']);
                if($v['cate_id'])
                    $res[$k]['classname']   = $this->where(array('id'=>$v['cate_id']))->getField('title');     
        }
               
        $datainfo   =   array(
            'cache' =>  $res,
            'counts'=>$count,
            'classid'=>$data['classid'],
        );
        if($count > $num){
            $datainfo['page']   =   $show;
        }
            
        return $datainfo;


    }
    //单条查询
    public function queryfind($classid){

        $data['classid']     =   $classid;
        $data['status']      =   1;
		$res = D('content')->query($data);
        $datainfo   =  array(
            'cache' =>  $res,
            'classid'=>$data['classid'],
        ); 
        return $datainfo;
    }
    
    
 }

?>