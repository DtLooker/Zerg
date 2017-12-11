<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * http调用方法
 *
 * @param string $url       get请求地址
 * @param int $httpCode     返回状态码
 * @return mixed
 */
function curl_get($url, &$httpCode = 0){
    $ch = curl_init();//初始化 cURL session
    // Set an option for a cURL transfer
    curl_setopt($ch, CURLOPT_URL, $url);
    //设置此属性为true，则会返回正确或错误的具体信息。  否则，直接返回true或false
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //不做正数校验，部署在linux环境下改为true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    // 执行cURL session
    $file_contents = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch); //关闭
    return $file_contents;
}

function curl_post_raw($url, $rawData){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
    curl_setopt(
        $ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: text'//微信设置的是原始的XML,所以设置成这个
        )
    );
    $data = curl_exec($ch);
    curl_close($ch);
    return ($data);
}

/**
 * 根据需求获取一串字符串
 *
 * @param $length
 * @return null|string
 */
function getRandChar($length){
    $str = null;
    $strPol = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
    $max = strlen($strPol) - 1;

    for ($i = 0; $i < $length; $i++){
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}
