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
        $articles=$Article->relation(true)->where('status=1')->select();
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
        //自动完成
        //implode explode

        $Article = D('Article');

//        if (!$Article->create()){
//            // 如果创建失败 表示验证没有通过 输出错误提示信息
//            //exit($Article->getError());
//            $this->success($Article->getError(),U('create'));
//        }else{
            // 验证通过 可以进行其他数据操作
            $Article->create();
            $Article->add();
            $this->redirect('index');
        //}
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
        //拆分字符串
        $file = explode('|', $article['file']);
        $this->assign('file', $file);

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
        $this->article->where("id='$id'")->setField("status",0);
        //$this->link->where("id='$v'")->setField("sort_order", $sort_order[$k]);
        $this->redirect('index');
    }
    public function destroy_checked()
    {
//        dump($_POST);
//        exit()

        $checked = I("post.destroy_checked");
        foreach ($checked as $id){
            $this->article->where("id='$id'")->setField("status",0);
        }
        $this->success("批量删除成功");

    }
}