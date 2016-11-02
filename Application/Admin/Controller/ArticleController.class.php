<?php
namespace Admin\Controller;
class ArticleController extends CommonController
{
    public function __construct()
    {
        parent::__construct();

        $this->article=M('Article');
        $this->category=D('Category');
    }

    public function index()
    {
        $Article=D('Article');
        $articles=$Article->relation(true)->select();
        $this->assign('articles', $articles);
        $this->display();
//        dump($articles);
//        exit();
    }

    public function create()
    {
        $categories = $this->category->all();
//        dd($categories);
        $this->assign('categories', $categories);
//      dump($categories);
//      exit();

        $this->display();
    }
    public function store()
    {
//        dump($_POST);
//        exit();
        $this->article->create();
        $this->article->add();
        $this->redirect('index');
    }
    public function edit()
    {
        $id = I("get.id");
        $categories=$this->category->all();
//        dd($categories);
//        exit();

        $this->assign('categories', $categories);

        $article=$this->article->where("id='$id'")->find();
        $this->assign('article',$article);
        $this->display();
    }
    public function update()
    {
//        dd($_POST);
//        exit();

        $this->article->create();
        $this->article->save();
        $this->redirect('index');
    }
    public function destroy()
    {
        $id=I("post.id");
        $this->article->delete($id);
        $this->redirect('index');
    }
}