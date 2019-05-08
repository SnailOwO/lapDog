<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chat_room_id')->default(0)->comment('chat_room');
            $table->unsignedInteger('wx_user_id')->default(0)->comment('weixin_user_profie id');
            $table->text('content')->comment('record');
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
        Schema::dropIfExists('chat_room_records');
    }
}
