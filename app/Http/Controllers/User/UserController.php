<?php

namespace App\Http\Controllers\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // 用于记录用户相关的信息

    // 用于获取登录后，根据code 获取相应的wx用户信息
    public function wxLogin(Request $request)
    {
        try {
            $param = $request->only(['code', 'iv', 'signature', 'encryptedData']);
            Log::info('jscode:', $param);
            $rules = [
                'code' => 'required',
                'iv' => 'required',
                'signature' => 'required',
                'encryptedData' => 'required'
            ];
            $method_result = customValidate($param, $rules);
            if ($method_result) {
                return failResponse($method_result);
            }
            $wx_return_ary = app('mini')->auth->session($param['code']);
            Log::info('wx_return_ary:', $wx_return_ary);
            if (isset($wx_return_ary['errcode'])) {   // 获取wx信息失败
                throw new Exception($wx_return_ary['errmsg']);
            }
            $wx_user_info = app('mini')->encryptor->decryptData($wx_return_ary['session_key'], $param['iv'], $param['encryptedData']);

            // $demo = app('mini')->encryptor->decryptData($wx_return_ary['session_key'], $iv, $encryptData);;
            // 当获取到openid之后，发放token，以及记录进自定义表中
            return $wx_return_ary;
        } catch (Exception $e) {
            Log::error(sprintf('使用jscode:%s,获取:wx session失败!', $param['code']), ['error_msg' => $e->getMessage()]);
            return failResponse('获取微信用户信息失败!');
        }
    }
}
