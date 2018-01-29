<?php
/**
 * Created by MisterBigbooo.
 * User: Zeno
 * Date: 2018/1/29
 * Time: 下午3:56
 */

namespace app\common\model;

use  think\Model;

class AdminUser extends Model{
    protected $autoWriteTimestamp = true;

    public function add($data){
        if (!is_array($data)){
            exception('传递数据不合法');
        }

        //allowField 过滤空数据
        $this->allowField(true)->save($data);

        return $this->id;

    }
}