<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_users', function (Blueprint $table) {
            $table->string('user_id', 255)->comment("Kaltura User Id");
            $table->string('type',255)->nullable(true)->comment("What type of user is it");
            $table->timestamps();
            $table->string('object_type', 255)
                ->nullable()
                ->comment("KalturaUser");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_users');
    }
}
