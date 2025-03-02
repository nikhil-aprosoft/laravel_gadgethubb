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
        Schema::table('order_shippings', function (Blueprint $table) {            
            $table->date('expected_delivery_date')->nullable();
            $table->timestamp('status_time')->nullable();
            $table->string('carrier')->nullable();
            $table->string('delivery_boy_name')->nullable();
            $table->string('delivery_boy_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_shippings', function (Blueprint $table) {
            $table->dropColumn([             
                'expected_delivery_date',
                'status_time',
                'carrier',
                'delivery_boy_name',
                'delivery_boy_phone',
            ]);
        });
    }
};
