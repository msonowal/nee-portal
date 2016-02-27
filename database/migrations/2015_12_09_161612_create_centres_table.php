<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->increments('centre_code');
            $table->string('centre_name', 55);
            $table->string('centre_state', 55);
            $table->integer('NEEI', false, false)->defualt(0);
            $table->integer('NEEII', false, false)->defualt(0);
            $table->integer('NEEIII', false, false)->defualt(0);
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
        Schema::dropIfExists('centres');
    }
}
