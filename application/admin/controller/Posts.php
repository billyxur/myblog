<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/10/22
 * Time: 16:37
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\TagMapping;
use think\Request;
use think\Session;
use app\common\model\Posts as PostsModel;
use app\common\model\Cate as CateModel;
use app\common\model\Tags as TagsModel;
use app\common\model\TagMapping as TamModel;

class Posts extends Base
{
    public function index()
    {
        $this->isLogin();
        return $this->redirect('posts/postslist');
    }

    public function postsList()
    {
        $id = Session::get('admin_id');
        $data = PostsModel::where('user_id','=',$id)->order('created_at desc')->paginate(10);
        //var_dump($data);
        $this->view->assign('postslist',$data);
        $this->assign('empty','<span style="color: red;">没有任何数据</span>');
        return $this->fetch('posts/postslist');
    }

    public function postInsert()
    {
        $cateList = CateModel::all();
        $tags= TagsModel::all();
        $this->assign('tags',$tags);
        $this->assign('cateList',$cateList);
        return $this->fetch('posts/postinsert');
    }

    public function doInsert()
    {
        $data = Request::instance()->param();

        $post = new \app\common\model\Posts();
        $post->title = $data['title'];
        $post->content = ltrim($data['content']);
        $post->user_id = $data['user_id'];
        $post->cate_id = $data['cate_id'];
        $post->introduction = $data['introduction'];

        if($post->save())
        {
            $id = \think\Db::table('posts')->getLastInsID();
            $map = [];
            $map['post_id'] = $id;
            $ma = input('post.manage/a');
            foreach ($ma as $val){
                $map['tag_id'] = $val;
                TamModel::create($map);
            }
            return $this->success("文章添加成功",'posts/postslist');
        }
        else
        {
            return $this->error("文章添加失败",'posts/postslist');
        }

    }

    public function postEdit()
    {
        $id = Request::instance()->param('id');



        $data = PostsModel::where('id','=',$id)->find();
        $cateList = CateModel::all();
        $tags= TagsModel::all();

        //设置session用于读取标签县官操作
        Session::set('postid',$id);

        $this->assign('tags',$tags);
        $this->assign('post',$data);
        $this->assign('cateList',$cateList);
        return $this->fetch('posts/postedit');
        //var_dump($data);
    }

    public function doEdit()
    {
        $data = Request::instance()->param();

        TamModel::where('post_id','=',$data['id'])->delete();

        $map = [];
        $map['post_id'] = $data['id'];
        $ma = input('post.manage/a');
        foreach ($ma as $val){
            $map['tag_id'] = $val;
            TamModel::create($map);
        }

        //session置空
        Session('postid',null);

        $data['content'] = ltrim($data['content']);
        $post = PostsModel::get($data['id']);
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->cate_id = $data['cate_id'];
        $post->introduction = $data['introduce'];

        if($post->save())
        {
            return $this->success("更新文章成功",'posts/postslist');
        }
        else
        {
            return $this->error("更新文章失败",'posts/postslist');
        }
    }

    public function del()
    {
        $id = Request::instance()->param('id');

        if(PostsModel::destroy($id))
        {
            $this->success("删除成功");
        }
        else
        {
            $this->error("删除失败");
        }
    }

}