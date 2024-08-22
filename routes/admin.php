<?php

// routes/admin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;


Route::prefix('products')->name('products.')->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
});
