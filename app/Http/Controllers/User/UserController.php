<?php

namespace App\Http\Controllers\User;
use Exception;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller {

    public $userService;

    // 用于记录用户相关的信息
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    // 用于获取登录后，根据code 获取相应的wx用户信息
    public function wxLogin(Request $request) {
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
        } catch (Exception $e) {
            Log::error(sprintf('使用jscode:%s,获取:wx session失败!', $param['code']), ['error_msg' => $e->getMessage()]);
            return failResponse('获取微信用户信息失败!');
        }
        Redis::set(sprintf('sessionKey4%s',$wx_return_ary['openid']),$wx_return_ary['session_key']);
        $wx_user_info = app('mini')->encryptor->decryptData($wx_return_ary['session_key'], $param['iv'], $param['encryptedData']);
        // 当获取到openid之后，发放token，以及记录进自定义表中
        $result = $this->userService->addUser($wx_user_info);
        if($result === false) {
            return failResponse(['系统繁忙,请稍候再试']);
        }
        // 发放token
        // $user = Auth::user();
        $wx_user_info['token'] = $result->createToken('lapDog')->accessToken;
        return $wx_user_info;
    }

    public function demo(Request $request) {
        dd('cc');
        return $request->all();
    }
}
