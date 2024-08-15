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
        Schema::create('products', function (Blueprint $table) {
            // Use UUID as the primary key
            $table->uuid('product_id')->primary();
            $table->uuid('category_id');
            $table->string('product_name');
            $table->string('slug')->nullable();            
            $table->string('search_product_name')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('current_value', 10, 2)->nullable();
            $table->text('images')->nullable();
            $table->text('specification')->nullable();
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->string('model')->nullable();
            $table->string('sku')->unique()->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->string('size')->nullable();
            $table->string('thumbnail')->nullable();
            // Foreign key constraint
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
