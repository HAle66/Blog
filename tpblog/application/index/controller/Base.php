<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //使用共享视图
    public function initialize()
    {
        $cates = model('Cate')->order('sort','asc')->select();
        $webInfo = model('System')->find();
        $topArticles = model('Article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $this->view->share([
            'cates'         => $cates,
            'webInfo'       => $webInfo,
            'topArticles'   => $topArticles,
        ]);
    }
}
