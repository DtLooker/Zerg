<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-02
 * Time: 11:21
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在';
    public $errorCode = 30000;
}