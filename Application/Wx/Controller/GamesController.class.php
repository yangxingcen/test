<?php
namespace Wx\Controller;
use Think\Controller;
class GamesController extends PublicController {

    public $user_info    = "";
    public function _initialize(){

        $sess_uid=  session('wx_user_id');
        if($sess_uid){
           $user_in= M('member')->where('id='.$sess_uid)->find();
            $this->user_info=$user_in;
        }

    }

	/**20171227wzz
	 * 砸金蛋
	 * */
	public function zajindan()
    {

        //基本信息
          $list_info=M('activity_config')->where('id=2')->find();
            //中奖名单
            $zhongj=M('activity_lottery')->where('type=2 and prize_type !=4')->order('id desc')->select();
                foreach ($zhongj  as $k=>$v){
                    $zhongj[$k]['user']=M('member')->where('id='.$v['uid'])->field('telephone,person_name')->find();
                    $zhongj[$k]['telephone']=substr_replace($zhongj[$k]['user']['telephone'], '****', 3, 5);
                    $zhongj[$k]['person_name']=($zhongj[$k]['user']['person_name']==null)?$zhongj[$k]['user']['telephone']:$zhongj[$k]['user']['person_name'] ;
                }
          $this->assign('list_info',$list_info);
          $this->assign('zhongj',$zhongj);

        $this->display('/Games/zajindan/zajindan');

    }
	/**20171227wzz
	 * 刮刮乐
	 * */
	public function guaguale(){


	    //我的中奖信息
        if($this->user_info['id']!=''){
        $zhongj=M('activity_lottery')->where('type=1 and prize_type !=4 and uid='.$this->user_info['id'])->fetchSql(true)->order('id desc')->select();
        }
        //全部中奖名单
        $zhongj_all=M('activity_lottery')->where('type=1 and prize_type !=4')->order('id desc')->select();
        foreach ($zhongj_all  as $k=>$v){
            $zhongj_all[$k]['user']=M('member')->where('id='.$v['uid'])->field('telephone,person_name')->find();
            $zhongj_all[$k]['telephone']=substr_replace($zhongj_all[$k]['user']['telephone'], '****', 3, 5);
            $zhongj_all[$k]['person_name']=($zhongj_all[$k]['user']['person_name']==null)?$zhongj_all[$k]['user']['telephone']:$zhongj_all[$k]['user']['person_name'] ;
        }
        //配置信息
        $yr=M('activity_config')->where('id=1 ')->find();
        $list_data=unserialize($yr['prize_config']);
        $i=1;
        foreach ($list_data as $k=>$v){
            if($v['type']==3){
                $list_data[$k]['yui']= M('integral_goods')->where('id='.$v['param'])->field('goods_name,logo_pic')->find();
            }
            $list_data[$k]['yu']=$i;
            $i++;
        }
        //抽奖次数
        $chounum=$yr['num'];//抽奖次数
        //抽奖活动参与次数
        $nian=date('Ymd',time());
        $zou=M('activity_lottery')->where("uid=".$this->user_info['id']."  and type=1  and date_format(from_unixtime(addtime),'%Y%m%d')=$nian")->count();

         $jinri=$chounum-$zou;//今日剩余多少


        $this->assign('list_datad',$list_data);
        $this->assign('yr',$yr);
        $this->assign('zhongj',$zhongj);
        $this->assign('jinri',$jinri);
        $this->assign('zhongj_all',$zhongj_all);

		$this->display('/Games/guaguale/guaguale');
	}



	/**20171227wzz
	 * 刮刮乐刮区
	 * */
	public function guaguale_inner(){

		$this->display('/Games/guaguale/guaguale_inner');
	}


	/**20171227wzz
	 * 大转盘
	 * */
	public function dazhuanpan(){
	    //中奖信息
        $zhongj=M('activity_lottery')->where('type=3 and prize_type !=4')->order('id desc')->select();
            foreach ($zhongj as $k=>$v){
                $zhongj[$k]['user']=M('member')->where('id='.$v['uid'])->find();
                $zhongj[$k]['person_imqg']=$zhongj[$k]['user']['person_img'];
                $zhongj[$k]['person_name']=($zhongj[$k]['user']['person_name']==null)?$zhongj[$k]['user']['telephone']:$zhongj[$k]['user']['person_name'] ;
            }
        $list_info=M('activity_config')->where('id=3')->find();
        $describe=$list_info['describe'];
        //活动状态
        $end_timer=date('Y.m.d H:i:s',strtotime($list_info['end_time']));//活动开始时间
        $start_timer=date('Y.m.d H:i:s',strtotime($list_info['start_time']));//活动开始时间
        if($end_timer==$start_timer){
            $start_time=date('Y.m.d H:i:s',strtotime($list_info['start_time']));//活动开始时间
            $end_time=date('H:s',strtotime($list_info['end_time']));//活动开始时间
        }else{
            $start_time=date('Y.m.d H:i:s',strtotime($list_info['start_time']));//活动开始时间
            $end_time=date('Y.m.d H:i:s',strtotime($list_info['end_time']));//活动开始时间
        }

        $list_data=unserialize($list_info['prize_config']);
          $i=1;
        foreach ($list_data as $k=>$v){
                    if($v['type']==3){
                        $list_data[$k]['yui']= M('integral_goods')->where('id='.$v['param'])->field('goods_name,logo_pic')->find();
                    }
            $list_data[$k]['yu']=$i;
                    $i++;
        }

        $this->assign('list_datad',$list_data);
        $this->assign('zhongj',$zhongj);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        $this->assign('describe',$describe);
		$this->display('/Games/dazhuanpan/dazhuanpan');
	}

	/**20171227wzz
	 * 大转盘中奖查询
	 * */
	public function dazhuanpan_inner(){
        $list=M('activity_lottery')->where('type=3 and prize_type !=4 and uid='.$this->user_info['id'])->order('id asc')->select();

        $this->assign('list',$list);

		$this->display('/Games/dazhuanpan/dazhuanpan_inner');
	}

    /*
* 大转盘抽奖
*  $idata['type']=1; 刮刮乐
*  $idata['type']=2; 砸金蛋
*  $idata['type']=3; 大转盘
*/

    public function dazhuanpan_chou(){
        if(IS_POST) {
            D('activity_config')->dazhuanpan_chou();
        }

    }


	/**20171228wzz
	 * 砸金蛋奖品列表
	 * */
	public function zajindanList(){

        $yi=M('activity_config')->where('id=2 ')->find();
        $yi= unserialize($yi['prize_config']);

        foreach ($yi as $k=>$v){
                if($v['type']==3){
                    $yi[$k]['ii']=M('integral_goods')->where('id='.$v['param'])->field('goods_name,logo_pic')->select();
                  }
        }
        $this->assign('yi',$yi);
		$this->display('/Games/zajindan/zajindanList');
	}

	/**20171228wzz
	 * 砸金蛋中奖查询
	 * */
	public function zajindanCheck(){

        $list=M('activity_lottery')->where('type=2 and prize_type !=4 and uid='.$this->user_info['id'])->order('id asc')->select();

        $this->assign('list',$list);

		$this->display('/Games/zajindan/zajindanCheck');
	}

    /*
 * 砸金蛋抽奖
   *  $idata['type']=1; 刮刮乐
   *  $idata['type']=2; 砸金蛋
   *  $idata['type']=3; 大转盘
 */

   public function zajindan_chou(){
            if(IS_POST){
                D('activity_config')->zajindan_chou();
            }
    }

    /*
     * 刮刮乐抽奖
     */

    /*
    * 刮刮乐
    *  $idata['type']=1; 刮刮乐
    *  $idata['type']=2; 砸金蛋
    *  $idata['type']=3; 大转盘
    */

    public function guaguale_chou(){
        if(IS_POST) {
            D('activity_config')->guaguale_chou();
        }

    }

    //填写中奖信息
    public  function  infor(){
        $id=I('get.id');
        if(IS_AJAX) {

            $pst=I("post.");

            $st=M('activity_lottery')->where('id='.$pst['id'])->save($pst);

        }
        $this->assign('id',$id);

        $this->display('/Games/zajindan/infor');
    }

}
