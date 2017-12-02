<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-02
 * Time: 16:33
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = [
        'delete_time', 'update_time'
    ];
    public function img(){
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}