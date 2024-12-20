<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $bestSellingProduct = $this->getBestSellingProduct();

        $transactionsOverview = $this->getTransactionsOverview();

        $getWeeklyOverview = $this->getWeeklyOverview();

        return view('admin.dashboard', compact('bestSellingProduct', 'transactionsOverview','getWeeklyOverview'));
    }
    public function getBestSellingProduct()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $bestSellingProduct = DB::table('order_items')
            ->select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(quantity * price) as total_sales')
            )
            ->join('orders', 'order_items.order_id', '=', 'orders.orderid')
            ->join('order_payments', 'orders.orderid', '=', 'order_payments.order_id')
            ->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->where('order_payments.status', 'completed')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->first();

        if ($bestSellingProduct) {
            // Fetch product details if necessary (Assuming you have a products table)
            $product = DB::table('products')->where('product_id', $bestSellingProduct->product_id)->first();

            return [
                'product_name' => $product->name ?? 'Unknown Product',
                'total_quantity' => $bestSellingProduct->total_quantity,
                'total_sales' => $bestSellingProduct->total_sales,
            ];
        }

        return null;
    }
    public function getTransactionsOverview()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Total sales (count of completed transactions)
        $totalSales = DB::table('order_payments')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('status', 'completed')
            ->count();

        // Total customers (unique customers who placed orders)
        $totalCustomers = DB::table('orders')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->distinct('user_id')
            ->count('user_id');

        // Total products sold (sum of quantities in order items)
        $totalProducts = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.orderid')
            ->join('order_payments', 'orders.orderid', '=', 'order_payments.order_id')
            ->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->where('order_payments.status', 'completed')
            ->sum('order_items.quantity');

        // Total revenue (sum of price * quantity for completed orders)
        $totalRevenue = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.orderid') 
            ->join('order_payments', 'orders.orderid', '=', 'order_payments.order_id') 
            ->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->where('order_payments.status', 'completed')
            ->sum(DB::raw('order_items.quantity * order_items.price'));

        return [
            'total_sales' => $totalSales,
            'total_customers' => $totalCustomers,
            'total_products' => $totalProducts,
            'total_revenue' => $totalRevenue,
        ];
    }
    public function getWeeklyOverview()
{
    $startOfCurrentWeek = Carbon::now()->startOfWeek();
    $endOfCurrentWeek = Carbon::now()->endOfWeek();

    $startOfPreviousWeek = Carbon::now()->subWeek()->startOfWeek();
    $endOfPreviousWeek = Carbon::now()->subWeek()->endOfWeek();

    // Current week sales
    $currentWeekSales = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.orderid')
        ->join('order_payments', 'orders.orderid', '=', 'order_payments.order_id')
        ->whereBetween('orders.created_at', [$startOfCurrentWeek, $endOfCurrentWeek])
        ->where('order_payments.status', 'completed')
        ->sum(DB::raw('order_items.quantity * order_items.price'));

    // Previous week sales
    $previousWeekSales = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.orderid')
        ->join('order_payments', 'orders.orderid', '=', 'order_payments.order_id')
        ->whereBetween('orders.created_at', [$startOfPreviousWeek, $endOfPreviousWeek])
        ->where('order_payments.status', 'completed')
        ->sum(DB::raw('order_items.quantity * order_items.price'));

    // Percentage change
    $performanceChange = $previousWeekSales > 0
        ? (($currentWeekSales - $previousWeekSales) / $previousWeekSales) * 100
        : 100;

    return [
        'current_week_sales' => $currentWeekSales,
        'previous_week_sales' => $previousWeekSales,
        'performance_change' => $performanceChange,
    ];
}

}
