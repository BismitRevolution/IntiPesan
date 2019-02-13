<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsetrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsetracks', function (Blueprint $table) {
            $table->increments('responsetrack_id');
            $table->integer('track_id')->unsigned();
            $table->string('registrant_email');
            $table->foreign('track_id')->references('track_id')->on('tracks');
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
        // Schema::dropIfExists('responsetracks');
    }
}
