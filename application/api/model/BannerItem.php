<?php

namespace app\api\model;

use think\Model;

class BannerItem extends Model
{

    public function img(){
        //关联模型，一对一 belongsTo
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
