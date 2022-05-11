<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SmsSendReceivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_send_receivers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sms_id');
            $table->string('trackingId')->nullable();
            $table->string('number');
            $table->string('receriver')->nullable();
            $table->integer('statusCode')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('statusDate')->nullable();
            $table->float('price')->nullable();
            $table->integer('credit')->nullable();
            $table->string('country')->nullable();
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
        Schema::drop('sms_send_receivers');
    }
}
