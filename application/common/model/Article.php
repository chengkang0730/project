<?php

/**
 * Created by PhpStorm.
 * User: hengge
 * Date: 2018/5/28
 * Time: 15:06
 */
namespace app\common\model;


use think\Cache;
use think\Model;
use think\Url;

class Article extends Model{

    protected $autoWriteTimestamp = true;


    /*
     * 获取文章数据库所有文章并分页
     */
    public function adminGetArticleAllDataToPage($param){
        $where['a.delete_time']=0;
        $where['c.delete_time']=0;
        $page_size=10;
        if(!empty($param)){
            //添加条件

            //栏目id
            if(isset($param['category_id']) && $param['category_id'] != 0){
                $where['a.category_id']=['eq',$param['category_id']];
            }
            //搜索条件
            if(!empty($param['search'])){
                $where['a.title']=['like',"%".$param['search']."%"];
            }
            isset($param['page_size']) && $param['page_size'] != 0 ? $page_size=(int)$param['page_size'] : '';

        }
        $field=('a.*,c.name as category_name');

        $data=$this
            ->alias('a')
            ->join('category c','a.category_id=c.id')
            ->where($where)
            ->order('id desc')
            ->field($field)
            ->paginate($page_size);
        return $data;
    }
    /*
     * 添加
     */
    public function add($params){
        $res=$this->isUpdate(false)->allowField(true)->save($params);
        $id=$this->id;
        Url::root('/');
        $url=url('index/article/show',['id'=>$id]);
        $this->edit(['url'=>$url,'id'=>$id]);

        return $res;
    }
    /*
     * 修改
     */
    public function edit($params){
        //Url::root('/');
        //$params['url']=url('index/article/show',['id'=>$params['id']]);
        $res=$this->isUpdate(true)->allowField(true)->save($params);

        return $res;
    }

    /*
     *  删除单个或多个
     *
     */
    public function del($id){
        if(is_array($id)){
            $ids=implode(',',$id);
        }else{
            $ids=$id;
        }
        $up=$this->destroy(['id'=>['in',$ids]]);
        return $up;

    }
    /*
     * 批量移动
     */
    public function remove_category($ids,$to_category_id){
        if(is_array($ids)){
            $up_arr=[];
            foreach ($ids as $k=>$v){
                $up_arr[$k]['id']=$v;
                $up_arr[$k]['category_id']=$to_category_id;

            }
            return $this->isUpdate(true)->allowField(true)->saveAll($up_arr);
        }
        return false;
    }
    /*
     *  通过id获取一条文章信息
     */
    public function adminFindDataToId($id){
        $data=$this->where(['delete_time'=>0])->find($id);
        if(empty($data)){
            return false;
        }
        return $data=$data->toArray();;
    }
}