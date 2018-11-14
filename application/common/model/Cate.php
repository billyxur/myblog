<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/23
 * Time: 16:15
 */

namespace app\common\model;


use think\Model;

class Cate extends Model
{
    protected $autoWriteTimestamp = 'timestamp';
    protected $createTime='created_at';
    protected $updateTime='updated_at';
}