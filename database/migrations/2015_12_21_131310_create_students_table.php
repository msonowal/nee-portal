<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 55);
            $table->string('last_name', 55)->nullable();
            $table->string('mobile_no', 10)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->integer('confirm_code')->nullable();
            $table->string('reset_key')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1->a/c Active, 0->a/c Inactive');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
