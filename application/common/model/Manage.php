<?php

/**
 * 后台管理员模型
 * User: chengkang
 * Date: 2018/5/28
 * Time: 15:06
 */
namespace app\common\model;

use think\exception\ValidateException;
use think\Model;
use think\facade\Validate;
use app\common\validate\Manage as manageValidate;

class Manage extends Model{
    const SUPER_MANAGE_ID = 1;

    const STATUS_NORMAL = 1;        //用户状态 正常
    const STATUS_DISABLE = 2;       //用户状态 停用

    //用户登录
    public function toLogin($data)
    {
        //返回的结果
        $result = array(
            'status' => false,
            'data' => '',
            'msg' => ''
        );
//        var_dump($data);die;
        //校验手机号码和密码
//        if (!isset($data['username']) || !isset($data['password'])) {
//            $result['msg'] = '请输入手机号码或者密码';
//            return $result;
//        }
        //校验手机号和密码
        $manageValidate = new manageValidate();

        if(!$manageValidate->scene('login')->check($data)){
            $result['msg'] = $manageValidate->getError();
            return $result;
        }
//        var_dump($result);die;

        //校验验证码
        if (session('?manage_login_fail_num')) {
            if (session('manage_login_fail_num') >= config('system.manage_login_fail_num')) {
                if (!isset($data['code']) || $data['code'] == '') {
                    return error_code(10013);
                }
                if (!captcha_check($data['code'])) {
                    return error_code(10012);
                };
            }
        }

        $userInfo = $this->where(array('username' => $data['username']))->whereOr(array('mobile' => $data['username']))->find();
        if (!$userInfo) {
            $result['msg'] = '没有找到此账号';
            return $result;
        }
        //判断账号状态
        if ($userInfo->status != self::STATUS_NORMAL) {
            $result['msg'] = '此账号已停用';
            return $result;
        }
        //判断是否是用户名登陆
        $userInfo = $this->where(array('username|mobile' => $data['username'], 'password' => $this->enPassword($data['password'], $userInfo->ctime)))->find();
        if ($userInfo) {
            $result = $this->setSession($userInfo);
        } else {
            //写失败次数到session里
            if (session('?manage_login_fail_num')) {
                session('manage_login_fail_num', session('manage_login_fail_num') + 1);
            } else {
                session('manage_login_fail_num', 1);
            }
            $result['msg'] = '密码错误，请重试';
        }
        return $result;

    }

    //保存用户信息到session
    private function setSession($userInfo)
    {
        $result = [
            'status' => false,
            'data' => '',
            'msg' => ''
        ];
        session('manage', $userInfo->toArray());

//        $userLogModel = new UserLog();//添加登录日志
//        $userLogModel->setLog($userInfo->id, $userLogModel::USER_LOGIN);

        $result['status'] = true;
        return $result;
    }

    /**
     * 密码加密方法
     * @param string $pw 要加密的字符串
     * @return string
     */
    private function enPassword($password, $ctime)
    {

        return md5(md5($password) . $ctime);
    }
}
