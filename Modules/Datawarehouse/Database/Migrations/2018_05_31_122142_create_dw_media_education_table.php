<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwMediaEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_media_education', function (Blueprint $table) {
            $table->increments('id');
            $table->string('media_id', 255)->comment("Kaltura Media Id");
            $table->string('education_code',255);
            $table->foreign('education_code')->references('education_code')->on('dw_education');
            $table->foreign('media_id')->references('id')->on('dw_media');
            $table->unique(['education_code','media_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_media_education');
    }
}
