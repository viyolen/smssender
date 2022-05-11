<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmailSendReceivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_send_receivers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('email_send_id');
            $table->string('trackingId')->nullable();
            $table->string('email');
            $table->string('status')->nullable();
            $table->dateTime('statusDate')->nullable();
            $table->float('price')->nullable();
            $table->integer('credit')->nullable();
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
        Schema::drop('email_send_receivers');
    }
}
