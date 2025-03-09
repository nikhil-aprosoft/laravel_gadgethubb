<?php
namespace App\Http\Controllers;

use App\Models\Offline_inventory_record;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Offline_inventory_recordController extends Controller
{
    public function offline_product_scan(Request $request)
    {
        $product_id      = $request->product_id;
        $offline_user_id = $request->offline_user_id;
        $device_id       = $request->device_id;

        // Get offline user details
        $offlineUser = DB::table('offline_users')->where('offline_user_id', $offline_user_id)->first();

        if (! $offlineUser) {
            return response()->json([
                'success' => false,
                'msg'     => 'Offline user not found',
            ]);
        }

        // Check if device_id matches
        if ($offlineUser->device_id !== $device_id) {
            return response()->json([
                'success' => false,
                'msg'     => 'Please login first',
            ]);
        }

        // Find the product
        $product = Product::where('product_id', $product_id)->first();

        if (! $product) {
            return response()->json([
                'success' => false,
                'msg'     => 'Product not found',
            ]);
        }

        // Check product quantity
        if ($product->quantity <= 0) {
            return response()->json([
                'success' => false,
                'msg'     => 'Product is out of stock',
            ]);
        }

        // Reduce quantity by 1 using decrement method
        Product::where('product_id', $product_id)->decrement('quantity', 1);

        // Get updated quantity
        $updatedProduct = Product::where('product_id', $product_id)->first();

        // Store record in offline_inventory_records table
        Offline_inventory_record::create([
            'offline_inventory_record_id' => Str::uuid(),
            'offline_user_id'             => $offlineUser->offline_user_id,
            'name'                        => $offlineUser->name,
            'phone'                       => $offlineUser->phone,
            'device_id'                   => $offlineUser->device_id,
            'product_id'                  => $product_id,
            'quantity'                    => 1,
            'isactive'                    => 1,
        ]);

        return response()->json([
            'success' => true,
            'msg'     => 'Product scanned successfully, quantity updated',
            'data'    => [
                'product_id'         => $product_id,
                'remaining_quantity' => $updatedProduct->quantity,
            ],
        ]);
    }

}
