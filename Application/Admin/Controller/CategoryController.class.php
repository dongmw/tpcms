<?php
namespace Admin\Controller;

use Think\Controller;

class CategoryController extends CommonController
{
    var $category;

    public function __construct()
    {
        parent::__construct();
        $this->category = D("Category");
    }

    public function index()
    {
        $categories = $this->category->all();
        $this->assign("categories", $categories);
        $this->display();
    }

    public function create()
    {
        $categories=$this->category->all();
        $this->assign("categories", $categories);
        $this->display();

    }

    public function destroy()
    {
        $id =I("post.id");
        $this->category->delete($id);
        $this->success('删除成功');
    }

    public function sort_order()
    {
        $id = I("post.id");
        $sort_order =I("post.sort_order");
        foreach ($id as $k=>$v)
        {
            $this->category->where("id='$v'")->setField("sort_order", $sort_order[$k]);
        }
        $this->redirect('index');
    }

    public function store()
    {
//        dump($_POST);
//        exit();
        $this->category->create();
        $this->category->add();

        F('categories', NULL);
        $this->redirect('index');

    }
    public function edit()
    {
        $id=I("get.id");
//        dump($id);
//        exit();
        $categories=$this->category->all();
        $this->assign("categories", $categories);
        $category=$this->category->where("id='$id'")->find();
        $this->assign('category', $category);

        $this->display();
    }
    public function update()
    {
//        dump($_POST);
//        exit();
        $Category=M("Category");
        $Category->create();
        $Category->save();
        F('categories', NULL);
        $this->success('编辑成功', 'index');
    }


}