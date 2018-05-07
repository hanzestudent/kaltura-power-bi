<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kaltura_media', function (Blueprint $table) {
            $table->primary('kaltura_media_id');
        });
        Schema::table('kaltura_category_entries', function (Blueprint $table) {
            $table->index('kaltura_media_id')->change();
            $table->index('kaltura_category_id')->change();
            $table->index('creator_user_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
