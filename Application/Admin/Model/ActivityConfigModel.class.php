<?php
namespace Admin\Model;
use Think\Model;
class ActivityConfigModel extends Model
{
    public function activityConfigInfo(){
        if(IS_POST){
            $data = I('post.');
            $data['update_time']=date('Y-m-d H:i:s');
            $time=explode(' To ',$data['time']);
            $data['start_time']=$time[0];
            $data['end_time']=$time[1];
            $res = $this->save($data);
            if($res){
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(0,'失败');
            }
        }
    }

/*
 * 奖品配置
 */
    public function activityConfigInfo_prize(){
        $percent = I('post.percent');//中奖百分比
        $zhongj=array_sum($percent);
        //中奖百分比
        if($zhongj!=100){
            ajaxReturn('','百分比总和只能:100,目前百分比:'.$zhongj);
        }


        $param   = I('post.param');//参数//中奖百分比
        $type    = I('post.type');//奖品类型
        $id    = I('post.id');
        $jiang_id    = I('post.jiang_id');

        $i=0;
        $arr=array(array());
        $arr=array_filter($arr);//去除空数组
        $time=time();

        foreach($percent as $k=>$v) {
            $arr[] = array('percent' => $v, 'type' => $type[$i], 'param' => $param[$i], 'pid' =>$id, 'addtime' =>$time, 'jiang_id' =>$jiang_id[$i]);
            $i=$i+1;
        }
        $arr=serialize($arr);
        if(IS_POST){

                $one  = M('activity_config')->where('id='.$id)->setField('prize_config',$arr);

            if($one){
                ajaxReturn(1,'成功');
            }else{
                ajaxReturn(0,'失败');
            }

            }




    }

    //删除奖品配置
    public  function  activityConfigInfo_prize_del(){
        $id = I('post.id');
        $one  = M('activity_config')->where('id='.$id)->setField('prize_config',null);
        if($one){
            ajaxReturn(1,'成功');
        }else{
            ajaxReturn(0,'失败');
        }

    }

}
 ?>