<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_media', function (Blueprint $table) {
            $table->string('id', 255)->comment("Kaltura Media Id");
            $table->integer('recording_id');
            $table->mediumText('name')->comment("Name of media entry");
            $table->text('description')->nullable(true)->comment("description thats provided for the video");
            $table->integer('media_type')->comment("What type of media is this. class MediaType");
            $table->string('source_type', 64)->comment("What kind of video is it class SourceType");
            $table->integer('duration')->comment("Duration of video in sec.");
            $table->integer('ms_duration')->comment("Duration of video in milliseconds");
            $table->string('user_id', 255)->comment("Current owner this is connected with kaltura user id");
            $table->string('creator_id', 255)->comment("creator of media entry connected with kaltura media id ");
            $table->text('tags')->nullable(true)->comment("Tags that have been added to the video");
            $table->integer('moderation_status')->nullable(false)->comment("Is this media entry approved by a reviewer class EntryModerationStatus");
            $table->integer('replacement_status')->comment("class EntryReplacementStatus");
            $table->string('root_entry_id', 255)->comment("what is the original id of the entry");
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
        Schema::dropIfExists('dw_media');
    }
}
