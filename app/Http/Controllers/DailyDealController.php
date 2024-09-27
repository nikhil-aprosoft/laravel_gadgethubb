<?php

namespace App\Http\Controllers;

use App\Models\DailyDeal;
use Illuminate\Http\Request;

class DailyDealController extends Controller
{
    public function dailyDeal(Request $request)
    {
        $dailyDeals = DailyDeal::with('product')->get();

        $products = $dailyDeals->map(function ($deal) {
            return $deal->product; 
        });
        return view('website.daily_deal', compact('products'));
    }
}
