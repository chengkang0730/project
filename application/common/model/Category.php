<?php

namespace app\common\model;


use think\Cache;
use think\Model;
use think\model\concern\SoftDelete;
use think\Url;
use tree\Tree;

class Category extends Model {
//    use SoftDelete;
//    protected $defaultSoftDelete = NULL;
    //模型名
//    protected $name = 'category';

    //表名


    //数组常量
    public $const = [
        'is_menu' => [
            '0'=>'否'
            ,'1'=>'是'
        ],
    ];

    //关联文章模型表
    public function models()
    {
        return $this->belongsTo('Models', 'model_id')->setEagerlyType(0);
    }

    //新增栏目
    public function add($param)
    {
        //添加时间
        $param['create_time'] = $param['update_time'] = time();
        $res=$this->isUpdate(false)->allowField(true)->save($param);
        //非链接模型
        if($param['model_id'] != 4){

            $fun='lists';
            //顶级分类用’index‘方法
            if ((int)$param['model_id'] == 1 || (int)$param['pid'] == 0){
                $fun='index';
            }
            $id=$this->id;
            //更新url字段
            $this->edit(['id'=>$id,'url'=>$this->getUrlToModelId($id,$param['model_id'],$fun)]);
        }
        return $res;
    }

    //编辑
    public function edit($param){
        /*if($param['model_id'] != 4){
            $fun='lists';
            if ((int)$param['model_id'] == 1 || (int)$param['parent_id'] == 0){
                $fun='index';
            }
            $param['url']=$this->getUrlToModelId($param['id'],$param['model_id'],$fun);
        }*/
        //更新时间
        $param['update_time'] = time();
        return $this->isUpdate(true)->allowField(true)->save($param);
    }


    //根据模型id查找内容(目前主要是链接模型使用了)
    public function adminGetDataToModelId($model_id){
        return $this->where(['delete_time'=>0,'model_id'=>$model_id])->order('id desc')->select()->toArray();
    }
    //生成前台可访问url
    public function getUrlToModelId($id,$model_id,$fun='index'){
        $model_data=model('models')->adminGetTableNameToModelId($model_id);
//        Url::root('/');
        $url=url('index/'.$model_data['tablename'].'/'.$fun,['category'=>$id]);
        return $url;
    }

    public function getCategorySelectList()
    {
        $category_select = $this->field('id,pid,name')->select()->toArray();
        $category_select_tree_obj = \library\Tree::instance();
        $category_select_tree_obj->init($category_select);
        $category_select = $category_select_tree_obj->getTreeList($category_select_tree_obj->getTreeArray(0));
        return $category_select;
    }

    public function getById(int $id)
    {
        return $this->where('id',$id)->findOrFail()->toArray();
    }
}