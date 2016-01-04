<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_details', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('exam_id', false, true);
            //$table->integer('qualification_id', false, true);
            $table->string('eligible_for', 100)->comment('ELIGIBLE FOR ADMISSION TO');
            $table->integer('paper_code', false, true);
            $table->timestamps();
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
        Schema::dropIfExists('exam_details');
    }
}
