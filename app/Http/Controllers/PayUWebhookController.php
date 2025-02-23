<?php

namespace App\Http\Controllers;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentTransaction;

class PayUWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Get the webhook payload data (PayU sends JSON data)
        $data = $request->all();

        // Log the received data (for debugging purposes)
        Log::info('PayU Webhook received: ', $data);

        PaymentTransaction::create(['transaction_data' => $data]);
        // Process the payment status and update the order status
        $order = Order::where('orderid', $data['udf1'])->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Example: Update order status based on PayU's response
        if ($data['status'] == 'success') {
            // Mark the order as paid
            $order->update([
                'payment_status' => 'paid',
                'payment_source' => 'PayU',
                'transaction_id' => $data['transaction_id'],
            ]);
        } else {
            // Handle other statuses like failure, pending, etc.
            $order->update([
                'payment_status' => 'failed',
            ]);
        }

        // Optionally, send an email or notify the user about the status update

        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }

    // Validate the signature (you may need to implement this based on PayU's docs)
    private function isValidSignature($data)
    {
        // Example validation logic, implement signature validation here.
        $signature = $data['signature']; // Example, check if the signature is correct.

        // Compare signature (this part depends on PayU's documentation)
        return true; // For simplicity, assume it returns true
    }
}
