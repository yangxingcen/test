<?php
namespace Admin\Model;
use Think\Model;
class SignConfigModel extends Model{

	public function query($id){


	    if($id==1){
        $start_day=I('post.start_day');
        $end_day=I('post.end_day');
        $give_integral=I('post.give_integral');
        $i=0;
        $arr=array(array());
        $arr=array_filter($arr);//去除空数组
        foreach($start_day as $k=>$v) {
            $arr[] = array('start_day' => $v, 'end_day' => $end_day[$i], 'give_integral' => $give_integral[$i]);
            $i=$i+1;
        }
        $data=serialize($arr);

        $into['addtime']=date('Y-m-d H:i:s',time());
        $into['sign_config']=$data;
        $one= M('sign_config')->where('id='.$id)->setField($into);


        if($one){

            $datas['status']=1;
            $datas['info']="修改成功";

            echo  json_encode($datas);
        }

    }else{

            $start_day=I('post.continuity');

            $give_integral=I('post.give_integral');
            $i=0;
            $arr=array(array());
            $arr=array_filter($arr);//去除空数组
            foreach($start_day as $k=>$v) {
                $arr[] = array('continuity' => $v, 'give_integral' => $give_integral[$i]);
                $i=$i+1;
            }
            $data=serialize($arr);

            $into['addtime']=date('Y-m-d H:i:s',time());
            $into['sign_config']=$data;
            $one= M('sign_config')->where('id='.$id)->setField($into);

            if($one){

                $datas['status']=1;
                $datas['info']="修改成功";

                echo  json_encode($datas);
            }
        }
    }

    
    
 }

?>