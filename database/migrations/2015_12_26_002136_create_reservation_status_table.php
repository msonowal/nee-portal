<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_code')->unsigned();
            //$table->integer('qualification_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->integer('examdetail_id')->unsigned();
            //$table->enum('status', ['active','inactive']);
            $table->timestamps();
            $table->foreign('reservation_code')->references('reservation_code')->on('reservations');
            //$table->foreign('qualification_id')->references('id')->on('qualifications');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('examdetail_id')->references('id')->on('exam_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_status');
    }
}
