<?php

namespace App\Jobs;

use App\Models\Shipping;
use App\Models\Order\Order;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\Order\OrderShipping;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PushOrderToShippingApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $orderId;

    /**
     * Create a new job instance.
     *
     * @param string $orderId
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $order = Order::with(['address', 'items.product.category', 'user'])->where("orderid",$this->orderId)->first();

        if (!$order) {
            \Log::error("Order not found for ID: {$this->orderId}");
            return;
        }

        // Prepare shipping data
        $shippingData = [
            "order_id" => $order->orderid,
            "order_date" => $order->created_at,
            "order_type" => "ESSENTIALS",
            "consignee_name" => $order->address->fname,
            "consignee_phone" => $order->address->phone_no,
            "consignee_alternate_phone" => $order->address->alternate_phone ?? "",
            "consignee_email" => $order->user->email ?? "",
            "consignee_address_line_one" => $order->address->address,
            "consignee_address_line_two" => $order->address->area ?? "",
            "consignee_pin_code" => $order->address->pincode,
            "consignee_city" => $order->address->city,
            "consignee_state" => $order->address->state,
            "product_detail" => $order->items->map(function ($item) {
                return [
                    "sku_number" => $item->product->sku,
                    "unit_price" => $item->price,
                    "quantity" => $item->quantity,
                    "product_category" => $item->product->category->category_name ?? 'Other',
                    "name" => $item->product->product_name ?? 'N/A',
                    "discount" => ""
                ];
            })->toArray(),
            "payment_type" => "PREPAID",
            "cod_amount" => "",
            "shipping_charges" => "20",
            "weight" => "20",
            "length" => "20",
            "width" => "20",
            "height" => "20",
        ];

        try {
            // Perform the API call
            $response = Http::withHeaders([
                "Accept" => "*/*",
                "Content-Type" => "application/json",
                "User-Agent" => "Laravel API Client",
                "private-key" => env('SHIPMOJO_PRIVATE_KEY'),
                "public-key" => env('SHIPMOJO_PUBLIC_KEY'),
            ])->post("https://shipping-api.com/app/api/v1/push-order", $shippingData);

            $apiResponse = $response->json();

            if ($apiResponse['result'] === "1") {
                // Success - Create a new Shipping entry
                OrderShipping::create([
                    'shipping_id' => Str::uuid(),
                    'order_id' => $apiResponse['data']['refrence_id'],
                    'shipment_id' => $apiResponse['data']['order_id'],
                    'delivery_status' => "new",
                ]);

                \Log::info("Shipping entry created successfully for Order ID: {$this->orderId}");
            } else {
                \Log::error("API Error for Order ID: {$this->orderId}: " . $apiResponse['message']);
            }
        } catch (\Exception $e) {
            \Log::error("Error in PushOrderToShippingApi Job: " . $e->getMessage());
        }
    }
}
