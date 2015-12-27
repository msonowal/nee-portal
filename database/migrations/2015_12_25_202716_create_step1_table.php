<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStep1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step1', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_info_id', false)->unsigned()->unique();
            $table->integer('quota')->unsigned();
            $table->integer('c_pref1')->unsigned();
            $table->integer('c_pref2')->unsigned();
            $table->enum('nerist_stud', array('YES' => 'YES', 'NO' => 'NO'))->comment('NERIST STUDENT');
            $table->tinyInteger('status')->default(0)->comment('1->PASSED, 0->APPEARED');
            $table->integer('admission_in')->unsigned();
            $table->integer('voc_subject')->unsigned()->default(0);
            $table->integer('branch')->unsigned()->default(0);
            $table->integer('allied_branch')->unsigned()->default(0);
            $table->integer('reservation_code')->unsigned()->comment('Reservation Code');
            $table->timestamps();
            $table->foreign('candidate_info_id')->references('id')->on('candidate_info');
            $table->foreign('quota')->references('id')->on('quotas');
            $table->foreign('c_pref1')->references('id')->on('centres');
            $table->foreign('c_pref2')->references('id')->on('centres');
            $table->foreign('branch')->references('id')->on('branches');
            $table->foreign('allied_branch')->references('id')->on('allied_branches');
            $table->foreign('reservation_code')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('step1');
    }
}
