<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/11/30
 * Time: 21:50
 */

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends Model
{

    protected $hidden = ['update_time', 'delete_time'];

    public function items(){
        //hsaMany()关联其他模型,一对多
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id)
    {
        $banner = self::with(['items', 'items.img'])->find($id);
        return $banner;
    }
}
