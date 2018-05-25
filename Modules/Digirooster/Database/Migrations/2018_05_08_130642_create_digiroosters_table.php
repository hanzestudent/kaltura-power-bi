<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigiroostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digiroosters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object_id',255);
            $table->string('name',255);
            $table->string('type',255);
            $table->string('location',255);
            $table->string('speaker_id',255);
            $table->string('class_id',255);
            $table->timestamp('start_time_full')->nullable();
            $table->timestamp('end_time_full')->nullable();
            $table->string('start_date',255);
            $table->string('start_time',255);
            $table->string('end_date',255);
            $table->string('end_time',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digiroosters');
    }
}
