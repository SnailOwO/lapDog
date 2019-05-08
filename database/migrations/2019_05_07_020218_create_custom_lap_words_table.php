<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomLapWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_lap_words', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wx_user_id')->default(0)->comment('wx_user_id');
            $table->text('word')->comment('舔狗语句');
            $table->tinyInteger('status')->default(1)->comment('0:下线 1:在线');
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
        Schema::dropIfExists('custom_lap_words');
    }
}
