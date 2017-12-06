<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-06
 * Time: 16:55
 */

namespace app\api\service;


use app\api\model\Product;

class Order
{
    // 订单的商品列表，即客户端传递过来的products参数
    protected $oProducts;

    // 真实商品信息（包括库存量）
    protected $products;

    protected $uid;

    public function place($uid, $oProducts){
        //oProducts和products作对比
        // products 从数据库中查询出来
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
    }

    //根据订单信息，查找真实的商品信息
    private function getProductsByOrder($oProducts){

        $oPIDs = [];
        foreach ($oProducts as $item){
            array_push($oPIDs, $item['product_id']);
        }
        $products = Product::all($oPIDs)
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();

        return $products;
    }
}