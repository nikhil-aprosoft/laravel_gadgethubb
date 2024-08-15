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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('addressid')->primary(); // Keeps address_id as the primary key
            $table->uuid('user_id'); // Define user_id as a regular column
            $table->string('fname');
            $table->string('phone_no');
            $table->longText('address');
            $table->longText('area');
            $table->longText('landmark');
            $table->string('pincode');
            $table->string('city');
            $table->string('state');
            $table->string('alternate_phone')->nullable();
            $table->timestamps();
            
            // Define the foreign key constraint
            $table->foreign('user_id')
                  ->references('userid') // Assumes `userid` is the primary key in the referenced table
                  ->on('users') // Name of the table where `userid` is the primary key
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
        Schema::dropIfExists('address');
    }
};
