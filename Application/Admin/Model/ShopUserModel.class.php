<?php
namespace Admin\Model;
use Think\Model;
class ShopUserModel extends Model
{
    /**20171212wzz
     * 管理员列表
     * */
    public function user_list()
    {
        return $this->field('id,username,cate,is_open')->where('id!=1')->select();
    }

    /**20171212wzz
     * 登录
     * */
    function login()
    {
        if (isset($_POST['username'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $userInfo = $this->where(array('username' => $username))->find();
            if ($userInfo) {
                $r = encrypt_pass($password);
                if (!$r) {
                    return 0; // 用户名密码错误
                } else {
                    if ($userInfo['is_open'] == 1) {
                        $_SESSION['admin'] = $userInfo['username'];
                        $_SESSION['admin_id'] = $userInfo['id'];
                        $data_log = array(
                            'last_login' => date("Y-m-d H:i:s",time()),
                            'login_num' =>$userInfo['login_num']+1,
                        );
                        M('shop_user')->where(array('id' => $userInfo['id']))->save($data_log);

                        //记录登录日志
                        $ipres   = GetIpLookup();
                        $data =array(
                            'admin_id'  =>$userInfo['id'],
                            'add_time'  =>date("Y-m-d H:i:s",time()),
                            'ip'        =>$ipres['ip'],
                            'country'   =>$ipres['country'],
                            'province'  =>$ipres['province'],
                            'city'      =>$ipres['city'],
                        );
                        M("shop_login_log")->add($data);
                        $this->logs($username,'登陆后台 成功');
                        ajaxReturn(1,'登陆成功',U('Admin/Index/index'));
                    } else {
                        ajaxReturn(0,'帐号被禁用');
                    }
                }
            } else {
                $this->logs($username,'登陆后台 失败');
                ajaxReturn(0,'用户名密码错误');
            }
        }
    }

    /**
     * 单独处理登陆日志
     * @param $account
     * @param $content
     */
    protected function logs($account,$content)
    {
        $add = [
            'account' => $account,
            'content' => $content,
            'add_time' => date('Y-m-d H:i:s')
        ];
        M('admin_log')->add($add);
    }

    /**20171213wzz
     * 添加/编辑管理员
     * */
    public function addAdmin()
    {
        if(IS_POST){
            $id         = I('post.id','','intval');
            $username   = I('post.username','','trim');
            $password   = I('post.password','','trim');
            $cate       = I('post.cate','','intval');
            $data=array(
                'id'        => $id,
                "username"  => $username,
                "password"  => encrypt_pass($password),
                "cate"      => $cate,
            );
            if($id)
            {#编辑
                $rs = $this->where(array('username' =>$username,'id'=>array('neq',$id)))->count();
            }else{#添加
                $rs = $this->where(array('username' =>$username))->count();
            }
            if($rs){
                ajaxReturn(0,'账号已存在');
            }else{
                if($id){#编辑
                    $data['edit_time']  = date("Y-m-d H:i:s");
                    $r ='编辑';
                    $res = $this->save($data);
                }else{#添加
                    $data['add_time']   = date("Y-m-d H:i:s");
                    $data['edit_time']  = date("Y-m-d H:i:s");
                    $data['is_open']    =  0;
                    $r ='添加';
                    $res = $this->data($data)->add();
                }
                if($res!=false)
                {
                    ajaxReturn(1,$r.'成功');
                }else{
                    ajaxReturn(0,$r.'失败');
                }
            }
        }
        ajaxReturn(0,'未知错误');
    }

    /**20171213wzz
     * 启用/禁用/删除 管理员
     * */
    public function ableDelAdmin()
    {
        if(IS_POST){
            $id = I("post.id",'','intval');
            $item = I("post.item",'','trim');
            check_data(I('post.'),array('id','item'));
            $info  =$this->find($id);
            if($info){
                switch($item){
                    case 'is_open':
                        $res = $this->where(array('id'=>$id))->setField('is_open',1-$info['is_open']);
                        $t = '更新';
                        break;

                    case 'is_del':
                        $res = $this->where(array('id'=>$id))->setField('is_del',1);
                        $t = '删除';
                        break;
                    default:
                        ajaxReturn(0,'未知错误');
                        break;
                }
                if($res!=false){
                    ajaxReturn(1,$t.'成功');
                }else{
                    ajaxReturn(0,$t.'失败');
                }
            }
            ajaxReturn(0,'未知错误');
        }
    }
}
 ?>