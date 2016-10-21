<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
    }

    function check_login()
    {
        //如果session已经存在,不需要继续查数据库了,直接返回
        if ($_SESSION['user']) {
            $this->assign('user', $_SESSION['user']);
            return;
        }

        if (!isset($_COOKIE['token'])) {
            $this->error('您还没有登陆', U('User/login'));
        }

        $token = $_COOKIE['token'];
        $User = M("User");
        $user = $User->where("token='$token'")->find();

        if (!$user) {
            $this->error('非法登录', U('User/login'));
        }

        $_SESSION['user'] = $user;
        $this->assign('user', $user);
    }
}