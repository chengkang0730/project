<?php


namespace app\blog\controller;

use think\Controller;
use app\common\model\Article as ArticleModel;
use app\common\model\Category as categoryModel;

class Article extends Controller
{
    public  function index()
    {
        $articleModel = new ArticleModel();
        $articleData = $articleModel->adminGetArticleAllDataToPage($array = [])->toArray();
        foreach($articleData['data'] as $k=>$v){
            $articleData['data'][$k]['create_time_new'] = changeTime($v['create_time']);
        }
        $this->assign('articleData',$articleData);

        //侧边分类
        $categoryModel = new categoryModel();
        $categoryData = $categoryModel->getCategoryList();
        $this->assign('categoryData',$categoryData);

        //热门文章
        $popularArticles = $articleModel->field('title,url')->order('hits')->select()->toArray();
        $this->assign('popularArticles',$popularArticles);

        //置顶推荐
        $recommendArticles = $articleModel->field('title,url')->where(["is_recommend"=>"1"])->select()->toArray();
        $this->assign('recommendArticles',$recommendArticles);
        return $this->fetch('article');
    }
}