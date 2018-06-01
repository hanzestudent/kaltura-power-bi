<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwMediaCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_media_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('media_id', 255)->comment("Kaltura Media Id");
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('dw_categories');
            $table->foreign('media_id')->references('id')->on('dw_media');
            $table->unique(['category_id','media_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_media_categories');
    }
}
