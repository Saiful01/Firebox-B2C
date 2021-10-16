<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWholeSalePriceRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whole_sale_price_ranges', function (Blueprint $table) {
            $table->id();
            $table->integer('min_quantity');
            $table->integer('max_quantity');
            $table->double('price');
            $table->unsignedBigInteger('whole_sales_product_id');
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
        Schema::dropIfExists('whole_sale_price_ranges');
    }
}
