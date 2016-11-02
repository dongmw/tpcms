<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class ArticleModel extends RelationModel
{

    protected $_link = array(
        'category'=> self::BELONGS_TO,


    );




//    function all()
//    {
//        if (!F('articles')){
//            $articles = $this->relation(true)->where("parent_id=0")->order("sort_order")->select();
//            F('articles', $articles);
//        }
//        return F('articles');
//    }
}
