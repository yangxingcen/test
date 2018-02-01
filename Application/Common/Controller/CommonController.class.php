<?php
namespace Common\Controller;
use Think\Controller;
class CommonController extends Controller
{


    /**20171213wzz
     * 上传图片
     * */
    public function addImage(){
        $type = I("get.type","","trim");
        $result = $this->uploadImg($type);
        $this->ajaxReturn($result);
    }


    /**20171213wzz
     * 上传图片
     * 在下面配置图片文件夹
     */
    private function uploadImg($type="")
    {   switch ($type){
            case "1":   #商城配置
                $filePath = "ShopImg";
            break;
            case "2":   #积分商品图片
                $filePath = "IntegralImg";
            break;
            case "3":   #商品图片
                $filePath = "GoodsImg";
            break;
            case "4":   #广告图片
                $filePath = "BannerImg";
            break;
            case "5":   #商品分类图片
                $filePath = "GoodsCateImg";
            break;
            default:
                $filePath="Img";
                break;
        }

        $upload = new \Think\UploadFile;
        $upload->maxSize    = 51200000 ;                                         #设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','svg');         #设置附件上传类型
        $savepath='./Uploads/'.$filePath.'/'.date('Ymd').'/';
        if (!file_exists($savepath))
            mkdir($savepath);
        $upload->savePath =  $savepath;                                         #设置附件上传目录
        if(!$upload->upload()){                                                 #上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{                                                                  #上传成功 获取上传文件信息
            $info       = $upload->getUploadFileInfo();
             $image      = new \Think\Image;                                     #居中裁剪
             $url        = $info[0]['savepath'].$info[0]['savename'];            #保存到本地图片的路径
             $image->open($url);
             $width      = $image->width();                                      #返回图片的宽度
             $height     = $image->height();                                     #返回图片的高度
             $savename   = date('YmdHis').rand(10000,99999).'.png';              #图片名称
             $image->thumb($width, $height)->save($savepath.$savename);          #生成缩略图图片
             $info[0]['savename'] = $savename;                                   #缩略图图片名称 2017110820085417226.png
             $smallpath  = $savepath.$info[0]['savename'];                       #缩略图图片路径 ./Uploads/MerchantImg/20171108/2017110820085417226.png
             $imgUrl     = substr($smallpath ,1);                                #缩略图图片路径 /Uploads/MerchantImg/20171108/2017110820085417226.png

            //$oss_return = oss_upload($imgUrl);                                  #上传阿里云
            //$info[0]['oss_return'] = $oss_return;                               #阿里云图片返回值
            $info['error'] = 0;                                                 #上传图片插件返回参数
            $info['url'] = substr($info[0]['savepath'].$info[0]['savename'],1); #上传图片插件返回参数
            @unlink ($url);                                                     #删除原图
        }
        return $info;
    }

    /**20171120wzz
     * 上传文件
     * */
    private function uploadFile($type){
        switch ($type){
            case "1":   #编辑器文件
                $filePath = "UeditorFile";
                break;

            default:
                $filePath="File";
                break;
        }

        $upload = new \Think\UploadFile;// 实例化上传类
        $upload->maxSize   =     51200000;//上传大小限制，单位B，默认50MB
        $upload->exts      =     array("png", "jpg", "jpeg", "gif", "bmp",
            "flv", "swf", "mkv", "avi", "rm", "rmvb", "mpeg", "mpg","ogg", "ogv",
            "mov", "wmv", "mp4", "webm", "mp3", "wav", "mid",
            "rar", "zip", "tar", "gz", "7z", "bz2", "cab", "iso","doc",
            "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "md", "xml");
        $savepath='./Uploads/'.$filePath.'/'.date('Ymd').'/';       # 文件夹
        if (!file_exists($savepath)){
            mkdir($savepath);
        }
        $upload->savePath  =     $savepath;
        #上传成功 获取上传文件信息
        if(!$upload->upload()) {                                                #上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{                                                                  #上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
        }
        return $info;
    }

    /**20171120wzz
     * 上传视频
     * */
    private function uploadVideo($type){
        switch ($type){
            case "1":   #编辑器视频
                $filePath = "UeditorVideo";
                break;
            default:
                $filePath="Video";
                break;
        }

        $upload = new \Think\UploadFile;// 实例化上传类
        $upload->maxSize   =     51200000;
        $upload->exts      =     array("flv", "swf", "mkv", "avi", "rm", "rmvb", "mpeg", "mpg","ogg", "ogv", "mov", "wmv", "mp4", "webm", "mp3", "wav", "mid");
        $savepath='./Uploads/'.$filePath.'/'.date('Ymd').'/';       # 文件夹
        #创建文件夹
        if(!file_exists('./Uploads/'.$filePath.'/')){
            mkdir($savepath);
        }
        if (!file_exists($savepath)){
            mkdir($savepath);
        }
        $upload->savePath  =     $savepath;
        #上传成功 获取上传文件信息
        if(!$upload->upload()) {                                                #上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{                                                                  #上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
        }
        return $info;
    }




    /**20171213wzz
     * 删除文件
     * */
    protected function delFile($srcfile)
    {
        $srcfile=str_replace(__ROOT__.'/', '', str_replace('//', '/', $srcfile));
        if (file_exists($srcfile))
            unlink($srcfile);
        print_r($srcfile);
        exit;
    }


    /**20171108wzz
     * 获取图片库
     * */
    public function uploadImgList()
    {
        $filePath = I("get.type","","trim");
        switch ($filePath){
            case "1":   #商城配置
                $filePath = "ShopImg";
                break;
            case "2":   #积分商品图片
                $filePath = "IntegralImg";
                break;
            case "3":   #商品图片
                $filePath = "GoodsImg";
                break;
            case "4":   #广告图片
                $filePath = "BannerImg";
                break;
            case "5":   #商品分类图片
                $filePath = "GoodsCateImg";
                break;
            default:
                $filePath="Img";
                break;
        }

        require_once './Public/UploadImg/JSON.php';
        $php_path = $_SERVER['DOCUMENT_ROOT'];
        $protocol = empty($_SERVER['HTTP_X_CLIENT_PROTO']) ? 'http://' : $_SERVER['HTTP_X_CLIENT_PROTO'] . '://';
        $php_url = $protocol.$_SERVER['HTTP_HOST'];

        //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = $php_path . '/Uploads/'.$filePath.'/';
        //根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        $root_url = $php_url . '/Uploads/'.$filePath.'/';
        //图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        //根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        //排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            echo 'Access is not allowed.';
            exit;
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            echo 'Parameter is not valid.';
            exit;
        }
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            echo 'Directory does not exist.';
            exit;
        }

        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }

        //排序
        function cmp_func($a, $b) {
            global $order;
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        }
        usort($file_list, 'cmp_func');

        $result = array();
        //相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;
        //相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
        //当前目录的URL
        $result['current_url'] = $current_url;
        //文件数
        $result['total_count'] = count($file_list);
        //文件列表数组
        $result['file_list'] = $file_list;
        //输出JSON字符串
        header('Content-type: application/json; charset=UTF-8');
        $json = new \Services_JSON();
        echo $json->encode($result);
    }

    /**
     * 发送系统通知的方法
     * @param int     $userid    接受消息者的id
     * @param string  $msg       需要推送的消息
     * @param array   $data      需要修改的参数
     */
    protected function sendSystemMessage($userid,$title, $msg, $data=array())
    {
        $data["title"]=$title;
        $data["msg"]       = $msg;
        $data['user_id']   = $userid;
        $data['create_at'] = time();
        $res = M("systemMessage")->add($data);
        if($res)
            return true;
        return false;
    }



    /*****************************************************Ueditor编辑器上传 1************************************************/
    public function ueditorup(){
        header("Content-Type: text/html; charset=utf-8");
        $editconfig = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(C('HOST')."/Public/Ueditor/config.json")), true);
        $action = I('get.action');
        switch ($action) {
            case 'config':
                $result =  json_encode($editconfig);
                echo $result;die;
                break;

            /* 上传图片 */
            case 'uploadimage':
                $result = $this->editup('img');
                break;
            /* 上传涂鸦 */
            case 'uploadscrawl':
                $result = $this->editup('img');
                break;
            case 'uploadvideo':
                $result = $this->editup('video');
                break;
            case 'uploadfile':
                $result = $this->editup('file');
                break;

            /* 列出图片 */
            case 'listimage':
                $result = $this->editlist('listimg');
                break;
            /* 列出文件 */
            case 'listfile':
                $result = $this->editlist('listfile');
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                //$result = include("action_crawler.php");
                break;

            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ));
                break;
        }

        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }

    }

    /*编辑器上传图片文件*/
    public function editup($uptype){
        $editconfig = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(C('HOST')."/Public/Ueditor/config.json")), true);
        switch ($uptype) {
            case 'img': #上传图片
                $info = $this->uploadImg(1);
                $info =$info[0];
                $info['savepath'] =substr($info['savepath'],1);
                break;
            case 'file':#上传图片
                $info = $this->uploadFile(1);

                break;
            case 'video':#上传视频
                $info = $this->uploadVideo(1);
                break;
            default:
                return false;
                break;
        }

        if(!$info) {// 上传错误提示错误信息
            $_re_data['state'] = 'ERROR';
            $_re_data['url'] = '';
            $_re_data['title'] = '';
            $_re_data['original'] = '';
            $_re_data['type'] = '';
            $_re_data['size'] = '';
        }else{// 上传成功 获取上传文件信息
            $_re_data['state'] = 'SUCCESS';
            $_re_data['url'] = $info['savepath'].$info['savename'];
            $_re_data['title'] = $info['savename'];
            $_re_data['original'] = $info['name'];
            $_re_data['type'] = '.'.$info['ext'];
            $_re_data['size'] = $info['size'];
        }

        return json_encode($_re_data);

    }

    /**20171120wzz
     * 在线管理
     * */
    public function editlist($listtype){
        switch ($listtype) {
            case 'listimg':
                $allowFiles = [".png", ".jpg", ".jpeg", ".gif", ".bmp"];
                $listSize = 20;
                $path = '/Uploads/GoodsImg/';
                break;

            case 'listfile':
                $allowFiles = [".png", ".jpg", ".jpeg", ".gif", ".bmp",
                    ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
                    ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
                    ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
                    ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"];
                $listSize = 20;
                $path = '/Uploads/UeditorFile/';
                break;

            default:
                return false;
                break;
        }
        /* 获取参数 */
        $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end = $start + $size;

        /* 获取文件列表 */
        $path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
        $files = $this->getfiles($path, $allowFiles);
        if (!count($files)) {
            return json_encode(array(
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files)
            ));
        }

        /* 获取指定范围的列表 */
        $files=$this->array_sort($files,'mtime','asc');
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
            $list[] = $files[$i];
        }
        //倒序
//        for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
//            $list[] = $files[$i];
//        }

        /* 返回数据 */
        $result = json_encode(array(
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files)
        ));

        return $result;

    }


    /**20171120wzz
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param array $files
     * @return array
     */
    public function getfiles($path, $allowFiles, &$files = array())
    {
        if (!is_dir($path)) return null;
        if(substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getfiles($path2, $allowFiles, $files);
                } else {
                    if(in_array('.'.pathinfo($file, PATHINFO_EXTENSION), $allowFiles)){

                        $files[] = array(
                            'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime'=> filemtime($path2)
                        );
                    }
                }
            }
        }
        return $files;
    }


    /**20171120wzz
     * 排序
     */
    public function array_sort($array,$row,$type){
        $array_temp = array();
        $arr=array();
        foreach($array as $v){
            $array_temp[$v[$row]] = $v;
        }
        if($type == 'asc'){
            ksort($array_temp);
        }elseif($type='desc'){
            krsort($array_temp);
        }else{
        }
        $i=0;
        foreach ($array_temp as $vd){
            $arr[$i]=$vd;
            $i++;
        }
        return $arr;
    }
    /*****************************************************Ueditor编辑器上传 2************************************************/



}