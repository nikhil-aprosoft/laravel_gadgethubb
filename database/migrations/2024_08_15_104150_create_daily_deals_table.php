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
        Schema::create('daily_deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('product_id');
            $table->string('text')->nullable();      
            $table->decimal('discount_amount', 10, 2);
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('inactive');
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_deals');
    }
};
