<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStep3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step3', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_info_id', false, true);
            $table->enum('doc_type', array('Photo', 'Signature'))->default(null);
            $table->string('file', 155);
            $table->timestamps();
            $table->foreign('candidate_info_id')->references('id')->on('candidate_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('step3');
    }
}
