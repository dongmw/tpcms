<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends LayoutController
{
    public function __construct()
    {
        parent::__construct();
        $this->category = D('Category');
        $this->article = D('Article');
    }

    public function index()
    {
        $categories = $this->category->all();
        $this->assign("categories", $categories);
        $this->display();
    }
    public function lists()
    {
        $categories = $this->category->all();
        $this->assign("categories", $categories);

        $category_id = I("get.id");
        $articles = $this->article->where("category_id='$category_id'")->all();
        dd($articles);
        $this->assign("articles", $articles);
        $this->display();

    }
    public function article()
    {
        $categories = $this->category->all();
        $this->assign("categories", $categories);

        $id = I("get.id");

        $articles = $this->article->all();
        //dump($articles);

        $this->assign('articles', $articles);
        $this->display();


    }
    public function show()
    {
        $categories = $this->category->all();
        $this->assign("categories", $categories);

        $id = I('get.id');
        $article = $this->article->find($id);
        $this->assign('article', $article);
        $this->display();

    }
}