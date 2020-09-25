<?php


namespace app\manage\controller;

use library\Token;
use think\App;
use think\Controller;
use think\facade\Cookie;
use think\Session;

class Login extends Controller
{
    function __construct(App $app = null)
    {
        parent::__construct($app);
        //不开启模板布局
        $this->view->engine->layout(false);
    }

    //后台用户登录
    public  function index()
    {
        $token = $this->request->param('admin_token', $this->request->param('admin_token', Cookie::get('admin_token')));
        if( $token ){
            $data = Token::get($token);
//            var_dump($data);die;
            if(isset($data['user_id'])){
                return $this->redirect(url('/manage/index/index'));
            }
        }
        $referer = $this->request->server('HTTP_REFERER');
        $host = $this->request->server('HTTP_HOST');
        if(
            "http://".$host.'/' == $referer || "https://".$host.'/' == $referer ||
            "http://".$host.'/install.php/' == $referer || "https://".$host.'/install.php/' == $referer
        ){
            $referer = $referer.'admin';
        }
        $normal_logout = Cookie::get('normal_logout');
        if(!$normal_logout && $referer){
            $parse_url = parse_url($referer);
            $query = '';
            if(isset($parse_url['query'])){
                $query = str_replace('=','/',$parse_url['query']);
                $query = str_replace('ref','laytp_menu_id',$query);
            }
            $this->assign('referer',$parse_url['scheme'].'://'.$parse_url['host'].$parse_url['path'].'/'.$query);
        }else{
            $this->assign('referer','');
        }
        Cookie::set('normal_logout',0);
        return $this->fetch();
    }



}