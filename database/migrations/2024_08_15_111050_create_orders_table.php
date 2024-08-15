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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('orderid')->primary(); // Primary key for orders table
            $table->uuid('user_id'); // Foreign key to users table
            $table->uuid('address_id'); // Foreign key to addresses table
            $table->string('orderproduct_id');
            $table->string('shipping_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('price');
            $table->string('quantity');
            $table->string('payment_status')->nullable();
            $table->string('courierpartner_id')->nullable();
            $table->string('tracking_id')->nullable();
            $table->longText('product_color_id')->nullable();
            $table->tinyInteger('isactive')->default(0); // Use integer for tinyInteger
            $table->timestamps();
        
            // Define foreign key constraints
            $table->foreign('user_id')
                  ->references('userid') // Assumes `userid` is the primary key in the users table
                  ->on('users')
                  ->onDelete('cascade'); // Optional: defines what happens on delete
        
            $table->foreign('address_id')
                  ->references('addressid') // Assumes `addressid` is the primary key in the addresses table
                  ->on('addresses')
                  ->onDelete('cascade'); // Optional: defines what happens on delete
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
