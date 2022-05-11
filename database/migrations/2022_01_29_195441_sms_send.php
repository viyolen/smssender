<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SmsSend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_send', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('message');
            $table->string('from');
            $table->string('trackingId')->nullable();
            $table->dateTime('scheduleDate')->nullable();
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
        Schema::drop('sms_send');
    }
}
