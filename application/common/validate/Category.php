<?php

namespace app\common\validate;

use think\Validate;

class Category extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'model_id|模型'   =>  'require|>:0',
        'pid|上级栏目'     =>  '>=:0',
        'name|栏目名称'    =>  'require|max: 100',
        'description|栏目描述' =>  'max:200',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'model_id.require'  =>  '模型为必选项',
        'model_id.>'        =>  '模型参数错误',
        'pid.>'             =>  '上级栏目参数错误',
        'name.require'      =>  '栏目名称不能为空',
        'name.max'          =>  '栏目最多100个字符',
        'description.max'   =>  '栏目描述最多200个字符'
    ];

//    protected $scene = [
//        'add'   =>  ['model_id','name'],
//        'edit'  =>  [],
//
//    ];


    //自定义验证场景
//    public function addManage(){
//        return $this->only(['username,password,mobile'])
//            ->append(['username','unique:manage'])
//            ->append(['mobile','unique:manage']);
//    }
}
