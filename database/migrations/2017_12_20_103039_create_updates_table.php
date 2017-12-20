<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('chat_id')->nullable();
            $table->string('message_id')->nullable();
            $table->string('from_id')->nullable();
            $table->string('date')->nullable();
            $table->string('text')->nullable();
            $table->string('type')->nullable();
            $table->string('new_chat_member')->nullable();
            $table->string('left_chat_member')->nullable();
            $table->longText('raw_updates')->nullable();
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
        Schema::dropIfExists('updates');
    }
}
