<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust as necessary for your authorization logic
    }

    public function rules()
    {
        return [
            'fname' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'required|string',
            'area' => 'required|string',
            'pincode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'alternate_phone' => 'nullable|string|max:255',
        ];
    }
}
