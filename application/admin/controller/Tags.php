<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/11/13
 * Time: 21:18
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\Tags as TagsModel;
use app\common\model\TagMapping as TamModel;
use think\Request;

class Tags extends Base
{
    public function TagList()
    {
        $data = TagsModel::all();

        $this->assign('tags',$data);
        return $this->fetch('tags/taglist');
    }

    public function del()
    {
        $id = Request::instance()->param('id');

        $res1 = TamModel::where('tag_id','=',$id)->delete();
        $res2 = TagsModel::where('id','=',$id)->delete();

        if($res1 && $res2){
            $this->success('删除标签成功','tags/taglist');
        }else{
            $this->error('删除失败');
        }
    }

    public function TagAdd()
    {
        return $this->fetch('tags/tagadd');
    }

    public function doAdd()
    {
        $data = Request::instance()->param();
        if(TagsModel::create($data)){
            $this->success('标签添加成功','tags/taglist');
        }else{
            $this->error('标签添加失败','tags/taglist');
        }
    }
}