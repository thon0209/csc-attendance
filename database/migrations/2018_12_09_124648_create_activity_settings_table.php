<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_settings', function (Blueprint $table) {
          $table->increments('id');

          $table->unsignedInteger('activity_id');
          $table->foreign('activity_id')->references('id')->on('activities');

          $table->unsignedInteger('schoolyear_id');
          $table->foreign('schoolyear_id')->references('id')->on('school_year');

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
        Schema::dropIfExists('activity_settings');
    }
}
