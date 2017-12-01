<?php

namespace app\api\model;

use think\Model;

class Image extends Model
{
    protected $hidden = ['from', 'id', 'delete_time', 'update_time'];

    public function getUrlAttr($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
