<?php


namespace app\blog\controller;

use think\Controller;

class Message extends Controller
{
    public function index()
    {
        return $this->fetch('message');
    }
}