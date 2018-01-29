<?php
/**
 * Created by MisterBigbooo.
 * User: Zeno
 * Date: 2018/1/29
 * Time: 下午4:31
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller{

    public function index(){
        return $this->fetch();
    }

    public function check(){

        $data = input('post.');
       if (!captcha_check($data['code'])) {
           $this->error('验证码失败');
       }else{
           $this->success('通过');
       }

    }
}