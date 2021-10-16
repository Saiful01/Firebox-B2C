<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('category_name_en')->nullable();
            $table->string('category_name_bn')->nullable();
            $table->string('category_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_whole_sales')->default(false);
            $table->unsignedBigInteger('parent_category_id');
            $table->timestamps();
            $table->foreign('parent_category_id')->references('parent_category_id')->on('parent_categories');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
