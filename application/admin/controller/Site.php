<?php
/**
 * Created by PhpStorm.
 * User: xuyuxuan
 * Date: 2018/11/1
 * Time: 22:52
 */

namespace app\admin\controller;

use app\common\controller\Base;
use app\common\model\Site as SiteModel;
use think\Request;

class Site extends Base
{
    public function index()
    {
        //获取站点信息
        $siteInfo = SiteModel::get(1);

        $this->assign('siteInfo',$siteInfo);

        return $this->fetch();
    }

    public function save()
    {
        $data = Request::instance()->param();

        if(SiteModel::update($data))
        {
            return $this->success("网站更新成功",'site/index');
        }
        else
        {
            return $this->error("网站更新失败",'site/index');
        }
    }
}