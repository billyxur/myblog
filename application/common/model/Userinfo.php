<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/11/2
 * Time: 23:26
 */

namespace app\common\model;


use think\Model;

class Userinfo extends Model
{
    //开启自动时间戳
    protected $autoWriteTimestamp = true;
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

}