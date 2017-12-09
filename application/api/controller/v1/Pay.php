<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-09
 * Time: 9:06
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePositiveInt;
use app\api\service\Pay as PayService;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id=''){
        (new IDMustBePositiveInt())->goCheck();

        $pay = new PayService($id);
        $pay->pay();
    }
}