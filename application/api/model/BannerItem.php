<?php

namespace app\api\model;

use think\Model;

class BannerItem extends Model
{

    protected $hidden = ['update_time', 'delete_time', 'id', 'img_id', 'banner_id'];

    public function img(){
        //关联模型，一对一 belongsTo
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
