<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_info_id', false)->unsigned();
            $table->string('mobile_no', 10);
            $table->string('email', 100);
            $table->string('trans_type', 100)->comment('Transaction type');
            $table->string('order_id', 100)->default(NULL);
            $table->string('order_info', 100)->default(NULL);
            $table->string('amount', 100);
            $table->integer('response_code')->nullable();
            $table->string('description', 100)->comment('response code description')->nullable();
            $table->string('message', 100)->nullable();
            $table->string('receipt_no', 100)->nullable();
            $table->string('tansaction_id', 100)->nullable();
            $table->string('bank_id', 100)->nullable();
            $table->string('card_type', 100)->nullable();
            $table->date('transaction_date')->nullable();
            $table->enum('status', ['PENDING', 'FAILURE', 'SUCCESS']);
            $table->timestamps();
            $table->foreign('candidate_info_id')->references('id')->on('candidate_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
