<?php

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
});
Route::view('index', 'website.index');
Route::view('myaccount', 'website.myaccount')->name('myaccount')->middleware('auth');
Route::view('cart','website.cart');
//------------------------------- Nikhil Chages Start Here -------------------------------
Route::view('cat_product', 'website.cat_product');
Route::view('daily_deal', 'website.daily_deal');
//------------------------------- Nikhil Chages End Here ---------------------------------

//  Website View End Here

Route::controller(CategoryController::class)->group(function () {
    Route::get('index', 'index');
    Route::get('category/{slug}', 'showCategoryProducts')->name('category.product');   
    Route::get('/search', 'search')->name('search');
});
Route::controller(UserController::class)->group(function () {
    Route::post('/user-login', 'login')->name('user-login');
    Route::post('/signup', 'signUp')->name('signup');
});
Route::controller(ProductController::class)->group(function () {
    Route::get('product-details/{slug}', 'productDetails')->name('product-details');
    Route::get('quick-view/{slug}','quickView')->name('quick-view');
    Route::get('products','mixProducts')->name('products');
});
Route::get('daily-deals',[DailyDealController::class,'dailyDeal'])->name('daily-deals');
