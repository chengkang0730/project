<?php

namespace app\admin\behavior;

class AdminLog
{

    public function run($token)
    {
//        if (request()->isPost())
//        {
        \app\common\model\AdminLog::record($token);
//        }
    }

}
