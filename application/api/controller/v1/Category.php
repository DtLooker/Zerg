<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-02
 * Time: 16:33
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::all([], 'img');
        if(!$categories){
            throw new CategoryException();
        }
        return $categories;
    }
}