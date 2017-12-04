<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-02
 * Time: 9:40
 */

namespace app\api\model;


class Product extends BaseModel
{
    //pivot 多对多关系中间表
    protected $hidden = [
        'delete_time', 'create_time', 'update_time',
        'main_img_id', 'pivot', 'from', 'category_id',
        'summary'
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count){
        $products = self::limit($count)
            ->order('create_time desc')//desc 降序
            ->select();

        return $products;
    }

    public static function getProductsByCategoryID($categoryID){
        $products = self::where('category_id', '=', $categoryID)
            ->select();
        return $products;
    }
}