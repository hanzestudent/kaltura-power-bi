<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKalturaMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('kaltura_media')) {
            Schema::create('kaltura_media', function (Blueprint $table) {
                $table->string('kaltura_media_id', 255)->comment("Kaltura Media Id");
                $table->mediumText('name')->comment("Name of media entry");
                $table->text('description')->nullable(true)->comment("description thats provided for the video");
                $table->integer('media_type')->comment("What type of media is this. class MediaType");
                $table->string('source_type', 64)->comment("What kind of video is it class SourceType");
                $table->string('license_type', 64)->nullable(true)->comment("What kind of license has this video class LicenseType");
                $table->string('type')->default(0)->nullable(false)->comment("What type of media entry is this. class EntryType");
                $table->integer('duration')->comment("Duration of video in sec.");
                $table->integer('ms_duration')->comment("Duration of video in milliseconds");
                $table->string('kaltura_user_id', 255)->comment("Current owner this is connected with kaltura user id");
                $table->string('kaltura_creator_id', 255)->comment("creator of media entry connected with kaltura media id ");
                $table->text('tags')->nullable(true)->comment("Tags that have been added to the video");
                $table->string('status', 64)->nullable(false)->comment("What status has the media entry class EntryStatus");
                $table->integer('moderation_status')->nullable(false)->comment("Is this media entry approved by a reviewer class EntryModerationStatus");
                $table->integer('replacement_status')->comment("class EntryReplacementStatus");
                $table->string('root_entry_id', 255)->comment("what is the original id of the entry");
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kaltura_media');
    }
}
