<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWholeSaleProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whole_sale_product_images', function (Blueprint $table) {
            $table->bigIncrements('whole_sale_product_image_id');
            $table->string('image');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
         /*   $table->foreign('product_id')->references('whole_sales_product_id')->on('whole_sales');*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whole_sale_product_images');
    }
}
