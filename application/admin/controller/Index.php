<?php
namespace app\admin\controller;

use  think\Controller;

class Index extends Base
{


    public function index()
    {
        $islogin = $this->isLogin();
        //未登录
        if (!$islogin){
            return $this->redirect('login/index');
        }else{
            return $this->fetch();
        }

    }
    public function welcome(){
        return 'hello world';
    }


}
