<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/21
 * Time: 20:40
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\User as UserModel;
use think\Request;
use think\Session;

class User extends Base
{
    public function login()
    {
        return $this->fetch('user/login');
    }

    public function checkLogin()
    {
        $data = Request::instance()->param();
        $data['password'] = sha1($data['password']);

        $res = UserModel::get(['email'=>$data['email'], 'password'=>$data['password']]);
        //echo $res['name'];
        if($res)
        {
            Session::set('admin_id',$res['id']);
            Session::set('admin_name',$res['name']);
            $this->success("登录成功",'user/userlist');
        }else
        {
            $this->error('登陆失败');
        }
        //var_dump($data);
    }

    public function loginOut()
    {
        Session::clear();
        $this->success('退出登录','user/login');
    }

    public function userList()
    {
        $this->isLogin();
        $data['admin_id'] = Session::get('admin_id');
        $res = UserModel::where('id',$data['admin_id'])->find();
        $this->view->assign('user',$res);
        //var_dump($res);
        return $this->fetch('user/userlist');
    }

    public function userEdit()
    {

    }

    public function doEdit()
    {

    }

    public function test()
    {
        return $this->fetch('user/test');
    }
}