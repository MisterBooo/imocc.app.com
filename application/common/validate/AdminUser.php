<?php
/**
 * Created by MisterBigbooo.
 * User: Zeno
 * Date: 2018/1/29
 * Time: 下午3:51
 */

namespace app\common\validate;

use  think\Validate;

class AdminUser extends Validate{

    protected $rule = [
        'username' => 'require|max:20',
        'password' => 'require|max:20'
    ];

}