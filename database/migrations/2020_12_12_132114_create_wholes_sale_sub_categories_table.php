<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWholesSaleSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wholes_sale_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('whole_sale_sub_category_id');
            $table->string('sub_category_name_en')->nullable();
            $table->string('sub_category_name_bn')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('whole_sale_category_id')->on('whole_sale_categories');

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
        Schema::dropIfExists('wholes_sale_sub_categories');
    }
}
