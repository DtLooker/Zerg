<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-06
 * Time: 14:43
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenService;

class Order extends BaseController
{
    // 用户选择商品后，向API提交所选择商品的相关信息
    // API在接收到信息后，需要检查订单相关商品库存量
    // 有库存，把订单数据存入数据库中。。。下单成功了，返回客户端消息，告诉客户端可以支付了
    // 调用我们的支付接口，进行支付
    // 还需要再次进行库存量检测
    // 服务器这边可以调用微信的支付接口进行支付
    // 微信会返回给我们一个支付的结果（异步）
    // 成功： 也需要进行可存量检测
    // 成功： 进行库存量的扣除

    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        //获取post传递的数据，因为products是数组，想要获取数组，要写成post.products/a
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
    }
}