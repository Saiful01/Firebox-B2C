<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_payments', function (Blueprint $table) {
            $table->increments('merchant_payment_id');
            $table->double('payment_amount');
            $table->string('payment_medium')->nullable();
            $table->unsignedInteger('shop_id');
            $table->string('transaction_id')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('is_received')->default(false); // status received
            $table->integer('status')->default(1); // 1=send, 2=returned
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
        Schema::dropIfExists('merchant_payments');
    }
}
