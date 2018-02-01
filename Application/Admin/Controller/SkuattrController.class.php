<?php
namespace Admin\Controller;
class SkuattrController extends AdminCommonController
{
    public function skuAttr()
    {   
        $m   = M("skuAttr");
        $map = array(
            "pid"       => 0,
            "is_del"     => 0,
        );
        $res = $m->where($map)->select();
        foreach($res as $k=>$v){
            $res[$k]["data"] = $m->where(array("pid"=>$v['id'], "is_del"=>0))->select();
        }
        $this->logs('查看商品规格');
        $this->assign("cache", $res);
        $this->assign("cate",  $res);
        $this->display();
    }
    /**20171214wzz
     *添加/编辑商品规格
     * */
    public function skuAttrAdd()
    {
        $this->logs('添加/编辑商品规格');
        D('SkuAttr')->skuAttrAdd();
    }
    /**20171214wzz
     * 删除 商品规格
     * */
    public function skuAttrDel()
    {
        $this->logs('删除 商品规格');
        D('SkuAttr')->skuAttrDel();
    }

}