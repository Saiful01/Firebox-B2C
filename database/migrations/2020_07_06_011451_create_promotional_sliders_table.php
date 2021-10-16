<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionalSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotional_sliders', function (Blueprint $table) {
            $table->increments('promotional_slider_id');
            $table->integer('section_id');
            $table->string('slider_image')->nullable();
            $table->string('slider_mobile_image')->nullable();
            $table->string('slider_title')->nullable();
            $table->longText('slider_sub_title')->nullable();
            $table->string('slider_url')->nullable();
            $table->boolean('publish_status')->default(true);
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
        Schema::dropIfExists('promotional_sliders');
    }
}
