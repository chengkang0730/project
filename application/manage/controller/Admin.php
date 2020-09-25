<?php


namespace app\manage\controller;


use controller\Backend;


class Admin extends Backend
{

    public function index()
    {
        return $this->fetch('index/index');
    }

}