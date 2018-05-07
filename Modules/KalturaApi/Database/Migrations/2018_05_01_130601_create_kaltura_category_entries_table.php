<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKalturaCategoryEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaltura_category_entries', function (Blueprint $table) {
            $table->increments('kaltura_category_entry_id');
            $table->integer('kaltura_category_id')->unsigned()->comment("Category id linked to this category entry");
            $table->string('kaltura_media_id',255)->comment("Media id linked to this category entry");
            $table->string('creator_user_id',255)->nullable(true)->comment("User Id that created the category entry");
            $table->string('category_full_ids',255)->comment("Full path to category");
            $table->integer('status')->comment("Status of category entry class CategoryEntryStatus");
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kaltura_category_entries');
    }
}
