<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id');
            $table->unsignedBigInteger('product_id');
            $table->double('selling_price');
            $table->double('quantity');
            $table->double('order_invoice');
            $table->double('total_price');
            $table->integer('size')->nullable();
            $table->integer('color')->nullable();
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('commission_rate');
            $table->double('delivery_charge')->default(0);
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
        Schema::dropIfExists('order_items');
    }
}
