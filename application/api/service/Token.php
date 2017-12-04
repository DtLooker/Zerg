<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-04
 * Time: 11:24
 */

namespace app\api\service;


class Token
{
    public static function generateToken(){
        // 32个字符串组成一组随机字符串
        $randChars = getRandChar(32);
        //用三组字符串，进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        // SALT  盐
        $salt = config('secure.token_salt');

        return md5($randChars . $timestamp . $salt);
    }
}