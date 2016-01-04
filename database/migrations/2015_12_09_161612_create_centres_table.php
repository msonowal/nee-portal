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
            //$table->integer('centre_code')->unsigned();
            $table->string('centre_name', 55);
            $table->string('centre_state', 55);
            $table->integer('NEE I', false, false)->defualt(0);
            $table->integer('NEE II', false, false)->defualt(0);
            $table->integer('NEE III', false, false)->defualt(0);
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
