<?php

namespace app\api\model;

class BannerItem extends BaseModel
{

    protected $hidden = ['update_time', 'delete_time', 'id', 'img_id', 'banner_id'];

    public function img(){
        //关联模型，一对一 belongsTo
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
