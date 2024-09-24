<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\StoreApiController;
use App\Http\Controllers\OfferApiController;
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
    // staff login
    Route::post('/api-store.store', [StoreApiController::class, 'api_store']);
    Route::get('/store.approved', [StoreApiController::class, 'approved']);
    Route::get('/store.all', [StoreApiController::class, 'all_store']);
    Route::get('/store.all.count', [StoreApiController::class, 'all_count']);
    Route::get('/store.pending', [StoreApiController::class, 'pending']);
    Route::get('/store.rejected', [StoreApiController::class, 'rejected']);
    Route::get('/store.terminated', [StoreApiController::class, 'terminated']);
    Route::get('/store.approved.count', [StoreApiController::class, 'approved_count']);
    Route::get('/store.pending.count', [StoreApiController::class, 'pending_count']);
    Route::get('/store.rejected.count', [StoreApiController::class, 'rejected_count']);
    Route::get('/store.terminated.count', [StoreApiController::class, 'terminated_count']);
    Route::get('/store.thisweek', [StoreApiController::class, 'thisweek']);
    Route::get('/store.thisweek.count', [StoreApiController::class, 'thisweek_count']);
    Route::get('/store.thismonth', [StoreApiController::class, 'thismonth']);
    Route::get('/store.thismonth.count', [StoreApiController::class, 'thismonth_count']);
    Route::get('/store.view', [StoreApiController::class, 'store_view']);
    Route::get('/store.search', [StoreApiController::class, 'store_search']);
    Route::get('/store.get.classification', [StoreApiController::class, 'store_classification']);
    Route::get('/store.get.type', [StoreApiController::class, 'store_type']);

    // offer store login
    Route::post('/api-offer.store', [OfferApiController::class, 'offer_store']);
    Route::get('/get.categories', [OfferApiController::class, 'categories']);
    Route::get('/get.sub-categories', [OfferApiController::class, 'sub_categories']);
    Route::get('/get.offer.categories', [OfferApiController::class, 'offer_categories']);
    Route::get('/get.offer.tags', [OfferApiController::class, 'tags']);
    Route::get('/get.offer.all', [OfferApiController::class, 'offer_all']);
    Route::get('/get.offer.all.count', [OfferApiController::class, 'offer_all_count']);
    Route::get('/get.offer.active', [OfferApiController::class, 'offer_active']);
    Route::get('/get.offer.active.count', [OfferApiController::class, 'offer_active_count']);
    Route::get('/get.offer.pending', [OfferApiController::class, 'offer_pending']);
    Route::get('/get.offer.pending.count', [OfferApiController::class, 'offer_pending_count']);
    Route::get('/get.offer.rejected', [OfferApiController::class, 'offer_rejected']);
    Route::get('/get.offer.rejected.count', [OfferApiController::class, 'offer_rejected_count']);
    Route::get('/get.offer.inactive', [OfferApiController::class, 'offer_inactive']);
    Route::get('/get.offer.inactive.count', [OfferApiController::class, 'offer_inactive_count']);
    Route::get('/offer.view', [OfferApiController::class, 'offer_view']);

    Route::get('/get.districts', [StoreApiController::class, 'districts']);
});