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
        Schema::table('order_payments', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('txnid')->unique();
            $table->string('mode')->nullable();
            $table->string('mihpayid')->nullable();
            $table->decimal('net_amount_debit', 10, 2)->nullable();
            $table->timestamp('addedon')->nullable();
            $table->string('hash')->nullable();
            $table->string('unmappedstatus')->nullable();
            $table->string('payment_source')->nullable();
            $table->string('pg_type')->nullable();
            $table->string('bank_ref_num')->nullable();
            $table->string('bankcode')->nullable();
            $table->string('error')->nullable();
            $table->string('error_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payments', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'txnid',
                'mode',
                'mihpayid',
                'net_amount_debit',
                'addedon',
                'hash',
                'unmappedstatus',
                'payment_source',
                'pg_type',
                'bank_ref_num',
                'bankcode',
                'error',
                'error_message'
            ]);
        });
    }
};
