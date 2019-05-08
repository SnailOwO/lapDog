<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room', function (Blueprint $table) {
            $table->increments('id');
            $table->text('users_id')->comment('chat room users ,隔开');
            $table->string('room_name',64)->default('lap dog')->comment('舔狗语句');
            $table->tinyInteger('type')->default(1)->comment('0:lapdog聊天室(预留字段)');
            $table->tinyInteger('status')->default(1)->comment('0:close 1:using 2: manual close');
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
        Schema::dropIfExists('chat_room');
    }
}
