<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/23
 * Time: 16:16
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\Cate as CateModel;
use think\Request;

class Cate extends Base
{
    public function index()
    {
        $this->isLogin();
        return $this->redirect('cate/catelist');
    }

    public function cateList()
    {
        $data = CateModel::all();
        //var_dump($data);
        $this->assign("cates",$data);
        return $this->view->fetch('cate/catelist');

    }

    public function cateEdit()
    {
        $id = Request::instance()->param('id');
        $data = CateModel::where('id','=',$id)->find();
        //var_dump($data);
        $this->assign('cate',$data);
        return $this->fetch('cate/cateedit');
    }

    public function doEdit()
    {
        $data = Request::instance()->param();
        if(CateModel::update($data))
        {
            return $this->success("栏目修改成功",'cate/catelist');
        }
        else
        {
            return $this->error("栏目修改失败",'cate/catelist');
        }
    }

    public function cateAdd()
    {
        return $this->fetch('cate/cateadd');
    }

    public function doAdd()
    {
        $data = Request::instance()->param();
        if(CateModel::create($data))
        {
            return $this->success("创建栏目成功",'cate/catelist');
        }else{
            return $this->error("创建栏目失败");
        }
    }

    public function cateDel()
    {
        $id = Request::instance()->param('id');
        if(CateModel::destroy($id))
        {
            return $this->success("栏目删除成功",'cate/catelist');
        }else{
            return $this->error("栏目删除失败",'cate/catelist');
        }
    }
}