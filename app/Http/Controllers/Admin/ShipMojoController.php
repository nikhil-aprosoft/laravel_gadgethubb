<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Order\OrderShipping;
use App\Http\Controllers\Controller;

class ShipMojoController extends Controller
{
    public function shipMojoWebhookResponse(Request $request)
    {
        \Log::debug('ShipMojo Webhook Data:', $request->all());
        $orderShip = OrderShipping::where('shipment_id',$request->order_id)->first();
        $orderShip->delivery_status=$request->current_status;
        $orderShip->tracking_code=$request->awb_number;

        //new fields
        $orderShip->expected_delivery_date = $request->expected_delivery_date;
        $orderShip->status_time = $request->status_time;
        $orderShip->carrier = $request->carrier;
        $orderShip->delivery_boy_name = $request->delhivery_name;
        $orderShip->delivery_boy_phone = $request->delhivery_phone;
        
        $orderShip->save();
    } 
}
