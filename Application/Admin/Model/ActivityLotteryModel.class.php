<?php
namespace Admin\Model;
use Think\Model;
class ActivityLotteryModel extends Model
{

    /*
     * 20180106yxc
     * 抽奖列表
     */
    public function lists($map){

        if(IS_POST){


                   $item=I('post.item');

                   $data= I('post.data');
                   $ids= I('post.ids');
                   switch ($item){
                       //更新领取状态
                       case "update":


                           $one=M('activity_lottery')->where('id='.$ids)->setField('status',$data);

                           if($one){
                               $da['status']=1;
                               $da['info']="状态修改成功";
                               echo json_encode($da);
                           }
                           break;
                       case "del":
                           $ids=explode('-',$ids);
                           $ids=array_filter($ids);

                           $one  = M('activity_lottery')->where(array("id"=>array('in',$ids)))->delete();

                           if($one){
                               $da['status']=1;
                               $da['info']="删除成功";
                               echo json_encode($da);

                           }
                           break;


                   }

            exit();
        }


        $count = $this->alias('a')
            ->field('a.*,m.telephone')
            ->join('tb_member as m on m.id=a.uid')
            ->where($map)->count();


//        prize_type
        $Page  = getpage($count, 10);
        $show  = $Page->show();
        $lists =$this->alias('a')
            ->field('a.*,m.telephone')
            ->join(' tb_member as m on a.uid=m.id')
            ->where($map)
        ->order('a.id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();

            if($map['a.type']!=''){
                  $sql= 'a.type='.$map['a.type'];
            }else{
                $sql='';
            }

            //分类总数
        $count12 = $this->alias('a')
            ->field('count(*) as sum,a.prize_type')
            ->group('a.prize_type')
            ->where($sql)->select();


        $arr_Array2 = array_reduce($count12,function(&$arr_Array2,$v){
            $arr_Array2[$v['prize_type']] = $v;
            return $arr_Array2;
        });

        //全部总数
        $count12count = $this->alias('a')
            ->join('tb_member as m on m.id=a.uid')
            ->where($sql)->select();


        return array($count,$lists,$show,$arr_Array2,count($count12count));
    }

}
 ?>