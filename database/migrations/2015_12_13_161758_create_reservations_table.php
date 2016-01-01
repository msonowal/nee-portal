<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('reservation_code');
            //$table->integer('reservation_code', false, false)->unsigned()->unique();
            $table->integer('quota_id')->unsigned();
            $table->string('category_name');
            $table->string('description', 255);
            $table->timestamps();
            //$table->primary('reservation_code'); because increments automatically set primary key
            $table->foreign('quota_id')->references('id')->on('quotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservations');
    }
}
