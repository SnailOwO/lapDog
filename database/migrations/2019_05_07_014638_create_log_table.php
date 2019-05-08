<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            // log表，主要用于多种用户行动记录
            $table->increments('id');
            $table->unsignedInteger('wx_user_id')->comment('weixin_user_profie');
            $table->string('action', 32)->comment('LOGIN:登录,START_LAP:开舔,CLOSE_LAP:关舔');
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
        Schema::table('log', function (Blueprint $table) {
            //
        });
    }
}
