<?php
/**
 * 地区表模型
 */
namespace app\common\model;

use model\Base;

class Area extends Base
{
    //模型名
    protected $name = 'area';

    //表名
    

    //数组常量
    public $const = [
		'level' => [
			'1'=>'省'
			,'2'=>'市'
			,'3'=>'区县'
		],
    ];

    //关联模型
    public function area(){
        return $this->belongsTo('app\common\model\Area','pid','id');
    }
}
