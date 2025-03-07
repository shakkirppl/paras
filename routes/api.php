<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\StoreApiController;
use App\Http\Controllers\OfferApiController;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\OfferAddApiController;
use App\Http\Controllers\ProductCreateApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreProductController;
use App\Http\Controllers\HomeApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\SubCategoryApiController;
use App\Http\Controllers\StoreProductApiController;
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
Route::post('/customer.store', [CustomerApiController::class, 'customer_store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/user', [ApiAuthController::class, 'user']);
    // common
    Route::get('/get.districts', [StoreApiController::class, 'districts']);
    Route::get('/get.city.districts', [StoreApiController::class, 'cityByDistricts']);
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
    Route::get('/get.temp.category.product', [ProductController::class, 'temp_category_products']);
    Route::get('/get.temp.sub-category.product', [ProductController::class, 'temp_subcategory_products']);
    Route::get('/get.temp.product', [ProductController::class, 'temp_products']);
    Route::get('/get.selected.temp.product', [ProductController::class, 'selected_temp_products']);
    Route::post('/add.new.product', [StoreProductController::class, 'add_new_product']);
// home
    Route::get('/get.offer.adds-section1', [OfferApiController::class, 'offer_adds_section1']);
    Route::get('/get.offer.adds-section2', [OfferApiController::class, 'offer_adds_section2']);
    Route::get('/get.offer.adds-section3', [OfferApiController::class, 'offer_adds_section3']);
    Route::get('/get.offer.adds-section4', [OfferApiController::class, 'offer_adds_section4']);
    Route::get('/get.offer.adds-section5', [OfferApiController::class, 'offer_adds_section5']);
    Route::get('/get.home.categories', [HomeApiController::class, 'categories']);
    Route::get('/get.home.store.list', [HomeApiController::class, 'store_list']);
    Route::get('/get.home.products.section1', [HomeApiController::class, 'home_products_section1']);
    Route::get('/get.home.products.section2', [HomeApiController::class, 'home_products_section2']);
    Route::get('/get.home.products.section3', [HomeApiController::class, 'home_products_section3']);
    Route::get('/get.home.products.section4', [HomeApiController::class, 'home_products_section4']);
    Route::get('/get.home.categories.products', [HomeApiController::class, 'category_products']);
    Route::get('/get.home.subcategories.products', [HomeApiController::class, 'subcategory_products']);
    Route::get('/get.home.selected.products', [HomeApiController::class, 'selected_products']);
    Route::get('/get.home.search.products', [HomeApiController::class, 'searchProducts']);
    Route::get('/get.home.upto.40', [HomeApiController::class, 'upto_40_products']);
    Route::get('/get.home.upto.50', [HomeApiController::class, 'upto_50_products']);
    Route::get('/get.home.upto.60', [HomeApiController::class, 'upto_60_products']);

    // category
    Route::get('/get.category.products.section1', [CategoryApiController::class, 'category_products_section1']);
    Route::get('/get.category.products.section2', [CategoryApiController::class, 'category_products_section2']);
    Route::get('/get.category.products.section3', [CategoryApiController::class, 'category_products_section3']);
    Route::get('/get.category.products.section4', [CategoryApiController::class, 'category_products_section4']);
    Route::get('/get.category.upto.40', [CategoryApiController::class, 'upto_40_products']);
    Route::get('/get.category.upto.50', [CategoryApiController::class, 'upto_50_products']);
    Route::get('/get.category.upto.60', [CategoryApiController::class, 'upto_60_products']);
    
        // subcategory
    Route::get('/get.sub-category.products.section1', [SubCategoryApiController::class, 'category_products_section1']);
    Route::get('/get.sub-category.products.section2', [SubCategoryApiController::class, 'category_products_section2']);
    Route::get('/get.sub-category.products.section3', [SubCategoryApiController::class, 'category_products_section3']);
    Route::get('/get.sub-category.products.section4', [SubCategoryApiController::class, 'category_products_section4']);
    Route::get('/get.sub-category.upto.40', [SubCategoryApiController::class, 'upto_40_products']);
    Route::get('/get.sub-category.upto.50', [SubCategoryApiController::class, 'upto_50_products']);
    Route::get('/get.sub-category.upto.60', [SubCategoryApiController::class, 'upto_60_products']);
    // store product
    Route::get('/get.store.list', [HomeApiController::class, 'store_list']);
    Route::get('/get.store.category.products.list', [HomeApiController::class, 'store_category_products_list']);
    Route::get('/get.store.subcategory.products.list', [HomeApiController::class, 'store_subcategory_products_list']);
    Route::get('/get.store.products.list', [HomeApiController::class, 'store_products_list']);
    Route::get('/get.store.products.section1', [StoreProductApiController::class, 'store_products_section1']);
    Route::get('/get.store.products.section2', [StoreProductApiController::class, 'store_products_section2']);
    Route::get('/get.store.products.section3', [StoreProductApiController::class, 'store_products_section3']);
    Route::get('/get.store.products.section4', [StoreProductApiController::class, 'store_products_section4']);
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

    Route::get('/offer.list', [OfferAddApiController::class, 'all_list']);
    Route::get('/offer.list.by.district', [OfferAddApiController::class, 'district_list']);
    Route::get('/offer.list.by.district.city', [OfferAddApiController::class, 'city_district_list']);
    Route::get('/offer.list.by.store', [OfferAddApiController::class, 'store_list']);
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