<?php
namespace app\admin\controller;

use  think\Controller;

class Index extends Controller
{
    public function index()
    {
//        halt(session(config('admin.session_user'), '', config('admin.session_user_scope')));
        return $this->fetch();
    }
    public function welcome(){
        return 'hello world';
    }



}
