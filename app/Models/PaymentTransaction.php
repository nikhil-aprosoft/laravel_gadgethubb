<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    // Declare that 'transaction_data' is a JSON column
    protected $casts = [
        'transaction_data' => 'array', // Or 'object' if the structure is an object
    ];

    protected $fillable = ['transaction_data'];
}
