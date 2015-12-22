<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qualification', 55);
            $table->enum('NEE_I', array('YES', 'NO'))->deault('NO')->comment('ELIGIBLE TO APPEAR NEE I');
            $table->enum('NEE_II', array('YES', 'NO'))->deault('NO')->comment('ELIGIBLE TO APPEAR NEE II');
            $table->enum('NEE_III', array('YES', 'NO'))->deault('NO')->comment('ELIGIBLE TO APPEAR NEE III');
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
        Schema::drop('qualifications');
    }
}
