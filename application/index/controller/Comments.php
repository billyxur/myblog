<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/11/12
 * Time: 22:28
 */

namespace app\index\controller;


use app\common\controller\Base;

class comments extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}