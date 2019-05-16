<?php

namespace App\Repositories;
use App\WeixinUserProfile;

class UserRepository {
    use BaseRepository;

    public function __construct(WeixinUserProfile $WeixinUserProfile) {
        $this->model = $WeixinUserProfile;
    }
}
