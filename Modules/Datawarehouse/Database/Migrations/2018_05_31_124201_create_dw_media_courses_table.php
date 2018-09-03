<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwMediaCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_media_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('media_id', 255)->comment("Kaltura Media Id");
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('dw_courses');
            $table->foreign('media_id')->references('id')->on('dw_media');
            $table->unique(['course_id','media_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_media_courses');
    }
}
