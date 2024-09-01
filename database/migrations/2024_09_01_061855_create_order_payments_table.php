<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->uuid('order_payment_id')->primary();
            $table->foreignUuid('order_id');
            $table->string('payment_method');
            $table->decimal('amount', 10, 2);
            $table->string('payment_status');
            $table->string('transaction_id')->unique();
            $table->timestamp('payment_date');
            $table->timestamps();

            // Add foreign key constraint
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
        Schema::dropIfExists('order_payments');
    }
}
