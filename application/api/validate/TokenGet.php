<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-04
 * Time: 9:51
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => '没有code不能获取Token'
    ];


}