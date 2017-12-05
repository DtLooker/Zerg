<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-05
 * Time: 16:06
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = ['product_id', 'delete_time', 'id'];
}