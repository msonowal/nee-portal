<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStep2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step2', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_info_id', false)->unsigned()->unique();
            $table->string('name', 100)->comment('Candidate full name');
            $table->string('father_name', 100);
            $table->string('guardian_name', 100);
            $table->enum('gender', array('MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'TRANSGENDER' => 'TRANSGENDER'));
            $table->enum('nationality', array('INDIA' => 'INDIA'));
            $table->enum('emp_status', array('YES' => 'YES', 'NO' => 'NO'))->default('NO')->comment('EMPLOYMENT STATUS');
            $table->string('relationship', 100)->comment('Relationship with Guardian');
            $table->integer('state')->unsigned()->default(0);
            $table->integer('district')->unsigned()->default(0);
            $table->string('po', 100)->comment('Post Office');
            $table->string('pin');
            $table->string('village', 100);
            $table->string('address_line', 100);
            $table->timestamps();
            $table->foreign('candidate_info_id')->references('id')->on('candidate_info');
            $table->foreign('state')->references('id')->on('states');
            $table->foreign('district')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('step2');
    }
}
