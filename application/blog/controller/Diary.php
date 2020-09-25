<?php


namespace app\blog\controller;

use think\Controller;

class Diary extends Controller
{
    public function index()
    {
        return $this->fetch('diary');
    }
}