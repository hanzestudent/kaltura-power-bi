<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKalturaCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaltura_categories', function (Blueprint $table) {
            $table->increments('kaltura_category_id');
            $table->integer('parent_id')->comment("Parent Category Id of current Category");
            $table->integer('depth')->comment("How many parents before this one");
            $table->string('name',255)->comment("Name of category");
            $table->string('education_code',255)->nullable(true)->comment("Code for educations");
            $table->string('full_ids',255)->comment("parents path to this category");
            $table->string('owner',255)->nullable(true)->comment("who is the owner of this category");
            $table->integer('status')->comment("Status of category class CategoryStatus");
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
        Schema::dropIfExists('kaltura_categories');
    }
}
