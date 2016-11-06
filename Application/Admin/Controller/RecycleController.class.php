<?php
namespace Admin\Controller;
class RecycleController extends CommonController
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
        $articles=$Article->relation(true)->where('status=0')->select();
        $this->assign('articles', $articles);
        $this->display();
//        dump($articles);
//        exit();
    }


    public function destroy()
    {
        $id=I("post.id");
        $this->article->where("id='$id'")->delete();
        //$this->link->where("id='$v'")->setField("sort_order", $sort_order[$k]);
        $this->redirect('index');
    }

    public function recover()
    {
        $id=I("post.id");
        $this->article->where("id='$id'")->setField('status',1);
        $this->redirect('index');
    }

}