<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/11/30
 * Time: 21:06
 */

namespace app\api\controller\v2;

class Banner
{
    /**
     * 获取指定id的banner信息BannerMissException
     * @id banner的id号
     * @url /banner/:id
     * @http GET
     */
    public function getBanner($id)
    {

        echo 'this is the second version';
    }
}