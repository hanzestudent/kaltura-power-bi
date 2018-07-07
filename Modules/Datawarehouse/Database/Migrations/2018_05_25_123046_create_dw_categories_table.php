<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable(true)->comment("Parent Category Id of current Category");
            $table->integer('depth')->comment("How many parents before this one");
            $table->string('name',255)->comment("Name of category");
            $table->integer('course_id')->unsigned()->nullable(true);
            $table->string('full_ids',255)->comment("parents path to this category");
            $table->string('owner',255)->nullable(true)->comment("who is the owner of this category");
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
        Schema::dropIfExists('dw_categories');
    }
}
