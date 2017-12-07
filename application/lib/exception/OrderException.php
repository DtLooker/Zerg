<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/12/7
 * Time: 21:13
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}