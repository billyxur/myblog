<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

if(!function_exists('getUserName'))
{
    function getUserName($id)
    {
        return \think\Db::table('user')->where('id','=',$id)->value('name');
    }
}

if(!function_exists('getCateName'))
{
    function getCateName($id)
    {
        return \think\Db::table('cate')->where('id',$id)->value('name');
    }
}

function getArtContent($content)
{
    return mb_substr(strip_tags($content),0,50)."...";
}

function getTags($post_id)  //获取文章对应的id
{
    $str = '';

    $tam = \think\Db::table('tag_mapping')->where('post_id',$post_id)->select();
    if(!empty($tam)){

        $tags = [];
        foreach ($tam as $val){

            $tid = $val['tag_id'];
            $tag_name = \think\Db::table('tags')->where('id',$tid)->value('tag_name');
            $tag_id = \think\Db::table('tags')->where('id',$tid)->value('id');
            array_push($tags,$tag_name);
            array_push($tags,$tag_id);
        }

        $len = count($tags);

        for($i = 0;$i < $len; $i++){
            $str .= '<div style="border-radius: 5px;float: left;margin-left: 2px;padding-left: 1px;padding-right: 1px"><a href="/myface/public/index/index/index/tag_id/'.$tags[$i+1].'" title="" target="" class="classname">'.$tags[$i].'</a></div>';
            $i++;
        }
    }



    return $str;

}

function getTags2($post_id)
{
    $str = '';

    $tam = \think\Db::table('tag_mapping')->where('post_id',$post_id)->select();
    if(!empty($tam)){

        $tags = [];
        foreach ($tam as $val){

            $tid = $val['tag_id'];
            $tag_name = \think\Db::table('tags')->where('id',$tid)->value('tag_name');
            $tag_id = \think\Db::table('tags')->where('id',$tid)->value('id');
            array_push($tags,$tag_name);
            array_push($tags,$tag_id);
        }

        $len = count($tags);

        for($i = 0;$i < $len; $i++){
            $str .= '<a href="/myface/public/index/index/index/tag_id/'.$tags[$i+1].'" target="_blank">'.$tags[$i].'</a> &nbsp;';
            $i++;
        }
    }

    return $str;

}

function iftags($tagid,$tagname)
{
    $postid = \think\Session::get('postid');

    $str = '';
    $map =[];
    $map['tag_id'] = $tagid;
    $map['post_id'] = $postid;

    if (\think\Db::table('tag_mapping')->where($map)->count() == 1){
        $str .= '<input type="checkbox" name="manage[]" value="'.$tagid.'" title="修改" checked >'.$tagname;
    }
    else{
        $str .= '<input type="checkbox" name="manage[]" value="'.$tagid.'" title="修改" >'.$tagname;
    }

    return $str;
}
