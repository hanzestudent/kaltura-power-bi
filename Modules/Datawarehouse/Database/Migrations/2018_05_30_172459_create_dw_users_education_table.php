<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwUsersEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_users_education', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 255);
            $table->string('education_code',255);
            $table->foreign('education_code')->references('education_code')->on('dw_education');
            $table->foreign('user_id')->references('id')->on('dw_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_users_education');
    }
}
