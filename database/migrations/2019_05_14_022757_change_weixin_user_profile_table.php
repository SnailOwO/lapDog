<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeWeixinUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weixin_user_profile', function (Blueprint $table) {
            //
            $table->string('language',100)->default('')->comment('微信用户使用语言');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weixin_user_profile', function (Blueprint $table) {
            //
        });
    }
}
