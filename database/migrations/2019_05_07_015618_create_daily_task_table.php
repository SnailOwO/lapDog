<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_task', function (Blueprint $table) {
            // daily_task
            $table->increments('id');
            $table->unsignedInteger('tasks_id')->default(0)->comment('tasks_id');
            $table->text('open_id')->comment('weixin openid');
            $table->unsignedInteger('wx_user_id')->default(0)->comment('weixin_user_profie');
            $table->tinyInteger('is_finsh')->default(0)->comment('0:未完成 1:已完成');
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
        Schema::table('daily_task', function (Blueprint $table) {
            //
        });
    }
}
