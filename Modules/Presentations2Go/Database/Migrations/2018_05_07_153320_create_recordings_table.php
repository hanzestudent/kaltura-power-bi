<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordings', function (Blueprint $table) {
            $table->string('title',255)->nullable(false)->comment("Title of recording");
            $table->text('description')->nullable(true)->comment("Description of recording");
            $table->string('tags')->nullable(true)->comment("Keyword of recording");
            $table->string('creator_id')->nullable(false)->comment("id of user can be 4 digits");
            $table->integer('duration')->nullable(false)->comment("Duration of recording");
            $table->timestamp('recorded_at')->nullable(false)->comment("Recording has been recorded at");
            $table->index(['title','creator_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recordings');
    }
}
