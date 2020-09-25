<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');

use think\facade\Route;

//博客首页
Route::get("/",'blog/index/index');
//博文列表页
Route::get('/article','blog/article/index');
//留言板
Route::get('/message','blog/message/index');
//日记
Route::get('/diary','blog/diary/index');
//友链
Route::get('/link','blog/link/index');
return [

];
