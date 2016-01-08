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
            $table->string('name', 40)->comment('Candidate full name');
            $table->string('father_name', 40);
            $table->string('guardian_name', 40);
            $table->enum('gender', ['MALE', 'FEMALE', 'TRANSGENDER']);
            $table->enum('nationality', ['INDIAN']);
            $table->enum('emp_status', ['YES', 'NO'])->default('NO')->comment('EMPLOYMENT STATUS');
            $table->string('relationship', 20)->comment('Relationship with Guardian');
            $table->integer('state')->unsigned();
            $table->integer('district')->unsigned();
            $table->string('po', 20)->comment('Post Office');
            $table->string('pin', 6);
            $table->string('village', 20)->nullable();
            $table->string('address_line', 300);
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
        Schema::dropIfExists('step2');
    }
}
