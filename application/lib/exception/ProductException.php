<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-02
 * Time: 15:32
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定商品不存在，请检查参数';
    public $errorCode = 20000;
}