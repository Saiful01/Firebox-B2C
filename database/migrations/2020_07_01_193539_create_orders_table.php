<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('order_id');
            $table->string('order_invoice');
            $table->double('total')->nullable();//Total Product Price
            $table->double('shipping_cost')->default(0);
            $table->double('vat')->default(0);
            $table->double('sub_total');// Price Except Discount(Total price-(voucher+coupon))
            $table->double('coupon')->default(0);
            $table->string('coupon_code')->nullable();
            $table->double('discount')->default(0);//Voucher+Coupon
            $table->double('paid_amount')->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->string('comment')->nullable();
            $table->string('expected_delivery_date')->nullable();
            $table->boolean('is_inside_dhaka')->default(true);

            $table->unsignedBigInteger('delivery_address_id')->nullable();
            $table->string('payment_type')->nullable();// Online, Cash
            $table->boolean('is_whole_sale')->default(0);// Online, Cash
            $table->integer('payment_status')->default(0);// 0=pending (cash), 1=success (Online), 2=Online failed
            $table->integer('order_status')->default(1);//  1=success, 0=cancelled,
            $table->text('notes')->nullable();
            $table->string('shops')->nullable();
            $table->string('vouchers')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
