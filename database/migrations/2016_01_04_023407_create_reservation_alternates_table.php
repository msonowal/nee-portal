<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationAlternatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_alternates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_code', false, true);
            $table->integer('alternate_code')->unsigned();
            //$table->timestamps();
            $table->foreign('reservation_code')->references('reservation_code')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_alternates');
    }
}
