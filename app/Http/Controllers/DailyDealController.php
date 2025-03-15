<?php

namespace App\Http\Controllers;

use App\Models\DailyDeal;
use Illuminate\Http\Request;

class DailyDealController extends Controller
{
    public function dailyDeal(Request $request)
    {
        $dailyDeals = DailyDeal::with('product')->get();

        $products = $dailyDeals->map->product->filter(); 
    
        if ($request->has('orderby')) {
            
            switch ($request->orderby) {
                case 'rating':
                    $products = $products->sortByDesc('average_rating');
                    break;
                case 'date':
                    $products = $products->sortByDesc('created_at');
                    break;
                case 'price-low':
                    $products = $products->sortBy('price');
                    break;
                case 'price-high':
                    $products = $products->sortByDesc('price');
                    break;
                default:
                    $products = $products->sortByDesc('created_at');
            }
        }
    
        return view('website.daily_deal', compact('products'));
    }
    
}
