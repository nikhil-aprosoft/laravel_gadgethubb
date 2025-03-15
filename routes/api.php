<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayUWebhookController;
use App\Http\Controllers\admin\ShipMojoController;
use App\Http\Controllers\Offline_inventory_recordController;
use App\Http\Controllers\Offline_userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// routes/web.php or routes/api.php

Route::post('/payu-webhook', [PayUWebhookController::class, 'handleWebhook']);

Route::post('/order-tracking-status',[ShipMojoController::class,'shipMojoWebhookResponse']);

Route::controller(Offline_userController::class)->group(function () {
    Route::post('offline_device_login', 'offline_device_login');
});

Route::controller(Offline_inventory_recordController::class)->group(function () {
    Route::post('offline_product_scan', 'offline_product_scan');
});
