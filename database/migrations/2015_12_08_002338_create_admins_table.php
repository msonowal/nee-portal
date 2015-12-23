<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 55)->unique();
            $table->string('fullname', 55);
            $table->string('mobile_no', 10)->unique();
            $table->string('email', 55)->unique();
            $table->string('password');
            $table->string('reset_key')->nullable();
            $table->enum('active', array('YES', 'NO'))->default('YES');
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
        Schema::drop('admins');
    }
}
