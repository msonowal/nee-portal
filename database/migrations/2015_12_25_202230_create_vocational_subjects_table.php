<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVocationalSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocational_subjects', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('paper_code', false, true);
            $table->string('name');
            //$table->integer('exam_id', false, true);
            //$table->integer('qualification_id', false, true);
            //$table->integer('paper_code', false, true);
            $table->timestamps();
            $table->primary('paper_code');
            //$table->foreign('exam_id')->references('id')->on('exams');
            //$table->foreign('qualification_id')->references('id')->on('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vocational_subjects');
    }
}
