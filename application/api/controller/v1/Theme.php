<?php

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\lib\exception\ThemeException;
use think\Controller;
use app\api\model\Theme as ThemeModel;

class Theme extends Controller
{
    /**
     * @url /theme?ids=id1,id2,id3,...
     * @return  1组 theme 模型
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();

        //explode把字符串打撒为数组
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')
            ->select($ids);

        if (!$result) {
            throw new ThemeException();
        }
        return $result;

    }

    public function getComplexOne($id){
        return 'success';
    }
}
