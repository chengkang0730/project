<?php
/**
 * 管理员日志表模型
 */
namespace app\common\model\admin;

use think\Model;

class Log extends Model
{
    //模型名
    protected $name = 'admin_log';

    //表名
    

    //数组常量
    public $const = [

    ];

    public function admin(){
        return $this->belongsTo('app\common\model\auth\User','admin_id','id');
    }
    
}
