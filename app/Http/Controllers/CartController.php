<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with('status', implode(' ', $errors))->with('status_type', 'error');
        }
        $user = session('user');

        $cartItem = Cart::where('user_id', $user->userid)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {

            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {

            Cart::create([
                'cart_id' => Str::uuid(),
                'user_id' => $user->userid,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => \DB::table('products')->where('product_id', $request->product_id)->first()->price,
            ]);
        }
    }
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Attempt to find the cart item
        $cartItem = Cart::where('cart_id', $cartId)->first();

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->route('cart.index')->withErrors(['error' => 'Cart item not found.']);
        }

        // Update the quantity
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        $userId = session('user')->userid ?? null;
        $cartCount = $userId ? Cart::where('user_id', $userId)->count() : 0;
        $cartItems = $userId ? Cart::with('product')->where('user_id', $userId)->get() : collect();

        $cartItemsHtml = view('cart.items', compact('cartItems'))->render();
        $cartTotal = $cartItems->sum(function ($item) {
            return (float) str_replace('₹', '', $item->product->price) * $item->quantity;
        });

        return response()->json([
            'cartCount' => $cartCount,
            'cartItemsHtml' => $cartItemsHtml,
            'cartTotal' => $cartTotal,
        ]);
    }
}
