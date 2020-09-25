<?php

namespace app\common\validate;

use think\Validate;

class Manage extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username|用户名'  =>  'require|chsDash',      //chsDash 只能是汉字、字母、数字和下划线_及破折号-
        'password|密码'    =>  'require|min:6',
        'mobile|手机号'    =>  'require|mobile'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require'  =>  '用户名必填',
        'username.unique'   =>  '用户名已存在',
        'password.require'  =>  '密码必填',
        'password.min'      =>  '密码不得少于6位',
        'mobile.mobile'     =>  '手机号格式错误'
    ];

    protected $scene = [
        'login'  =>  ['username','password'],

    ];


    //自定义验证场景
    public function addManage(){
        return $this->only(['username,password,mobile'])
            ->append(['username','unique:manage'])
            ->append(['mobile','unique:manage']);
    }
}
