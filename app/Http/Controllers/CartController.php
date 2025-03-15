<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $user = session('user');
        $cartItems = Cart::where('user_id', $user->userid)->get();
        $shippingCost = Shipping::all();
        return view('website.cart', compact('cartItems','shippingCost'));
    }
    public function store(Request $request)
    {
        // \Log::debug(json_encode($request->all()));
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
            return redirect()->back()
                ->with('status', implode(' ', $validator->errors()->all()))
                ->with('status_type', 'error');
        }
    
        $product = Product::where('product_id', $request->product_id)->first();
    
        if (!$product) {
            return redirect()->back()->with('status', 'Product not found.')->with('status_type', 'error');
        }
    
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('status', 'Not enough stock available.')->with('status_type', 'error');
        }
    
        $cartItem = Cart::where('user_id', $user->userid)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->quantity) {
                return redirect()->back()->with('status', 'Not enough stock available.')->with('status_type', 'error');
            }
    
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            Cart::create([
                'cart_id' => Str::uuid(),
                'user_id' => $user->userid,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->convertToDecimal($product->price),
            ]);
        }
    
        return redirect()->back()->with('status', 'Product added to cart successfully!')->with('status_type', 'success');
    }
     public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $cartItem = Cart::where('cart_id', $cartId)->first();

        if (!$cartItem) {
            return redirect()->route('cart.index')->withErrors(['error' => 'Cart item not found.']);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        if($request->cartPage == 1){
            // \Log::debug(json_encode($cartItem));
            return response()->json('Cart updated successfully');
        }
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function destroy(Request $request)
    {
        $cartId = $request->input('cart_id');
        $cartItem = Cart::where('cart_id', $cartId)->first();

        if (!$cartItem) {
            return response()->json(['error' => 'No product found']);

        }
        $cartItem->delete();

        return response()->json(['success' => 'Product removed from cart!']);
    }
    public function clearCart()
    {
        $user = session('user');
        $cart = Cart::where('user_id', $user->userid)->delete();
        return redirect()->back()->with('success', 'Cart removed!');;
    }
}
