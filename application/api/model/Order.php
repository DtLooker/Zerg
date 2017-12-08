<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/12/7
 * Time: 22:42
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;
}