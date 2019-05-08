<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeixinUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weixin_user_profile', function (Blueprint $table) {
            // weixin_user_profile
            $table->increments('id');
            $table->text('open_id')->comment('weixin openid');
            $table->string('nickName',100)->default('')->comment('微信用户nickname');
            $table->text('avatarUrl')->comment('微信用户头像');
            $table->tinyInteger('gender')->default(1)->comment('0:女,1:男');
            $table->string('country',255)->default('')->comment('国家');
            $table->string('province',120)->default('')->comment('省份');
            $table->string('city',120)->default('')->comment('城市');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weixin_user_profile');
    }
}
