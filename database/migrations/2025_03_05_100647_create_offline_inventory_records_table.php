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
        Schema::create('offline_inventory_records', function (Blueprint $table) {
            $table->id();
            $table->uuid('offline_inventory_record_id');
            $table->string('offline_user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('device_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('quantity')->nullable();
            $table->tinyInteger('isactive')->default(1);
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
        Schema::dropIfExists('offline_inventory_records');
    }
};
