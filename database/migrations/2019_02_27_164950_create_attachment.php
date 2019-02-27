<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('attachment_id')->unsigned();
            $table->string('path');
            $table->string('filename')->nullable();
            $table->string('format')->nullable();
            $table->boolean('archived')->default(false);
            $table->integer('speaker_id')->unsigned();
            $table->foreign('speaker_id')->references('speaker_id')->on('speakers');
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
