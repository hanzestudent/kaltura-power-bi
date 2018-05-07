<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKalturaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('kaltura_users')) {
            Schema::create('kaltura_users', function (Blueprint $table) {
                $table->string('kaltura_user_id', 255)->comment("Kaltura User Id");
                $table->integer('status')
                    ->comment("Class \"UserStatus\"")
                    ->nullable(false);
                $table->timestamps();
                $table->string('object_type', 255)
                    ->nullable()
                    ->comment("KalturaUser");
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
        Schema::dropIfExists('kaltura_users');
    }
}