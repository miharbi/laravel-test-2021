<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->text('done')->nullable();
            $table->text('doing')->nullable();
            $table->text('blocking')->nullable();
            $table->text('todo')->nullable();
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
        Schema::dropIfExists('daily_meetings');
    }
}
