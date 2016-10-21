<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function register()
    {
        $this->display();
    }

    public function do_register()
    {
        $User = D("User"); // 实例化User对象
        if (!$User->create()) {
            $this->error($User->getError());
        } else {
            $User->add();
            $this->success('注册成功', U('login'));
        }
    }

    public function login()
    {
        $this->display();
    }

    public function do_login()
    {
        $code = I("post.code");
        if (!$this->check_verify($code)) {
            $this->error('验证码错误');
        }

        $data['username'] = I('post.username');
        $data['password'] = md5(I('post.password'));
        $User = M("User");
        $user = $User->where($data)->find();
        if (!$user) {
            $this->error('账号或密码错误');
        }

        $token = $user['token'];
        //判断是否需要记住密码
        if (isset($_POST['rem'])) {
            setcookie('token', $token, time() + 60 * 60 * 24 * 7, '/');
        } else {
            setcookie('token', $token, null, '/');
        }

        $this->success('登录成功', U('Index/index'));
    }

    //生成验证码
    public function verify()
    {
        $config = array(
            'length' => 4,     // 验证码位数
            'codeSet' => '0123456789',
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    //验证码检测
    function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    function logout()
    {
        $_SESSION = array();

        //session_name(), cookie中储存的session标识, 即key
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        if (isset($_COOKIE['token'])) {
            setcookie("token", "", time() - 3600, "/");
        }
        $this->success('您已经安全退出');
    }
}