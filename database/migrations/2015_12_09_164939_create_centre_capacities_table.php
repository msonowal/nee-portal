<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentreCapacitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre_capacities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('centre_id')->unsigned();
            $table->string('centre_location', 55);
            $table->integer('centre_capacity', false, false)->default(0);
            $table->timestamps();
            $table->foreign('centre_id')->references('id')->on('centres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('centre_capacities');
    }
}
