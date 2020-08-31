<?php
namespace app\common\validate;
use think\Validate;

class Article extends Validate
{
  protected $rule = [
      'title|文章标题'      =>      'require|unique:article',
      'tag|标签'          =>      'require',
      'cate_id|所属栏目'     =>      'require',
      'desc|文章概要'       =>      'require',
      'content|文章内容'    =>      'require',
      'is_top|推荐'       =>         'require',
      'author|作者'       =>         'require'
  ];

  //添加场景
    public function sceneAdd()
    {
        return $this->only(['title','tag','cate_id','desc','content','author']);
    }

    //推荐场景
    public function sceneTop()
    {
        return $this->only(['is_top']);
    }

    //编辑场景
    public function sceneEdit()
    {
        return $this->only(['title','author','tag','is_top','cate_id','desc','content']);
    }

}