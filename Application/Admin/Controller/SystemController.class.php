<?php
namespace Admin\Controller;
class SystemController extends CommonController
{
    public function config()
    {
        $this->display();
    }

    public function change_password()
    {
        $this->display();
    }

    public function password_update()
    {
        $old_password = md5(I("post.old_password"));
        if ($old_password != $_SESSION['user']['password']) {
            $this->error('原始密码错误');
        }

        $password = I("post.password");
        $check_password = I("post.check_password");

        if ($password != $check_password) {
            $this->error('两次输入的密码不一致');
        }

        $User = M('User');
        $id = $_SESSION['user']['id'];
        $User->where("id='$id'")->setField('password', md5($password));
        //echo $User->getLastSql();

        $this->redirect("/Admin/User/logout");
    }
}