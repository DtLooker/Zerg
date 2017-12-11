<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-11
 * Time: 11:37
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger',
    ];

    protected $message = [
        'page' => '分页参数必须是正数',
        'size' => '分页参数必须是正数',
    ];
}