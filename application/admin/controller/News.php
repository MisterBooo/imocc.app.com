<?php
namespace app\admin\controller;

use  think\Controller;

class News extends Base {


    public function add(){
        //加载模板输出
        return $this->fetch();
    }


}
