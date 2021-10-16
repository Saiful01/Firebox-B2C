<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWholeSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whole_sales', function (Blueprint $table) {
            $table->bigIncrements('whole_sales_product_id');
            $table->string('product_name');
            $table->string('product_slug')->nullable();
            $table->string('qr_code')->nullable();
            $table->longText('product_details')->nullable();
            $table->longText('product_specification')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('stock_status')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->string('length_class')->nullable();
            $table->string('height_class')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_class')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('owner_id')->nullable();//Will be deleted
            $table->string('certification')->nullable();
            $table->string('video')->nullable();
            $table->double('delivery_charge')->default(0);
            $table->integer('max_delivery_quantity')->default(1);
            $table->integer('min_delivery_quantity')->default(1);
            $table->integer('extra_charge')->default(0);

            $table->string('materials')->nullable();
            $table->string('yarn_type')->nullable();
            $table->string('yarn_count')->nullable();
            $table->string('density')->nullable();
            $table->string('weaving_machine')->nullable();
            $table->string('design')->nullable();
            $table->string('color_quality')->nullable();
            $table->text('wash_process')->nullable();
            $table->string('customized_fold')->nullable();
            $table->string('packing')->nullable();
            $table->string('bundle_packing')->nullable();
            $table->string('supply_ability')->nullable();
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('whole_sales');
    }
}
