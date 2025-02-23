<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Order\OrderPayment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $currentPage = $request->get('page', 1);
        $ordersQuery = Order::query();

        // Search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $ordersQuery->where(function ($query) use ($searchTerm) {
                $query->where('order_no', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Eager load related models
        $ordersQuery->with(['payments', 'shipping', 'user']);

        $orders = $ordersQuery->paginate($request->get('length', 10));
        $totalPages = $orders->lastPage();

        // Aggregated counts
        $pendingPaymentsCount = Order::whereHas('payments', function ($query) {
            $query->where('payment_status', 'pending');
        })->count();

        $completedOrdersCount = Order::whereHas('payments', function ($query) {
            $query->where('payment_status', 'success');
        })->count();

        $refundedOrdersCount = Order::whereHas('payments', function ($query) {
            $query->where('payment_status', 'refunded');
        })->count();

        $failedOrdersCount = Order::whereHas('payments', function ($query) {
            $query->where('payment_status', 'failed');
        })->count();

        return view('admin.orders.index', [
            'orders' => $orders,
            'pendingPayments' => $pendingPaymentsCount,
            'completedOrders' => $completedOrdersCount,
            'refundedOrders' => $refundedOrdersCount,
            'failedOrders' => $failedOrdersCount,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }
    public function orderDetails($order_no)
    {
        $order = Order::where('order_no', $order_no)->first();

        $response = Http::withHeaders([
            "Accept" => "*/*",
            "Content-Type" => "application/json",
            "User-Agent" => "Laravel API Client",
            "private-key" => env('SHIPMOJO_PRIVATE_KEY'),
            "public-key" => env('SHIPMOJO_PUBLIC_KEY'),
        ])->get("https://shipping-api.com/app/api/v1/track-order?awb_number=3394432268");
    

        return view('admin.orders.details', compact('order'));
    }
    public function userDetails($userId)
    {
        $user = User::where('userid', $userId)->first();

        $paidOrderCount = OrderPayment::whereIn('order_id', $user->orders->pluck('orderid'))->where('payment_status', 'success')->count();

        $pendingOrderCount = OrderPayment::whereIn('order_id', $user->orders->pluck('orderid'))->where('payment_status', 'pending')->count();
        // $paidOrderCount =
        return view('admin.orders.user-details', compact('user', 'paidOrderCount', 'pendingOrderCount'));
    }
}
