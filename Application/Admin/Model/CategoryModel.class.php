<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class CategoryModel extends RelationModel
{
    protected $_link = array(
        'Category' => array(
            'mapping_type'  => self::HAS_MANY,
            'mapping_name'  => 'children',

        ),
    );
    function all()
    {
        if (!F('categories')){
            $categories = $this->relation(true)->where("parent_id=0")->order("sort_order")->select();
            F('categories', $categories);
        }
        return F('categories');
    }
}
