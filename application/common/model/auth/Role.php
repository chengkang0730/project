<?php
/**
 * 后台菜单模型
 */
namespace app\common\model\auth;

use model\Base;

class Role extends Base
{
    protected $name = 'admin_role';
    protected $autoWriteTimestamp = 'datetime';
}