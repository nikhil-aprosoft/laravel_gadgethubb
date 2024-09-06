<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePriceAndQuantityFromOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the columns from the orders table
            $table->dropColumn(['price', 'quantity','orderproduct_id','shipping_id','payment_id','payment_status','courierpartner_id','tracking_id','product_color_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('price');
            $table->string('quantity');
            $table->string('orderproduct_id')->after('quantity');
            $table->string('shipping_id')->nullable()->after('orderproduct_id');
            $table->string('payment_id')->nullable()->after('shipping_id');
            $table->string('payment_status')->nullable()->after('payment_id');
            $table->string('courierpartner_id')->nullable()->after('payment_status');
            $table->string('tracking_id')->nullable()->after('courierpartner_id');
            $table->longText('product_color_id')->nullable()->after('tracking_id');
        });
    }
}
