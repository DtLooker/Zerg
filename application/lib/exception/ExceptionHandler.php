<?php
/**
 * Created by PhpStorm.
 * User: looker
 * Date: 2017/11/30
 * Time: 22:11
 */

namespace app\lib\exception;

use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    //需要返回客户端当前请求url路径

    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            //如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;

        } else {

            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = '服务器内部错误,不告诉你...';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
        }

        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];

        return json($result, $this->code);
    }

    private function recordErrorLog(\Exception $e)
    {
        //关闭了系统日志，要初始化日志
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}