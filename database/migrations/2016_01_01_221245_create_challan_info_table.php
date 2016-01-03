<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallanInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challan_info', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('candidate_info_id', false)->unsigned()->unique()->default(Null);
            $table->string('transaction_id');
            $table->date('transaction_date');
            $table->timestamps();
            //$table->foreign('candidate_info_id')->references('id')->on('candidate_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('challan_info');
    }
}
