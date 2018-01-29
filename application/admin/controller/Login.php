<?php
/**
 * Created by MisterBigbooo.
 * User: Zeno
 * Date: 2018/1/29
 * Time: 下午4:31
 */
namespace app\admin\controller;

use think\Controller;
use app\common\lib\IAuth;
class Login extends Controller{

    public function index(){
        return $this->fetch();
    }

    public function check(){

     if (request()->isPost()) {
         $data = input('post.');
         if (!captcha_check($data['code'])) {
             $this->error('验证码不正确');
         } else {
//             $this->success('通过');
             $user = model('AdminUser')->get(['username' => $data['username']]);
             if (!$user || $user->status != 1){
                 $this->error('用户不存在');
             }
             //再校验密码
             if (IAuth::setPassword($data['password']) != $user['password']){
                 $this->error('密码错误');
             }
             halt($user);
         }

      } else{
         $this->error('请求不合法');
      }


    }
}