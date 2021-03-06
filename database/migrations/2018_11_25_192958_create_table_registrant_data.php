<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegistrantData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrant_datas', function (Blueprint $table) {
            $table->increments('registrant_id');
            $table->string('registration_code');
            $table->string('name');
            $table->string('email');
            $table->string('position');
            $table->string('phone');
            $table->string('company');
            $table->longText('company_address');
            $table->integer('payment_method')->unsigned();
            $table->integer('status')->unsigned()->default(0);
            $table->integer('certificate')->unsigned()->default(0);
            $table->string('qr_path');
            $table->integer('event_id')->unsigned();
            $table->foreign('registration_code')->references('email')->on('registrants');
            $table->foreign('event_id')->references('event_id')->on('events');
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
        //
    }
}
