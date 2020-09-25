<?php


namespace app\manage\controller;

use think\Controller;
use think\facade\Session;
use app\common\model\Manage;
use think\facade\Request;

use library\Random;
use library\Token;
use think\facade\Cookie;
use app\common\validate\Login;
use app\common\model\AdminUser;

class Common extends Controller
{

    //后台管理系统--用户登录
    public function login()
    {
//        $shop_name = getSetting('shop_name');
//        $this->assign('shop_name',$shop_name);
        if (session('?manage')) {
            $this->success('已经登录成功，跳转中...',redirect_url());
        }
        if(Request::isPost()){
            $manageModel = new Manage();
//            var_dump(input('param.'));die;
            $result = $manageModel->toLogin(input('param.'));
            if($result['status']){
                if(Request::isAjax()){
                    $result['data'] = redirect_url();
                    return $result;
                }else{
                    $this->redirect(redirect_url());
                }
            }else{
                return $result;
            }
        }else{
            return $this->fetch('index');
        }
    }

    //后台用户登录
    public function do_login(){
        $validate = new Login();
        $param = $this->request->param();
        // var_dump($param);die;
        if (!$validate->check($param))
            return $this->error($validate->getError());
        //设置登录信息
        $adminUserModel = new AdminUser();
        $user_id = $adminUserModel->where('username','=',$param['username'])->value('id');
//        var_dump($user_id);die;
        $token = Random::uuid();
        Token::set($token, $user_id, 24 * 60 * 60 * 3);
        return $this->success('登录成功','/manage/index/index?ref=1',['admin_token'=>$token]);
    }
}