<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-05
 * Time: 16:03
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];

    public function imgUrl(){
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}