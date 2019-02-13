<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsespeakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsespeakers', function (Blueprint $table) {
            $table->increments('responsespeaker_id');
            $table->integer('speaker_id')->unsigned();
            $table->string('registrant_email');
            $table->foreign('speaker_id')->references('speaker_id')->on('speakers');
            $table->foreign('registrant_email')->references('email')->on('registrants');
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
        // Schema::dropIfExists('responsespeakers');
    }
}
