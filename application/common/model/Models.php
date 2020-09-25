<?php
/**
 * 文章模型
 */
namespace app\common\model;

use model\Base;

class Models extends Base
{

    //下拉列表
    public function getList()
    {
        return $this->field('id,name')->select()->toArray();
    }

    //根据模型id获取数据表名称
    public function adminGetTableNameToModelId($id){
        $data = $this->where(['id'=>$id])->field('id,name,tablename')->find();
        if(empty($data)){
            return false;
        }else{
            $data=$data->toArray();
        }
        return $data;
    }
}