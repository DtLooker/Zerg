<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];

use think\Route;

//banner 接口
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');
//专栏接口
Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
//特定专栏 接口
Route::get('api/:version/theme/:id', 'api/:version.Theme/getComplexOne');

//Route::get('api/:version/product/recent', 'api/:version.Product/getRecent');
//Route::get('api/:version/product/by_category', 'api/:version.Product/getAllInCategory');
//Route::get('api/:version/product/:id', 'api/:version.Product/getOne', [], ['id' => '\d+']);

//路由分组
Route::group('api/:version/product', function (){

    Route::get('/recent', 'api/:version.Product/getRecent');

    Route::get('/by_category', 'api/:version.Product/getAllInCategory');

    Route::get('/:id', 'api/:version.Product/getOne', [], ['id' => '\d+']);
});

Route::get('api/:version/category/all', 'api/:version.Category/getAllCategories');

Route::post('api/:version/token/user', 'api/:version.Token/getToken');

Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');

Route::post('api/:version/order', 'api/:version.Order/placeOrder');

Route::get('api/:version/order/:id', 'api/:version.Order/getDetail', [], ['id'=>'\d+']);

Route::post('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');

Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');

Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');

Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');



