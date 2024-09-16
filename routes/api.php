<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\StoreApiController;
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

Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/user', [ApiAuthController::class, 'user']);
    Route::post('/api-store.store', [StoreApiController::class, 'api_store']);
    Route::get('/store.approved', [StoreApiController::class, 'approved']);
    Route::get('/store.pending', [StoreApiController::class, 'pending']);
    Route::get('/store.rejected', [StoreApiController::class, 'rejected']);
    Route::get('/store.terminated', [StoreApiController::class, 'terminated']);
    Route::get('/store.approved.count', [StoreApiController::class, 'approved_count']);
    Route::get('/store.pending.count', [StoreApiController::class, 'pending_count']);
    Route::get('/store.rejected.count', [StoreApiController::class, 'rejected_count']);
    Route::get('/store.terminated.count', [StoreApiController::class, 'terminated_count']);
    Route::get('/store.get.classification', [StoreApiController::class, 'store_classification']);
    Route::get('/store.get.type', [StoreApiController::class, 'store_type']);
    Route::get('/get.districts', [StoreApiController::class, 'districts']);
});