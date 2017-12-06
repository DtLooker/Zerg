<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017-12-04
 * Time: 9:59
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');

        //sprintf 把格式化的字符串写入变量中
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppID,
            $this->wxAppSecret, $this->code);
    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        //转换成json格式
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            //属于服务器内部异常，没必要返回到客户端，所以没自定义异常
            throw new Exception('获取session_key及openID异常，微信内部异常');
        } else {
            //调用错误，微信会返回一个errCode码。正常就没有errCode码
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }

    private function grantToken($wxResult)
    {
        // 拿到openId
        // 数据库确认，是否存在此openId
        // 如果存在，则不处理，不存在，新增一条use数据
        //生成令牌，准备缓存数据，写入缓存
        // 把令牌返回到客户端去
        //key: 令牌   value: wxResult，uid(数据库中id，唯一), scope(决定哪些接口可以访问)
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if ($user) {
            $uid = $user->id;//存在，返回数据库中id
        } else {
            $uid = $this->newUser($openid);//不存在，插入到数据库
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    private function saveToCache($cachedValue)
    {

        $key = self::generateToken();
        //转换成json
        $value = json_encode($cachedValue);
        $expire_in = config('setting.token_expire_in');

        $request = cache($key, $value, $expire_in);
        if(!$request){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;

        //scope=16 代表App用户权限数值
        //scope=32 代表CMS（管理员）用户的权限数值
        $cachedValue['scope'] = ScopeEnum::User;

        return $cachedValue;
    }

    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    private function processLoginError($wxResult)
    {
        throw  new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }
}