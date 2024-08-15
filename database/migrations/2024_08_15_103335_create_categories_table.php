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
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('category_id')->primary();
            $table->unsignedBigInteger('parent_category_id'); // Change this to UUID
            $table->string('category_name');
            $table->string('slug');
            $table->string('category_image');
            $table->timestamps();

            $table->foreign('parent_category_id')
            ->references('id')
            ->on('parent_categories')
            ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
