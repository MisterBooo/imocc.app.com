<?php

namespace app\common\lib;

/**
 * Class IAuth IAuth相关
 * @package app\common\lib
 */
class IAuth {


    /**
     * 设置密码
     * @param $data
     */
    public static function setPassword($data){
         return md5($data.config('password_pre_halt')) ;
    }


}