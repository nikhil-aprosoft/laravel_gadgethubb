<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userData = session('user');
        if ($userData) {
            $wishlistItems = Wishlist::with('product')->where('user_id', $userData->userid)->get();
        
            return view('website.wishlist', compact('wishlistItems'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWishlistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve user data from session
        $userData = session('user');

        if ($userData) {
            $request['user_id'] = $userData->userid;

            // Validate the request
            $request->validate([
                'user_id' => 'required|uuid|exists:users,userid',
                'product_id' => 'required|uuid|exists:products,product_id',
            ]);

            // Check if the product already exists in the wishlist for the user
            $existingWishlistItem = Wishlist::where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingWishlistItem) {
                return response()->json([
                    'status' => 'Product already exists in your wishlist.',
                    'status_type' => 'warning',
                ]);
            }

            // Create a new wishlist entry
            $wishlist = Wishlist::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);

            return response()->json([
                'status' => 'Product added to wishlist successfully.',
                'status_type' => 'success',
            ]);
        }

        return response()->json([
            'status' => 'User not authenticated.',
            'status_type' => 'error',
        ], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWishlistRequest  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlistItem = Wishlist::find($id);

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['message' => 'Item removed from wishlist successfully.']);
        }

        return response()->json(['message' => 'Item not found.'], 404);
    }
}
