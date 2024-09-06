<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressid',
        'user_id',
        'fname',
        'phone_no',
        'address',
        'area',
        'landmark',
        'pincode',
        'city',
        'state',
        'alternate_phone',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
