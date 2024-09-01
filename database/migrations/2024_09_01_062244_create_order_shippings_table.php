<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('order_shippings', function (Blueprint $table) {
                $table->uuid('shipping_id')->primary();
                $table->uuid('order_id');
                $table->string('shipment_id')->nullable();
                $table->string('tracking_code')->nullable();
                $table->timestamps();
           
                $table->foreign('order_id')->references('orderid')->on('orders')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_shippings');
    }
};
