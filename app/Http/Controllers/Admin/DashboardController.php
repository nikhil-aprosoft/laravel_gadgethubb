<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $bestSellingProduct = $this->getBestSellingProduct();

        $transactionsOverview = $this->getTransactionsOverview();

        $getWeeklyOverview = $this->getWeeklyOverview();

        $getTotalEarning = $this->getTotalEarning();

        $getTotalProfit = $this->getTotalProfit();

        $lastWeekProfit = $this->lastWeekProfit();

        $getPendingOrders = $this->getPendingOrders();

        $getSuccessOrders = $this->getSuccessOrders();

        return view('admin.dashboard', compact('bestSellingProduct', 'transactionsOverview', 'getWeeklyOverview', 'getTotalEarning', 'getTotalProfit', 'lastWeekProfit', 'getPendingOrders', 'getSuccessOrders'));
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
            ->where('status', 'success')
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
            ->where('order_payments.status', 'success')
            ->sum('order_items.quantity');

        // Total revenue (sum of price * quantity for completed orders)
        $totalRevenue = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.orderid')
            ->join('order_payments', 'orders.orderid', '=', 'order_payments.order_id')
            ->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->where('order_payments.status', 'success')
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
    public function getTotalEarning()
    {
        // Current year and last year
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;

        // Current year's earnings
        $currentEarnings = DB::table('order_payments')
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        // Last year's earnings
        $lastYearEarnings = DB::table('order_payments')
            ->whereYear('created_at', $lastYear)
            ->sum('amount');

        // Calculate percentage change
        $percentageChange = $lastYearEarnings > 0
        ? round((($currentEarnings - $lastYearEarnings) / $lastYearEarnings) * 100, 2)
        : 0;

        // Fetch top-selling categories
        $topCategories = DB::table('order_items as oi')
            ->join('products as p', 'oi.product_id', '=', 'p.product_id')
            ->join('categories as c', 'p.category_id', '=', 'c.category_id')
            ->select(
                'c.category_name as category_name',
                'c.category_image as category_image',
                DB::raw('COUNT(oi.product_id) as total_sold'),
                DB::raw('SUM(oi.quantity) as total_quantity'),
                DB::raw('SUM(oi.price * oi.quantity) as total_amount')
            )
            ->groupBy('p.category_id', 'c.category_name', 'c.category_image')
            ->orderByDesc('total_quantity')
            ->limit(3)
            ->get();

        // Format the data for frontend
        $sources = $topCategories->map(function ($category) {
            return [
                'name' => $category->category_name,
                'cat_image' => $category->category_image,
                'description' => 'Top selling category',
                'amount' => number_format($category->total_amount, 2),
                'progress' => rand(50, 100),
            ];
        });

        // Return the final response
        return [
            'totalEarnings' => $currentEarnings,
            'lastYearEarnings' => $lastYearEarnings,
            'percentageChange' => $percentageChange,
            'sources' => $sources,
        ];
    }
    public function getTotalProfit()
    {
        $totalProfit = OrderItem::with('product')
            ->get()
            ->sum(function ($item) {
                return ((float) str_replace('₹', '', $item->product->price) - (float) str_replace('₹', '', $item->product->cost)) * $item->quantity;
            });

        // Convert totalProfit to a numeric value
        $totalProfit = is_numeric($totalProfit) ? $totalProfit : 0;

        return $totalProfit;
    }
    public function lastWeekProfit()
    {
        $lastWeekStart = now()->subWeek()->startOfWeek();
        $lastWeekEnd = now()->subWeek()->endOfWeek();

        $lastWeekProfit = OrderItem::with('product')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->get()
            ->sum(function ($item) {
                return ((float) str_replace('₹', '', $item->product->price) - (float) str_replace('₹', '', $item->product->cost)) * $item->quantity;
            });

        // Convert lastWeekProfit to a numeric value
        $lastWeekProfit = is_numeric($lastWeekProfit) ? $lastWeekProfit : 0;

        return $lastWeekProfit;
    }
    public function getPendingOrders()
    {
        $pendingOrder = DB::table('order_payments')->where('payment_status', 'pending')->count();

        return $pendingOrder;
    }
    public function getSuccessOrders()
    {
        $successOrder = DB::table('order_payments')->where('payment_status', 'success')->count();

        return $successOrder;
    }
}
