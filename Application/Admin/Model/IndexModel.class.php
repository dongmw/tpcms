<?php
namespace Admin\Model;

use Think\Model;

class IndexModel extends Model
{
    public function system($server_info)
    {
        $total_space = round((@disk_total_space(".") / (1024 * 1024)));
        $free_space = round((@disk_free_space(".") / (1024 * 1024)));
        $already_used = round($total_space-$free_space);
        $already_used_percent = round(($total_space-$free_space)/$total_space*100);

        $server_info = array(
            'os' => PHP_OS,
            'server_software' => $_SERVER["SERVER_SOFTWARE"],
            'php' => php_sapi_name(),
            'mysql' => 'x.x',
            'canon_version' => CANONPD_VERSION . "&nbsp;&nbsp;&nbsp; [<a href='http://www.canon4ever.com' target='_blank'>访问官网</a>]",
            'upload' => ini_get('upload_max_filesize'),
            //'执行时间限制' => ini_get('max_execution_time') . "秒",
            'total_space'=> $total_space,
            'free_space' => $free_space,
            'already_used' =>$already_used,
            'already_used_percent' => $already_used_percent,
            'core' => THINK_VERSION,
        );


        return ($server_info);

        //$this->assign('server_info', $server_info);
    }


}
