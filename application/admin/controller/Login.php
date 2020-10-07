<?php

namespace app\admin\controller;

use app\admin\validate\user;
use think\Controller;
use think\Request;


class Login extends Controller
{
    //后台登录界面的加载
    public function login() {
        return view('admin@login/login');
    }

    // 后台请求登录数据控制器
    public function checkLogin(Request $request) {
        $data = $request->post();
        // dump($req);
        // 验证用户名和密码是否合法
        $ret = $this->validate($data,user::class);
        if ($ret !== true) {
            return $this->error('密码或账号不能为空！');
        }

        // 账号和密码不为空的情况，连接数据库进行账号和密码验证
        // 调用模型进行匹配
        $dbRet = model('User')->checkUser($data);
        dump($dbRet);
        dump(session('admin.user'));

    }
}
