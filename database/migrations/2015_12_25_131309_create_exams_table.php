<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('exam_name', array('NEE I', 'NEE II', 'NEE III'));
            $table->text('description')->nullable();
            $table->decimal('n_price', 10, 2)->comment('NORMAL PRICE');
            $table->decimal('scst_price', 10, 2)->comment('SC, ST PRICE');
            $table->string('min_age')->comment('MIN AGE OF CANDIDATE');
            $table->string('start_date')->comment('EXAM START DATE');
            $table->enum('active', array('YES', 'NO'))->default('YES');
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
        Schema::dropIfExists('exams');
    }
}
