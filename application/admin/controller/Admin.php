<?php
namespace app\admin\controller;

use  think\Controller;

class Admin extends Controller
{
   public function add(){

       //判定是否是post提交
       if (request()->isPost()){

////           dump(input('post.'));
//           halt(input('post.'));
           $data = input('post.');
           $validate = validate('AdminUser');
           //校验
           if (!$validate->check($data)){
               $this->error($validate->getError());
           }

           $data['password'] = md5($data['password'].'_#sing_ty');
           $data['status'] = 1;

           try{
               $id =  model('AdminUser')->add($data);
           }catch (\Exception $e){
               //exception
//               echo $e->getMessage();
               $this->error($e->getMessage());
           }
           if ($id){
               $this->success('id='.$id.'的用户新增成功');
           }else{
               $this->error($e->getMessage());

//               $this->error();
           }



       }else{
           return $this->fetch();

       }


   }
}