<?php

/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/20
 * Time: 22:50
 */

 namespace app\admin\controller;


 use app\common\controller\Base;
 use app\common\model\Posts;
 use think\Controller;
 use think\Request;

 class index extends Base
{
    public function index()
    {
        $this->isLogin();
        return $this->redirect('user/login');
        //return $this->fetch();
    }


    public function edit()
    {
        return $this->fetch('index/edit');
    }

    public function doedit()
    {
        $data = Request::instance()->param();
        $data['content'] = ltrim($data['content']);
//        $this->assign('data',$data);
//        var_dump($data);
        if(Posts::create($data))
        {
            return $this->success("编写文章成功",'index/edit');
        }
        else
        {
            return $this->error("创建文章失败",'index/edit');
        }

    }

     public function upload()
     {
         $file = request()->file('FileName');
         $info = $file->validate(['ext' => 'jpg,png,gif'])->move(ROOT_PATH . 'public/uploads');
         $path = "/myface/public/uploads/".$info->getSaveName();
         $path = str_replace("\\",'/',$path);
         return $path;
     }
}