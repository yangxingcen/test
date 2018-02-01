<?php
namespace Common\Model;
use Think\Model;
class MemberModel extends Model
{
    public function getMemberList()
    {
        #手机号 昵称
        $keyword = I('get.keyword','','trim');
        if($keyword){
            $map['telephone|person_name']=array('like', $keyword."%");
        }
        #id
        $id = I('get.id','','trim');
        if($id){
            $map['id']=$id;
        }

        $count = $this->where($map)->count();
        $Page  = getpage($count,5);
        $show  = $Page->show();
        $lists = $this->where($map)->order('id DESC')->limit($Page->firstRow, $Page->listRows)->select();

        return array($count,$lists,$show);


    }

}

?>