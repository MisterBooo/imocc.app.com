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

class Login extends Base {

    //防止在Base与Login之间不停的跳转
    public function _initialize(){
    }

    public function index(){
        $islogin = $this->isLogin();
        if ($islogin){
            //如果登录 跳转到后台首页
            return $this->redirect('index/index');
        }else{
            return $this->fetch();
        }
    }

    public function check(){

     if (request()->isPost()) {

         $data = input('post.');
         //为了不输入验证码 提高coding效率 关闭验证码
         //正确应该是  !captcha_check($data['code'])
         if (captcha_check($data['code'])) {
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
             session(config('admin.session_user'), $user, config('admin.session_user_scope'));
             $this->success('登录成功','index/index');
//             halt($user);
         }

      } else{
         $this->error('请求不合法');
      }


    }
    /**
     * 退出登录
     * 清空session
     * 跳转到登录
     */
    public function logout(){
        session(null,config('admin.session_user_scope'));
        //跳转
        $this->redirect('login/index');

    }
}