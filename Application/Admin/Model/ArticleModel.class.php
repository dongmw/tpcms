<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class ArticleModel extends RelationModel
{

    protected $_link = array(
        'category'=> self::BELONGS_TO,
    );

    protected $_auto = array(
        array('time','strtotime',3,'function'),
        array('file','make_file',3,'callback'),

    );
    protected $_validate = array(
        array('title','require','您的标题必须填写！'), //默认情况下用正则进行验证
        array('content','require','您的内容必须填写！'), //默认情况下用正则进行验证

    );

    function make_file($file)
    {
        //合并字符串
        return implode('|',array_filter($file));
    }




//    function all()
//    {
//        if (!F('articles')){
//            $articles = $this->relation(true)->where("parent_id=0")->order("sort_order")->select();
//            F('articles', $articles);
//        }
//        return F('articles');
//    }
}
