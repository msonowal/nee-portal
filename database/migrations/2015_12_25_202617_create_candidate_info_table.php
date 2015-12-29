<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id', false, true);
            $table->integer('q_id', false, true)->comment('QUALIFICATION ID');
            $table->integer('exam_id', false, true);
            $table->enum('qualification_status', array('PASSED', 'APPEARED'));
            $table->integer('form_no', false, false)->nullable();
            $table->string('rollno', 30)->nullable();
            $table->date('reg_date')->nullable()->comment('registration date');
            $table->enum('reg_status', array('not_submitted', 'payment_pending', 'completed', ))->default('not_submitted');
            $table->string('remarks', 50)->nullable();
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('q_id')->references('id')->on('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('candidate_info');
    }
}
