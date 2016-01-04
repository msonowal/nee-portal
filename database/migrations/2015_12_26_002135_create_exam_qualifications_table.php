<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('q_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->timestamps();
            $table->foreign('q_id')->references('id')->on('qualifications');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_qualifications');
    }
}
