<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('shop_id');
            $table->string('shop_name');
            $table->string('shop_phone')->nullable();
            $table->string('shop_email')->nullable();
            $table->text('division_id')->nullable();
            $table->text('district_id')->nullable();
            $table->text('upazila_id')->nullable();
            $table->text('shop_address')->nullable();
            $table->longText('shop_details')->nullable();
            $table->string('shop_image')->nullable();
            $table->string('trade_licence')->nullable();
            $table->string('shop_type')->nullable();
            $table->double('commission_rate')->default(0);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('shops');
    }
}
