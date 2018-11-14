<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/25
 * Time: 20:10
 */

namespace app\index\controller;

use app\common\model\Posts as PostModel;
use think\Request;

class Cate
{
    public function index()
    {

    }

    public function cateshow()
    {
        $id = Request::instance()->param('id');
        $data = PostModel::where('cate_id','=',$id)->select();
        var_dump($data);
    }
}