<?php

namespace app\admin\controller;

class Admin extends Base
{
    //管理员列表
    public function all()
    {
        $admins = model('Admin')->order(['is_super'=>'desc','status'=>'desc'])->paginate(10);
        $this->assign('admins',$admins);
        return view();
    }

    //管理员添加
    public function add()
    {
        if (request()->isAjax()){
            $data = [
                'username'      =>      input('post.username'),
                'password'      =>      input('post.password'),
                'conpass'       =>      input('post.conpass'),
                'nickname'      =>      input('post.nickname'),
                'email'         =>      input('post.email'),
            ];
            $result = model('Admin')->add($data);
            if ($result == 1){
                $this->success('管理员添加成功','admin/admin/all');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //管理员状态
    public function status()
    {
        $data = [
            'id'        =>      input('post.id'),
            'status'    =>      input('post.status') ? 0:1
        ];
        $adminInfo = model('Admin')->find($data['id']);
        $adminInfo->status = $data['status'];
        $result = $adminInfo->save();
        if ($result){
            $this->success('操作成功','admin/admin/all');
        }else{
            $this->error('操作失败');
        }
    }

    //编辑
    public function edit()
    {
        if (request()->isAjax()){
            $data = [
                'id'        =>      input('post.id'),
                'oldpass'   =>      input('post.oldpass'),
                'newpass'   =>      input('post.newpass'),
                'nickname'  =>      input('post.nickname')
            ];
            $result = model('Admin')->edit($data);
            if ($result == 1){
                $this->success('管理员修改成功！','admin/admin/all');
            }else{
                $this->error($result);
            }
        }
        $adminInfo = model('Admin')->find(input('id'));
        $this->assign('adminInfo',$adminInfo);
        return view();
    }

    //删除
    public function del()
    {
        $adminInfo = model('Admin')->find(input('id'));
        $result = $adminInfo->delete();
        if ($result){
            $this->success('删除成功','admin/admin/all');
        }else{
            $this->error('删除失败 ');
        }
    }
}
