<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-02
 * Time: 16:49
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在,请检查参数';
    public $errorCode = 50000;
}