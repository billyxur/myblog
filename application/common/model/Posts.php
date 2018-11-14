<?php

/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/20
 * Time: 15:09
 */
namespace app\common\model;

use \think\Model;

class Posts extends Model
{
    //开启自动时间戳
    protected $autoWriteTimestamp = 'timestamp';
    protected $createTime='created_at';
    protected $updateTime='updated_at';

    public function tags()
    {
        return $this->belongsToMany('tags','tag_mapping','tag_id','post_id');
    }
}