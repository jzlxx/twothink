<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络  <82550565@qq.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

class Index extends Base
{
    public function index(){
        if (!is_login()){
            $this->error( '您还没有登陆',url('User/login') );
        }
        return $this->fetch();
    }
}