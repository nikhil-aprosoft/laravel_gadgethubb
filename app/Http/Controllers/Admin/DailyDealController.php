<?php

namespace App\Http\Controllers\Admin;

use App\Models\DailyDeal;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;

class DailyDealController extends Controller
{    
    public function index()
    {
        $dailyDeals = DailyDeal::all();
        return view('admin.daily_deals.index', compact('dailyDeals'));
    }
    // Show the form for creating a new daily deal
    public function create()
    {
        $products = Product::all();
        return view('admin.daily_deals.create',compact('products'));
    }

    // Store a newly created daily deal in storage
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|uuid|exists:products,product_id',
            'text' => 'nullable|string',
            'discount_amount' => 'required|numeric',
            'discount_type' => 'required|in:fixed,percentage',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive,expired',
        ]);

        DailyDeal::create($request->all());

        return redirect()->back()->with('success', 'Daily Deal created successfully.');
    }

    // Display the specified daily deal
    public function show(DailyDeal $dailyDeal)
    {
        return view('admin.daily_deals.show', compact('dailyDeal'));
    }

    // Show the form for editing the specified daily deal
    public function edit(DailyDeal $dailyDeal)
    {
        $products = Product::all();
        return view('admin.daily_deals.edit', compact('dailyDeal','products'));
    }

    // Update the specified daily deal in storage
    public function update(Request $request, DailyDeal $dailyDeal)
    {
        $request->validate([
            'product_id' => 'required|uuid|exists:products,product_id',
            'text' => 'nullable|string',
            'discount_amount' => 'required|numeric',
            'discount_type' => 'required|in:fixed,percentage',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive,expired',
        ]);

        $dailyDeal->update($request->all());

        return redirect()->back()->with('success', 'Daily Deal updated successfully.');

    }

    // Remove the specified daily deal from storage
    public function destroy(DailyDeal $dailyDeal)
    {
        $dailyDeal->delete();
        return redirect()->back()->with('success', 'Daily Deal deleted successfully.');
    }
}
