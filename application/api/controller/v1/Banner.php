<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/11/30
 * Time: 21:06
 */

namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissException;

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
        (new IDMustBePositiveInt())->goCheck();

        //get, find 只能找一条       all, select 一组记录
        $banner = BannerModel::getBannerByID($id);

        if(!$banner){
           throw new BannerMissException();
        }
        return $banner;
    }
}