<?php

// routes/admin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('products')->name('products.')->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('show',[ProductController::class,'viewProduts']);
    Route::post('update-stock-status/{id}', [ProductController::class, 'updateStockStatus'])->name('updateStockStatus');
    Route::post('deactivate-product',[ProductController::class,'deactivate'])->name('deactivate-product');
    Route::get('update/{slug}',[ProductController::class,'show']);
    Route::put('update/{product_id}', [ProductController::class, 'update'])->name('update');

});
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('show',[CategoryController::class,'viewCategory']);
    Route::put('update-category/{category_id}', [CategoryController::class, 'update'])->name('update');
});
