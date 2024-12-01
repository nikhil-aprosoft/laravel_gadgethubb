<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

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
        'order_note',
        'created_at',
        'updated_at',
    ];

    public $incrementing = false; // Since addressid is a string
    protected $keyType = 'string'; // Specify the key type as string

    /**
     * Store user address.
     *
     * @param \Illuminate\Http\Request $request
     * @return Address
     */
    public static function storeUserAddress($request)
    {
        $user  = session('user');
        return self::create([
            'addressid'=>Str::uuid(),
            'user_id' => $user->userid,
            'fname' => $request->fname,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'area' => $request->area,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,
            'alternate_phone' => $request->alternate_phone,
            'order_note'=>$request->order_note,
            'landmark'=>$request->landmark,
        ]);
    }
}
