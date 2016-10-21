<?php
namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{
    protected $_validate = array(
        array('username', 'require', '用户名必须！'), //默认情况下用正则进行验证
        array('username', '', '帐号名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('password', 'require', '密码必须！'), //默认情况下用正则进行验证
        array('password', 'checkPwd', '密码格式不正确', 0, 'function'), // 自定义函数验证密码格式
        array('check_password', 'password', '确认密码不正确', 0, 'confirm'), // 验证确认密码是否和密码一致
    );

    protected $_auto = array(
        array('password', 'md5', 3, 'function'), // 对password字段在新增和编辑的时候使md5函数处理
        array('token', 'get_token', 1, 'callback'),
    );

    function get_token()
    {
        return md5(uniqid());
    }
}
