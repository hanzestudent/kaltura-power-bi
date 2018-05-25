<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_views', function (Blueprint $table) {
            $table->increments('view_id');
            $table->string('user_id', 255)->comment("kaltura user id");
            $table->string('media_id',255)->comment("kaltura media id");
            $table->timestamp('played_at')->nullable();
            $table->integer('count_plays')->comment("How many times has user watched it on a day");
            $table->float('sum_time_viewed',20,15)->comment("Total time a user watched a video");
            $table->float("avg_time_viewed",20,15)->comment("Avarage time user watched the video in total");
            $table->float("avg_view_drop_off",20,15)->comment("Avarage view drop off");
            $table->integer('count_loads')->comment("how many times has the video been loaded");
            $table->float("load_play_ratio",20,15)->comment("How many people have loaded the video and also played it");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_views');
    }
}
