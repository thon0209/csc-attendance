<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('activity_id');
            $table->foreign('activity_id')->references('id')->on('activities');

            $table->unsignedInteger('student_no');
            $table->foreign('student_no')->references('id')->on('students');

            $table->timestamp('time_log');

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
        Schema::dropIfExists('attendance');
    }
}
