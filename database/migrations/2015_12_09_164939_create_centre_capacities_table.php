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
            $table->integer('centre_code')->unsigned();
            $table->string('centre_location', 250);
            $table->integer('centre_capacity', false, false)->default(0);
            $table->timestamps();
            $table->foreign('centre_code')->references('centre_code')->on('centres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centre_capacities');
    }
}
