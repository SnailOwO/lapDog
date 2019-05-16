<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WeixinUserProfile extends Authenticatable {
    use HasApiTokens, Notifiable;

    protected $table = 'weixin_user_profile';

    protected $fillable = [
                            'open_id',
                            'nickName',
                            'avatarUrl',
                            'gender',
                            'country',
                            'province',
                            'city'
                        ];

}
