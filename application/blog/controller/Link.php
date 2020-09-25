<?php


namespace app\blog\controller;

use think\Controller;

class Link extends Controller
{
    public function index()
    {
        return $this->fetch('link');
    }
}