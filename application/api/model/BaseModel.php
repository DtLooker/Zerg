<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //getUrlAttr 自动被tp5框架识别为读取器
    protected function prefixImgUrl($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
