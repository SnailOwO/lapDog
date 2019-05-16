<?php

namespace App\Service;
use App\Service\BaseService;
use App\Repositories\UserRepository;

class UserService extends BaseService {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    // 微信初步登录时，用户添加
    public function addUser($data) {
        $rules = [
            'openId' => 'required|String',
            'nickName' => 'required|String',
            'gender' => 'required|Integer',
            'language' => 'required|String',
            'city' => 'required|String',
            'province' => 'required|String',
            'country' => 'required|String',
            'avatarUrl' => 'required|String',
        ];
        $result = $this->veritify($data,$rules);
        if(!empty($result)) {
            return $result;
        }
        // 入库
        $data = $this->formatData($data);
        return $this->userRepository->getModel()->firstOrCreate($data);
    }

    // 组装入库格式的数据
    public function formatData($data) {
        if(isset($data['watermark'])) {
            unset($data['watermark']);
        }
        $open_id = $data['openId'];
        unset($data['openId']);
        $data['open_id'] = $open_id;
        return $data;
    }
}
