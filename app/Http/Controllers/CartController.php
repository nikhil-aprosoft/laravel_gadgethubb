<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return response()->json(['status' => 401]);
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
                'price' => Product::find($request->product_id)->price,
            ]);
        }
    }
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($cartId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }
    public function destroy($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
