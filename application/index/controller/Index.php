<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Posts;
use app\common\model\Cate as CateModel;
use app\common\model\Tags as TagsModel;
use app\common\model\TagMapping;
use app\common\model\Tags;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Index extends Base
{
    public function index()
    {
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';

        $post = new Posts();
        $map = [];

        $keywords = Request::instance()->param('keywords');

        //组装条件，如果搜索关键字存在
        if(!empty($keywords)){
            $map['title'] = ['like','%'.$keywords.'%'];
        }

        $id = Request::instance()->param('id');
        $tag_id = Request::instance()->param('tag_id');

        $tags_show = [];

        $i = 0;
        //进行判断如果id存在进行栏目跳转，tag_id存在进行标签文章显示，否则显示全文
        if(isset($id)){
            $posts = $post->where('cate_id','=',$id)
                          ->order('created_at','desc')
                          ->paginate(10);


        }
        else if (isset($tag_id)){
            $tag_p = TagsModel::get($tag_id);
            $posts = $tag_p->posts()->order('created_at','desc')->paginate(10);

        }
        else{
            $posts = Db::table("posts")
                          ->where($map)
                          ->order('created_at','desc')
                          ->paginate(10);

        }


        $pt = $posts;


        //获取所有标签
        $tags = TagsModel::all();
        $this->assign('tags',$tags);

        $this->assign('empty','<h3>没有文章</h3>');
        $this->view->assign('posts',$pt);

        return $this->fetch();
    }

    public function detail()
    {
        $data_id = Request::instance()->param('id');

        $post = new Posts();
        $posts = $post->where('id',$data_id)->find();
        $post->where('id',$data_id)->setInc('pv');
        $this->view->assign('post',$posts);
        return $this->fetch('index/detail');
    }

    public function search()
    {

    }

    public function test()
    {


        $data = Tags::all();

        Session::set('postid',2);
        $this->assign('tags',$data);
        return $this->fetch('index/test');

//        $map =[];
//        $map['tag_id'] = 1;
//        $map['post_id'] = 35;
//        if(TagMapping::where($map)->count() == 1){
//            echo '成功';
//        }else{
//            echo '失败';
//        }

    }

    public function testshow()
    {

        Session('postid',null);
        $res = Session::get('postid');
        var_dump($res);

//        if($res){
//            $this->success('删除成功','index/test');
//        }else{
//            $this->error('删除失败','index/test');
//        }

    }
}
