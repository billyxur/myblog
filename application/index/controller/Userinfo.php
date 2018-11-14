<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/11/2
 * Time: 23:28
 */

namespace app\index\controller;


use app\common\controller\Base;
use app\common\model\Userinfo as UserinfoModel;

class Userinfo extends Base
{
    public function index()
    {
//        $data = UserinfoModel::get(1);
//        var_dump($data);
        return $this->fetch();
    }
}