<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id', false, true);
            $table->integer('exam_id', false, true);
            $table->integer('form_no', false, false)->nullable();
            $table->string('rollno', 30)->nullable();
            $table->date('reg_date')->nullable()->comment('registration date');
            //$table->enum('reg_page', array('0', '1', '2', '3', '4', 'final'))->default('0');
            $table->enum('reg_status', array('not_submitted', 'submitted', 'payment_pending', 'completed', ))->default('not_submitted');
            //$table->enum('process', array('Online', 'Offline'))->default('Online');
            $table->string('remarks', 50)->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::drop('student_info');
    }
}
