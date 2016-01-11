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
            $table->string('branch_id')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('trans_type')->nullable();
            $table->string('transaction_id');
            $table->date('transaction_date');
            $table->string('amount')->nullable();
            $table->string('field_1')->nullable();
            $table->string('field_2')->nullable();
            $table->string('field_3')->nullable();
            $table->string('field_4')->nullable();
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
        Schema::dropIfExists('challan_info');
    }
}
