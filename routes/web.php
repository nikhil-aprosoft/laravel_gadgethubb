<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
Route::view('login', 'website.login');
//------------------------------- Nikhil Chages Start Here -------------------------------
Route::view('cat_product', 'website.cat_product');
Route::view('product_detail', 'website.product_detail');
Route::view('daily_deal', 'website.daily_deal');
//------------------------------- Nikhil Chages End Here ---------------------------------

//  Website View End Here

Route::controller(CategoryController::class)->group(function () {
    Route::get('index', 'index');
//------------------------------- Nikhil Chages Start Here -------------------------------
    Route::get('cat_product', 'getData');
//------------------------------- Nikhil Chages End Here ---------------------------------
    Route::get('/search', 'search')->name('search');
});
Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/signup', 'signUp')->name('signup');
});

Route::get('slug', function () {

    $categories = Category::where('slug', '')->get();

    foreach ($categories as $category) {
        $slug = Str::slug($category->category_name);
        $originalSlug = $slug;
        $count = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $category->slug = $slug;
        $category->save();
    }

    return 'Slugs updated successfully!';
});
