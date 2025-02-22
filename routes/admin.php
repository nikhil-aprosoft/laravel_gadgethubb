<?php

// routes/admin.php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DailyDealController;
use App\Http\Controllers\Admin\DashboardController;



Route::view('login','admin.login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
Route::get('/weekly-overview', [DashboardController::class, 'getWeeklyOverview'])->name('admin.weekly-overview');


Route::prefix('deliveries')->name('deliveries.')->group(function () {
    Route::get('/', [DeliveryController::class,'index']);
    Route::post('store',[DeliveryController::class,'store'])->name('store');
    Route::delete('destroy/{delivery}',[DeliveryController::class,'destroy'])->name('destroy');

});

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/order-details/{order_no}',[OrderController::class,'orderDetails']);
    Route::get('/user-details/{userid}',[OrderController::class,'userDetails']);
});


Route::prefix('products')->name('products.')->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('show', [ProductController::class, 'viewProduts']);
    Route::post('update-stock-status/{id}', [ProductController::class, 'updateStockStatus'])->name('updateStockStatus');
    Route::get('activate-deactivate/{slug}', [ProductController::class, 'deactivate'])->name('deactivate-product');
    Route::get('update/{slug}', [ProductController::class, 'show']);
    Route::put('update/{product_id}', [ProductController::class, 'update'])->name('update');
});
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('show', [CategoryController::class, 'viewCategory']);
    Route::put('update-category/{category_id}', [CategoryController::class, 'update'])->name('update');
});

Route::resource('daily-deals', DailyDealController::class);

Route::prefix('migrations')->name('migrations.')->group(function () {
    Route::get('run', function () {
        Artisan::call('migrate');
        return back()->with('success', 'Migrations run successfully!');
    })->name('run');

    Route::get('rollback', function () {
        Artisan::call('migrate:rollback');
        return back()->with('success', 'Last migration batch rolled back successfully!');
    })->name('rollback');

    Route::get('refresh', function () {
        Artisan::call('migrate:refresh');
        return back()->with('success', 'Migrations refreshed successfully!');
    })->name('refresh');
});
