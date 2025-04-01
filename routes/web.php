<?php

use App\Jobs\GenerateQrCodeJob;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DailyDealController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//  Website View Start Here
Route::get('/', function () {
    return view('website.index');
})->name('home');
Route::get('/', [CategoryController::class, 'index'])->name('home');
Route::view('index', 'website.index');
Route::view('cart', 'website.cart');
Route::view('login', 'website.login');
// Route::view('wishlist', 'website.wishlist');
// Route::view('cat_product', 'website.cat_product');
// Route::view('daily_deal', 'website.daily_deal');

//  Website View End Here

Route::controller(CategoryController::class)->group(function () {
    Route::get('index', 'index');
    Route::get('category/{slug}', 'showCategoryProducts')->name('category.product');
    Route::get('/searchRoute', 'search')->name('searchRoute');
});
Route::controller(UserController::class)->group(function () {
    Route::get('register-login', 'index')->name('register-login');
    Route::post('/user-login', 'login')->name('user-login');
    Route::post('/signup', 'signUp')->name('signup');
    Route::get("/logout", 'logout')->name('logout');
    Route::get('myaccount', 'myaccount')->name('myaccount')->middleware('session');
    Route::get('orders-history','userOrders')->name('orders-history')->middleware('session');

});
Route::controller(ProductController::class)->group(function () {
    Route::get('product-details/{slug}', 'productDetails')->name('product-details');
    Route::get('quick-view/{slug}', 'quickView')->name('quick-view');
    Route::get('products', 'mixProducts')->name('products');
});
Route::get('daily-deals', [DailyDealController::class, 'dailyDeal'])->name('daily-deals');

Route::controller(WishlistController::class)->group(function () {
    Route::post('/wishlist', 'store')->name('wishlist');
    Route::get('view-wishlist', 'index')->name('view-wishlist')->middleware('session');
    Route::delete('wishlist/{id}', 'destroy')->name('wishlist.destroy');
});
Route::controller(ContactController::class)->group(function () {
    Route::get('contact-us', 'index')->name('contact-us');
    Route::post('contact', 'store')->name('contact');
});
Route::controller(CartController::class)->group(function () {
    Route::get('view-cart', 'index')->name('view-cart')->middleware('session');
    Route::post('/cart', 'store')->name('cart');
    Route::post('destroy', 'destroy')->name('remove_product_cart');
    Route::get('clear-cart', 'clearCart')->name('clear-cart');
    Route::post('/cart/update/{cartId}', 'update')->name('cart.update');
});
Route::prefix('address')->controller(AddressController::class)->group(function () {
    Route::post('store', 'store')->name('store');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('checkout', 'create')->name('checkout')->middleware('session');
    Route::post('payment-request','paymentRequest')->name('payment-request')->middleware('session');
    Route::match(['get', 'post'], 'payment-success', 'paymentSuccess')->name('payment-success');
    Route::match(['get', 'post'], 'payment-failure', 'paymentFailure')->name('payment-failure');
    Route::get('latestorder','latestOrder')->middleware('session');
    Route::get('order-details/{order_no}', 'orderDetails')->name('order-details')->middleware('session');

});

Route::get('qr',function(){
    GenerateQrCodeJob::dispatch("faa");
 });