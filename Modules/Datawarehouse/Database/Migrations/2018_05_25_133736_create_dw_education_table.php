<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_education', function (Blueprint $table) {
            $table->string('education_code',255)->primary()->comment("education id from blackboard");
            $table->string('type',255)->nullable(false)->comment("Is it fulltime or parttime");
            $table->string('education',255)->nullable(false)->comment("What is the shortcode for the education");
            $table->string('school',255)->nullable(false)->comment("What is the name of the school for this education");
            $table->string('name',255)->nullable(true)->comment("name of education");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dw_education');
    }
}
