<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/11/30
 * Time: 21:06
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @id banner的id号
     * @url /banner/:id
     * @http GET
     */
    public function getBanner($id){
        (new IDMustBePositiveInt())->goCheck();
    }
}