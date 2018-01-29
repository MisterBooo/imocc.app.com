<?php
namespace app\admin\controller;

use  think\Controller;

class Base extends Controller
{

    public function _initialize()
{
    $isLogin = $this->isLogin();
    //未登录，重定向到登录界面
    if (!$isLogin){
        $this->redirect('login/index');
    }

}

    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin(){
        $user = session(config('admin.session_user'), '', config('admin.session_user_scope'));
        if ($user && $user->id) {
            return true;
        }
        return false;
    }


}
