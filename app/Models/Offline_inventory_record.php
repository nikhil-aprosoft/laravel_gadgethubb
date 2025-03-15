<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offline_inventory_record extends Model
{
    use HasFactory;
    protected $keyType  = 'string';
    protected $fillable = [
        'offline_inventory_record_id',
        'offline_user_id',
        'name',
        'phone',
        'device_id',
        'product_id',
        'quantity',
        'isactive',
    ];
}
