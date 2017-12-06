<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-04
 * Time: 9:58
 */

namespace app\api\model;


class User extends BaseModel
{

    public function address()
    {
        //有外键要一对一关联没有外键另一方，要用belongsTo
        //没有外键要一对一关联有外键的另一方， 要用hasOne
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }


}