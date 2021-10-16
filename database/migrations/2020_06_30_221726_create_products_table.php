<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name');
            $table->string('product_slug')->nullable();
            $table->string('qr_code')->nullable();
            $table->longText('product_details')->nullable();
            $table->longText('product_specification')->nullable();
            $table->integer('stock')->nullable();
            $table->double('regular_price');
            $table->double('selling_price');
            $table->double('discount_rate')->nullable();
            $table->integer('stock_status')->default(1);
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->string('length_class')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_class')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('product_type')->default(1);
            $table->boolean('publish_status')->default(true);
            $table->integer('minimum_order_quantity')->default(1);
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('product_tags')->nullable();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('parent_category_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->string('video')->nullable();

            $table->double('delivery_charge')->default(0);
            $table->integer('deliverable_quantity')->default(1);
            $table->double('extra_delivery_charge')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            /*    $table->foreign('product_category_id')->references('category_id')->on('product_categories');*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
