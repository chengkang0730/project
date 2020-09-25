<?php
/**
 * 系统配置
 */
namespace app\common\model;

use model\Base;

class Sysconf extends Base
{
    public function addData($post){
        $data['group'] = $post['group'];
        $data['type'] = $post['type'];
        $data['key'] = $post['key'];
        $data['name'] = $post['name'];
        $data['value'] = $post['value'];
        $this->insert($data,true);
        return true;
    }

    public function saveData($post,$group){
        foreach($post as $k=>$v){
            $data['group'] = $group;
            $data['key'] = $k;
            $data['value'] = $v;
            $this->insert($data,true);
        }
        return true;
    }
}