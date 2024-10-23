<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\StoreApiController;
use App\Http\Controllers\OfferApiController;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\OfferAddApiController;
use App\Http\Controllers\ProductCreateApiController;
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
    // common
    Route::get('/get.districts', [StoreApiController::class, 'districts']);
    Route::get('/store.get.classification', [StoreApiController::class, 'store_classification']);
    Route::get('/store.get.type', [StoreApiController::class, 'store_type']);
    Route::get('/get.offer.categories', [OfferApiController::class, 'offer_categories']);
    Route::get('/get.offer.tags', [OfferApiController::class, 'tags']);
    Route::get('/get.categories', [ProductCreateApiController::class, 'categories']);
    Route::get('/get.sub-categories', [ProductCreateApiController::class, 'sub_categories']);
    Route::get('/get.brands', [ProductCreateApiController::class, 'brands']);
    Route::get('/get.attributes.color', [ProductCreateApiController::class, 'color_attributes']);
    Route::get('/get.attributes.size', [ProductCreateApiController::class, 'size_attributes']);
    Route::post('/product.store', [ProductCreateApiController::class, 'store']);
    Route::post('/productUnit.store', [ProductCreateApiController::class, 'productUnitStore']);
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
    

    // offer store login
    Route::post('/api-offer.store', [OfferApiController::class, 'offer_store']);
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

    // public login
    Route::post('/customer.store', [CustomerApiController::class, 'customer_store']);
    Route::get('/offer.list', [OfferAddApiController::class, 'all_list']);
    Route::get('/offer.list.by.district', [OfferAddApiController::class, 'district_list']);
    Route::get('/offer.list.by.categories', [OfferAddApiController::class, 'categories_list']);
    Route::get('/offer.list.by.sub_categories', [OfferAddApiController::class, 'sub_categories_list']);
    Route::get('/offer.list.by.offer_categories', [OfferAddApiController::class, 'offer_categories_list']);
    Route::get('/offer.list.by.search', [OfferAddApiController::class, 'search_list']);
    Route::get('/offer.list.near.you', [OfferAddApiController::class, 'offer_near_you']);
    Route::get('/offer.list.trending', [OfferAddApiController::class, 'offer_trending']);
    Route::get('/offer.list.expiring.soon', [OfferAddApiController::class, 'offer_expiring_soon']);
    Route::get('/offer.single.view', [OfferAddApiController::class, 'offer_single_view']);
    Route::post('/offer.single.like', [OfferAddApiController::class, 'offer_like']);
    Route::post('/offer.single.deslike', [OfferAddApiController::class, 'offer_deslike']);
   
});