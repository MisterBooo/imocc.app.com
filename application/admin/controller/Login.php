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
use think\Request;

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
              try{
                  $user = model('AdminUser')->get(['username' => $data['username']]);
              }catch (\Exception $e){
                  $this->error($e->getMessage());
              }

              if (!$user || $user->status != config('code.status_normal')){
                     $this->error('用户不存在');
              }
                 //再校验密码
              if (IAuth::setPassword($data['password']) != $user['password']){
                     $this->error('密码错误');
              }
                 // 1 更新数据库 登录时间 登录ip
              $udata = [
                     'last_login_time' =>time(),
                     'last_login_ip' => request()->ip(), //获取ip
              ];

             try{
                 model('AdminUser')->save($udata,['id' => $user->id]);
             }catch (\Exception $e){
                 $this->error($e->getMessage());
             }

             // 2 session
             session('adminuser',$user,'imooc_app_scope');
             $this->success('登录成功','index/index');
//             halt($user);
         }

      } else{
         $this->error('请求不合法');
      }


    }
}