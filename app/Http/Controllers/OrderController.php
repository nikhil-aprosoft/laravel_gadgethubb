<?php

namespace App\Http\Controllers;

use App\Jobs\PushOrderToShippingApi;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Order\OrderPayment;
use App\Models\Product\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create()
    {
        $user = session('user');

        $cartData = Cart::with('product')->where('user_id', $user->userid)->get();

        $shippingCost = Shipping::all();

        $cartData->transform(function ($item) {
            // Clean and convert the price to a float
            $cleanPrice = str_replace(['₹', ','], '', $item->product->price);
            $item->subtotal = floatval($cleanPrice) * $item->quantity;
            return $item;
        });
        if ($cartData->isEmpty()) {
            return redirect('/');
        }
        return view('website.checkout', compact('cartData', 'shippingCost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentRequest(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'phone_no' => 'required|string|regex:/^[0-9]{10}$/',
            'address' => 'required|string|max:500',
            'landmark' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'area' => 'required|string|max:255',
        ]);

        $user = session('user');
        $address = $this->storeAddress($request);
        $this->orderCreate($request, $address);
        $orderId = session('orderid');
        $cart = Cart::with('product')->where('user_id', $user->userid)->get();

        $productNamesString = implode(' -- ', $cart->pluck('product.product_name')->toArray());

        $merchantKey = env('PAYU_MERCHANT_KEY');
        $salt = env('PAYU_SALT');

        $apiEndpoint = "https://test.payu.in/_payment";

        $amount = $cart->sum(function ($item) {
            $cleanPrice = str_replace(['₹', ','], '', $item->product->price);
            return floatval($cleanPrice) * $item->quantity;
        });

        $shippingCost = Shipping::all();
        $shipCost = 0;

        foreach ($shippingCost as $shipping) {
            if ($shipping->from <= $amount && $shipping->to >= $amount) {
                $amount += $shipping->cost;
            }
        }

        if ($amount == 0) {
            return redirect('/');
        }
        $productInfo = $productNamesString;
        $firstName = $request->fname;
        $email = $user->email;
        $phone = $request->phone_no;
        $txnId = "TXN" . time();
        $surl = config('app.url') . "/payment-success?order_id=" . $orderId;
        $furl = config('app.url') . "/payment-failure";

        $params = [
            "key" => $merchantKey,
            "txnid" => $txnId,
            "amount" => $amount,
            "productinfo" => $productInfo,
            "firstname" => $firstName,
            "email" => $email,
            "phone" => $phone,
            "surl" => $surl,
            "furl" => $furl,
            "udf1" => "",
            "udf2" => "",
            "udf3" => "",
            "udf4" => "",
            "udf5" => "",
        ];

        // Generate the hash
        $hash = $this->generateHash($params, $salt);
        $params["hash"] = $hash;

        $form = $this->buildPaymentForm($apiEndpoint, $params);
        foreach ($cart as $cartItem) {
            $cartItem->delete();
        }
        return response($form);
    }
    public function orderCreate($request, $address)
    {
        $user = session('user');

        $order = Order::create([
            'orderid' => Str::uuid(),
            'user_id' => $user->userid,
            'address_id' => $address->addressid,
        ]);

        session(['orderid' => $order->orderid]);
        $this->createOrderItems($order->orderid);
        return true;
    }
    public function createOrderItems($orderId)
    {
        $user = session('user');
        $cartItems = Cart::with('product')->where('user_id', $user->userid)->get();
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $productPrice = floatval(str_replace('₹', '', $cartItem->product->price));
            $totalPrice += $productPrice * $cartItem->quantity;

            OrderItem::create([
                'order_item_id' => Str::uuid(),
                'order_id' => $orderId,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $productPrice * $cartItem->quantity,
            ]);
        }

        $shippingCost = Shipping::all();
        $shipCost = 0;

        foreach ($shippingCost as $shipping) {
            if ($shipping->from <= $totalPrice && $shipping->to >= $totalPrice) {
                $shipCost += $shipping->cost;
            }
        }

        \DB::table('orders')->where('orderid', $orderId)->update(['shipcost' => $shipCost]);
    }
    public function storeAddress($request)
    {
        $address = Address::storeUserAddress($request);
        return $address;
    }
    public function buildPaymentForm($apiEndpoint, $params)
    {
        $form = '<form id="paymentForm" method="POST" action="' . htmlspecialchars($apiEndpoint) . '">';
        foreach ($params as $key => $value) {
            $form .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
        }
        $form .= '</form>';

        // Add JavaScript to submit the form automatically
        $form .= '<script type="text/javascript">
                    document.getElementById("paymentForm").submit();
                  </script>';

        return $form;
    }

    public function generateHash($params, $salt)
    {
        // Correct formula including udf1 to udf5
        $hashString = $params["key"] . "|" . $params["txnid"] . "|" . $params["amount"] . "|" . $params["productinfo"] . "|" . $params["firstname"] . "|" . $params["email"] . "|" . $params["udf1"] . "|" . $params["udf2"] . "|" . $params["udf3"] . "|" . $params["udf4"] . "|" . $params["udf5"] . "||||||" . $salt;

        // Generate the hash
        return hash("sha512", $hashString);
    }
    public function paymentSuccess(Request $request)
    {
        $user = session('user');
        try {
            $orderId = $request->query('order_id');

            $chkTxnId = OrderPayment::where('txnid', $request->txnid)->get();

            if ($chkTxnId->isNotEmpty()) {
                return redirect('latestorder')->with('success', 'Your order is placed');
            }

            $this->orderPayment($request->all(), $orderId);
            $this->orderStatus($orderId);
            $this->decreaseProductQty($orderId);

            return redirect('latestorder')->with('success', 'Your order is placed');

        } catch (\Throwable $th) {
            Log::error('Step 8: An error occurred during payment success processing: ' . $th->getMessage(), [
                'exception' => $th,
                'trace' => $th->getTraceAsString(),
            ]);
            return redirect('/')->with('error', 'An error occurred, please try again later.');
        }
    }
    public function paymentFailure(Request $request)
    {
        Log::info('Payment Failure Data:', $request->all());
        return response()->json(['status' => 'failure', 'data' => $request->all()]);
    }

    public function orderPayment($data, $orderId)
    {
        // Step 1: Log the data being passed to the payment order
        //Log::info('Step 1: Processing order payment for Order ID: ' . $orderId);
        // Log::info('Step 2: Payment Data: ' . json_encode($data)); // Log all payment data (ensure sensitive data is handled properly)

        try {
            $mihpayid = $data['mihpayid'];
            $mode = $data['mode'];
            $status = $data['status'];
            $txnid = $data['txnid'];
            $amount = $data['amount'];
            $net_amount_debit = $data['net_amount_debit'];
            $addedon = $data['addedon'];
            $productinfo = $data['productinfo'];
            $email = $data['email'];
            $phone = $data['phone'];
            $payment_source = $data['payment_source'];
            $error_message = $data['error_Message'];
            $hash = $data['hash'];
            $unmappedstatus = $data['unmappedstatus'];
            $pg_type = $data['PG_TYPE'];
            $bank_ref_num = $data['bank_ref_num'];
            $bankcode = $data['bankcode'];
            $error = $data['error'];
            $cardnum = $data['cardnum'];

            // Log::info('Step 3: Payment details extracted - Transaction ID: ' . $txnid . ', Amount: ' . $amount);
            $payment = OrderPayment::create([
                'order_payment_id' => Str::uuid(),
                'order_id' => $orderId,
                'payment_method' => 'PREPAID',
                'amount' => $amount,
                'payment_status' => $status,
                'payment_date' => now(),
                'status' => $status,
                'txnid' => $txnid,
                'mode' => $mode,
                'mihpayid' => $mihpayid,
                'net_amount_debit' => $net_amount_debit,
                'addedon' => $addedon,
                'hash' => $hash,
                'unmappedstatus' => $unmappedstatus,
                'payment_source' => $payment_source,
                'pg_type' => $pg_type,
                'bank_ref_num' => $bank_ref_num,
                'bankcode' => $bankcode,
                'error' => $error,
                'error_message' => $error_message,
                'productinfo' => $productinfo,
                'email' => $email,
                'phone' => $phone,
                'cardnum' => $cardnum,
            ]);

            // Log::info('Step 4: Payment successfully recorded for Order ID: ' . $orderId);
            return true;
        } catch (\Throwable $th) {
            Log::error('Step 5: Error occurred while processing payment for Order ID: ' . $orderId, [
                'exception' => $th,
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            Log::notice('Issue occurred in orderPayment: ' . $th->getMessage());
            return false;
        }
    }

    public function orderStatus($orderId)
    {
        try {
            $order = Order::where('orderid', $orderId)->update([
                'order_no' => generateStylishId(),
                'isactive' => 1,
            ]);

            PushOrderToShippingApi::dispatch($orderId);

            return $order;
        } catch (\Throwable $th) {

            Log::error('Step 4: Error occurred while updating order status for Order ID: ' . $orderId, [
                'exception' => $th,
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            return false;
        }
    }
    public function decreaseProductQty($orderId)
    {
        try {
            $order = Order::with('items')->where('orderid', $orderId)->first();

            if (!$order) {
                Log::error("Order not found: $orderId");
                return false;
            }

            foreach ($order->items as $item) {
                $product = Product::where('product_id', $item->product_id)->first();

                if ($product) {
                    if ($product->quantity > 0) {
                        $product->decrement('quantity', 1);
                    } else {
                        Log::warning("Product {$product->product_id} is already out of stock.");
                    }
                } else {
                    Log::error("Product not found: {$item->product_id}");
                }
            }

            return true;
        } catch (\Throwable $th) {
            Log::error('Error occurred while updating product quantity', [
                'exception' => $th,
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            return false;
        }
    }

    public function latestOrder(Request $request)
    {
        try {
            $user = session('user');
            $order = Order::with(['user', 'items', 'payments', 'shipping', 'address'])
                ->where('orders.user_id', '=', $user->userid)
                ->latest()
                ->first();

            return view('website.order-view', compact('order'));
        } catch (\Throwable $th) {
            Log::error("Log_from_latest_order: {$th}");
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function orderDetails($order_no)
    {
        try {
            $user = session('user');
            $order = Order::with(['user', 'items', 'payments', 'shipping', 'address'])
                ->where('orders.user_id', '=', $user->userid)
                ->where('order_no', $order_no)
                ->first();
            if ($order) {

                return view('website.order-view', compact('order'));
            }
            return redirect('/');
        } catch (\Throwable $th) {
            Log::error("orderDetails: {$th}");
        }
    }
}
