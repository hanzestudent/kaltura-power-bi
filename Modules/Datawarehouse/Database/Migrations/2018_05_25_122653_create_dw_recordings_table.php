<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_recordings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->nullable(true)->comment("Title of recording");
            $table->text('description')->nullable(true)->comment("Description of recording");
            $table->string('tags')->nullable(true)->comment("Keyword of recording");
            $table->string('device')->nullable(true)->comment("name of device");
            $table->string('creator_id')->nullable(true)->comment("id of user can be 4 digits");
            $table->integer('duration')->nullable(true)->comment("Duration of recording");
            $table->timestamp('recorded_at')->nullable(true)->comment("Recording has been recorded at");
            $table->string('object_id',255);
            $table->string('name',255);
            $table->string('type',255);
            $table->string('location',255);
            $table->timestamp('start_time_full')->nullable();
            $table->timestamp('end_time_full')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_recordings');
    }
}
