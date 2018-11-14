<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/11/13
 * Time: 11:44
 */

namespace app\common\model;


use think\Model;

class Tags extends Model
{

    public function posts()
    {
        return $this->belongsToMany('posts','tag_mapping','post_id','tag_id');
    }

}