<?php

/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/21
 * Time: 20:34
 */
namespace app\common\controller;

use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    protected function _initialize()
    {
        $this->getHot(); //获取热门文章
        $this->getCate(); //获取栏目
        $this->is_open();
    }

    protected function isLogin()
    {
        if(!Session::has('admin_id'))
        {
           $this->error('请先登录','user/login');
        }
    }

    protected function getCate()
    {
        $cate = \think\Db::table('cate')->select();
        $this->view->assign('cates',$cate);
    }

    protected function getHot()
    {
        $data = \think\Db::table('posts')->order('pv','desc')->limit(10)->select();
        $this->assign('hotPostsList',$data);
    }

    protected function is_open()
    {
        $status = \think\Db::table('site')->where('id',1)->value('is_open');

        if($status == 0 &&Request::instance()->module() == 'index')
        {

            $info ='
                <body style="background-color: #333">
            <h1 style="color: #eee;text-align: center;margin: 200px">站点维护中</h1>
            </body>
            ';
            
            exit($info);
            
        }
    }
}