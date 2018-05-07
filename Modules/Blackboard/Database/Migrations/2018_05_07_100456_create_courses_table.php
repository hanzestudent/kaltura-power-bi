<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->string('course_id',255)->comment("Course id from blackboard");
            $table->string('name',255)->nullable(true)->comment("Course name for course id");
            $table->timestamp('created_at')->nullable(true)->comment("Course was created at");
            $table->integer('number_of_enrolled_users')->nullable(true)->comment("users that have enrolled to course");
            $table->index(['course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
