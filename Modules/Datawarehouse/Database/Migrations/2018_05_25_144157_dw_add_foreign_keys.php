<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DwAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dw_courses', function (Blueprint $table) {
             $table->foreign('education_code')->references('education_code')->on('dw_education');
        });
        Schema::table('dw_views', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('dw_media');
            $table->foreign('user_id')->references('id')->on('dw_users');
        });
        Schema::table('dw_media', function (Blueprint $table) {
            $table->foreign('recording_id')->references('id')->on('dw_recordings');
            $table->foreign('user_id')->references('id')->on('dw_users');
            $table->foreign('creator_id')->references('id')->on('dw_users');
        });
        Schema::table('dw_category_entries', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('dw_categories');
            $table->foreign('media_id')->references('id')->on('dw_media');
            $table->foreign('user_id')->references('id')->on('dw_users');
        });
        Schema::table('dw_categories', function (Blueprint $table) {
            $table->foreign('owner')->references('id')->on('dw_users');
            $table->foreign('course_id')->references('id')->on('dw_courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
