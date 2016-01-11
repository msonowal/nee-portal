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
            $table->enum('qualification_status', array('PASSED', 'APPEARING/APPEARED'));
            $table->string('form_no', 10)->nullable();
            $table->string('rollno', 20)->nullable();
            $table->enum('reg_status', array('not_submitted', 'payment_pending', 'completed'))->default('not_submitted');
            $table->integer('paper_code')->nullable();
            //$table->date('reg_date')->nullable()->comment('registration date');
            $table->string('remarks', 100)->nullable();
            $table->integer('centre_code')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('q_id')->references('id')->on('qualifications');
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
        Schema::dropIfExists('candidate_info');
    }
}
