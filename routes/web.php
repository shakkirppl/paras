<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreTypeController;
use App\Http\Controllers\StoreClassificationsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LuckyDrawController;
use App\Http\Controllers\LuckyDrawGiftesController;
use App\Http\Controllers\LuckyDrawImageController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferAddsController;
use App\Http\Controllers\OtherTransactionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function() {
    //   $mytime = Carbon\Carbon::now();
    //  return $mytime->toDateTimeString();
    $exitCode = Artisan::call('cache:clear');
     $exitCode = Artisan::call('config:clear');
     $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>cleared</h1>';
});
Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard', [DashboardController::class,'dashboard']);
    Route::resource('store-type', StoreTypeController::class);
    Route::resource('store-classifications', StoreClassificationsController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('lucky-draws', LuckyDrawController::class);
    Route::resource('employees', EmployeesController::class);
    
    Route::prefix('lucky_draws/{lucky_draw}/gifts')->group(function () {
        Route::get('create', [LuckyDrawGiftesController::class, 'create'])->name('lucky_draw_giftes.create');
        Route::post('store', [LuckyDrawGiftesController::class, 'store'])->name('lucky_draw_giftes.store');
        Route::get('{gift}/edit', [LuckyDrawGiftesController::class, 'edit'])->name('lucky_draw_giftes.edit');
        Route::put('{gift}', [LuckyDrawGiftesController::class, 'update'])->name('lucky_draw_giftes.update');
        Route::delete('{gift}', [LuckyDrawGiftesController::class, 'destroy'])->name('lucky_draw_giftes.destroy');
        
    });
    Route::post('lucky_draws/{lucky_draw}/images', [LuckyDrawImageController::class, 'store'])->name('lucky_draw_images.store');
    Route::delete('lucky_draws/{lucky_draw}/images/{image}', [LuckyDrawImageController::class, 'destroy'])->name('lucky-draw-images.destroy');
    Route::resource('coupons', CouponController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('product-attributes', ProductAttributeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('offer-adds', OfferAddsController::class);
    Route::get('offer-adds.view/{id}', [OfferAddsController::class, 'show'])->name('offer-adds.view');
    
    Route::post('offer-adds-product.store', [OfferAddsController::class, 'offer_adds_store'])->name('offer-adds-product.store');
    Route::get('offer-adds.remove/{id}', [OfferAddsController::class, 'show'])->name('offer-adds.remove');
    
    Route::post('products-sku.store', [ProductController::class, 'storeSku'])->name('products-sku.store');
    Route::delete('product-sku/{id}', [ProductController::class, 'destroySku'])->name('product-sku.destroy');
    Route::post('products-update', [ProductController::class, 'updateProduct'])->name('products.update');
    Route::post('products-image.store', [ProductController::class, 'updateImages'])->name('products-image.store');
    Route::get('delete.image/{id}', [ProductController::class, 'deleteImage'])->name('delete.image');
   
    Route::get('products.addon/{id}', [ProductController::class, 'addon']);
    Route::get('products.edit/{id}', [ProductController::class, 'edit']);
    Route::get('products.show/{id}', [ProductController::class, 'show']);
    Route::get('products.image/{id}', [ProductController::class, 'image']);
    Route::get('categories/get-subcategories', [CategoryController::class, 'getSubCategories'])->name('categories.getSubCategories');
    Route::get('/get-subcategories', [ProductController::class, 'getSubCategories'])->name('getSubCategories');

// Route to get products by sub-category
    Route::get('/get-products-by-subcategory', [ProductController::class, 'getProductsBySubCategory'])->name('getProductsBySubCategory');
});
Route::get('/privacy-policy', [OtherTransactionController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('/terms-conditions', [OtherTransactionController::class, 'terms_conditions'])->name('terms-conditions');
Route::get('/support', [OtherTransactionController::class, 'support'])->name('support');

require __DIR__.'/auth.php';
